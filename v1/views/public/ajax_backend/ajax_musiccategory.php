<?php
if(isset ($_POST['page'])){
  $page = $_POST['page'];
  $id = $_POST['id'];
}

$music_category = fetchContent($conn, "hom_mav_category");
$music_category_data = [];
foreach ($music_category as $key => $value) {
  $music_category_data[$value['hom_mav_category_hash_id']] = $value['hom_mav_category_name'];
}

$music_category1 = fetchContent($conn, "hom_mav_category");
$music_category_slug = [];
foreach ($music_category1 as $key => $value) {
  $music_category_slug[$value['hom_mav_category_hash_id']] = $value['hom_mav_category_slug'];
}

$post_author = fetchContent($conn, "admin");
$post_author_data = [];
foreach ($post_author as $key => $value) {
  $post_author_data[$value['admin_hash']] = $value['admin_username'];
}

$post_sect = fetchContent($conn, "admin");
$author_profile = [];
foreach ($post_sect as $key => $value) {
  $author_profile[$value['admin_hash']] = $value['admin_profile_pics'];
}

// $post_section = fetchContent($conn, "web_section");
// $post_section_data = [];
// foreach ($post_section as $key => $value) {
//   $post_section_data[$value['section_hash_id']] = $value['web_section_name'];
// }

$record = loadRecord($conn, "hom_mav", "hom_mav_category_id", $id, "hom_mav_id", $page);
 ?>

<?php foreach ($record as $key => $value): ?>
  <div class="post-item">
    <div class="post-item-wrap">
      <div class="post-image">
        <a href="/musiccategory/<?= $music_category_slug[$value['hom_mav_category_id']] ?>-<?= $value['hom_mav_category_id'] ?>">
        <img alt="" src="/uploads/POSTS/<?php echo $value['hom_mav_image'] ?>" style="height: 202.39px">
        </a>
        <span class="post-meta-category"><a href="/musiccategory/<?= $music_category_data[$value['hom_mav_category_id']] ?>-<?= $value['hom_mav_category_id'] ?>"><?php echo $music_category_data[$value['hom_mav_category_id']] ?></a></span>
      </div>
      <div class="post-item-description">
        <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?php echo date("F j, Y ", strtotime($value["date_created"])) ?></span>
        <!-- <span class="post-meta-comments">
          <a href="#"><i class="fa fa-comments-o"></i>33 Comments</a>
        </span> -->
        <h2><a href="/music/<?= $value['hom_mav_title_slug'] ?>-<?= $value['hom_mav_hash_id'] ?>"><?php echo $value['hom_mav_title'] ?>
        </a></h2>
        <?php //$body = shortContent($value['hom_mav_content']) ?>
        <p><?php //echo $body ?></p>
        <?php if($author_profile[$value['hom_mav_added_by']] == "NULL"): ?>
        <div class="post-author"> <img src="/<?php echo $dummy ?>">
        <p>by <a href="#"><?php echo $post_author_data[$value['hom_mav_added_by']] ?></a> <time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>"></p>
        </div>
         <?php else: ?>
        <div class="post-author"> <img src="/uploads/admin/<?= $author_profile[$value['hom_mav_added_by']] ?>">
        <p>by <a href="/author/<?= strtolower($post_author_data[$value['hom_mav_added_by']]) ?>-<?= $value['hom_mav_added_by'] ?>"><?php echo $post_author_data[$value['hom_mav_added_by']] ?></a> <time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>"></p>
        </div>
        <?php endif ?>
      </div>
    </div>
  </div>
<?php endforeach; ?>
