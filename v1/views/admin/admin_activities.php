<?php
authenticate($_SESSION['admin_id'], "adminlogin");
if(isset ($_GET['id'])){
  $id = $_GET['id'];
  $admin = fetchRecord2($conn, "admin", "admin_hash", $id);
}
$page_title = "Admin Activities";
include "includes/header.php";
?>

<div id="page-wrapper">
  <div class="graphs">
    <h3 class="blank1">Activities by - <?= $admin['admin_username'] ?></h3>
    <a href="admin"><i class="fa fa-arrow-circle-left"></i>Back to admin page</a>
       <div class="xs tabls">
         <div class="bs-example4" data-example-id="contextual-table">
           <div class="tab-content">
             <div class="tab-pane active" id="horizontal-form">
               <div class="form-group">
            			  <div class="col-md-3">
            					<div class="input-icon right spinner">
            						<input id="search" onkeyup="searchQuery(10, <?= $id ?>)" class="form-control1" type="text" placeholder="Search">
            					</div>
            				</div>
            				<div class="col-md-3"></div>
            				<div class="col-md-3">
            					<div class="input-icon right spinner">
                        <p>
                          <span>
                						<select class="" style="visibility:hidden" name="" id="sort" >
                              <option value="">Date</option>
                            </select>
                          </span>

                        </p>
            					</div>
            				</div>
            				<div class="col-md-3">
            					<div class="input-icon right spinner">
                        <p>Show
                          <span>
                						<select class="" name="" id="limit" onchange="filterLimit(10, <?= $id ?>)">
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
               <div id="loadrecord" class="table-responsive"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">loadData(1, '', 10, <?= $id ?>)</script>

<?php include("includes/footer.php"); ?>
