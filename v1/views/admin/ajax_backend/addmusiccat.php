<?php
$status = [];
try{
  // $visibility = "show";
  if(isset ($_POST['category'])){
    $category = $_POST['category'];
    $slug = cleans($category);
    $chck_cat = countContent2($conn, "hom_mav_category", "hom_mav_category_name", $category);;
    if($chck_cat > 0){
      $status['failed'] = "Music Category Already Exist!";
    }
  }

  if(empty ($status['failed'])){
    $hash = uniqid($category, true);
    $hash_id = md5($hash)."mct";
    $stmt = $conn->prepare("INSERT INTO hom_mav_category VALUES(NULL, :ct, :cs,:hi, NOW(),NOW())");
    $stmt->bindParam(":ct",$category);
    $stmt->bindParam(":cs",$slug);
    $stmt->bindParam(":hi",$hash_id);
    $stmt->execute();

    $desc = "Added a music category - (".$category.")";
    $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
    $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
    $ad_ac->bindParam(":ds", $desc);
    $ad_ac->execute();
    $status['success'] = "successful";
    $_SESSION['msg'] = "Music Category Added Successfully";
  }

} catch(Exception $e){
  $status['failed'] = "Something went wrong";
  // $status['failed'] = $e;
}

$res = json_encode($status);
echo $res;




 ?>
