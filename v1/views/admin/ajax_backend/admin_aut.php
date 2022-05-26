<?php
$status = [];
try {
  if(isset ($_POST['cd'])){
    $gen_code = $_POST['cd'];
    $st = 0;
  }
  $stmt = $conn->prepare("INSERT INTO admin_auth VALUES (NULL,:gc,:st,NULL,NULL, NOW(), NOW())");
  $stmt->bindParam(":gc", $gen_code);
  $stmt->bindParam(":st", $st);
  $stmt->execute();

  $status['success'] = "Successful";
} catch(Excetion $e){
  $status['failed'] = "Something went wrong, Try again!!!";
}

$res = json_encode($status);
echo $res;
 ?>
