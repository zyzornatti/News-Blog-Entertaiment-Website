<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Profile";
include "includes/header.php";
?>
<?php
$id = $_SESSION['admin_id'];
$profile = fetchRecord2($conn, "admin", "admin_hash", $id);
?>
<div id="page-wrapper">
  <div class="graphs">
    <h3 class="blank1">Edit Your Profile</h3>
      <div class="tab-content">
        <div class="tab-pane active" id="horizontal-form">
          <form id="myform" class="form-horizontal" action="prf" method="post">
            <div id="profile-response" style="visibility:hidden" class="alert alert-danger" role="alert"></div>
            <div class="form-group">
              <label for="focusedinput" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-8">
                <input type="text" class="form-control1" id="pname" name="name" placeholder="Enter Name" value="<?php echo $profile['name'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="disabledinput" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-8">
                <input type="text" class="form-control1" id="pemail" name="email" placeholder="Enter Email" value="<?php echo $profile['email'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="disabledinput" class="col-sm-2 control-label">Phone Number</label>
              <div class="col-sm-8">
                <input type="text" class="form-control1" id="ppnum" name="pnum" placeholder="Enter Phone Number" value="<?php echo $profile['phone_number'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="disabledinput" class="col-sm-2 control-label">Username</label>
              <div class="col-sm-8">
                <input type="text" class="form-control1" id="pusername" name="username" placeholder="Enter Username" value="<?php echo $profile['admin_username'] ?>">
              </div>
            </div>
            <div class="panel-footer">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <button class="btn-success btn" type="button" name="submit" onclick="editProfile(<?= $id ?>);" id="prfbtn">Update</button>
              </div>
            </div>
          </form>
        </div>
        </div>
      </div>
  </div>
</div>

<?php include "includes/footer.php"; ?>
