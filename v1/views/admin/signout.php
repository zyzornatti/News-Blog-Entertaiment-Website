<?php
if(isset ($_SESSION['admin_id'])){
  $desc = "Logged Out";
  $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
  $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
  $ad_ac->bindParam(":ds", $desc);
  $ad_ac->execute();

  unset ($_SESSION['admin_id']);
  session_destroy();
  header("location: adminlogin");
}
 ?>
