<?php
$status = [];
try{
  $ad = $_POST['admin_description'];
  $id = $_POST['admin_id'];

  $author = $conn->prepare("UPDATE admin SET admin_description = :ad WHERE admin_hash = :au");
  $author->bindParam(":ad", $ad);
  $author->bindParam(":au", $id);
  $author->execute();

  $desc = "Edited Author Profile";
  $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
  $ad_ac->bindParam(":ad", $_POST['admin_id']);
  $ad_ac->bindParam(":ds", $desc);
  $ad_ac->execute();

  $status['success'] = "Successful";
  $_SESSION['msg'] = "You have successfully updated your author bio";

} catch(Exception $e){
  // $status['failed'] = $e;
  $status['failed'] = "Something went wrong!!!";
}

$res = json_encode($status);
echo $res;

 ?>
