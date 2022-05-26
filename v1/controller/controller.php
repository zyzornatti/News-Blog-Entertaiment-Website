<?php

function authenticate($session, $url){
  if(!isset ($session)){
    header("Location: /$url?msg=You_have_not_logged_in");
  }
}

function post_slug($text){

  // replace non letter or digits by -
  $text = preg_replace('~[^pLd]+~u', '-', $text);

  // trim
  $text = trim($text, '-');

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // lowercase
  $text = strtolower($text);

  // remove unwanted characters
  $text = preg_replace('~[^-w]+~', '', $text);

  if (empty($text))
  {
    return 'n-a';
  }

  return $text;
}

function cleans($string){
  $string = str_replace(array('[\', \']'), '', $string);
  $string = preg_replace('/\[.*\]/U', '', $string);
  $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
  $string = htmlentities($string, ENT_COMPAT, 'utf-8');
  // $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
  $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
  return strtolower(trim($string, '-'));
}

function previewBody($string, $count){
  $original_string = $string;
  $words = explode(' ', $original_string);
  if(count($words) > $count){
    $words = array_slice($words, 0, $count);
    $string = implode(' ', $words)."...";
  }
  return strip_tags($string);
}

function shortContent($content){
 $body = $content;
 $string = strip_tags($body);
 if (strlen($string) > 100){
   $stringCut = substr($string, 0, 100);
   $endPoint = strrpos($stringCut, ' ');
   $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
   $string .= '...';
 }
 return $string;
}

function shortlink($content){
 $body = $content;
 $string = strip_tags($body);
 if (strlen($string) > 15){
   $stringCut = substr($string, 0, 15);
   $endPoint = strrpos($stringCut, ' ');
   $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
   $string .= '...';
 }
 return $string;
}

function countContent($dbconn, $table){
  $fb = $dbconn->prepare("SELECT * FROM $table");
  $fb->execute();
  $bf = $fb->rowCount();

  return $bf;
}

function countContent2($dbconn, $table, $column, $id){
  $fb = $dbconn->prepare("SELECT * FROM $table WHERE $column = :rc");
  $fb->bindParam(":rc", $id);
  $fb->execute();
  $bf = $fb->rowCount();

  return $bf;
}

function countContent3($dbconn, $table, $column1, $id1, $column2, $id2){
  $fb = $dbconn->prepare("SELECT * FROM $table WHERE NOT $column1 = :rc AND $column2 = :cl");
  $fb->bindParam(":rc", $id1);
  $fb->bindParam(":cl", $id2);
  $fb->execute();
  $bf = $fb->rowCount();

  return $bf;
}

function countContent4($dbconn, $table, $column1, $id1, $column2, $id2, $column3, $id3){
  $fb = $dbconn->prepare("SELECT * FROM $table WHERE NOT $column1 = :rc AND $column2 = :cl AND $column3= :cll");
  $fb->bindParam(":rc", $id1);
  $fb->bindParam(":cl", $id2);
  $fb->bindParam(":cll", $id3);
  $fb->execute();
  $bf = $fb->rowCount();

  return $bf;
}

//count with where clause
function countW2C($dbconn, $table, $column1, $id1, $column2, $id2){
  $fb = $dbconn->prepare("SELECT * FROM $table WHERE $column1=:cl AND $column2=:cll");
  $fb->bindParam(":cl", $id1);
  $fb->bindParam(":cll", $id2);
  $fb->execute();
  $bf = $fb->rowCount();

  return $bf;
}



function countPaginatedRecord($dbconn, $table, $column, $id, $order, $offset, $limit){
  $fb = $dbconn->prepare("SELECT * FROM $table WHERE $column=:cl ORDER BY $order DESC LIMIT $offset, $limit");
  $fb->bindParam(":cl", $id);
  $fb->execute();
  $bf = $fb->rowCount();

  return $bf;
}

function fetchContent($dbconn, $table){
  $rc = $dbconn->prepare("SELECT * FROM $table");
  $rc->execute();

  return $rc;
}

function fetchContent2($dbconn, $table, $column, $cid){
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE $column=:cid");
  $rc->bindParam(":cid", $cid);
  $rc->execute();

  return $rc;
}

function fetchAdminActivities($dbconn, $table, $column, $cid, $limit){
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE $column=:cid ORDER BY admin_activities_id DESC LIMIT $limit");
  $rc->bindParam(":cid", $cid);
  $rc->execute();

  return $rc;
}

