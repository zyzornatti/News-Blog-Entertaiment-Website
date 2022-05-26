<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Change Password";
include "includes/header.php";
?>

<div id="page-wrapper">
  <div class="graphs">
    <h3 class="blank1">Change Password</h3>
      <div class="tab-content">
      <div class="tab-pane active" id="horizontal-form">
        <form class="form-horizontal" action="" method="post">
          <div id="changepassword-response" style="visibility:hidden" class="alert alert-danger" role="alert"></div>
          <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Old Password</label>
            <div class="col-sm-8">
              <input type="password" class="form-control1" id="oldpword" placeholder="Enter Old Password">
            </div>
          </div>
          <div class="form-group">
            <label for="disabledinput" class="col-sm-2 control-label">New Password</label>
            <div class="col-sm-8">
              <input type="password" class="form-control1" id="newpword" placeholder="Enter New Password">
            </div>
          </div>
          <div class="form-group">
            <label for="disabledinput" class="col-sm-2 control-label">Confirm New Password</label>
            <div class="col-sm-8">
              <input type="password" class="form-control1" id="newcpword" placeholder="Confirm New Password">
            </div>
          </div>
          <div class="panel-footer">
          <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
              <button class="btn-success btn" onclick="changePass(<?= $_SESSION['admin_id'] ?>)" type="button">Change Password</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<?php include "includes/footer.php"; ?>
