<?php
$status = [];
try{
  if(isset ($_POST['name'])){
    $name = $_POST['name'];
  }

  if(isset ($_POST['email'])){
    if(!filter_var ($_POST['email'], FILTER_VALIDATE_EMAIL)){
      $status['failed'] = "Enter a valid Email";
    }else{
      $email1 = $conn->prepare("SELECT * FROM admin WHERE email=:email");
      $email1->bindParam(":email", $_POST['email']);
      $email1->execute();

      if($email1->rowCount() > 0){
        $status['failed'] = "Email Already Exist";
      }else{
        $email = $_POST['email'];
      }
    }

  }
  if(isset ($_POST['pnum'])){

    if(!is_numeric ($_POST['pnum'])){
    	$status['failed']= "Phone number can only be numeric value";
    }else{
      $usr = $conn->prepare("SELECT * FROM admin WHERE phone_number=:pnum");
      $usr->bindParam(":pnum", $_POST['pnum']);
      $usr->execute();

      if($usr->rowCount() > 0){
        $status['failed'] = "Phone Number Already Used";
      }else{
        $pnum = $_POST['pnum'];
      }
    }
  }

  if(isset ($_POST['username'])){
    $usr = $conn->prepare("SELECT * FROM admin WHERE admin_username=:usr");
    $usr->bindParam(":usr", $_POST['username']);
    $usr->execute();

    if($usr->rowCount() > 0){
      $status['failed'] = "Username Taken, Try another one!!!";
    }else{
      $username = $_POST['username'];
    }
  }

  if($_POST['pword'] !== $_POST['cpword']){
    $status['failed'] = "Password Missmatch";
  }else {
    $pword = $_POST['pword'];
    $hash = password_hash($pword, PASSWORD_BCRYPT);
  }

  if(isset ($_POST['aut_code'])){
    $aut_code = $_POST['aut_code'];
    $stt = 0;
    // $check = fetchRecord2($conn, "admin_auth", "authentication_code", $aut_code);
    $check = $conn->prepare("SELECT * FROM admin_auth WHERE authentication_code=:aut");
    $check->bindParam(":aut", $aut_code);
    $check->execute();

    if($check->rowCount() > 0){
      // $chk = fetchContentW2C($conn, "admin_auth", "authentication_code", $aut_code, "status", $stt);
      $chk = $conn->prepare("SELECT * FROM admin_auth WHERE authentication_code=:aut AND status=:st");
      $chk->bindParam(":aut", $aut_code);
      $chk->bindParam(":st", $stt);
      $chk->execute();

      if($chk->rowCount() > 0){
        // $status['success'] = "Successful";
          if(empty ($status['failed'])){
              $rank = 0;
              $fb = "www.facebook.com/enteryourusername";
              $tw = "www.twitter.com/enteryourusername";
              $ig = "www.instagram.com/enteryourusername";
              $sts = "OK";
              $des = "home of memes";
              $dp = "dummy.png";
              // $admin_h = uniqid($name, true);
              // $admin_hash = md5($admin_h)."ad";
              $admin_hash = rand(1000, 9999).time();
              $adminsignup = $conn->prepare("INSERT INTO admin VALUES(NULL, :nm,:em,:pn,:us,:pw,:st,:rnk,:fbu,:twu,:igu,:dp,:ds,:hs, NOW(),NOW() )");
              $adminsignup->bindParam(":nm",$name);
              $adminsignup->bindParam(":em",$email);
              $adminsignup->bindParam(":pn",$pnum);
              $adminsignup->bindParam(":us",$username);
              $adminsignup->bindParam(":pw",$hash);
              $adminsignup->bindParam(":st",$sts);
              $adminsignup->bindParam(":rnk",$rank);
              $adminsignup->bindParam(":fbu",$fb);
              $adminsignup->bindParam(":twu",$tw);
              $adminsignup->bindParam(":igu",$ig);
              $adminsignup->bindParam(":dp",$dp);
              $adminsignup->bindParam(":ds",$des);
              $adminsignup->bindParam(":hs",$admin_hash);
              $adminsignup->execute();

              $st = 1;
              $date_used = date("Y-m-d")." at ".date("h:i:s");

              $stmt = $conn->prepare("UPDATE admin_auth SET status = :st, aut_user_email = :em, date_used = :dt WHERE authentication_code = :aut");
              $stmt->bindParam(":st", $st);
              $stmt->bindParam(":em", $email);
              $stmt->bindParam(":dt", $date_used);
              $stmt->bindParam(":aut", $aut_code);
              $stmt->execute();

              $_SESSION['msg'] = "You have Successfully registered!";
              $status['success'] = 'successful';
    }
      }else{
        $status['failed'] = "Authentication code has already been used";
      }


    }else{
      $status['failed'] = "Authentication code entered is invalid";
    }

  }





}catch(Exception $e){
  // $status['failed'] = $e;
  $status['failed'] = 'Something went wrong, try again!!!';
}

$res = json_encode($status);
echo $res;

 ?>
