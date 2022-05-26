<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Add Music Category";
include "includes/header.php";
if(isset ($_GET['id'])){
  $id = $_GET['id'];
  $edit = fetchRecord2($conn, "hom_mav_category", "hom_mav_category_hash_id", $id);
}
 ?>

 <div id="page-wrapper">
   <div class="graphs">
     <h3 class="blank1">Edit Music Category</h3>
       <div class="tab-content">
       <div class="tab-pane active" id="horizontal-form">
         <form id="myform" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
           <div id="musiccat-response" style="visibility:hidden" class="alert alert-danger" role="alert"></div>
           <div class="form-group">
             <label for="disabledinput" class="col-sm-2 control-label">Music Category</label>
             <div class="col-sm-8">
               <input type="text" class="form-control1" id="category" placeholder="Enter Music Category" value="<?= $edit['hom_mav_category_name'] ?>"/>
             </div>
           </div>
           <div class="panel-footer">
           <div class="row">
             <div class="col-sm-8 col-sm-offset-2">
               <button class="btn-success btn" type="button" onclick="editMusicCategory('<?= $edit['hom_mav_category_hash_id']  ?>');" id="btn">Update</button>
             </div>
           </div>
         </form>
       </div>
     </div>
   </div>
  </div>
 </div>

 <?php include "includes/footer.php"; ?>
