<?php
authenticate($_SESSION['admin_id'], "adminlogin");
if(isset ($_GET['id'])){
  $id = $_GET['id'];
  $post = fetchRecord2($conn, "web_content", "hash_id", $id);
  $views = countContent2($conn, "stats", "content_id", $id);
  $comments = countContent2($conn, "hom_comments", "content_id", $id);
  $replies = countContent2($conn, "hom_replies", "content_id", $id);
  $total_interactions = $comments+$replies;
}
$page_title = "Post Activities";
include "includes/header.php";
?>

<div id="page-wrapper">
  <div class="graphs">
    <h3 class="blank1">Activities on this post :- <?= $post['title'] ?></h3>
    <h2 class="blank1"><?=$views ?> Views, <?= $total_interactions ?> Interactions(<?= $comments ?> Comments, <?= $replies ?> Replies)</h2>
    <a href="viewpost"><i class="fa fa-arrow-circle-left"></i>Back to view post page</a>
       <div class="xs tabls">
         <div class="bs-example4" data-example-id="contextual-table">
           <div class="tab-content">
             <div class="tab-pane active" id="horizontal-form">

               <div class="col-md-3">
                   <div class="input-icon right spinner">
                      <p>Show
                       <span>
                       <select class="" name="" id="limit" onchange="postAct(1, '<?= $id ?>')">
                         <option value="1">1</option>
                         <option value="2">2</option>
                         <option value="3">3</option>
                         <option value="4">4</option>
                       </select>
                       </span>
                       entries
                      </p>
                   </div>
                 </div><br><br>

               <div id="loadrecord" class="table-responsive"></div>
             </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  postAct(1, '<?= $id ?>');
</script>

<?php include("includes/footer.php"); ?>
