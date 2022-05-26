<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Add About";
$page_folder = "ABOUT";
include "includes/header.php";
 ?>

 <div id="page-wrapper">
   <div class="graphs">
     <h3 class="blank1">Add About</h3>
       <div class="tab-content">
       <div class="tab-pane active" id="horizontal-form">
         <form id="myform" class="form-horizontal" action="addcont" method="post" enctype="multipart/form-data">
           <div id="about-response" style="visibility:hidden" class="alert alert-danger" role="alert"></div>
           <div class="form-group">
             <label for="txtarea1" class="col-sm-2 control-label">About Content</label>
             <div class="col-sm-8"><textarea name="txtarea1" id="abtbody" cols="50" rows="4" class="form-control1"></textarea></div>
           </div>
           <div class="form-group">
           <label for="exampleInputFile" class="col-sm-2 control-label">About Image</label>
           <div class="col-sm-8"><input  type="file" id="image" onchange="loadImage(event);"></div>
           <img class="col-sm-3" id="viewImage" width="200px" height="200px" >
           </div>
           <div class="panel-footer">
           <div class="row">
             <div class="col-sm-8 col-sm-offset-2">
               <button class="btn-success btn" type="button" onclick="addAbout();" id="abtbtn">Post</button>
             </div>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>
 </div>

 <?php include "includes/footer.php"; ?>
