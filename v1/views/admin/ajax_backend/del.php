<?php

$status = [];

try{
  //blog
  if(isset ($_POST['blog'])){

    $row = fetchRecord2($conn, "web_content", "web_content_id", $_POST['blog']);
    $previous_image = $row['image'];
    $prevImg_destination = 'uploads/POSTS/'.$previous_image;
    ajaxDeleteRecord($conn, "web_content", "web_content_id", $_POST['blog']);

    if(unlink($prevImg_destination)){
      $desc = "Deleted a post - ".$row['title'];
      $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
      $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
      $ad_ac->bindParam(":ds", $desc);
      $ad_ac->execute();
      $status['success'] = "Post Deleted Successfully!!!";
    }

  }
  //music
  if(isset ($_POST['music'])){

    $row = fetchRecord2($conn, "hom_mav", "hom_mav_id", $_POST['music']);
    $previous_image = $row['hom_mav_image'];
    $prevImg_destination = 'uploads/POSTS/'.$previous_image;
    ajaxDeleteRecord($conn, "hom_mav", "hom_mav_id", $_POST['music']);

    if(unlink($prevImg_destination)){
      $desc = "Deleted a music - ".$row['hom_mav_title'];
      $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
      $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
      $ad_ac->bindParam(":ds", $desc);
      $ad_ac->execute();
      $status['success'] = "Music Deleted Successfully!!!";
    }

  }

  //web section
  if(isset ($_POST['sec'])){
    $row = fetchRecord2($conn, "web_section", "section_id", $_POST['sec']);
    ajaxDeleteRecord($conn, "web_section", "section_id", $_POST['sec']);
    $desc = "Deleted a web section - ".$row['web_section_name'];
    $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
    $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
    $ad_ac->bindParam(":ds", $desc);
    $ad_ac->execute();
    $status['success'] = "Web Section Deleted Successfully!!!";
  }

  //category
  if(isset ($_POST['cat'])){
    $row = fetchRecord2($conn, "web_category", "web_category_id", $_POST['cat']);
    ajaxDeleteRecord($conn, "web_category", "web_category_id", $_POST['cat']);
    $desc = "Deleted a web category - ".$row['web_category_name'];
    $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
    $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
    $ad_ac->bindParam(":ds", $desc);
    $ad_ac->execute();
    $status['success'] = "Category Deleted Successfully!!!";
  }

  //contact
  if(isset ($_POST['ct'])){
    $row = fetchRecord2($conn, "contact", "id", $_POST['ct']);
    $previous_image = $row['contact_image'];
    $prevImg_destination = 'uploads/CONTACT/'.$previous_image;
    ajaxDeleteRecord($conn, "contact", "id", $_POST['ct']);

    if(unlink($prevImg_destination)){
      $desc = "Deleted a contact post";
      $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
      $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
      $ad_ac->bindParam(":ds", $desc);
      $ad_ac->execute();
      $status['success'] = "Post Deleted Successfully!!!";
    }
  }

  //about
  if(isset ($_POST['abt'])){

    $row = fetchRecord2($conn, "about", "id", $_POST['abt']);
    $previous_image = $row['about_image'];
    $prevImg_destination = 'uploads/ABOUT/'.$previous_image;
    ajaxDeleteRecord($conn, "about", "id", $_POST['abt']);

    if(unlink($prevImg_destination)){
      $desc = "Deleted an about post";
      $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
      $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
      $ad_ac->bindParam(":ds", $desc);
      $ad_ac->execute();
      $status['success'] = "Post Deleted Successfully!!!";
    }

  }

  //user
  if(isset ($_POST['usr'])){
    $row = fetchRecord2($conn, "public", "user_id", $_POST['usr']);
    ajaxDeleteRecord($conn, "public", "user_id", $_POST['usr']);
    $desc = "Deleted a user account - ".$row['username'];
    $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
    $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
    $ad_ac->bindParam(":ds", $desc);
    $ad_ac->execute();
    $status['success'] = "User Account Deleted Successfully!!!";
  }

  //admin
  if(isset ($_POST['admid'])){
    $row = fetchRecord2($conn, "admin", "admin_id", $_POST['admid']);
    ajaxDeleteRecord($conn, "admin", "admin_id", $_POST['admid']);
    $desc = "Deleted an admin account - ".$row['admin_username'];
    $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
    $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
    $ad_ac->bindParam(":ds", $desc);
    $ad_ac->execute();
    $status['success'] = "Admin Account Deleted Successfully!!!";
  }

  //meme category
  if(isset ($_POST['memec'])){
    $row = fetchRecord2($conn, "hom_memes_category", "hom_memes_category_id", $_POST['memec']);
    $cat_name = $row['memes_category_name'];
    ajaxDeleteRecord($conn, "hom_memes_category", "hom_memes_category_id", $_POST['memec']);

    $desc = "Deleted a meme category - (".$cat_name.")";
    $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
    $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
    $ad_ac->bindParam(":ds", $desc);
    $ad_ac->execute();
    $status['success'] = "Meme Category Deleted Successfully!!!";
  }
  //music category
  if(isset ($_POST['musiccat'])){
    $row = fetchRecord2($conn, "hom_mav_category", "hom_mav_category_id", $_POST['musiccat']);
    $cat_name = $row['hom_mav_category_name'];
    ajaxDeleteRecord($conn, "hom_mav_category", "hom_mav_category_id", $_POST['musiccat']);

    $desc = "Deleted a music category - (".$cat_name.")";
    $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
    $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
    $ad_ac->bindParam(":ds", $desc);
    $ad_ac->execute();
    $status['success'] = "Music Category Deleted Successfully!!!";
  }

  //meme
  if(isset ($_POST['meme'])){

    $row = fetchRecord2($conn, "hom_memes", "hom_memes_id", $_POST['meme']);
    $previous_image = $row['memes_image'];
    $prevImg_destination = 'uploads/MEMES/'.$previous_image;
    ajaxDeleteRecord($conn, "hom_memes", "hom_memes_id", $_POST['meme']);

    if(unlink($prevImg_destination)){
      $desc = "Deleted a meme";
      $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
      $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
      $ad_ac->bindParam(":ds", $desc);
      $ad_ac->execute();
      $status['success'] = "Meme Deleted Successfully!!!";
    }

  }

 }catch(Exception $e){
  $status['failed'] = $e;
  // $status['failed'] = "Something Went wrong!!! Try Again";
}

$res = json_encode($status);
echo $res;

 ?>
