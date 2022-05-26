<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Edit Category";
include "includes/header.php";
 ?>

<?php
if(isset ($_GET['id'])){
  $id = $_GET['id'];
  $row = fetchRecord2($conn, "web_category", "category_hash_id", $id);
}

 ?>
 <div id="page-wrapper">
   <div class="graphs">
     <h3 class="blank1">Edit Category</h3>
       <div class="tab-content">
       <div class="tab-pane active" id="horizontal-form">
         <form id="myform" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
           <div id="category-response" style="visibility:hidden" class="alert alert-danger" role="alert"></div>
           <div class="form-group">
             <label for="disabledinput" class="col-sm-2 control-label">Category</label>
             <div class="col-sm-8">
               <input type="text" class="form-control1" id="category" placeholder="Enter Category Name" value="<?php echo $row['web_category_name']; ?>"/>
               <p style="visibility:hidden" data-id="<?php echo $row['category_hash_id']; ?>" data-section="<?= $row['web_section_id'] ?>" id="p"></p>
             </div>
           </div>
           <div class="panel-footer">
           <div class="row">
             <div class="col-sm-8 col-sm-offset-2">
               <button class="btn-success btn" type="button" onclick="editCategory();" id="catbtn">Update</button>
             </div>
           </div>
         </form>
       </div>
     </div>
   </div>
  </div>
 </div>

 <?php include "includes/footer.php"; ?>
