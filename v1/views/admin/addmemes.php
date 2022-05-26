<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Add memes";
include "includes/header.php";
 ?>

 <div id="page-wrapper">
   <div class="graphs">
     <h3 class="blank1">Add Memes</h3>
       <div class="tab-content">
         <div id="addmeme-response" class="alert alert-warning" role="alert"><h4>You can select maximum of 3 images to upload at a time</h4></div>
       <div class="tab-pane active" id="horizontal-form">
         <form id="myform" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
           <div id="addmeme-response" style="visibility:hidden" class="alert alert-danger" role="alert"></div>
           <div class="form-group">
             <?php $category = fetchContent($conn, "hom_memes_category"); ?>
               <label for="selector1" class="col-sm-2 control-label">Meme Category</label>
               <div class="col-sm-3">
                 <select name="selector1" id="selector1" class="form-control1" >
                   <option value="">--Select Category--</option>
                   <?php foreach ($category as $key => $value): ?>
                     <option value="<?= $value['memes_category_hash_id'] ?>"><?= $value['memes_category_name'] ?></option>
                   <?php endforeach; ?>
                 </select>
               </div>
           </div>
           <div class="form-group">
             <label for="exampleInputFile" class="col-sm-2 control-label">Meme</label>
             <!-- <div class="col-sm-3"><input type="file" id="image" class="form-control" multiple/></div> -->

             <div class="col-sm-3"><input type="file" id="image" class="form-control" multiple/></div>
             <!-- <div class="col-sm-8"><input type="file" id="image" onchange="loadImages();"  multiple/></div> -->
             <!-- <img class="col-sm-3" id="viewImage" width="200px" height="200px"/> -->
             <!-- <div id="showboard"> -->

             </div>
             <!-- <div class="col-sm-8"><img class="col-sm-3" id="viewImage" width="200px" height="200px"/></div> -->
           </div>
           <div class="panel-footer">
           <div class="row">
             <div class="col-sm-8 col-sm-offset-2">
               <button class="btn-success btn" type="button" onclick="addMeme(<?= $_SESSION['admin_id'] ?>)">Add</button>
             </div>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>
 </div>

 <?php include "includes/footer.php" ?>
