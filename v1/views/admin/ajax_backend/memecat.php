<?php
$status = [];
try{
  if(isset ($_POST['category'])){
    $category = $_POST['category'];
    $slug = cleans($category);
    $chck_cat = countContent2($conn, "hom_memes_category", "memes_category_name", $category);
    if($chck_cat > 0){
      $status['failed'] = "Meme Category Already Exist";
    }
  }

  if(empty ($status['failed'])){
    $hash = uniqid($category, true);
    $hash_id = md5($hash)."mct";
    $stmt = $conn->prepare("INSERT INTO hom_memes_category VALUES(NULL, :ctn, :ms, :hi, NOW(),NOW())");
    $stmt->bindParam(":ctn",$category);
    $stmt->bindParam(":ms",$slug);
    $stmt->bindParam(":hi",$hash_id);
    $stmt->execute();

    $desc = "Added a meme category - (".$category.")";
    $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
    $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
    $ad_ac->bindParam(":ds", $desc);
    $ad_ac->execute();
    $status['success'] = "successful";
    $_SESSION['msg'] = "Meme Category Added Successfully";
  }

} catch(Exception $e){
  $status['failed'] = "Something went wrong";
  // $status['failed'] = $e;
}

$res = json_encode($status);
echo $res;




 ?>
