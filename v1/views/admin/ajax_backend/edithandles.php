<?php
$status = [];
try{
  $facebook_usr = $_POST['fbu'];
  $twitter_usr = $_POST['twu'];
  $instagram_usr = $_POST['igu'];
  $id = $_POST['id'];

  $author = $conn->prepare("UPDATE admin SET facebook_username = :fbu, twitter_username = :twu, instagram_username = :igu WHERE admin_hash = :au");
  $author->bindParam(":fbu", $facebook_usr);
  $author->bindParam(":twu", $twitter_usr);
  $author->bindParam(":igu", $instagram_usr);
  $author->bindParam(":au", $id);
  $author->execute();

  $desc = "Edited Author Social Media Handles";
  $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
  $ad_ac->bindParam(":ad", $_POST['id']);
  $ad_ac->bindParam(":ds", $desc);
  $ad_ac->execute();

  $status['success'] = "Successful";
  $_SESSION['msg'] = "You have successfully updated your social media handles";

} catch(Exception $e){
  // $status['failed'] = $e;
  $status['failed'] = "Something went wrong!!!";
}

$res = json_encode($status);
echo $res;

 ?>
