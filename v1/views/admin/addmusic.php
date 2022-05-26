<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Upload Music";
$page_folder = "MUSIC";
include "includes/header.php";
 ?>

  <div id="page-wrapper">
    <div class="graphs">
      <h3 class="blank1">Upload Music</h3>
        <div class="tab-content">
        <div class="tab-pane active" id="horizontal-form">
          <form id="myform" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <div id="addmusic-response" class="alert alert-warning" role="alert">Please ensure you have uploaded the music file in sabishare.com and copy the upload link</div>
            <div class="form-group">
              <label for="focusedinput" class="col-sm-2 control-label">Music Title</label>
              <div class="col-sm-8">
                <input type="text" class="form-control1" id="musictitle" placeholder="Enter Music Title">
              </div>
            </div>
            <div class="form-group">
                <label for="selector1" class="col-sm-2 control-label">Music Category</label>
                <div class="col-sm-8">
                  <select id="musiccategory" name="selector1" id="selector1" class="form-control1">
                    <?php $musiccat = fetchContent($conn, "hom_mav_category"); ?>
                    <option value="">--Select Category--</option>
                    <?php foreach ($musiccat as $key => $value): ?>
                      <option value="<?= $value['hom_mav_category_hash_id'] ?>"><?= $value['hom_mav_category_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label for="txtarea1" class="col-sm-2 control-label">Music Info</label>
              <div class="col-sm-8"><textarea name="txtarea1" id="body" cols="50" rows="4" class="form-control1"></textarea></div>
            </div>
            <div class="form-group">
									<label for="radio" class="col-sm-2 control-label">Single music or album</label>
									<div class="col-sm-8">
										<div class="radio-inline"><label><input type="radio" name="ma" onclick="showLink()" value="music"/> Music</label></div>
										<div class="radio-inline"><label><input type="radio" name="ma" onclick="hideLink()" value="album"/> Album</label></div>
									</div>
								</div>
            <div class="form-group">
              <label for="focusedinput" class="col-sm-2 control-label" id ="ml">Music Upload Link</label>
              <div class="col-sm-8">
                <input type="text" class="form-control1" id="musiclink" placeholder="Enter Music Upload Link">
              </div>
            </div>
            <div class="form-group">
            <label for="exampleInputFile" class="col-sm-2 control-label">Music cover Image</label>
            <div class="col-sm-8"><input type="file" id="image" onchange="loadImage(event);"></div>
            <img class="col-sm-3" id="viewImage" width="200px" height="200px"/>
            </div>
            <div class="panel-footer">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <button class="btn-success btn" type="button" onclick="addMusic(<?= $_SESSION['admin_id'] ?>)">Upload</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>

<?php include("includes/footer.php"); ?>