function fetchSingleContent($dbconn, $table){
  $rc = $dbconn->prepare("SELECT * FROM $table");
  $rc->execute();

  $rsc = $rc->fetch(PDO::FETCH_BOTH);
  return $rsc;
}

function fetchRecentContent($dbconn, $table, $order, $limit){
  $rc = $dbconn->prepare("SELECT * FROM $table ORDER BY $order DESC LIMIT $limit");
  $rc->execute();

  return $rc;
}

function fetchRecentContent2($dbconn, $table, $column, $cid, $order, $limit){
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE $column = :cid ORDER BY $order DESC LIMIT $limit");
  $rc->bindParam(":cid", $cid);
  $rc->execute();

  return $rc;
}

function fetchRecentContentW2C($dbconn, $table, $column1, $id1, $column2, $id2, $order, $limit){
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE $column1 = :cid AND $column2=:cll ORDER BY $order DESC LIMIT $limit");
  $rc->bindParam(":cid", $id1);
  $rc->bindParam(":cll", $id2);
  $rc->execute();

  return $rc;
}

function fetchRecentRecordWithL($dbconn, $table, $column, $cid, $order, $limit){
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE $column = :cid ORDER BY $order DESC LIMIT $limit");
  $rc->bindParam(":cid", $cid);
  $rc->execute();

  return $rc;
}

function fetchRecentRecordWithoutL($dbconn, $table, $column, $cid, $order){
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE $column = :cid ORDER BY $order DESC");
  $rc->bindParam(":cid", $cid);
  $rc->execute();

  return $rc;
}

function fetchRelatedContent($dbconn, $table, $column, $id){
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE $column=:rc ORDER BY date_created DESC LIMIT 3");
  $rc->bindParam(":rc",$id);
  $rc->execute();

  return $rc;
}

function fetchRelatedMusic($dbconn, $table, $column1, $notid, $column2, $id){
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE NOT $column1=:ntid AND $column2=:rc ORDER BY date_created DESC LIMIT 3");
  $rc->bindParam(":ntid",$notid);
  $rc->bindParam(":rc",$id);
  $rc->execute();

  return $rc;
}

function fetchRecentContentWC($dbconn, $table, $column, $id){
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE $column=:cl ORDER BY date_created DESC LIMIT 3");
  $rc->bindParam(":cl", $id);
  $rc->execute();

  return $rc;
}

function fetchRecord($dbconn, $table, $column, $id){
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE $column=:rc");
  $rc->bindParam(":rc",$id);
  $rc->execute();

  return $rc;
}

function fetchRecordByOrder($dbconn, $table, $order, $limit){
  $vs = "show";
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE visibility = :vs ORDER BY $order DESC LIMIT $limit");
  $rc->bindParam(":vs", $vs);
  $rc->execute();

  return $rc;
}

function fetchMusicRecordByOrder($dbconn, $table, $order, $limit){
  $vs = "show";
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE hom_mav_visibility = :vs ORDER BY $order DESC LIMIT $limit");
  $rc->bindParam(":vs", $vs);
  $rc->execute();

  return $rc;
}

function loadComment($dbconn, $table, $column, $id){
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE $column=:rc ORDER BY id DESC");
  $rc->bindParam(":rc",$id);
  $rc->execute();

  return $rc;
}
function loadRecord($dbconn, $table, $column, $id, $order, $limit){
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE $column=:rc ORDER BY $order DESC LIMIT $limit");
  $rc->bindParam(":rc",$id);
  $rc->execute();

  return $rc;
}
function loadBlog($dbconn, $table, $column, $id, $order, $limit){
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE $column=:rc ORDER BY $order DESC LIMIT $limit");
  $rc->bindParam(":rc",$id);
  $rc->execute();

  return $rc;
}

function loadReply($dbconn, $table, $column, $id){
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE $column=:rc ORDER BY date_created DESC");
  $rc->bindParam(":rc",$id);
  $rc->execute();

  return $rc;
}

// function loadRecord($dbconn, $table, $postNewNumber){
//   $lr = $dbconn->prepare("SELECT * FROM $table LIMIT $postNewNumber");
//   $lr->execute();
//
//   return $lr;
// }

function fetchRecord2($dbconn, $table, $column, $id){
  $rc = $dbconn->prepare("SELECT * FROM $table WHERE $column=:rc");
  $rc->bindParam(":rc",$id);
  $rc->execute();

  $record = $rc->fetch(PDO::FETCH_BOTH);
  return $record;
}

function deleteRecord($dbconn, $table, $id, $location){
    $del = $dbconn->prepare("DELETE FROM $table WHERE hash_id=:id");
    $del->bindParam(":id", $id);
    $del->execute();

    header("Location: /$location");
}

