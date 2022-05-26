 <?php
 $user_id = fetchContent($conn, "public");
 $user_id_data = [];
 foreach ($user_id as $key => $value) {
   $user_id_data[$value['user_hash']] = $value['username'];
 }

 if(isset ($_POST['page'])){
   $page = $_POST['page'];
 }
 if(isset ($_POST['id'])){
   $id = $_POST['id'];
 }

 $comment = loadRecord($conn, "hom_comments", "content_id", $id, "comment_id", $page);
 ?>
  <?php foreach ($comment as $key => $value): ?>
    <div class="comment" id="comment-1">
      <div class="image">
        <img alt="" src="/<?php echo $dummy ?>" class="avatar">
      </div>
      <div class="text">
        <h5 class="name"><?php echo $user_id_data[$value['user_id']] ?></h5>
        <span class="comment_date"><time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>"></time></span>
        <a class="comment-reply-link" href="javascript:void(0)" onclick="getReply('<?= $value['comment_id'] ?>', '<?= $id ?>', '<?= $value['user_id'] ?>')">Reply</a>
        <div class="text_holder">
          <p><?php echo $value['body'] ?></p>
        </div>
      </div>

      <?php $reply = countContent2($conn, "hom_replies", "comment_id", $value['comment_id']); ?>
      <?php if($reply > 0): ?>
        <?php $replies = loadRecord($conn, "hom_replies", "comment_id", $value['comment_id'], "reply_id", 5); ?>
        <?php foreach ($replies as $key => $value): ?>
        <div class="comment" id="comment-1-1">
          <div class="image"><img alt="" src="/<?php echo $dummy ?>" class="avatar"></div>
        <div class="text">
          <h5 class="name"><?php echo $user_id_data[$value['user_id']] ?></h5>
          <span class="comment_date"><time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>"></time></span>
          <a class="comment-reply-link" href="javascript:void(0)" onclick="getReply('<?= $value['comment_id'] ?>', '<?= $id ?>', '<?= $value['user_id'] ?>')" >Reply</a>
          <div class="text_holder">
          <p><?php echo $value['body'] ?></p>
          </div>
        </div>
      </div>
        <?php endforeach ?>
      <?php endif ?>
      </div>
    <?php endforeach ?>
