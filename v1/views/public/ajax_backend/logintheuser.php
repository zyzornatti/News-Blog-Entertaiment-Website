<?php
$status = [];
try {
  if(isset ($_POST['rd'])){
    $rdt = base64url_decode($_POST['rd']);
    $status['rdt'] = $rdt;
  }

  if(isset ($_POST['username'])){
    $username = $_POST['username'];
  }

  if(isset ($_POST['pword'])){
    $pword = $_POST['pword'];
  }
  $check_username = $conn->prepare("SELECT * FROM public WHERE username = :us OR email = :em");
  $check_username->bindParam(":us", $username);
  $check_username->bindParam(":em", $username);
  $check_username->execute();

  $confirm = $check_username->fetch(PDO::FETCH_BOTH);
  if($check_username->rowCount() > 0 && password_verify($pword, $confirm['password'])){
    if($confirm['status'] == "OK"){
      $_SESSION['user'] = $confirm['user_hash'];
      // $login_time = time();
      $desc = "Logged In";
      $ad_ac = $conn->prepare("INSERT INTO public_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
      $ad_ac->bindParam(":ad", $confirm['user_hash']);
      $ad_ac->bindParam(":ds", $desc);
      $ad_ac->execute();

      $status['success'] = "successful";
    }else{
      $status['failed'] = "Your Account Has Been Suspended!!!";
    }

    // $_SESSION['user'] = $confirm['user_id'];
    // $status['success'] = "successful";
  }else{
    $status['failed'] = "Either username or password is incorrect";
  }
} catch(Exception $e){
    $status['failed'] = $e;
  // $status['failed'] = "Something went wrong";
}
$res = json_encode($status);
echo $res;



 ?>
