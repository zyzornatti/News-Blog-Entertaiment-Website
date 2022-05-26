<?php
$section = $_POST['section'];

$category = fetchContent2($conn, "web_category", "web_section_id", $section);
$count = countContent2($conn, "web_category", "web_section_id", $section);
$output = '
  <select id="category" name="selector1" class="form-control1">
    <option value="">--Select Category--</option>
';
if($count > 0){
  foreach ($category as $row) {
    $output .= '
        <option value="'.$row['category_hash_id'].'">'.$row['web_category_name'].'</option>
    ';
  }
}else{
  $output .= '
  <option value="">No category found for this section</option>
  ';
}
$output .= '</select>';
echo $output;

 ?>
