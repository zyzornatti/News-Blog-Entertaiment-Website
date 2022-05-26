<?php
require_once APP_PATH.'/vendor/autoload.php';

$clientId = "751855922065-b255gdh3h5t90178lr0srsr2aet98f8q.apps.googleusercontent.com";
$clientSecret = "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";
$redirectUrl = "https://homeofmemes.com/gsignin";

$client = new Google_Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUrl);

$client->AddScope('profile');
$client->AddScope('email');

if(isset ($_GET['code'])){

  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token);

  $gauth = new Google_Service_Oauth2($client);
  $google_info = $gauth->userinfo->get();
  $gemail = $google_info->email;
  $gname = $google_info->name;

  var_dump($google_info);
  if(isset ($token['error']) != "invalid_grant"){
    $fname = $google_info->familyName;
    $lname = $google_info->givenName;
    $name = $fname." ".$lname;
    $email = $google_info->email;
    $username = "user".time();
    $

    $reg_user = $conn->prepare("INSERT INTO public VALUES (NULL, :nm,:em,:pn,:us,:ps,:st,:uh,NOW(),NOW())");
    $reg_user->bindParam(":nm", $name);
    $reg_user->bindParam(":em", $email);
    $reg_user->bindParam(":pn", $pnum);
    $reg_user->bindParam(":us", $username);
    $reg_user->bindParam(":ps", $hash);
    $reg_user->bindParam(":st", $stat);
    $reg_user->bindParam(":uh", $user_hash);
    $reg_user->execute();

    var_dump($google_info);
    // header("Location: /");
  }else{
    header("Location: /signin");
  }
  // $_SESSION['msg'] = "Welcome ".$gname." your email is ".$gemail;


}else{
  header("Location: /signin");
}


?>
