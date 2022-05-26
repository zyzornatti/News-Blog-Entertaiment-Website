<?php
$status = [];
try{
  $id = $_POST['admid'];

  $image = $_FILES['image'];
  $imageName = $image['name'];
  $imageTmpName = $image['tmp_name'];
  $imageSize = $image['size'];
  $imageError = $image['error'];
  $imageNewExt = strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
  $img_allowed = array('jpg', 'jpeg', 'png');
  $imageNewName = md5($imageName).time().".".$imageNewExt;
  // $imageNewName = uniqid('', true).".".$imageNewExt;
  $imageDestination = 'uploads/admin/'.$imageNewName;

    if (!in_array($imageNewExt, $img_allowed)){

        $status['failed'] = "Image extension not allowed!!!";

      }
    if ($imageError !== 0){

      $status['failed'] = "Error Uploading Image!!!";

      }
    if ($imageSize > 1000000){

      $status['failed'] = "Image too large!!!";

      }

    if(empty ($status['failed'])){
      $prf = $conn->prepare("UPDATE admin SET admin_profile_pics = :app WHERE admin_id = :id");
      $prf->bindParam(':app', $imageNewName);
      $prf->bindParam(':id', $id);
      $prf->execute();
      move_uploaded_file($imageTmpName, $imageDestination);
      $status['success'] = "Profile Image Uploaded Successfully";
      // $_SESSION['msg'] = "Profile Image Uploaded Successfully";
    }

} catch(Exception $e){
  // $status['failed'] = "Something went wrong, try again!!!";
  $status['failed'] = $e;
}

$res = json_encode($status);
echo $res;

 ?>
