<?php
$status = [];
try{
  $adminlogin = $conn->prepare("SELECT * FROM admin WHERE email=:em OR admin_username=:usr");
  $adminlogin->bindParam(":em",$_POST['email']);
  $adminlogin->bindParam(":usr",$_POST['email']);
  $adminlogin->execute();

  $row = $adminlogin->fetch(PDO::FETCH_BOTH);

  if ($adminlogin->rowCount() > 0 && password_verify($_POST['password'], $row['password'])){
    if($row['status'] == "OK"){
      $_SESSION['admin_id'] = $row['admin_hash'];
      // $login_time = time();
      $desc = "Logged In";
      $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
      $ad_ac->bindParam(":ad", $row['admin_hash']);
      $ad_ac->bindParam(":ds", $desc);
      $ad_ac->execute();

      $status['success'] = "successful";
    }else{
      $status['failed'] = "Your Account Has Been Suspended!!!";
    }
  }else{
    $status['failed'] = "Either Password or Username is Incorrect";
  }
}catch (Exception $e){
  // $status['failed'] = $e;
  $status['failed'] = "Something Went Wrong";
}

$response = json_encode($status);
echo $response;



 ?>
