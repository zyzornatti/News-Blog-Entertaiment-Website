<?php

  $status = [];
  try{
    if(isset ($_POST['musictitle'])){
      $musictitle = $_POST['musictitle'];
      $music_slug = cleans($musictitle);
      $chck_slug = countContent2($conn, "hom_mav", "hom_mav_title_slug", $music_slug);
      if($chck_slug > 0){
        $status['failed'] = "Music has already been uploaded!";
      }
    }
    if(isset ($_POST['admin_id'])){
      $admin = $_POST['admin_id'];
    }
    if(isset ($_POST['category'])){
      $category = $_POST['category'];
    }
    if(isset ($_POST['body'])){
      $bb = $_POST['body'];
      $body = str_replace("uploads/POSTS", "/uploads/POSTS", $bb);
    }
    if(isset ($_POST['uploadlink'])){
      $uploadlink = $_POST['uploadlink'];
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

      $ad = $conn->prepare("INSERT INTO hom_mav VALUES(NULL,:musictitle,:slug,:category,:author,:body,:uploadlink,:img,:hi,:vs,:ht,NOW(),NOW())");
      $ad->bindParam(":musictitle", $musictitle);
      $ad->bindParam(":slug", $music_slug);
      $ad->bindParam(":category", $category);
      $ad->bindParam(":author", $admin);
      $ad->bindParam(":body", $body);
      $ad->bindParam(":uploadlink", $uploadlink);
      $ad->bindParam(":img", $imageNewName);
      $ad->bindParam(":hi", $hash_id);
      $ad->bindParam(":vs", $visibility);
      $ad->bindParam(":ht", $hits);
      $ad->execute();

      move_uploaded_file($imageTmpName, $imageDestination);
        $desc = "Uploaded a music - ".$_POST['musictitle'];
        $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
        $ad_ac->bindParam(":ad", $_POST['admin_id']);
        $ad_ac->bindParam(":ds", $desc);
        $ad_ac->execute();
        $status['success'] = "Successful";
        $_SESSION['msg'] = "Music Added Successfully";

    }

  } catch(Exception $e){
    // $status['failed'] = $e;
    $status['failed'] = "Something went wrong!!!";
  }

  $res = json_encode($status);
  echo $res;

?>
