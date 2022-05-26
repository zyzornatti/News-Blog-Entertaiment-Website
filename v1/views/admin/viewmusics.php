<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Musics";
$page_folder = "MUSIC";
include "includes/header.php";
?>

<?php if(isset ($_SESSION['msg'])){ ?>
  <div style="visibility:hidden" id="msg" data-msg="<?php echo $_SESSION['msg']; ?>"></div>
<?php unset ($_SESSION['msg']); ?>
<?php } ?>

<script type="text/javascript">popUpShow()</script>

<div id="page-wrapper">
  <div class="graphs">
    <h3 class="blank1">Musics</h3>
    <a href="addmusic"><i class="fa fa-plus-square"></i>Add New Music</a>
       <div class="xs tabls">
         <div class="bs-example4" data-example-id="contextual-table">
           <div class="tab-content">
             <div class="tab-pane active" id="horizontal-form">
               <div class="form-group">
            			  <div class="col-md-3">
            					<div class="input-icon right spinner">
            						<input id="search" onkeyup="searchQuery(15, <?= $_SESSION['admin_id'] ?>)" class="form-control1" type="text" placeholder="Search">
            					</div>
            				</div>
            				<div class="col-md-3"></div>
            				<div class="col-md-3">
            					<div class="input-icon right spinner">
                        <p>
                          Sort by
                          <span>
                						<select class="" name="" id="sort" onchange="sortRecord(15, <?= $_SESSION['admin_id'] ?>)">
                              <?php $sort = fetchContent($conn, "hom_mav_category") ?>
                              <?php foreach ($sort as $key => $value): ?>
                                <option value="<?= $value['hom_mav_category_hash_id'] ?>"><?= $value['hom_mav_category_name'] ?></option>
                              <?php endforeach; ?>
                            </select>
                          </span>
                          Category
                        </p>
            					</div>
            				</div>
            				<div class="col-md-3">
            					<div class="input-icon right spinner">
                        <p>Show
                          <span>
                						<select class="" name="" id="limit" onchange="filterLimit(15, <?= $_SESSION['admin_id']?>)">
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
<script type="text/javascript">loadData(1, '', 15, <?= $_SESSION['admin_id'] ?>)</script>

<?php include("includes/footer.php"); ?>
