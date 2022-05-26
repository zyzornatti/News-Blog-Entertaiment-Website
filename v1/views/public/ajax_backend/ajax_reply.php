<?php
$status = [];
try{
  $user= $_POST['user'];
  $body = $_POST['body'];
  $comment_id = $_POST['comment_id'];
  $post_id = $_POST['post_id'];

  $post_details = fetchRecord2($conn, "web_content", "hash_id", $post_id);
  $comment_details = fetchRecord2($conn, "hom_comments", "comment_id", $comment_id);

  $sc = $conn->prepare("INSERT into hom_replies VALUES(NULL, :us,:bd,:cid,:pid,NOW(),NOW())");
  $sc->bindParam(":us", $user);
  $sc->bindParam(":bd", $body);
  $sc->bindParam(":cid", $comment_id);
  $sc->bindParam(":pid", $post_id);
  $sc->execute();

  $desc = "Replied to a comment";
  $desc_comment = $comment_details['body'];
  $desc.=" '$desc_comment'";
  $desc.=" on a post :-";
  $desc_post = $post_details['title'];
  $desc.= " ($desc_post)";
  $ad_ac = $conn->prepare("INSERT INTO public_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
  $ad_ac->bindParam(":ad", $user);
  $ad_ac->bindParam(":ds", $desc);
  $ad_ac->execute();

  $status['success'] = true;

  if($status['success'] == true){
  $hits = $conn->prepare("UPDATE web_content SET hits = hits+1 WHERE hash_id = :id ");
  $hits->bindParam(":id", $post_id);
  $hits->execute();

  }

} catch(Exception $e){
  // $status['failed'] = "Something went wrong, try Again!!!";
  $status['failed'] = $e;
}

$res = json_encode($status);
echo $res;

 ?>
