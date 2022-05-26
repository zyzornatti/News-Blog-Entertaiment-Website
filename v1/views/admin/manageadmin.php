<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Admins";
$check_rank = fetchRecord2($conn, "admin", "admin_hash", $_SESSION['admin_id']);
include "includes/header.php";
?>

<?php if(isset ($_SESSION['msg'])){ ?>
  <div style="visibility:hidden" id="msg" data-msg="<?php echo $_SESSION['msg']; ?>"></div>
<?php unset ($_SESSION['msg']); ?>
<?php } ?>
<script type="text/javascript">popUpShow()</script>

<?php if($check_rank['rank'] == 1): ?>
  <div id="page-wrapper">
    <div class="graphs">
      <h3 class="blank1">H.O.M Admins</h3>
        <div class="xs tabls">
          <div class="bs-example4" data-example-id="contextual-table">
            <div class="tab-content">
              <div class="tab-pane active" id="horizontal-form">
                <div class="form-group">
                     <div class="col-md-3">
                       <div class="input-icon right spinner">
                         <input id="search" onkeyup="searchQueryUser(4)" class="form-control1" type="text" placeholder="Search">
                       </div>
                     </div>
                     <div class="col-md-3"></div>
                     <div class="col-md-3">
                       <p id="sort"></p>
                     </div>
                     <div class="col-md-3">
                       <div class="input-icon right spinner">
                          <p>Show
                           <span>
                           <select class="" name="" id="limit" onchange="filterLimitUser(4)">
                             <option value="10">10</option>
                             <option value="25">25</option>
                             <option value="50">50</option>
                             <option value="100">100</option>
                           </select>
                           </span>
                           entries
                         </p>
                       </div>
                     </div>
                     <div class="clearfix"> </div>
                 </div>
                <div id="loadrecord" class="table-responsive">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">loadUser(1, '', 4)</script>
<?php else: ?>
      <div id="page-wrapper">
  			<div class="graphs">
  				<div class="error-main">
    					<h3><i class="fa fa-exclamation-triangle"></i> <span>404</span></h3>
    					<div class="col-xs-7 error-main-left">
    						<span>Oops!</span>
    						<p>You're not authorised to access this page!!!</p>
    						<div class="error-btn">
    							<a href="adminhome">Go back?</a>
    						</div>
    					</div>
    					<div class="col-xs-5 error-main-right">
    						<img src="adminasset/images/7.png" alt=" " class="img-responsive" />
    					</div>
    					<div class="clearfix"> </div>
  				</div>
  			</div>
  		</div>
<?php endif ?>

<?php include("includes/footer.php"); ?>
