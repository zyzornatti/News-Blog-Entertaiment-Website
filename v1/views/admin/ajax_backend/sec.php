<?php
$status = [];
try{
  // $visibility = "show";
  if(isset ($_POST['section'])){
    $section = $_POST['section'];
    $slug = cleans($section);
    $chck_sec = countContent2($conn, "web_section", "web_section_name", $section);
    if($chck_sec > 0){
      $status['failed'] = "Web Section Already Exist";
    }
  }

  if(empty ($status['failed'])){
    $hash = uniqid($section, true);
    $hash_id = md5($hash)."sec";
    $stmt = $conn->prepare("INSERT INTO web_section VALUES(NULL, :ct, :sc, :hi, NOW(),NOW())");
    $stmt->bindParam(":ct",$section);
    $stmt->bindParam(":sc",$slug);
    $stmt->bindParam(":hi",$hash_id);
    $stmt->execute();

    $desc = "Added a web section - (".$section.")";
    $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
    $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
    $ad_ac->bindParam(":ds", $desc);
    $ad_ac->execute();
    $status['success'] = "successful";
    $_SESSION['msg'] = "Web Section Added Successfully";
  }

} catch(Exception $e){
  $status['failed'] = "Something went wrong";
  // $status['failed'] = $e;
}

$res = json_encode($status);
echo $res;




 ?>
