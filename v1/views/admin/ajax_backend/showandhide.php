<?php
$status = [];

try{
  if(isset ($_POST['postid'])){
    $postid = $_POST['postid'];
    $value = fetchRecord2($conn, "web_content", "web_content_id", $postid);

    if($value['visibility'] == "show"){
      $new_value = "hide";
      $sh = $conn->prepare("UPDATE web_content SET visibility = :vs WHERE web_content_id= :id");
      $sh->bindParam(":vs", $new_value);
      $sh->bindParam(":id", $postid);
      $sh->execute();
      $status['success'] = "This post will no longer be visible to users!";
    }else{
      $new_value = "show";
      $sh = $conn->prepare("UPDATE web_content SET visibility = :vs WHERE web_content_id= :id");
      $sh->bindParam(":vs", $new_value);
      $sh->bindParam(":id", $postid);
      $sh->execute();
      $status['success'] = "This post will now be visible to users!";
    }
  }

  if(isset ($_POST['musicid'])){
    $musicid = $_POST['musicid'];
    $value = fetchRecord2($conn, "hom_mav", "hom_mav_hash_id", $musicid);

    if($value['hom_mav_visibility'] == "show"){
      $new_value = "hide";
      $sh = $conn->prepare("UPDATE hom_mav SET hom_mav_visibility = :vs WHERE hom_mav_hash_id= :id");
      $sh->bindParam(":vs", $new_value);
      $sh->bindParam(":id", $musicid);
      $sh->execute();
      $status['success'] = "This music will no longer be visible to users!";
    }else{
      $new_value = "show";
      $sh = $conn->prepare("UPDATE hom_mav SET hom_mav_visibility = :vs WHERE hom_mav_hash_id= :id");
      $sh->bindParam(":vs", $new_value);
      $sh->bindParam(":id", $musicid);
      $sh->execute();
      $status['success'] = "This music will now be visible to users!";
    }
  }

  if(isset ($_POST['memeid'])){
    $memeid = $_POST['memeid'];
    $value = fetchRecord2($conn, "hom_memes", "hom_memes_id", $memeid);

    if($value['visibility'] == "show"){
      $new_value = "hide";
      $sh = $conn->prepare("UPDATE hom_memes SET visibility = :vs WHERE hom_memes_id= :id");
      $sh->bindParam(":vs", $new_value);
      $sh->bindParam(":id", $memeid);
      $sh->execute();
      $status['success'] = "This meme will no longer be visible to users!";
    }else{
      $new_value = "show";
      $sh = $conn->prepare("UPDATE hom_memes SET visibility = :vs WHERE hom_memes_id= :id");
      $sh->bindParam(":vs", $new_value);
      $sh->bindParam(":id", $memeid);
      $sh->execute();
      $status['success'] = "This meme will now be visible to users!";
    }

  }

} catch(Exception $e){
  // $status['failed'] = $e;
  $status['failed'] = "Something went wrong!!!";
}


$res = json_encode($status);
echo $res;
 ?>
