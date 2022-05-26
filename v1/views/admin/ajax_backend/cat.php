<?php
$status = [];
try{
  // $visibility = "show";
  if(isset ($_POST['category'])){
    $category = $_POST['category'];
    $slug = cleans($category);
    $chck_cat = countW2C($conn, "web_category", "web_section_id", $_POST['section'], "web_category_name", $category);
    if($chck_cat > 0){
      $status['failed'] = "Category Already Exist For That Section";
    }
  }
  // if(isset ($_POST['title'])){
  //   $title = $_POST['title'];
  //   $post_slug = cleans($title);
  //   $chck_slug = countContent2($conn, "web_content", "title_slug", $post_slug);
  //   if($chck_slug > 0){
  //     $status['failed'] = "There is a post with this title already, try another one";
  //   }
  // }
  if(isset ($_POST['section'])){
    $section = $_POST['section'];
  }

  if(empty ($status['failed'])){
    $hash = uniqid($category, true);
    $hash_id = md5($hash)."ct";
    $stmt = $conn->prepare("INSERT INTO web_category VALUES(NULL, :ct, :cs, :sc, :hi, NOW(),NOW())");
    $stmt->bindParam(":ct",$category);
    $stmt->bindParam(":cs",$slug);
    $stmt->bindParam(":sc",$section);
    $stmt->bindParam(":hi",$hash_id);
    $stmt->execute();

    $desc = "Added a web category - (".$category.")";
    $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
    $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
    $ad_ac->bindParam(":ds", $desc);
    $ad_ac->execute();
    $status['success'] = "successful";
    $_SESSION['msg'] = "Category Added Successfully";
  }

} catch(Exception $e){
  $status['failed'] = "Something went wrong";
  // $status['failed'] = $e;
}

$res = json_encode($status);
echo $res;




 ?>
