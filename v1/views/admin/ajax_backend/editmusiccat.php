<?php
$status = [];
try{
  if(isset ($_POST['category']) && isset ($_POST['cat_id'])){
    $category = $_POST['category'];
    $slug = cleans($category);
    $hash_id = $_POST['cat_id'];
    $old_c = fetchRecord2($conn, "hom_mav_category", "hom_mav_category_hash_id", $hash_id);
    $old_cat = $old_c['hom_mav_category_name'];

    $chck_cat = countContent3($conn, "hom_mav_category", "hom_mav_category_hash_id", $hash_id, "hom_mav_category_name", $category);
    if($chck_cat > 0){
      $status['failed'] = "Music Category Already Exist!";
    }
  }

  if(empty ($status['failed'])){

    $stmt = $conn->prepare("UPDATE hom_mav_category SET hom_mav_category_name = :mcn, hom_mav_category_slug = :cs WHERE hom_mav_category_hash_id = :mchi");
    $stmt->bindParam(":mcn",$category);
    $stmt->bindParam(":cs",$slug);
    $stmt->bindParam(":mchi",$hash_id);
    $stmt->execute();

    $desc = "Edited music category from (".$old_cat.") - (".$category.")";
    $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
    $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
    $ad_ac->bindParam(":ds", $desc);
    $ad_ac->execute();
    $status['success'] = "successful";
    $_SESSION['msg'] = "Meme Category Updated Successfully";
  }

} catch(Exception $e){
  $status['failed'] = "Something went wrong";
  // $status['failed'] = $e;
}

$res = json_encode($status);
echo $res;




 ?>
