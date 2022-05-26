<?php
$status = [];
try{
  if(isset ($_POST['section'])){
    $section = $_POST['section'];
    $slug = cleans($section);
    $chck_sec = countContent3($conn, "web_section", "section_hash_id", $_POST['id'], "web_section_name", $section);
    if($chck_sec > 0){
      $status['failed'] = "Web Section Already Exist";
    }
  }
  if(isset ($_POST['id'])){
    $id = $_POST['id'];
  }

  if(empty ($status['failed'])){
    $stmt = $conn->prepare("UPDATE web_section set web_section_name=:ct, sec_slug=:sc WHERE section_hash_id=:id");
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":ct", $section);
    $stmt->bindParam(":sc", $slug);
    $stmt->execute();
    $status['success'] = "successful";
    $_SESSION['msg'] = "Web Section Edited Successfully";
  }

} catch(Exception $e){
  $status['failed'] = "Something went wrong";
  // $status['failed'] = $e;
}

$res = json_encode($status);
echo $res;

 ?>
