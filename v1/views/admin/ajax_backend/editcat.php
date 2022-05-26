<?php
$status = [];
try{
  if(isset ($_POST['category'])){
    $category = $_POST['category'];
    $slug = cleans($category);
    $chck_cat = countContent4($conn, "web_category", "category_hash_id", $_POST['id'], "web_category_name", $category, "web_section_id", $_POST['section']);
    if($chck_cat > 0){
      $status['failed'] = "Category Already Exist For That Section";
    }
  }
  if(isset ($_POST['id'])){
    $id = $_POST['id'];
  }

  if(empty ($status['failed'])){
    $stmt = $conn->prepare("UPDATE web_category SET web_category_name=:ct, cat_slug=:cs WHERE category_hash_id=:id");
    $stmt->bindParam(":id",$id);
    $stmt->bindParam(":ct",$category);
    $stmt->bindParam(":cs",$slug);
    $stmt->execute();
    $status['success'] = "successful";
    $_SESSION['msg'] = "Category Edited Successfully";
  }

} catch(Exception $e){
  $status['failed'] = "Something went wrong";
}

$res = json_encode($status);
echo $res;

 ?>
