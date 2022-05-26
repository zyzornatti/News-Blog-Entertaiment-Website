<?php

if(isset($page_name)){
  $metakeys = $page_name;
if($page_name == "Home"){
  include 'home_meta.php';
}elseif ($page_name == "Contact") {
  include 'contact_meta.php';
}elseif ($page_name == "Post") {
    include 'blog_meta.php';
}elseif ($page_name == "Category") {
    include 'category_meta.php';
}elseif ($page_name == "Author") {
    include 'author_meta.php';
}elseif ($page_name == "Music") {
    include 'music_meta.php';
}elseif ($page_name == "Music Category") {
    include 'music_cat_meta.php';
}else{
  include 'others_meta.php';
}
}else{
  include 'others_meta.php';
}
// include 'seo/fb_head.php';

 ?>