function ajaxDeleteRecord($dbconn, $table, $column, $id){
    $del = $dbconn->prepare("DELETE FROM $table WHERE $column=:id");
    $del->bindParam(":id", $id);
    $del->execute();
}

function pagiNate($dbconn, $table, $column, $id, $order, $offset, $limit){
  $post = $dbconn->prepare("SELECT * FROM $table WHERE $column=:rc ORDER BY $order DESC LIMIT $offset, $limit");
  $post->bindParam(":rc", $id);
  $post->execute();

  return $post;
}
function pagiNateRecord($dbconn, $table, $column, $id, $order, $offset, $limit){
  $post = $dbconn->prepare("SELECT * FROM $table WHERE $column=:cl ORDER BY $order DESC LIMIT $offset, $limit");
  $post->bindParam(":cl", $id);
  $post->execute();

  return $post;
}

function pagiNateRecord2($dbconn, $table, $column1, $id1, $column2, $id2, $order, $offset, $limit){
  $post = $dbconn->prepare("SELECT * FROM $table WHERE $column1=:cl AND $column2 =:sc ORDER BY $order DESC LIMIT $offset, $limit");
  $post->bindParam(":cl", $id1);
  $post->bindParam(":sc", $id2);
  $post->execute();

  return $post;
}

function countPagiNateRecord2($dbconn, $table, $column1, $id1, $column2, $id2, $order, $offset, $limit){
  $post = $dbconn->prepare("SELECT * FROM $table WHERE $column1=:cl AND $column2 =:sc ORDER BY $order DESC LIMIT $offset, $limit");
  $post->bindParam(":cl", $id1);
  $post->bindParam(":sc", $id2);
  $post->execute();

  $rc = $post->rowCount();

  return $rc;
}

function fetchContentWC($dbconn, $table, $column1, $id, $column2, $cl, $order, $limit){
  $post = $dbconn->prepare("SELECT * FROM $table WHERE $column1=:cl AND $column2 =:sc ORDER BY $order DESC LIMIT $limit");
  $post->bindParam(":cl", $id);
  $post->bindParam(":sc", $cl);
  $post->execute();

  return $post;
}

// function removeSpace($text){
//   if(strpos($text, " ") !== false){
//     return str_replace(" ", "-", $text);
//   }
// }

function fetchContentW2C($dbconn, $table, $column1, $id, $column2, $cl){
  $post = $dbconn->prepare("SELECT * FROM $table WHERE $column1=:cl AND $column2 =:sc");
  $post->bindParam(":cl", $id);
  $post->bindParam(":sc", $cl);
  $post->execute();

  return $post;
}

function pagiNateNews($dbconn, $table, $column, $id, $offset, $limit){
  $post = $dbconn->prepare("SELECT * FROM $table WHERE $column=:cl ORDER BY news_content_id DESC LIMIT $offset, $limit");
  $post->bindParam(":cl", $id);
  $post->execute();

  return $post;
}



// function submitComment($dconn, $name, $email, $website, $body, $content_id){
//   $sc = $dbconn->prepare("INSERT into comments VALUES(NULL, :nm,:em,:wb,:bd,:cid,NOW(),NOW())");
//   $sc->bindParam(":nm", $name);
//   $sc->bindParam(":em", $email);
//   $sc->bindParam(":wb", $website);
//   $sc->bindParam(":bd", $body);
//   $sc->bindParam(":cid", $content_id);
//   $sc->execute();
// }

function ipCheck($dbconn, $page_id, $visitor_ip, $user_id){
  $chk = $dbconn->prepare("SELECT * FROM stats WHERE content_id = :cid AND visitor = :vt AND user_id = :uid");
  $chk->bindParam(":cid", $page_id);
  $chk->bindParam(":vt", $visitor_ip);
  $chk->bindParam(":uid", $user_id);
  $chk->execute();

  return $chk;
}

function visitPage($dbconn, $table, $page_id, $visitor_ip, $user){
  $go = $dbconn->prepare("INSERT INTO $table VALUES(NULL, :cid, :ip, :uid, NOW())");
  $go->bindParam(":cid", $page_id);
  $go->bindParam(":ip", $visitor_ip);
  $go->bindParam(":uid", $user);
  $go->execute();
}

function base64url_encode($s) {
  return str_replace(array('+', '/'), array('-', '_'), base64_encode($s));
}

function base64url_decode($s) {
  return base64_decode(str_replace(array('-', '_'), array('+', '/'), $s));
}

?>
