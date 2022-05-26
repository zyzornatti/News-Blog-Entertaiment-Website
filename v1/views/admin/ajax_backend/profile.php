<?php
$status = [];
try{
  $prf = $conn->prepare("UPDATE admin SET name=:nm, email=:em, phone_number=:pn, admin_username=:usr WHERE admin_hash=:id");
  $prf->bindParam(":id",$_POST['id']);
  $prf->bindParam(":nm",$_POST['name']);
  $prf->bindParam(":em",$_POST['email']);
  $prf->bindParam(":pn",$_POST['pnum']);
  $prf->bindParam(":usr",$_POST['username']);
  $prf->execute();

  $desc = "Edited Profile";
  $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
  $ad_ac->bindParam(":ad", $_POST['id']);
  $ad_ac->bindParam(":ds", $desc);
  $ad_ac->execute();

  $status['success'] = "successful";
  $_SESSION['msg'] = "You have successfully edited your details";

}catch(Exception $e){
  $status['failed'] = $e;
}

$res = json_encode($status);
echo $res;

 ?>
