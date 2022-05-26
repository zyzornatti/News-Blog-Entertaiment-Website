<?php
$page_name = "Register";
// $page_title = "Register";
include "includes/header.php";
 ?>

 <section id="page-title" data-bg-parallax="">
   <div class="container">
   <div class="page-title">
   <h1>User Sign Up</h1>
   <span>Fill in your details to register</span>
   </div>
   <!-- <div class="breadcrumb">
     <ul>
       <li><a href="home">Home</a>
       </li>
       <li><a href="register">Sign Up</a>
       </li>
     </ul>
    </div>
   </div> -->
 </section>


 <section>
   <div class="container">
     <div class="row">
       <div class="col-lg-4 offset-4">
         <div class="panel ">
           <div class="panel-body">
             <h3>Register</h3>
             <div class="" id="signup-res" style="visibility:hidden;"></div>
             <form action="" method="post" id="usersignup-form">
               <div class="form-group">
                 <label class="sr-only">Name</label>
                 <input type="text" placeholder="Enter Name" class="form-control" id="user-name">
               </div>
               <div class="form-group m-b-5">
                 <label class="sr-only">Email</label>
                 <input type="text" placeholder="Enter Email" class="form-control" id="user-email">
               </div>
               <div class="form-group m-b-5">
                 <label class="sr-only">Phone number</label>
                 <input type="text" placeholder="Enter Phone number" class="form-control" id="pnumber">
               </div>
               <div class="form-group m-b-5">
                 <label class="sr-only">Username</label>
                 <input type="text" placeholder="Enter Username" class="form-control" id="username">
               </div>
               <div class="form-group m-b-5">
                 <label class="sr-only">Password</label>
                 <input type="password" placeholder="Password" class="form-control" id="pword">
               </div>
               <div class="form-group m-b-5">
                 <label class="sr-only">Confirm Password</label>
                 <input type="password" placeholder="Confirm Password" class="form-control" id="cpword">
               </div>
               <div class="form-group">
                 <?php if(isset ($_GET['rd'])): ?>
                   <button class="btn" type="button" onclick="registerUser('<?= $_GET['rd'] ?>');">Register</button>
                 <?php else: ?>
                   <button class="btn" type="button" onclick="registerUser();">Register</button>
                 <?php endif ?>
               </div>
             </form>
           </div>
         </div>
         <h5>Have an account already? <a href="signin">Login</a></h5>
       </div>
     </div>
   </div>
 </section>

 <?php include "includes/footer.php" ?>
