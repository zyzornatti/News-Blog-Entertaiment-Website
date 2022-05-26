<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Add Post";
$page_folder = "POSTS";
include "includes/header.php";
 ?>

  <div id="page-wrapper">
    <div class="graphs">
      <h3 class="blank1">Add Post</h3>
        <div class="tab-content">
        <div class="tab-pane active" id="horizontal-form">
          <form id="myform" class="form-horizontal" action="blog" method="post" enctype="multipart/form-data">
            <div id="addblog-response" style="visibility:hidden" class="alert alert-danger" role="alert"></div>
            <div class="form-group">
              <label for="focusedinput" class="col-sm-2 control-label">Title</label>
              <div class="col-sm-8">
                <input type="text" class="form-control1" id="blogtitle" placeholder="Enter Post Title">
              </div>
            </div>
            <div class="form-group">
              <?php $section = fetchContent($conn, "web_section"); ?>
                <label for="selector1" class="col-sm-2 control-label">Section</label>
                <div class="col-sm-8">
                  <select id="section" name="selector1" id="selector1" class="form-control1" onchange="changeCatSelection()">
                  <option value="">--Select Section--</option>
                  <?php foreach ($section as $key => $value): ?>
                    <option value="<?= $value['section_hash_id'] ?>"><?= $value['web_section_name'] ?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label for="selector1" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-8">
                  <select id="category" name="selector1" id="selector1" class="form-control1">
                  <option value="">--Select Category--</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label for="txtarea1" class="col-sm-2 control-label">Content Body</label>
              <div class="col-sm-8"><textarea name="txtarea1" id="body" cols="50" rows="4" class="form-control1"></textarea></div>
            </div>
            <div class="form-group">
            <label for="exampleInputFile" class="col-sm-2 control-label">Title Image</label>
            <div class="col-sm-8"><input type="file" id="image" onchange="loadImage(event);"></div>
            <img class="col-sm-3" id="viewImage" width="200px" height="200px"/>
            </div>
            <div class="panel-footer">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <button class="btn-success btn" type="button" onclick="addBlog(<?= $_SESSION['admin_id'] ?>)">Post</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>

<?php include("includes/footer.php"); ?>
