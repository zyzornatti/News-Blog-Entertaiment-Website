<?php
  $status = [];
  try{
      if(isset ($_FILES['meme_img'])){
        $img_allowed = array('jpg', 'jpeg', 'png');
        // $imageNewName = uniqid('', true).".".$imageNewExt;

        foreach ($_FILES['meme_img']['tmp_name'] as $key => $value) {
          $image = $_FILES['meme_img'];
          $imageName = $image['name'][$key];
          $imageTmpName = $image['tmp_name'][$key];
          $imageSize = $image['size'][$key];
          $imageError = $image['error'][$key];
          $imageNewExt = strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
          $imageNewName = md5($imageName).time().".".$imageNewExt;
          $imageDestination = 'uploads/MEMES/'.$imageNewName;

          if (!in_array($imageNewExt, $img_allowed)){

              $status['img_failed'] = "Image extension not allowed for an image you selected!!!";

            }
            if ($imageError !== 0){

              $status['img_failed'] = "Error uploading an image you selected!!!";

            }
            if ($imageSize > 1000000){

              $status['img_failed'] = "One of the image you selected is too large!!!";

            }

            if(isset ($_POST['meme_cat'])){
              $category = $_POST['meme_cat'];
              $meme_cat = fetchRecord2($conn, "hom_memes_category", "memes_category_hash_id", $category);
            }
            if(empty ($status['failed'])){
              $hash = rand(1000, 9999).time();
              $hash_id = md5($hash)."hom";
              $visibility = "show";

              $ad = $conn->prepare("INSERT INTO hom_memes VALUES(NULL,:adb,:category,:img,:vs,:hi,NOW(),NOW())");
              $ad->bindParam(":adb", $_POST['admin_id']);
              $ad->bindParam(":category", $category);
              $ad->bindParam(":img", $imageNewName);
              $ad->bindParam(":vs", $visibility);
              $ad->bindParam(":hi", $hash_id);
              $ad->execute();

              move_uploaded_file($imageTmpName, $imageDestination);
              $desc = "Added a meme in - ".$meme_cat['memes_category_name']." category";
              $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
              $ad_ac->bindParam(":ad", $_POST['admin_id']);
              $ad_ac->bindParam(":ds", $desc);
              $ad_ac->execute();
              $status['success'] = "Successful";
              $_SESSION['msg'] = "Meme Added Successfully";
            }
        }



      }

  } catch(Exception $e){
    $status['failed'] = $e;
    // $status['failed'] = "Something went wrong!!!";
  }

  $res = json_encode($status);
  echo $res;

?>
