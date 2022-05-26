<?php
$status = [];
try{

  if(isset ($_POST['usr'])){
    $id = $_POST['usr'];
    $sus = $conn->prepare("SELECT * FROM public WHERE user_id=:id");
    $sus->bindParam(":id", $id);
    $sus->execute();

    $row = $sus->fetch(PDO::FETCH_BOTH);

    if($row['status'] == "SUSPENDED"){
      $st = "OK";
      $suspend = $conn->prepare("UPDATE public SET status=:st WHERE user_id=:id");
      $suspend->bindParam(":id", $id);
      $suspend->bindParam(":st", $st);
      $suspend->execute();
      $desc = "Unsuspend a user - ".$row['username'];
      $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
      $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
      $ad_ac->bindParam(":ds", $desc);
      $ad_ac->execute();
      $status['success'] = "This user now have access to the account";
    }
    if($row['status'] == "OK"){
      $st = "SUSPENDED";
      $suspend = $conn->prepare("UPDATE public SET status=:st WHERE user_id=:id");
      $suspend->bindParam(":id", $id);
      $suspend->bindParam(":st", $st);
      $suspend->execute();
      $desc = "Suspend a user - ".$row['username'];
      $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
      $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
      $ad_ac->bindParam(":ds", $desc);
      $ad_ac->execute();
      $status['success'] = "This user has been suspended!";
    }

  }

  if(isset ($_POST['admid'])){
      $id = $_POST['admid'];
      $sus = $conn->prepare("SELECT * FROM admin WHERE admin_id=:id");
      $sus->bindParam(":id", $_POST['admid']);
      $sus->execute();

      $row = $sus->fetch(PDO::FETCH_BOTH);

      if($row['status'] == "SUSPENDED"){
        $st = "OK";
        $suspend = $conn->prepare("UPDATE admin SET status=:st WHERE admin_id=:id");
        $suspend->bindParam(":id", $id);
        $suspend->bindParam(":st", $st);
        $suspend->execute();
        $desc = "Unsuspend an admin - ".$row['admin_username'];
        $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
        $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
        $ad_ac->bindParam(":ds", $desc);
        $ad_ac->execute();
        $status['success'] = "This admin now have access to the account!";
      }
      if($row['status'] == "OK"){
        $st = "SUSPENDED";
        $suspend = $conn->prepare("UPDATE admin SET status=:st WHERE admin_id=:id");
        $suspend->bindParam(":id", $id);
        $suspend->bindParam(":st", $st);
        $suspend->execute();
        $desc = "Suspend an admin - ".$row['admin_username'];
        $ad_ac = $conn->prepare("INSERT INTO admin_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
        $ad_ac->bindParam(":ad", $_SESSION['admin_id']);
        $ad_ac->bindParam(":ds", $desc);
        $ad_ac->execute();
        $status['success'] = "This admin has been suspended!";
      }

    }

} catch(Exception $e){
  $status['failed'] = "Something Went Wrong, Try Again!!!";
}

$res = json_encode($status);
echo $res;

 ?>
