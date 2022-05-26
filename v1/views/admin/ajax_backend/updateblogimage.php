<?php
$status = [];
try{
  $id = $_POST['id'];

  $prevImg = $conn->prepare("SELECT * FROM web_content WHERE web_content_id=:id");
  $prevImg->bindParam(":id", $id);
  $prevImg->execute();
  $row = $prevImg->fetch(PDO::FETCH_BOTH);
  $previous_image = $row['image'];
  $prevImg_destination = 'uploads/POSTS/'.$previous_image;

  $image = $_FILES['image'];
  $imageName = $image['name'];
  $imageTmpName = $image['tmp_name'];
  $imageSize = $image['size'];
  $imageError = $image['error'];
  $imageNewExt = strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
  $img_allowed = array('jpg', 'jpeg', 'png');
  // $imageNewName = uniqid('', true).".".$imageNewExt;
  $imageNewName = md5($imageName).time().".".$imageNewExt;
  $imageDestination = 'uploads/POSTS/'.$imageNewName;

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

      $forum_image = $conn->prepare("UPDATE web_content SET image = :img WHERE web_content_id = :id");
      $forum_image->bindParam(':img', $imageNewName);
      $forum_image->bindParam(':id', $id);
      $forum_image->execute();

      if(move_uploaded_file($imageTmpName, $imageDestination)){
        unlink($prevImg_destination);
        $status['success'] = "Successful";
        $_SESSION['msg'] = "Post Image Changed Successfully";
      }

    }

} catch(Exception $e){
  $status['failed'] = "Something went wrong, try again!!!";
  // $status['failed'] = $e;
}

$res = json_encode($status);
echo $res;

 ?>
