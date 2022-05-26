<?php
authenticate($_SESSION['admin_id'], "adminlogin");
$page_title = "Meme Category";
include "includes/header.php";
 ?>

<?php if(isset ($_SESSION['msg'])){ ?>
  <div style="visibility:hidden" id="msg" data-msg="<?php echo $_SESSION['msg']; ?>"></div>
<?php unset ($_SESSION['msg']); ?>
<?php } ?>
<script type="text/javascript">popUpShow()</script>

<div id="page-wrapper">
  <div class="graphs">
    <h3 class="blank1">Meme Categories</h3>
    <a href="addmemecat"><i class="fa fa-plus-square"></i>Add New Meme Category</a>
      <div class="xs tabls">
        <div class="bs-example4" data-example-id="contextual-table">
          <div class="tab-content">
            <div class="tab-pane active" id="horizontal-form">
              <div class="form-group">
                   <div class="col-md-3">
                     <div class="input-icon right spinner">
                       <input id="search" onkeyup="searchMeme(12)" class="form-control1" type="text" placeholder="Search">
                     </div>
                   </div>
                   <div class="col-md-3">
                     <p id="sort"></p>
                   </div>
                   <div class="col-md-3">
                       <div class="input-icon right spinner">
                          <p>Show
                           <span>
                           <select class="" name="" id="limit" onchange="filterMemeLimit(12)">
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
<script type="text/javascript">loadMeme(1, '', 12)</script>

 <?php include "includes/footer.php"; ?>
