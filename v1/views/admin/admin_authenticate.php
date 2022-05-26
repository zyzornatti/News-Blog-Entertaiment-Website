<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Admin authentication";
$page_folder = "ABOUT";
include "includes/header.php";
 ?>

 <div id="page-wrapper">
   <div class="graphs">
     <h3 class="blank1">Generate Authentication Code For New Admins</h3>
       <div class="tab-content">
       <div class="tab-pane active" id="horizontal-form">
         <form id="myform" class="form-horizontal" action="addcont" method="post" enctype="multipart/form-data">

           <div class="form-group">
             <!-- <label for="focusedinput" class="col-sm-2 control-label">Title</label> -->
             <div class="col-sm-8">
               <h3>Copy this link <span><strong>https://homeofmemes.com/adminsignup</strong></span> and share to the new admin</h3><br/>
               <h3 id="code" style="visibility:hidden">Copy the Authentication code generated and give it to the admin</h3>
               <!-- <input type="text" class="form-control1" id="blogtitle" placeholder="Enter Post Title"> -->
               <h4 id="code-response" style="visibility:hidden"></h4>
             </div>
           </div>

           <div class="panel-footer">
           <div class="row">
             <div class="col-sm-8 col-sm-offset-2">
               <button class="btn-success btn" type="button" onclick="generateAdminCode()">Generate authentication code</button>
             </div>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>
 </div>

 <?php include "includes/footer.php"; ?>
