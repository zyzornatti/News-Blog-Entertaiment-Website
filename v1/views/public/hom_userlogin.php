<?php
// require_once APP_PATH.'/views/public/includes/gauth/signinwithgoogle.php';
 
$page_name = "Login";
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
   <span data-notify="title">Success</span>
   <span data-notify="message"> <?= $_SESSION['failed'] ?></span>
 </div>
 <?php unset ($_SESSION['failed']); ?>
 <?php endif ?>

 <section id="page-title" data-bg-parallax="">
   <div class="container">
   <div class="page-title">
   <h1>User Login</h1>
   <span>Enter your login details to login</span>
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

             <h3>Login</h3>
             <!-- <a href=" //$client->createAuthUrl(); "><button type="button" name="button">Login With Google</button></a><br><br> -->
             <?php if(isset ($_GET['msg'])): ?>
               <?php $msg = str_replace("_", " ", $_GET['msg']) ?>
               <div class="" id="login-res" style="color:red;"><?= $msg ?></div>
             <?php else: ?>
               <div class="" id="login-res" style="visibility:hidden;"></div>
             <?php endif ?>

             <form action="" method="post" id="login-form">
               <div class="form-group">
                 <label class="sr-only">Username or Email</label>
                 <input type="text" placeholder="Username or Email" class="form-control" id="user-details">
               </div>
               <div class="form-group m-b-5">
                 <label class="sr-only">Password</label>
                 <input type="password" placeholder="Password" class="form-control" id="user-password">
               </div>
               <div class="form-group form-inline m-b-10 ">
                 <div class="form-check">
                   <!-- <label>
                     <input type="checkbox"><small class="m-l-10"> Remember me</small>
                   </label> -->
                 </div>
               </div>
               <div class="form-group">
                 <?php if(isset ($_GET['rd'])): ?>
                   <button class="btn" type="button" onclick="loginUser('<?= $_GET['rd'] ?>');">Login</button>
                 <?php else: ?>
                   <button class="btn" type="button" onclick="loginUser();">Login</button> <span>Or</span> <span><a href="forgotpassword">Forgot Password?</a></span>
                 <?php endif ?>
               </div>
             </form>
           </div>
         </div>
         <h5>Don't have an account yet? <a href="register">Register Now</a></h5>
       </div>
     </div>
   </div>
 </section>

 <?php include "includes/footer.php" ?>
