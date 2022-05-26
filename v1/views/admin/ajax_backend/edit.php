<?php

$status = [];
  try{
    if(isset ($_POST['id'])){
      $id = $_POST['id'];
    }
    if(isset ($_POST['title'])){
      $title = $_POST['title'];
      $post_slug = cleans($title);
      $chck_slug = countContent3($conn, "web_content", "hash_id", $id, "title_slug", $post_slug);
      if($chck_slug > 0){
        $status['failed'] = "There is a post with this title already, try another one";
      }
    }
    if(isset ($_POST['section'])){
      $section = $_POST['section'];
    }
    if(isset ($_POST['category'])){
      $category = $_POST['category'];
    }
    if(isset ($_POST['body'])){
      $bb = $_POST['body'];
      $body = str_replace("uploads/POSTS", "/uploads/POSTS", $bb);
    }

    if(empty ($status['failed'])){
      $ad = $conn->prepare("UPDATE web_content SET title=:title, title_slug=:slug, section=:section, category_id=:category, body=:body WHERE hash_id = :id");
      $ad->bindParam(":title", $title);
      // $ad->bindParam(":author", $_POST['author']);
      $ad->bindParam(":slug", $post_slug);
      $ad->bindParam(":section", $section);
      $ad->bindParam(":category", $category);
      $ad->bindParam(":body", $body);
      $ad->bindParam(":id", $id);
      $ad->execute();

      $desc = "Edited a post - ".$title;
      $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
      $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
      $ad_ac->bindParam(":ds", $desc);
      $ad_ac->execute();
      $status['success'] = "Successful";
      $_SESSION['msg'] = "Post Edited Successfully";
    }

  } catch(Exception $e){
    // $status['failed'] = $e;
    $status['failed'] = "Something went wrong!!!";
  }

  $res = json_encode($status);
  echo $res;

?>
