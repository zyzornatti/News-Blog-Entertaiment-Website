<?php

$status = [];
  try{
    $image = $_FILES['image'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    $imageNewExt = strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
    $img_allowed = array('jpg', 'jpeg', 'png');
    $imageNewName = md5($imageName).time().".".$imageNewExt;
    // $imageNewName = uniqid('', true).".".$imageNewExt;
    $imageDestination = 'uploads/CONTACT/'.$imageNewName;

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
    $visibility = "show";
    $hash_id = md5($imageNewName).time()."cont";
    $ad = $conn->prepare("INSERT INTO contact VALUES(NULL,:body,:img,:hi,:vs,NOW(),NOW())");
    $ad->bindParam(":body", $_POST['ctbody']);
    $ad->bindParam(":img", $imageNewName);
    $ad->bindParam(":hi", $hash_id);
    $ad->bindParam(":vs", $visibility);
    $ad->execute();

    if(move_uploaded_file($imageTmpName, $imageDestination)){
      $status['success'] = "Successful";
      $_SESSION['msg'] = "Post Added Successfully";
    }

  }

  } catch(Exception $e){
    $status['failed'] = $e;
    // $status['failed'] = "Something went wrong!!!";
  }

  $res = json_encode($status);
  echo $res;

?>
