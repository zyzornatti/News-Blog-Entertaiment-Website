<?php
authenticate($_SESSION['user'], "signin");

$page_name = "Edit Details";
// $page_title = "Edit Details";
include "includes/header.php";
if(isset ($_SESSION['user'])){
  $user = $_SESSION['user'];
}
$user_record = fetchRecord2($conn, "public", "user_hash", $user);
 ?>

  <?php if(isset ($_SESSION['msg'])): ?>
    <div data-notify="container" id="closeit" undefined="" class="bootstrap-notify col-11 col-md-4 alert alert-success" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; right: 20px; opacity:1;">
      <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;" onclick="closeMsg()">
        ×
      </button>
      <span data-notify="icon"></span>
      <span data-notify="title"><h4><b>Success</b></h4></span>
      <span data-notify="message"> <?= $_SESSION['msg'] ?></span>
    </div>
  <?php unset ($_SESSION['msg']); ?>
  <?php endif ?>

 <section id="page-title" data-bg-parallax="">
   <div class="container">
   <div class="page-title">
   <h1>Edit Details</h1>
   <span>Update your details correctly!</span>
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
             <h5>Edit Name</h5>
             <div class="" id="name-res" style="visibility:hidden;"></div>
             <form action="" method="post" id="name-form">
               <div class="form-group">
                 <label class="sr-only">Edit Name</label>
                 <input type="text" placeholder="Enter Name" class="form-control" id="user-name" value="<?= $user_record['name'] ?>">
               </div>
               <div class="form-group">
                 <button class="btn" type="button" onclick="editUserName(<?= $user ?>)">Update</button>
               </div>
             </form>

             <h5>Change Email</h5>
             <div class="" id="email-res" style="visibility:hidden;"></div>
             <form action="" method="post" id="email-form">
               <div class="form-group m-b-5">
                 <label class="sr-only">Enter Email</label>
                 <input type="text" placeholder="Enter Email" class="form-control" id="user-email" value="<?= $user_record['email'] ?>">
               </div>
               <div class="form-group">
                 <button class="btn" type="button" onclick="editUserEmail(<?= $user ?>)">Update</button>
               </div>
             </form>

             <h5>Change Phone Number</h5>
             <div class="" id="pnum-res" style="visibility:hidden;"></div>
             <form action="" method="post" id="pnum-form">
               <div class="form-group m-b-5">
                 <label class="sr-only">Enter Phone number</label>
                 <input type="text" placeholder="Enter Phone number" class="form-control" id="pnumber" value="<?= $user_record['phone_number'] ?>">
               </div>
               <div class="form-group">
                 <button class="btn" type="button" onclick="editUserNum(<?= $user ?>)">Update</button>
               </div>
             </form>

             <h5>Edit Username</h5>
             <div class="" id="uname-res" style="visibility:hidden;"></div>
             <form action="" method="post" id="">
               <div class="form-group m-b-5">
                 <label class="sr-only">Enter Username</label>
                 <input type="text" placeholder="Enter Username" class="form-control" id="username" value="<?= $user_record['username'] ?>">
               </div>
               <div class="form-group">
                 <button class="btn" type="button" onclick="editUserUsername(<?= $user ?>)">Update</button>
               </div>
             </form>

             <h5>Change Password</h5>
             <div class="" id="pword-res" style="visibility:hidden;"></div>
             <form action="" method="post" id="pword-form">
               <div class="form-group m-b-5">
                 <label class="sr-only">Old Password</label>
                 <input type="password" placeholder="Enter Old Password" class="form-control" id="pword">
               </div>
               <div class="form-group m-b-5">
                 <label class="sr-only">New Password</label>
                 <input type="password" placeholder="Enter New Password" class="form-control" id="npword">
               </div>
               <div class="form-group m-b-5">
                 <label class="sr-only">Confirm Password</label>
                 <input type="password" placeholder="Confirm Password" class="form-control" id="cpword">
               </div>
               <div class="form-group">
                 <button class="btn" type="button" onclick="changeUserPword(<?= $user?>)">Change</button>
               </div>
             </form>

           </div>
         </div>
       </div>
     </div>
   </div>
 </section>

 <?php include "includes/footer.php" ?>
