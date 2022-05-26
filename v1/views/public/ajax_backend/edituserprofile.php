<?php
// include "/controller/controller.php";
$status = [];
try{
  //edit name
  if(isset ($_POST['id']) && isset ($_POST['name'])){
    $id = $_POST['id'];
    $name = $_POST['name'];

    $user_name = $conn->prepare("SELECT * FROM public WHERE user_id = :uid");
    $user_name->bindParam(":uid", $id);
    $user_name->execute();
    $check_user_name = $user_name->fetch(PDO::FETCH_BOTH);
    $old_name = $check_user_name['name'];


    if($check_user_name['name'] == $name){
      $status['failed'] = "You haven't changed your name!!!";

    }else{
      $update_name = $conn->prepare("UPDATE public SET name = :nm WHERE user_id = :uid");
      $data = array(
        ":nm" => $name,
        ":uid" => $id
      );
      $update_name->execute($data);
      $new_name = fetchRecord2($conn, "public", "user_id", $id);


      $desc = "Updated name from";
      $old = $old_name;
      $desc.=" '$old' to :-";
      $new = $new_name['name'];
      $desc.=" '$new'";
      $ad_ac = $conn->prepare("INSERT INTO public_activities VALUES(NULL, :us, :ds, NOW(), NOW())");
      $ad_ac->bindParam(":us", $id);
      $ad_ac->bindParam(":ds", $desc);
      $ad_ac->execute();
      $_SESSION['msg'] = "Your name has been updated successfully!!!";
      $status['success'] = "successful";

    }
  }
//edit email
  if(isset ($_POST['id']) && isset ($_POST['email'])){
    $id = $_POST['id'];
    $email = $_POST['email'];

    if(!filter_var ($_POST['email'], FILTER_VALIDATE_EMAIL)){
      $status['failed'] = "Enter a valid email";
    }else{
      $user_email = $conn->prepare("SELECT * FROM public WHERE user_id = :uid");
      $user_email->bindParam(":uid", $id);
      $user_email->execute();
      $check_user_email = $user_email->fetch(PDO::FETCH_BOTH);
      $old_email = $check_user_email['email'];

      $check_email = $conn->prepare("SELECT * FROM public WHERE email = :em");
      $check_email->bindParam(":em", $email);
      $check_email->execute();

      if($check_user_email['email'] == $email){
        $status['failed'] = "You haven't changed your email!!!";

      }elseif(($check_user_email['email'] !== $email) && ($check_email->rowCount() > 0)){
        $status['failed'] = "Email has already been registered by another user!!!";

      }elseif(($check_user_email['email'] !== $email) && ($check_email->rowCount() < 1)){
        $update_email = $conn->prepare("UPDATE public SET email = :em WHERE user_id = :uid");
        $data = array(
          ":em" => $email,
          ":uid" => $id
        );
        $update_email->execute($data);
        $new_email = fetchRecord2($conn, "public", "user_id", $id);

        $desc = "Updated email from";
        $old = $old_email;
        $desc.=" '$old' to :-";
        $new = $new_email['email'];
        $desc.=" '$new'";
        $ad_ac = $conn->prepare("INSERT INTO public_activities VALUES(NULL, :us, :ds, NOW(), NOW())");
        $ad_ac->bindParam(":us", $id);
        $ad_ac->bindParam(":ds", $desc);
        $ad_ac->execute();

        $_SESSION['msg'] = "Your email has been changed successfully!!!";
        $status['success'] = "successful";

      }else{
        $status['failed'] = "Something went wrong, try again!!!";
      }
    }

  }
//edit phone number
if(isset ($_POST['id']) && isset ($_POST['pnum'])){
  $id = $_POST['id'];
  $pnum = $_POST['pnum'];

  if(!is_numeric ($pnum)){
    $status['failed']= "Phone number can only be numeric value";

  }else{
    $user_pnum = $conn->prepare("SELECT * FROM public WHERE user_id = :uid");
    $user_pnum->bindParam(":uid", $id);
    $user_pnum->execute();
    $check_user_pnum = $user_pnum->fetch(PDO::FETCH_BOTH);
    $old_number = $check_user_pnum['phone_number'];

    $check_pnum = $conn->prepare("SELECT * FROM public WHERE phone_number = :pn");
    $check_pnum->bindParam(":pn", $pnum);
    $check_pnum->execute();

    if($check_user_pnum['phone_number'] == $pnum){
      $status['failed'] = "You haven't changed your phone number!!!";

    }elseif(($check_user_pnum['phone_number'] !== $pnum) && ($check_pnum->rowCount() > 0)){
      $status['failed'] = "Phone number has already been registered by another user!!!";

    }elseif(($check_user_pnum['phone_number'] !== $pnum) && ($check_pnum->rowCount() < 1)){
      $update_pnum = $conn->prepare("UPDATE public SET phone_number = :pn WHERE user_id = :uid");
      $data = array(
        ":pn" => $pnum,
        ":uid" => $id
      );
      $update_pnum->execute($data);
      $new_number = fetchRecord2($conn, "public", "user_id", $id);

      $desc = "Updated phone number from";
      $old = $old_number;
      $desc.=" '$old' to :-";
      $new = $new_number['phone_number'];
      $desc.=" '$new'";
      $ad_ac = $conn->prepare("INSERT INTO public_activities VALUES(NULL, :us, :ds, NOW(), NOW())");
      $ad_ac->bindParam(":us", $id);
      $ad_ac->bindParam(":ds", $desc);
      $ad_ac->execute();

      $_SESSION['msg'] = "Your phone number has been changed successfully!!!";
      $status['success'] = "successful";

    }else{
      $status['failed'] = "Something went wrong, try again!!!";
    }
  }

}
//edit username
if(isset ($_POST['id']) && isset ($_POST['username'])){
  $id = $_POST['id'];
  $username = $_POST['username'];

  $user_username = $conn->prepare("SELECT * FROM public WHERE user_id = :uid");
  $user_username->bindParam(":uid", $id);
  $user_username->execute();
  $check_user_username = $user_username->fetch(PDO::FETCH_BOTH);
  $old_username = $check_user_username['username'];

  $check_username = $conn->prepare("SELECT * FROM public WHERE username = :us");
  $check_username->bindParam(":us", $username);
  $check_username->execute();

  if($check_user_username['username'] == $username){
    $status['failed'] = "You haven't changed your username!!!";

  }elseif(($check_user_username['username'] !== $username) && ($check_username->rowCount() > 0)){
    $status['failed'] = "Username taken, try another one!!!";

  }elseif(($check_user_username['username'] !== $username) && ($check_username->rowCount() < 1)){
    $update_username = $conn->prepare("UPDATE public SET username = :us WHERE user_id = :uid");
    $data = array(
      ":us" => $username,
      ":uid" => $id
    );
    $update_username->execute($data);
    $new_username = fetchRecord2($conn, "public", "user_id", $id);

    $desc = "Updated username from";
    $old = $old_username;
    $desc.=" '$old' to :-";
    $new = $new_username['username'];
    $desc.=" '$new'";
    $ad_ac = $conn->prepare("INSERT INTO public_activities VALUES(NULL, :us, :ds, NOW(), NOW())");
    $ad_ac->bindParam(":us", $id);
    $ad_ac->bindParam(":ds", $desc);
    $ad_ac->execute();
    $_SESSION['msg'] = "Your username has been changed successfully!!!";
    $status['success'] = "successful";

  }else{
    $status['failed'] = "Something went wrong, try again!!!";
  }

}
//Change Password
if(isset ($_POST['id']) && isset ($_POST['oldpword']) && isset ($_POST['newpword']) && isset ($_POST['cpword'])){
  $id = $_POST['id'];
  $oldpword = $_POST['oldpword'];
  $pword = $_POST['newpword'];
  $cpword = $_POST['cpword'];

  $user_password = $conn->prepare("SELECT * FROM public WHERE user_id = :uid");
  $user_password->bindParam(":uid", $id);
  $user_password->execute();
  $confirm_password = $user_password->fetch(PDO::FETCH_BOTH);

  if($confirm_password['user_id'] == $id && password_verify($oldpword, $confirm_password['password'])){
    if($pword !== $cpword){
      $status['failed'] = "Password missmatch";

    }else{
      $hash = password_hash($pword, PASSWORD_BCRYPT);
      $change_pword = $conn->prepare("UPDATE public SET password = :pw WHERE user_id = :uid");
      $change_pword->bindParam(":pw", $hash);
      $change_pword->bindParam(":uid", $id);
      $change_pword->execute();

      $desc = "Changed password";
      $ad_ac = $conn->prepare("INSERT INTO public_activities VALUES(NULL, :us, :ds, NOW(), NOW())");
      $ad_ac->bindParam(":us", $id);
      $ad_ac->bindParam(":ds", $desc);
      $ad_ac->execute();
      $_SESSION['msg'] = "Your password has been changed successfully!!!";
      $status['success'] = "successful";
    }
  }else{
    $status['failed'] = "Old password incorrect";
  }
}


} catch(Exception $e){
  // $status['failed'] = $e;
  $status['failed'] = "Something went wrong, try again!!!";
}

$res = json_encode($status);
echo $res;
 ?>
