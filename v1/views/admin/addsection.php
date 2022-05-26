<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Add Website Section";
include "includes/header.php";
 ?>

 <div id="page-wrapper">
   <div class="graphs">
     <h3 class="blank1">Add Website Category</h3>
       <div class="tab-content">
       <div class="tab-pane active" id="horizontal-form">
         <form id="myform" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
           <div id="section-response" style="visibility:hidden" class="alert alert-danger" role="alert"></div>
           <div class="form-group">
             <label for="disabledinput" class="col-sm-2 control-label">Section</label>
             <div class="col-sm-8">
               <input type="text" class="form-control1" id="section" placeholder="Enter Section Name">
             </div>
           </div>
           <div class="panel-footer">
           <div class="row">
             <div class="col-sm-8 col-sm-offset-2">
               <button class="btn-success btn" type="button" onclick="addSection()" id="btn">Add</button>
             </div>
           </div>
         </form>
       </div>
     </div>
   </div>
  </div>
 </div>

 <?php include "includes/footer.php"; ?>
