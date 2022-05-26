<?php
//allowed origin to upload images
$accepted_origins = array("http://192.168.33.18", "https://homeofmemes.com");

//images upload path
$folder = $_POST['folder'];
$imagefolder = "uploads/$folder/";
// $imagefolder = "uploads/";

reset($_FILES);
$temp = current($_FILES);
$imageNewExt = strtolower(pathinfo($temp['name'],PATHINFO_EXTENSION));
$img_allowed = array('jpg', 'jpeg', 'png');
$imageNewName = uniqid('', true).".".$imageNewExt;
$filetowrite = $imagefolder . $imageNewName;

if(is_uploaded_file($temp['tmp_name'])){

  if(isset ($_SERVER['HTTP_ORIGIN'])){
    //same-origin requests won't set an origin. If the origin is set, it must be valid.
    if(in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)){
      header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
    }else{
      header("HTTP/1.1 403 Origin Denied");
      return;
    }
  }

  //sanitize input
  if(preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])){
    header("HTTP/1.1 400 Invalid file name.");
    return;
  }

  if(!in_array ($imageNewExt, $img_allowed)){
    header("HTTP/1.1 400 Invalid extension.");
    return;
  }
  // if(!in_array (strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))){
  //   header("HTTP/1.1 400 Invalid extension.");
  //   return;
  // }

  if ($temp['size'] > 1000000){
    header("HTTP/1.1 400 Image too large!!!.");
    return;
  }

  //Accept upload if there was no origin, or if it is accepted origin den give the image a unique name

  // $filetowrite = $imagefolder . $temp['name'];

  move_uploaded_file($temp['tmp_name'], $filetowrite);
  // move_uploaded_file($temp['tmp_name'], $filetowrite);

  //Respond to the successful upload with JSON.
  //Use a location key to specify the path to the saved image resources.
  //{ location : '/your/upload/image/file'}

  echo json_encode(array('location' => $filetowrite));

}else{
  //Notify Editor that the upload failed
  header("HTTP/1.1 500 Server Error");
}

 ?>
