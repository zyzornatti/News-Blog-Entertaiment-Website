<?php
if(isset ($_SESSION['user'])){
  $desc = "Logged Out";
  $ad_ac = $conn->prepare("INSERT INTO public_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
  $ad_ac->bindParam(":ad", $_SESSION['user']);
  $ad_ac->bindParam(":ds", $desc);
  $ad_ac->execute();

  unset ($_SESSION['user']);
  session_destroy();
  header("location: /");
}
 ?>
