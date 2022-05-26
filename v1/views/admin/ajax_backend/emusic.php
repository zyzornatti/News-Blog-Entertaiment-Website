<?php

$status = [];
  try{
    if(isset ($_POST['id'])){
      $id = $_POST['id'];
    }
    if(isset ($_POST['musictitle'])){
      $musictitle = $_POST['musictitle'];
      $music_slug = cleans($musictitle);
      $chck_slug = countContent3($conn, "hom_mav", "hom_mav_hash_id", $id, "hom_mav_title_slug", $music_slug);
      if($chck_slug > 0){
        $status['failed'] = "There is a music post with this title already";
      }
    }
    if(isset ($_POST['category'])){
      $category = $_POST['category'];
    }
    if(isset ($_POST['body'])){
      $bb = $_POST['body'];
      $body = str_replace("uploads/MUSIC", "/uploads/MUSIC", $bb);
    }
    if(isset ($_POST['uploadlink'])){
      $uploadlink = $_POST['uploadlink'];
    }

    if(empty ($status['failed'])){
      $ad = $conn->prepare("UPDATE hom_mav SET hom_mav_title=:title, hom_mav_title_slug=:slug, hom_mav_category_id=:category, hom_mav_content=:body, hom_mav_link=:hml WHERE hom_mav_hash_id = :id");
      $ad->bindParam(":title", $musictitle);
      $ad->bindParam(":slug", $music_slug);
      $ad->bindParam(":category", $category);
      $ad->bindParam(":body", $body);
      $ad->bindParam(":hml", $uploadlink);
      $ad->bindParam(":id", $id);
      $ad->execute();

      $desc = "Edited a music post - ".$musictitle;
      $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
      $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
      $ad_ac->bindParam(":ds", $desc);
      $ad_ac->execute();
      $status['success'] = "Successful";
      $_SESSION['msg'] = "Music Post Edited Successfully";
    }

  } catch(Exception $e){
    $status['failed'] = $e;
    // $status['failed'] = "Something went wrong!!!";
  }

  $res = json_encode($status);
  echo $res;

?>
