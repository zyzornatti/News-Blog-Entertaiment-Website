<?php

$status = [];
  try{

    $ad = $conn->prepare("UPDATE contact SET contact_body=:cb WHERE hash_id=:id");
    $ad->bindParam(":id", $_POST['id']);
    $ad->bindParam(":cb", $_POST['ctbody']);
    $ad->execute();

    $status['success'] = "Successful";
    $_SESSION['msg'] = "Post Edited Successfully";


  } catch(Exception $e){
    // $status['failed'] = $e;
    $status['failed'] = "Something went wrong!!!";
  }

  $res = json_encode($status);
  echo $res;

?>
