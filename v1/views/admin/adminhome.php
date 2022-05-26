<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Dashboard";
include "includes/header.php";
 ?>
 <?php if(isset ($_SESSION['msg'])){ ?>
   <div style="visibility:hidden" id="msg" data-msg="<?php echo $_SESSION['msg']; ?>"></div>
 <?php unset ($_SESSION['msg']); ?>
 <?php } ?>
 <script type="text/javascript">popUpShow()</script>

			<div id="page-wrapper">
				<div class="graphs">

					<div class="col_3">
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-picture-o"></i>
								<div class="stats">
                  <?php if($chk['rank'] != 1){
                    $memeCount = countContent2($conn, "hom_memes", "added_by", $_SESSION['admin_id']);
                  }else{
                    $memeCount = countContent($conn, "hom_memes");
                  }
                    ?>
								  <h5><?php echo $memeCount; ?></h5>
								  <div class="grow">
									<p>Memes</p>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-picture-o"></i>
								<div class="stats">
                  <?php $memeCatCount = countContent($conn, "hom_memes_category"); ?>
								  <h5><?php echo $memeCatCount; ?></h5>
								  <div class="grow grow1">
									<p>Memes Category</p>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-book"></i>
								<div class="stats">
                  <?php if($chk['rank'] != 1){
                    $postCount = countContent2($conn, "web_content", "author_id", $_SESSION['admin_id']);
                  }else{
                    $postCount = countContent($conn, "web_content");
                  }
                    ?>

								  <h5><?php echo $postCount; ?></h5>
								  <div class="grow grow2">
									<p>Web Posts</p>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-pencil"></i>
								<div class="stats">
                  <?php $sectionCount = countContent($conn, "web_section"); ?>
								  <h5><?php echo $sectionCount; ?></h5>
								  <div class="grow grow3">
									<p>Web Section</p>
								  </div>
								</div>
							</div>
						</div>

            <div class="clearfix"> </div>
					</div>
          <div class="col_3">
            <div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-pencil-square-o"></i>
								<div class="stats">
                  <?php $webCategory = countContent($conn, "web_category"); ?>
								  <h5><?php echo $webCategory; ?></h5>
								  <div class="grow grow3">
									<p>Web Category</p>
								  </div>
								</div>
							</div>
						</div>
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                  <i class="fa fa-tasks"></i>
                  <div class="stats">
                    <?php $aboutCount = countContent($conn, "about"); ?>
                    <h5><?php echo $aboutCount; ?></h5>
                    <div class="grow grow2">
                    <p>About</p>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                  <i class="fa fa-users"></i>
                  <div class="stats">
                    <?php $userCount = countContent($conn, "public"); ?>
                    <h5><?php echo $userCount; ?></h5>
                    <div class="grow grow1">
                    <p>USERS</p>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                  <i class="fa fa-users"></i>
                  <div class="stats">
                    <?php $adminCount = countContent($conn, "admin"); ?>
                    <h5><?php echo $adminCount; ?></h5>
                    <div class="grow">
                    <p>ADMINS</p>
                    </div>
                  </div>
                </div>
            </div>
            <div class="clearfix"> </div>
          </div>
          <div class="col_3">
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                  <i class="fa fa-envelope"></i>
                  <div class="stats">
                    <?php $contactCount = countContent($conn, "contact"); ?>
                    <h5><?php echo $contactCount; ?></h5>
                    <div class="grow grow1">
                    <p>CONTACT</p>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-3 widget widget1">
              <div class="r3_counter_box">
                <i class="fa fa-music"></i>
                <div class="stats">
                  <?php $hom_mav = countContent($conn, "hom_mav"); ?>
                  <h5><?php echo $hom_mav; ?></h5>
                  <div class="grow grow2">
                  <p>Music</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"> </div>
          </div>
		   </div>

		  </div>

<?php include "includes/footer.php"; ?>
