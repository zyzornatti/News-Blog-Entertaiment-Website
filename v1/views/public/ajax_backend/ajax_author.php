<?php
if(isset ($_POST['page'])){
  $page = $_POST['page'];
  $id = $_POST['id'];
}

$post_category = fetchContent($conn, "web_category");
$post_category_data = [];
foreach ($post_category as $key => $value) {
  $post_category_data[$value['category_hash_id']] = $value['web_category_name'];
}

$post_category1 = fetchContent($conn, "web_category");
$post_category_slug = [];
foreach ($post_category1 as $key => $value) {
  $post_category_slug[$value['category_hash_id']] = $value['cat_slug'];
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

$post_section = fetchContent($conn, "web_section");
$post_section_data = [];
foreach ($post_section as $key => $value) {
  $post_section_data[$value['section_hash_id']] = $value['web_section_name'];
}

$post_section1 = fetchContent($conn, "web_section");
$post_section_slug = [];
foreach ($post_section1 as $key => $value) {
  $post_section_slug[$value['section_hash_id']] = $value['sec_slug'];
}

$record = loadRecord($conn, "web_content", "author_id", $id, "web_content_id", $page);
 ?>

<?php foreach ($record as $key => $value): ?>
  <div class="post-item">
    <div class="post-item-wrap">
      <div class="post-image">
        <a href="/post/<?= $value['title_slug'] ?>-<?= $value['hash_id'] ?>">
        <img alt="" src="/uploads/POSTS/<?php echo $value['image'] ?>" style="height: 202.39px">
        </a>
        <span class="post-meta-category"><a href="/category/<?= $post_section_slug[$value['section']] ?>/<?= $post_category_slug[$value['category_id']] ?>-<?= $value['category_id'] ?>"><?php echo $post_category_data[$value['category_id']] ?></a></span>
      </div>
      <div class="post-item-description">
        <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?php echo date("F j, Y ", strtotime($value["date_created"])) ?></span>
        <!-- <span class="post-meta-comments">
          <a href="#"><i class="fa fa-comments-o"></i>33 Comments</a>
        </span> -->
        <h2><a href="/post/<?= $value['title_slug'] ?>-<?= $value['hash_id'] ?>"><?php echo $value['title'] ?>
        </a></h2>
        <?php $body = shortContent($value['body']) ?>
        <p><?php echo $body ?></p>
        <?php if($author_profile[$value['author_id']] == "NULL"): ?>
        <div class="post-author"> <img src="/<?php echo $dummy ?>">
        <p>by <a href="/author/<?= strtolower($post_author_data[$value['author_id']]) ?>-<?= $value['author_id'] ?>"><?php echo $post_author_data[$value['author_id']] ?></a> <time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>"></p>
        </div>
         <?php else: ?>
        <div class="post-author"> <img src="/uploads/admin/<?= $author_profile[$value['author_id']] ?>">
        <p>by <a href="/author/<?= strtolower($post_author_data[$value['author_id']]) ?>-<?= $value['author_id'] ?>"><?php echo $post_author_data[$value['author_id']] ?></a> <time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>"></p>
        </div>
        <?php endif ?>
      </div>
    </div>
  </div>
<?php endforeach; ?>
