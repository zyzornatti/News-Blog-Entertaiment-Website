<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Author Profile";
$page_folder = "";
include "includes/header.php";
 ?>

 <?php
 $id = $_SESSION['admin_id'];
 $author = fetchRecord2($conn, "admin", "admin_hash", $id);
 ?>
 <div id="page-wrapper">
   <div class="graphs">
      <h3 class="blank1">Update Your Author Bio</h3>
      <div class="tab-content">
         <div class="tab-pane active" id="horizontal-form">
           <form id="myform" class="form-horizontal" action="prf" method="post">
             <div id="aut-response" style="visibility:hidden" class="alert alert-danger" role="alert"></div>
               <div class="form-group">
                 <label for="txtarea1" class="col-sm-2 control-label">About Author</label>
                 <div class="col-sm-8"><textarea name="txtarea1" id="body" cols="50" rows="4" class="form-control1"><?php echo $author['admin_description'] ?></textarea></div>
               </div>
             <div class="panel-footer">
             <div class="row">
               <div class="col-sm-8 col-sm-offset-2">
                 <button class="btn-success btn" type="button" name="submit" onclick="UpdateAuthorProfile(<?= $id ?>);" id="prfbtn">Submit</button>
               </div>
             </div>
           </form>
         </div>
       </div>
      </div>
   </div><br><br>

   <div class="graphs">
    <h3 class="blank1">Update Your Social Media Handles</h3>
      <div class="tab-content">
        <div class="tab-pane active" id="horizontal-form">
          <form id="myform" class="form-horizontal" action="prf" method="post">
            <div id="handles-response" style="visibility:hidden" class="alert alert-danger" role="alert"></div>
            <div class="form-group">
              <label for="focusedinput" class="col-sm-2 control-label">Facebook</label>
              <div class="col-sm-8">
                <input type="text" class="form-control1" id="fbu" name="name" placeholder="Enter Facebook Username" value="<?php echo $author['facebook_username'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="disabledinput" class="col-sm-2 control-label">Twitter</label>
              <div class="col-sm-8">
                <input type="text" class="form-control1" id="twu" name="email" placeholder="Enter Twitter Username" value="<?php echo $author['twitter_username'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="disabledinput" class="col-sm-2 control-label">Instagram</label>
              <div class="col-sm-8">
                <input type="text" class="form-control1" id="igu" name="pnum" placeholder="Enter Instagram Username" value="<?php echo $author['instagram_username'] ?>">
              </div>
            </div>
            <div class="panel-footer">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <button class="btn-success btn" type="button" name="submit" onclick="editSmh(<?= $id ?>)">Update</button>
              </div>
            </div>
          </form>
        </div>
        </div>
      </div>
  </div>

  
 </div>

 <?php include "includes/footer.php" ?>
