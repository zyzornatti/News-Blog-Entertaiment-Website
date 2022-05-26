<?php
$status = [];
try{
  // $check_email = countRecord($conn, "public", "email", $_POST['email']);

  // $check_pnum = countRecord($conn, "public", "phone_number", $_POST['pnum']);

  // $check_user = countRecord($conn, "public", "username", $_POST['username']);

  if(isset ($_POST['rd'])){
    $rdt = base64url_decode($_POST['rd']);
    $status['rdt'] = $rdt;
  }
  
  if(isset ($_POST['name'])){
    $name = $_POST['name'];
  }

  if(isset ($_POST['email'])){
    if(!filter_var ($_POST['email'], FILTER_VALIDATE_EMAIL)){
      $status['failed'] = "Enter a valid Email";
    }else{
      $check_email = $conn->prepare("SELECT * FROM public WHERE email=:email");
      $check_email->bindParam(":email", $_POST['email']);
      $check_email->execute();
      if($check_email->rowCount() > 0){
        $status['failed'] = "Email Already Exist!!!";
      }else{
        $email = $_POST['email'];
      }
    }
  }

  if(isset ($_POST['pnum'])){
    if(!is_numeric ($_POST['pnum'])){
    	$status['failed']= "Phone number can only be numeric value";
    }else{
      $check_pnum = $conn->prepare("SELECT * FROM public WHERE phone_number=:email");
      $check_pnum->bindParam(":email", $_POST['pnum']);
      $check_pnum->execute();
      if($check_pnum->rowCount() > 0){
        $status['failed'] = "Phone Number Already Used!!!";
      }else{
        $pnum = $_POST['pnum'];
      }
    }
  }

  if(isset ($_POST['username'])){
    $check_user = $conn->prepare("SELECT * FROM public WHERE username=:us");
    $check_user->bindParam(":us", $_POST['username']);
    $check_user->execute();
    if($check_user->rowCount() > 0){
      $status['failed'] = "Username Taken, Try another one!!!";
    }else{
      $username = $_POST['username'];
    }
  }

  if(isset ($_POST['pword'])){
    $pword = $_POST['pword'];
    $hash = password_hash($pword, PASSWORD_BCRYPT);
  }

  if(empty ($status['failed'])){
    $user_hash = rand(1000, 9999).time();
    $stat = "OK";
    $reg_user = $conn->prepare("INSERT INTO public VALUES (NULL, :nm,:em,:pn,:us,:ps,:st,:uh,NOW(),NOW())");
    $reg_user->bindParam(":nm", $name);
    $reg_user->bindParam(":em", $email);
    $reg_user->bindParam(":pn", $pnum);
    $reg_user->bindParam(":us", $username);
    $reg_user->bindParam(":ps", $hash);
    $reg_user->bindParam(":st", $stat);
    $reg_user->bindParam(":uh", $user_hash);
    $reg_user->execute();

    $status['success'] = "successful";
    $_SESSION['msg'] = "You have successfully registered, you can now login!";
  }

}catch(Exception $e){
  // $status['failed'] = $e;
  $status['failed'] = "Something went wrong, try again!!!";
}

$res = json_encode($status);
echo $res;

 ?>
