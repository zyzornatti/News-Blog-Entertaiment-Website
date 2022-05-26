<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Add Category";
include "includes/header.php";
 ?>

 <div id="page-wrapper">
   <div class="graphs">
     <h3 class="blank1">Add Category</h3>
       <div class="tab-content">
       <div class="tab-pane active" id="horizontal-form">
         <form id="myform" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
           <div id="category-response" style="visibility:hidden" class="alert alert-danger" role="alert"></div>
           <div class="form-group">
             <?php $category = fetchContent($conn, "web_section"); ?>
               <label for="selector1" class="col-sm-2 control-label">Choose Section</label>
               <div class="col-sm-8">
                 <select name="selector1" id="selector1" class="form-control1">
                 <option value="">--Select Section--</option>
                 <?php foreach ($category as $key => $value): ?>
                 <option value="<?php echo $value['section_hash_id']; ?>"><?php echo $value['web_section_name']; ?></option>
                 <?php endforeach; ?>
                 </select>
               </div>
           </div>
           <div class="form-group">
             <label for="disabledinput" class="col-sm-2 control-label">Category</label>
             <div class="col-sm-8">
               <input type="text" class="form-control1" id="category" placeholder="Enter Category Name">
             </div>
           </div>
           <div class="panel-footer">
           <div class="row">
             <div class="col-sm-8 col-sm-offset-2">
               <button class="btn-success btn" type="button" onclick="addCategory();" id="btn">Add</button>
             </div>
           </div>
         </form>
       </div>
     </div>
   </div>
  </div>
 </div>

 <?php include "includes/footer.php"; ?>
