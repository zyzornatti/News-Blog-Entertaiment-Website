<?php

$fetch_cat = fetchContent($conn, "web_category");

foreach ($fetch_cat as $key => $value) {
  $slug = cleans($value['web_category_name']);

  $update = $conn->prepare("UPDATE web_category SET cat_slug = :cs WHERE web_category_id = :wci");
  $update->bindParam(":cs", $slug);
  $update->bindParam(":wci", $value['web_category_id']);
  $update->execute();
}

$fetch_sec = fetchContent($conn, "web_section");

foreach ($fetch_sec as $key => $value) {
  $slug = cleans($value['web_section_name']);

  $update = $conn->prepare("UPDATE web_section SET sec_slug = :cs WHERE section_id = :wci");
  $update->bindParam(":cs", $slug);
  $update->bindParam(":wci", $value['section_id']);
  $update->execute();
}

$fetch_sec = fetchContent($conn, "hom_memes_category");

foreach ($fetch_sec as $key => $value) {
  $slug = cleans($value['memes_category_name']);

  $update = $conn->prepare("UPDATE hom_memes_category SET memes_slug = :cs WHERE hom_memes_category_id = :wci");
  $update->bindParam(":cs", $slug);
  $update->bindParam(":wci", $value['hom_memes_category_id']);
  $update->execute();
}

 ?>
