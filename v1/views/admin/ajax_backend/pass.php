<?php
// session_start();
$status = [];
try{
  if(isset ($_POST['oldpword'])){
    $id = $_POST['admin_id'];
    $row = fetchRecord2($conn, "admin", "admin_hash", $id);

    if(!password_verify($_POST['oldpword'], $row['password'])){
      $status['failed'] = "Old password entered is incorrect!!!";
    }
    if($_POST['newpword'] !== $_POST['newcpword']){
      $status['failed'] = "New Password Missmatch";
    }else{
      $hash = password_hash($_POST['newpword'], PASSWORD_BCRYPT);
    }
  }
  if(empty ($status['failed'])){
    $pass = $conn->prepare("UPDATE admin SET password=:pw WHERE admin_hash=:id");
    $pass->bindParam(":id", $id);
    $pass->bindParam(":pw", $hash);
    $pass->execute();

    $desc = "Changed Password";
    $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
    $ad_ac->bindParam(":ad", $id);
    $ad_ac->bindParam(":ds", $desc);
    $ad_ac->execute();
    $status['success'] = "success";
    $_SESSION['msg'] = "Password Changed successfully";
  }

} catch(Exception $e){
  // $status['failed'] = $e;
  $status['failed'] = "Something Went Wrong!!!";
}
$res = json_encode($status);
echo $res;

 ?>
