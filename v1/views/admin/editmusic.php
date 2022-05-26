<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Edit Music";
$page_folder = "MUSIC";
include "includes/header.php";

if(isset ($_GET['id'])){
  $id = $_GET['id'];
  $pos = $conn->prepare("SELECT hom_mav.hom_mav_id, hom_mav.hom_mav_hash_id AS music_hash, hom_mav.hom_mav_title, hom_mav.hom_mav_category_id, hom_mav_category.hom_mav_category_name AS category, hom_mav.hom_mav_content AS info, hom_mav.hom_mav_link, hom_mav.hom_mav_image, hom_mav.date_created, hom_mav.time_created FROM hom_mav INNER JOIN hom_mav_category ON hom_mav.hom_mav_category_id = hom_mav_category.hom_mav_category_hash_id WHERE hom_mav.hom_mav_hash_id = :id");
  $pos->bindParam(":id", $id);
  $pos->execute();
  $edit = $pos->fetch(PDO::FETCH_ASSOC);
}

?>
  <div id="page-wrapper">
    <div class="graphs">
      <h3 class="blank1">Edit Music</h3>
        <div class="tab-content">
        <div class="tab-pane active" id="horizontal-form">
          <form id="myform" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <div id="editmusic-response" style="visibility:hidden" class="alert alert-danger" role="alert"></div>
            <div class="form-group">
              <label for="focusedinput" class="col-sm-2 control-label">Music Title</label>
              <div class="col-sm-8">
                <input type="text" class="form-control1" id="musictitle" placeholder="Enter Music Title" value="<?php echo $edit['hom_mav_title']; ?>">
                <p style="visibility:hidden" data-id="<?php echo $edit['music_hash']; ?>" id="p"></p>
              </div>
            </div>
            <div class="form-group">
                <label for="selector1" class="col-sm-2 control-label">Music Category</label>
                <div class="col-sm-8">
                  <select id="category" name="selector1" id="selector1" class="form-control1">
                    <option value="<?php echo $edit['hom_mav_category_id']; ?>"><?php echo $edit['category']; ?></option>
                    <?php $musiccat = fetchContent($conn, "hom_mav_category") ?>
                    <?php foreach ($musiccat as $key => $value): ?>
                      <option value="<?= $value['hom_mav_category_hash_id'] ?>"><?= $value['hom_mav_category_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label for="txtarea1" class="col-sm-2 control-label">Music Info</label>
              <div class="col-sm-8"><textarea name="txtarea1" id="body" cols="50" rows="4" class="form-control1"><?php echo $edit['info']; ?></textarea></div>
            </div>
            <?php if($edit['hom_mav_link'] != "ALBUM"): ?>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-2 control-label">Music Upload Link</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control1" id="musiclink" placeholder="Enter Music Upload Link" value="<?php echo $edit['hom_mav_link']; ?>">
                </div>
              </div>
            <?php endif ?>
            <div class="panel-footer">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <button class="btn-success btn" type="button" onclick="editMusic();" id="emusicbtn">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
 <?php include "includes/footer.php"; ?>
