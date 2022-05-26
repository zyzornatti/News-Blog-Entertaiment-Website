<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Edit Blog";
$page_folder = "POSTS";
include "includes/header.php";

if(isset ($_GET['id'])){
  $id = $_GET['id'];
  // $edit = fetchRecord2($conn, "content", "hash_id", $id);
  // $pos = $conn->prepare('SELECT web_content.web_content_id, web_content.hash_id, web_content.title, web_content.category_id, web_content.section, web_section.web_section_name AS section_name, web_category.web_category_name AS category, web_content.body, web_content.image, web_content.date_created, web_content.time_created FROM web_content INNER JOIN web_category ON web_content.category_id = web_category.category_hash_id INNER JOIN web_section ON web_content.section = web_section.web_section_name WHERE web_content.hash_id = :id');
  $pos = $conn->prepare("SELECT web_content.web_content_id, web_content.hash_id AS content_hash, web_content.title, web_content.section, web_section.web_section_name AS section_name, web_content.category_id, web_category.web_category_name AS category, web_content.body, web_content.image, web_content.date_created, web_content.time_created FROM web_content INNER JOIN web_category ON web_content.category_id = web_category.category_hash_id INNER JOIN web_section ON web_content.section = web_section.section_hash_id WHERE web_content.hash_id = :id");
  $pos->bindParam(":id", $id);
  $pos->execute();
  $edit = $pos->fetch(PDO::FETCH_ASSOC);
  // $edit = $pos->fetchAll();
  // die(var_dump($post));
}

?>
  <div id="page-wrapper">
    <div class="graphs">
      <h3 class="blank1">Edit Post</h3>
        <div class="tab-content">
        <div class="tab-pane active" id="horizontal-form">
          <form id="myform" class="form-horizontal" action="blog" method="post" enctype="multipart/form-data">
            <div id="editblog-response" style="visibility:hidden" class="alert alert-danger" role="alert"></div>
            <div class="form-group">
              <label for="focusedinput" class="col-sm-2 control-label">Title</label>
              <div class="col-sm-8">
                <input type="text" class="form-control1" id="blogtitle" placeholder="Enter Post Title" value="<?php echo $edit['title']; ?>">
                <p style="visibility:hidden" data-id="<?php echo $edit['content_hash']; ?>" id="p"></p>
              </div>
            </div>
            <div class="form-group">
              <?php $section = fetchContent($conn, "web_section"); ?>
                <label for="selector1" class="col-sm-2 control-label">Section</label>
                <div class="col-sm-8">
                  <select id="section" name="selector1" id="selector1" class="form-control1" onchange="changeCatSelection()">
                    <option value="<?php echo $edit['section']; ?>"><?php echo $edit['section_name']; ?></option>
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
                    <option value="<?php echo $edit['category_id']; ?>"><?php echo $edit['category']; ?></option>
                    <option value="">--Select Category--</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label for="txtarea1" class="col-sm-2 control-label">Content Body</label>
              <div class="col-sm-8"><textarea name="txtarea1" id="body" cols="50" rows="4" class="form-control1"><?php echo $edit['body']; ?></textarea></div>
            </div>
            <!-- <div class="form-group">
            <label for="exampleInputFile" class="col-sm-2 control-label">Blog Image</label>
            <div class="col-sm-8"><input  type="file" id="image" onchange="loadImage(event);"></div>
            <img class="col-sm-3" id="viewImage" width="200px" height="200px" >
            </div> -->
            <div class="panel-footer">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <button class="btn-success btn" type="button" onclick="editBlog();" id="blogbtn">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
 <?php include "includes/footer.php"; ?>
