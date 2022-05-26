<?php
$page_name = "Change Password";
$error = [];

if(isset ($_GET['rid']) && isset($_GET['rem'])){
  $rid = $_GET['rid'];
  $rem = $_GET['rem'];

  $check = $conn->prepare("SELECT * FROM admin_auth WHERE authentication_code = :ac AND aut_user_email = :aue");
  $check->bindParam(":ac", $rid);
  $check->bindParam(":aue", $rem);
  $check->execute();
  $chk = $check->fetch(PDO::FETCH_BOTH);
  // die(var_dump($chk));
  if(($chk['authentication_code'] == $rid) && ($chk['aut_user_email'] == $rem)){
    // $chk = $check->fetch(PDO::FETCH_BOTH);
    if($chk['status'] == 0){
      if(isset ($_POST['submit'])){

        if(empty ($_POST['user-pword'])){
          $error['msg'] = "You have not entered a password";
        }else{
          $pword = $_POST['user-pword'];
        }

        if(empty ($_POST['user-cpword'])){
          $error['msg'] = "You didn't confirm your password";
        }else{
          $cpword = $_POST['user-cpword'];
        }

        if(isset ($pword) && isset ($cpword)){
          if($pword != $cpword){
            $error['msg'] = "Password Missmatch";
          }
        }

        if(!isset ($error['msg'])){
          $hash = password_hash($pword, PASSWORD_BCRYPT);
          $resetpword = $conn->prepare("UPDATE public SET password = :pw WHERE email = :em");
          $resetpword->bindParam(":pw", $hash);
          $resetpword->bindParam(":em", $rem);
          $resetpword->execute();

          $st = 1;
          $update_aut = $conn->prepare("UPDATE admin_auth SET status = :st WHERE authentication_code = :auc");
          $update_aut->bindParam(":st", $st);
          $update_aut->bindParam(":auc", $rid);
          $update_aut->execute();

          $_SESSION['msg'] = "Your Password has been changed successfully";
          header("Location: /signin");
          die;
        }
      }
    }else{
      $_SESSION['failed'] = "The link has already been used by another user to reset password";
      header("Location: /forgotpassword");
      die;
    }
  }else{
    $_SESSION['failed'] = "This link cannot be used by you";
    header("Location: /forgotpassword");
    die;
  }


}

// $page_title = "Login";
include "includes/header.php";
 ?>

 <?php if(isset ($_SESSION['msg'])): ?>
   <div data-notify="container" id="closeit" undefined="" class="bootstrap-notify col-11 col-md-4 alert alert-success" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; right: 20px; visibility:visible;">
   <button type="button" aria-hidden="true" class="close" data-notify="" style="position: absolute; right: 10px; top: 5px; z-index: 1033;" onclick="closeMsg()">
     ×
   </button>
   <span data-notify="icon"></span>
   <span data-notify="title">Success</span>
   <span data-notify="message"> <?= $_SESSION['msg'] ?></span>
 </div>
 <?php unset ($_SESSION['msg']); ?>
 <?php endif ?>

 <?php if(isset ($_SESSION['failed'])): ?>
   <div data-notify="container" id="closeit" undefined="" class="bootstrap-notify col-11 col-md-4 alert alert-danger" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; right: 20px; visibility:visible;">
   <button type="button" aria-hidden="true" class="close" data-notify="" style="position: absolute; right: 10px; top: 5px; z-index: 1033;" onclick="closeMsg()">
     ×
   </button>
   <span data-notify="icon"></span>
   <span data-notify="title">Error</span>
   <span data-notify="message"> <?= $_SESSION['failed'] ?></span>
 </div>
 <?php unset ($_SESSION['failed']); ?>
 <?php endif ?>

 <section id="page-title" data-bg-parallax="">
   <div class="container">
   <div class="page-title">
   <h1>Reset Password</h1>
   <span>Fill in the details below to reset password</span>
   </div>
   <!-- <div class="breadcrumb">
     <ul>
       <li><a href="home">Home</a>
       </li>
       <li><a href="signin">Login</a>
       </li>
     </ul>
   </div> -->
   </div>
 </section>


 <section>
   <div class="container">
     <div class="row">
       <div class="col-lg-4 offset-4">
         <div class="panel ">
           <div class="panel-body">
             <h3>Enter New Password</h3>
             <?php if(isset ($error['msg'])): ?>
               <?php $msg = str_replace("_", " ", $error['msg']) ?>
               <div class="" id="login-res" style="color:red;"><?= $msg ?></div>
             <?php else: ?>
               <div class="" id="login-res" style="visibility:hidden;"></div>
             <?php endif ?>

             <form action="" method="post" id="login-form">
               <div class="form-group">
                 <label class="sr-only">Enter New Password</label>
                 <input type="text" placeholder="Enter New Password" class="form-control" name="user-pword">
               </div>
               <div class="form-group">
                 <label class="sr-only">Confirm New Password</label>
                 <input type="text" placeholder="Confirm New Password" class="form-control" name="user-cpword">
               </div>
               <div class="form-group form-inline m-b-10 ">
                 <div class="form-check">
                   <!-- <label>
                     <input type="checkbox"><small class="m-l-10"> Remember me</small>
                   </label> -->
                 </div>
               </div>
               <div class="form-group">
                 <button class="btn" type="submit" name="submit">Reset Password</button>
               </div>
             </form>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>

 <?php include "includes/footer.php" ?>
