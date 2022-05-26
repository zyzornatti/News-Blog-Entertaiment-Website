<?php
$status = [];
try{
  // $name = $_POST['name'];
  // $email = $_POST['email'];
  // $website = $_POST['website'];
  $user = $_POST['user'];
  $body = $_POST['c_body'];
  $content_id = $_POST['postid'];

  $post_details = fetchRecord2($conn, "web_content", "hash_id", $content_id);

  $sc = $conn->prepare("INSERT into hom_comments VALUES(NULL, :us, :bd, :cid,NOW(),NOW())");
  $sc->bindParam(":us", $user);
  $sc->bindParam(":bd", $body);
  $sc->bindParam(":cid", $content_id);
  $sc->execute();

  $desc = "Commented on a post :-";
  $desc_post = $post_details['title'];
  $desc.=" '$desc_post'";
  $ad_ac = $conn->prepare("INSERT INTO public_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
  $ad_ac->bindParam(":ad", $user);
  $ad_ac->bindParam(":ds", $desc);
  $ad_ac->execute();

  $status['success'] = true;

  if($status['success'] == true){
  $hits = $conn->prepare("UPDATE web_content SET hits = hits+1 WHERE hash_id = :id ");
  $hits->bindParam(":id", $content_id);
  $hits->execute();

  }

} catch(Exception $e){
  // $status['failed'] = $e;
  $status['failed'] = "Something went wrong, try Again!!!";
}

$res = json_encode($status);
echo $res;

 ?>
