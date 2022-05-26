<?php

  $status = [];
  try{
    if(isset ($_POST['title'])){
      $title = $_POST['title'];
      $post_slug = cleans($title);
      $chck_slug = countContent2($conn, "web_content", "title_slug", $post_slug);
      if($chck_slug > 0){
        $status['failed'] = "There is a post with this title already, try another one";
      }
    }
    if(isset ($_POST['admin_id'])){
      $admin = $_POST['admin_id'];
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

    $image = $_FILES['image'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    $imageNewExt = strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
    $img_allowed = array('jpg', 'jpeg', 'png');
    $imageNewName = md5($imageName).time().".".$imageNewExt;
    // $imageNewName = uniqid('', true).".".$imageNewExt;
    $imageDestination = 'uploads/POSTS/'.$imageNewName;

    if (!in_array($imageNewExt, $img_allowed)){

        $status['failed'] = "Image extension not allowed!!!";

      }
      if ($imageError !== 0){

        $status['failed'] = "Error Uploading Image!!!";

      }
      if ($imageSize > 1000000){

        $status['failed'] = "Image too large!!!";

      }

    if(empty ($status['failed'])){
      $hits = 0;
      $visibility = "show";
      $hash_id = rand(1000, 9999).time();

      $ad = $conn->prepare("INSERT INTO web_content VALUES(NULL,:title,:slug,:author,:section,:category,:body,:img,:hi,:vs,:ht,NOW(),NOW())");
      $ad->bindParam(":title", $title);
      $ad->bindParam(":slug", $post_slug);
      $ad->bindParam(":author", $admin);
      $ad->bindParam(":section", $section);
      $ad->bindParam(":category", $category);
      $ad->bindParam(":body", $body);
      $ad->bindParam(":img", $imageNewName);
      $ad->bindParam(":hi", $hash_id);
      $ad->bindParam(":vs", $visibility);
      $ad->bindParam(":ht", $hits);
      $ad->execute();

      move_uploaded_file($imageTmpName, $imageDestination);
      $desc = "Added a post - ".$_POST['title'];
      $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
      $ad_ac->bindParam(":ad", $_POST['admin_id']);
      $ad_ac->bindParam(":ds", $desc);
      $ad_ac->execute();
      $status['success'] = "Successful";
      $_SESSION['msg'] = "Post Added Successfully";
    }

  } catch(Exception $e){
    // $status['failed'] = $e;
    $status['failed'] = "Something went wrong!!!";
  }

  $res = json_encode($status);
  echo $res;

?>
