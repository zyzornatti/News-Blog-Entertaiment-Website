<?php
$error= [];
// $idd = $_GET['id'];

if (isset($_POST['submit'])) {
  $check = countContent2($conn, "hom_newsletter", "email", $_POST['email']);
  var_dump($check);
  if($check > 0){
    $_SESSION['failed'] = "Already subscribed";
    // $loc = "/readpost?id=".$idd."#newsletter";
    // $loc = "post/my-fifth-post-218273383883";
    $loc = $_SERVER['REQUEST_URI'];
    $loc .="#newsletter";
    header("Location:".$loc);
    die;
  }


  // insertSafe($conn,"read_newsletter",$new);
  $subscribe = $conn->prepare("INSERT INTO hom_newsletter VALUES(NULL, :em, NOW(),NOW())");
  $subscribe->bindParam(":em", $_POST['email']);
  $subscribe->execute();


require APP_PATH.'/phpm/PHPMailerAutoload.php';

// If necessary, modify the path in the require statement below to refer to the
// location of your Composer autoload.php file.
// require 'phpm/PHPMailerAutoload.php';


// Instantiate a new PHPMailer
$mail = new PHPMailer;

// Tell PHPMailer to use SMTP
$mail->isSMTP();

// Replace sender@example.com with your "From" address.
// This address must be verified with Amazon SES.
$mail->setFrom($site_email, 'Home of Memes');
$mail->AddReplyTo($site_email, 'Home of Memes');

// Replace recipient@example.com with a "To" address. If your account
// is still in the sandbox, this address must be verified.
// Also note that you can include several addAddress() lines to send
// email to multiple recipients.
$mail->addAddress($_POST['email']);

// Replace smtp_username with your Amazon SES SMTP user name.
$mail->Username = $site_email;

// Replace smtp_password with your Amazon SES SMTP password.
$mail->Password = getenv("EMAIL_PASSWORD");

// Specify a configuration set. If you do not want to use a configuration
// set, comment or remove the next line.
// $mail->addCustomHeader('X-SES-CONFIGURATION-SET', 'ConfigSet');

// If you're using Amazon SES in a region other than US West (Oregon),
// replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
// endpoint in the appropriate region.
$mail->Host = 'smtp.gmail.com';

// The subject line of the email
$mail->Subject = 'Welcome to Home of Memes';

// The HTML-formatted body of the email
$mail->Body = "<h3>Welcome</h3>
<img src='https://homeofmemes.com/hom_logo.jpg'>
<p>

<p>Thank you for subscribing to our newsletters.</p>

<p>If you require any further information, feel free to contact us: homeofmemes51@gmail.com</p>
<p>Follow us on social media: </p>
<p>Twitter: https://twitter.com/the_homeofmemes</p>
<p>Facebook: https://facebook.com/homeofmemes51</p>
<p>Instagram: https://instagram.com/the_homeofmemes</p>
<p>Welcome to Home of Memes</p>
";

// Tells PHPMailer to use SMTP authentication
$mail->SMTPAuth = true;

// Enable TLS encryption over port 587
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Tells PHPMailer to send HTML-formatted email
$mail->isHTML(true);

// The alternative email body; this is only displayed when a recipient
// opens the email in a non-HTML email client. The \r\n represents a
// line break.
$mail->AltBody = "Do not send a reply to this mail";

if(!$mail->send()) {
  // die(var_dump($mail->Body));
  // die(var_dump("Email not sent. " , $mail->ErrorInfo , PHP_EOL));
} else {
  // echo "Email sent!" , PHP_EOL;
}




  $_SESSION['success'] = "Newsletter Subscription Successful";
  // $loc = "/readpost?id=".$idd."#newsletter";
  $loc = $_SERVER['REQUEST_URI'];
  $loc .="#newsletter";
  header("Location:".$loc);
  die;

}
?>

<?php
$url = explode("/", $_SERVER['REQUEST_URI']);

if(count($url) == 3){
  $hid = explode("-", $url[2]);
  $id = end($hid);

  $post_count = countContent2($conn, "hom_mav", "hom_mav_hash_id", $id);
  if($post_count < 1){
    header("Location: /");
    exit();
  }else{
    $post = fetchRecord2($conn, "hom_mav", "hom_mav_hash_id", $id);
    $views = countContent2($conn, "stats", "content_id", $id);
  }
}else{
  header("Location: /");
  exit();
}

$post_category = fetchContent($conn, "hom_mav_category");
$post_category_data = [];
foreach ($post_category as $key => $value) {
  $post_category_data[$value['hom_mav_category_hash_id']] = $value['hom_mav_category_name'];
}

$post_category1 = fetchContent($conn, "hom_mav_category");
$post_category_slug = [];
foreach ($post_category1 as $key => $value) {
  $post_category_slug[$value['hom_mav_category_hash_id']] = $value['hom_mav_category_slug'];
}

$post_author = fetchContent($conn, "admin");
$post_author_data = [];
foreach ($post_author as $key => $value) {
  $post_author_data[$value['admin_hash']] = $value['admin_username'];
}

// $post_section = fetchContent($conn, "web_section");
// $post_section_data = [];
// foreach ($post_section as $key => $value) {
//   $post_section_data[$value['section_hash_id']] = $value['web_section_name'];
// }

// $post_section1 = fetchContent($conn, "web_section");
// $post_section_slug = [];
// foreach ($post_section1 as $key => $value) {
//   $post_section_slug[$value['section_hash_id']] = $value['sec_slug'];
// }

$user_id = fetchContent($conn, "public");
$user_id_data = [];
foreach ($user_id as $key => $value) {
  $user_id_data[$value['user_hash']] = $value['username'];
}

$comment_count = countContent2($conn, "hom_comments", "content_id", $post['hom_mav_hash_id']);
$replies_count = countContent2($conn, "hom_replies", "content_id", $post['hom_mav_hash_id']);
$total_comment = $comment_count + $replies_count;
// var_dump($post['hom_mav_title']);
// die;
$visitor_ip = $_SERVER['REMOTE_ADDR'];
$visitor_ip_check = countContent2($conn, "stats", "visitor", $visitor_ip);
if($visitor_ip_check > 0){
  $chk = ipCheck($conn, $post['hom_mav_hash_id'], $visitor_ip, "NULL");

  if($chk->rowCount() < 1){
    visitPage($conn, "stats", $post['hom_mav_hash_id'], $visitor_ip, "NULL");
    $hits = $conn->prepare("UPDATE hom_mav SET hom_mav_hits = hom_mav_hits+1 WHERE hom_mav_hash_id = :id ");
    $hits->bindParam(":id", $post['hom_mav_hash_id']);
    $hits->execute();
  }else{
    if(isset ($_SESSION['user'])){
      $ip_user_check = ipCheck($conn, $post['hom_mav_hash_id'], $visitor_ip, $_SESSION['user']);
      if($ip_user_check->rowCount() < 1){
        visitPage($conn, "stats", $post['hom_mav_hash_id'], $visitor_ip, $_SESSION['user']);
        $hits = $conn->prepare("UPDATE hom_mav SET hom_mav_hits = hom_mav_hits+1 WHERE hom_mav_hash_id = :id ");
        $hits->bindParam(":id", $post['hom_mav_hash_id']);
        $hits->execute();

        $desc = "Viewed a music post :-";
        $desc_post = $post['hom_mav_title'];
        $desc.=" $desc_post";
        $ad_ac = $conn->prepare("INSERT INTO public_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
        $ad_ac->bindParam(":ad", $_SESSION['user']);
        $ad_ac->bindParam(":ds", $desc);
        $ad_ac->execute();
      }
    }
  }

}else{
  if(isset ($_SESSION['user'])){
    visitPage($conn, "stats", $post['hom_mav_hash_id'], $visitor_ip, $_SESSION['user']);
    $hits = $conn->prepare("UPDATE hom_mav SET hom_mav_hits = hom_mav_hits+1 WHERE hom_mav_hash_id = :id ");
    $hits->bindParam(":id", $post['hom_mav_hash_id']);
    $hits->execute();

    $desc = "Viewed a music post :-";
    $desc_post = $post['hom_mav_title'];
    $desc.=" $desc_post";
    $ad_ac = $conn->prepare("INSERT INTO public_activities VALUES(NULL, :ad, :ds, NOW(), NOW())");
    $ad_ac->bindParam(":ad", $_SESSION['user']);
    $ad_ac->bindParam(":ds", $desc);
    $ad_ac->execute();
  }else{
    visitPage($conn, "stats", $post['hom_mav_hash_id'], $visitor_ip, "NULL");
    $hits = $conn->prepare("UPDATE hom_mav SET hom_mav_hits = hom_mav_hits+1 WHERE hom_mav_hash_id = :id ");
    $hits->bindParam(":id", $post['hom_mav_hash_id']);
    $hits->execute();
  }
}

$page_name = "Music";
// $page_title = $post['hom_mav_title'];
include "includes/header.php";

 ?>

 <?php if(isset ($_SESSION['failed'])): ?>
   <div data-notify="container" id="closeit" undefined="" class="bootstrap-notify col-11 col-md-4 alert alert-danger" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; right: 20px; visibility:visible;">
   <button type="button" aria-hidden="true" class="close" data-notify="" style="position: absolute; right: 10px; top: 5px; z-index: 1033;" onclick="closeMsg()">
     ×
   </button>
   <span data-notify="icon"></span>
   <span data-notify="title">Notice!!!</span>
   <span data-notify="message"> <?= $_SESSION['failed'] ?></span>
 </div>
 <?php unset ($_SESSION['failed']); ?>
 <?php endif ?>

 <?php if(isset ($_SESSION['success'])): ?>
   <div data-notify="container" id="closeit" undefined="" class="bootstrap-notify col-11 col-md-4 alert alert-success" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; right: 20px; visibility:visible;">
   <button type="button" aria-hidden="true" class="close" data-notify="" style="position: absolute; right: 10px; top: 5px; z-index: 1033;" onclick="closeMsg()">
     ×
   </button>
   <span data-notify="icon"></span>
   <span data-notify="title">Success</span>
   <span data-notify="message"> <?= $_SESSION['success'] ?></span>
 </div>
 <?php unset ($_SESSION['success']); ?>
 <?php endif ?>

<section id="page-content" class="sidebar-right">
  <div class="container">
    <div class="row">

      <div class="content col-lg-9">

        <div id="blog" class="single-post">

          <div class="post-item">
            <div class="post-item-wrap">
              <div class="post-image">
                <a href="#">
                  <img alt="" src="/uploads/POSTS/<?php echo $post['hom_mav_image'] ?>">
                </a>
              </div>
              <div class="post-item-description">
                <h2><?php echo $post['hom_mav_title'] ?></h2>
                <div class="post-meta">
                  <span class="post-meta-date"><i class="fa fa-calendar-o"></i>Uploaded - <span><time class="timeago" datetime="<?php echo $post['date_created'] ?> <?php echo $post['time_created'] ?>"></time></span> on <?php echo date("F j, Y", strtotime($post['date_created'])) ?>
                  </span>
                  <span class="post-meta-comments">
                    <i class="fa fa-comments-o"></i><?php echo $views ?> view(s)
                    <i class="fa fa-comments-o"></i><?php echo $total_comment ?> Comment(s)
                  </span>
                  <span class="post-meta-category">
                    <a href="/musiccategory/<?= $post_category_slug[$post['hom_mav_category_id']] ?>-<?= $post['hom_mav_category_id'] ?>"><i class="fa fa-tag">
                    </i><?php echo $post_category_data[$post['hom_mav_category_id']] ?>
                    </a>,
                    <a href="/musiccategory/<?= $post_category_slug[$post['hom_mav_category_id']] ?>/<?= $post_category_slug[$post['hom_mav_category_id']] ?>-<?php echo $post['hom_mav_category_id'] ?>"><?php echo $post_category_data[$post['hom_mav_category_id']] ?>
                    </a>

                  </span>
                  <div class="post-meta-share">
                    <!-- ShareThis BEGIN -->
                    <div class="sharethis-inline-share-buttons"></div>
                    <!-- ShareThis END -->
                  </div>
                  <!-- <div class="post-meta-share">
                    <a class="btn btn-xs btn-slide btn-facebook" href="#">
                      <i class="fab fa-facebook-f"></i>
                      <span>Facebook</span>
                    </a>
                    <a class="btn btn-xs btn-slide btn-twitter" href="#" data-width="100">
                      <i class="fab fa-twitter"></i>
                      <span>Twitter</span>
                    </a>
                    <a class="btn btn-xs btn-slide btn-instagram" href="#" data-width="118">
                      <i class="fab fa-instagram"></i>
                      <span>Instagram</span>
                    </a>
                    <a class="btn btn-xs btn-slide btn-googleplus" href="mailto:#" data-width="80">
                      <i class="icon-mail"></i>
                      <span>Mail</span>
                    </a>
                  </div> -->
                </div>
                <p><?php echo $post['hom_mav_content'] ?></p>
                <?php if($post['hom_mav_link'] != "ALBUM"): ?>
                  <a href="<?= $post['hom_mav_link'] ?>" class="btn">DOWNLOAD MP3</a><br><br>
                <?php endif ?>

                <div class="post-meta-share">
                  <!-- ShareThis BEGIN -->
                  <div class="sharethis-inline-share-buttons"></div>
                  <!-- ShareThis END -->
                </div>
              </div>
              <!-- <div class="post-tags">
                <a href="#">Life</a>
                <a href="#">Sport</a>
                <a href="#">Tech</a>
                <a href="#">Travel</a>
              </div> -->
              <div class="post-navigation">
                <?php $prev = $post['hom_mav_id'] - 1;
                $count_prev_post = countContent2($conn, "hom_mav", "hom_mav_id", $prev);
                $previous_post = fetchRecord2($conn, "hom_mav", "hom_mav_id", $prev);
                 ?>
                <?php $next = $post['hom_mav_id'] + 1;
                $count_next_post = countContent2($conn, "hom_mav", "hom_mav_id", $next);
                $next_post = fetchRecord2($conn, "hom_mav", "hom_mav_id", $next);
                 ?>
                <?php if($count_prev_post > 0): ?>
                  <a href="/music/<?=$previous_post['hom_mav_title_slug']?>-<?= $previous_post['hom_mav_hash_id'] ?>" class="post-prev">
                    <div class="post-prev-title">
                      <span>Previous Post</span><?= $previous_post['hom_mav_title']?>
                    </div>
                  </a>
                <?php endif ?>
                <a href="#" class="post-all">
                  <i class="icon-grid"> </i>
                </a>
                <?php if($count_next_post > 0): ?>
                  <a href="/music/<?=$next_post['hom_mav_title_slug']?>-<?= $next_post['hom_mav_hash_id'] ?>" class="post-next">
                    <div class="post-next-title"><span>Next Post</span><?= $next_post['hom_mav_title']?></div>
                  </a>
                <?php endif ?>
              </div>

              <div class="comments" id="comments">
                <div class="comment_number">
                Comment(s) <span>(<?php echo $total_comment ?>)</span>
                </div>
                <div class="comment-list">
                  <div id="loadcomment">
                    <?php $comment = loadRecord($conn, "hom_comments", "content_id", $post['hom_mav_hash_id'], "comment_id", 2) ?>
                    <?php foreach ($comment as $key => $value): ?>
                      <div class="comment" id="comment-1">
                        <div class="image">
                          <img alt="" src="/<?php echo $dummy ?>" class="avatar">
                        </div>
                        <div class="text">
                          <h5 class="name"><?php echo $user_id_data[$value['user_id']] ?></h5>
                          <span class="comment_date"><time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>"></time></span>
                          <a class="comment-reply-link" href="javascript:void(0)" onclick="getReply('<?= $_SERVER['REQUEST_URI'] ?>', '<?= $value['comment_id'] ?>', '<?= $post['hom_mav_hash_id'] ?>', '<?= $value['user_id'] ?>')">Reply</a>
                          <div class="text_holder">
                            <p><?php echo $value['body'] ?></p>
                          </div>
                        </div>

                        <?php $reply = countContent2($conn, "hom_replies", "comment_id", $value['comment_id']); ?>
                        <?php if($reply > 0): ?>
                          <?php $replies = loadRecord($conn, "hom_replies", "comment_id", $value['comment_id'], "reply_id", 5); ?>
                          <?php foreach ($replies as $key => $value): ?>
                            <div class="comment" id="comment-1-1">
                          <div class="image"><img alt="" src="/<?php echo $dummy ?>" class="avatar"></div>
                          <div class="text">
                            <h5 class="name"><?php echo $user_id_data[$value['user_id']] ?></h5>
                            <span class="comment_date"><time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>"></time></span>
                            <a class="comment-reply-link" href="javascript:void(0)" onclick="getReply('<?= $_SERVER['REQUEST_URI'] ?>', '<?= $value['comment_id'] ?>', '<?= $post['hom_mav_hash_id'] ?>', '<?= $value['user_id'] ?>')" >Reply</a>
                            <div class="text_holder">
                            <p><?php echo $value['body'] ?></p>
                            </div>
                          </div>
                        </div>
                        <?php endforeach ?>
                      <?php endif ?>

                      </div>

                  <?php endforeach; ?>
                  </div>
                </div>
                <?php if($total_comment > 2): ?>
                <div class="section-row loadmore text-center">
                  <button onclick="loadComment('/ajax_lc', '<?= $post['hom_mav_hash_id'] ?>')" class="btn">Load More</button>
                </div>
              <?php endif ?>
              </div>

              <?php if(isset ($_SESSION['user'])): ?>
                <div class="respond-form" id="respond">
                  <div class="respond-comment">
                    <?php $user_name = fetchRecord2($conn, "public", "user_hash", $_SESSION['user']) ?>
                    Leave a <span>Comment </span> (<?php echo $user_name['username'] ?>)
                  </div>
                    <form class="form-gray-fields" id="c_form">
                      <!-- <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label class="upper" for="name">Name</label>
                            <input class="form-control required" name="senderName" placeholder="Enter name" id="name" aria-required="true" type="text">
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label class="upper" for="email">Email</label>
                            <input class="form-control required email" name="senderEmail" placeholder="Enter email" id="email" aria-required="true" type="email">
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label class="upper" for="website">Website</label>
                            <input class="form-control website" name="senderWebsite" placeholder="Enter Website" id="website" aria-required="false" type="text">
                          </div>
                        </div>
                      </div> -->
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label style="visibility:hidden" id="lbl_body">You haven't type in a comment</label>
                            <label class="upper" for="comment">Your comment</label>
                            <textarea class="form-control required" name="comment" rows="9" placeholder="Enter comment" id="c_body" aria-required="true"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group text-center">
                            <button class="btn" type="button" onclick="submitComment('<?= $_SERVER['REQUEST_URI'] ?>', '<?= $post['hom_mav_hash_id'] ?>', '<?= $_SESSION['user'] ?>')">Submit Comment</button>
                          </div>
                        </div>
                      </div>
                    </form>
              </div>
              <?php else: ?>
                <div class="well" style="margin-top: 20px;">
        					<h4 class="text-center"> <span><a href="/signin?rd=<?= base64url_encode($_SERVER['REQUEST_URI']) ?>">Login</a></span> or <a href="/register?rd=<?= base64url_encode($_SERVER['REQUEST_URI']) ?>">Signup</a> to post a comment</h4>
        				</div>
              <?php endif ?>
            </div>
          </div>

        </div>

       </div>


      <div class="sidebar sticky-sidebar col-lg-3">

        <div class="widget  widget-newsletter">
          <form id="widget-search-form-sidebar" action="/msearch" method="get">
            <div class="input-group">
              <input type="text" aria-required="true" name="q" class="form-control widget-search-form" placeholder="Search...">
              <div class="input-group-append">
                <button class="btn" type="submit"><i class="fa fa-search"></i></button><br><br>
              </div>
            </div>
          </form>
        </div>


        <div class="widget">
          <div class="tabs">
            <ul class="nav nav-tabs" id="tabs-posts" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#popular" role="tab" aria-controls="popular" aria-selected="true">Popular</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#featured" role="tab" aria-controls="featured" aria-selected="false">Related</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#recent" role="tab" aria-controls="recent" aria-selected="false">Recent</a>
              </li>
            </ul>
            <div class="tab-content" id="tabs-posts-content">
              <div class="tab-pane fade show active" id="popular" role="tabpanel" aria-labelledby="popular-tab">
                    <div class="post-thumbnail-list">
                      <?php $popular_post = fetchMusicRecordByOrder($conn, "hom_mav", "hom_mav_hits", 3) ?>
                      <?php foreach ($popular_post as $key => $value): ?>
                        <div class="post-thumbnail-entry">
                          <img alt="" src="/uploads/POSTS/<?php echo $value['hom_mav_image'] ?>">
                          <div class="post-thumbnail-content">
                            <a href="/music/<?= $value['hom_mav_title_slug'] ?>-<?= $value['hom_mav_hash_id'] ?>"><?php echo $value['hom_mav_title'] ?>
                            </a>
                            <span class="post-date"><i class="icon-clock"></i>
                              <time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>">
                              </time>
                            </span>
                            <span class="post-category"><i class="fa fa-tag"></i> <?php echo $post_category_data[$value['hom_mav_category_id']] ?>
                            </span>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
              </div>
              <div class="tab-pane fade" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                <div class="post-thumbnail-list">
                  <?php $date_created = date("Y-m-d") ?>
                  <?php $trending_post = fetchRelatedMusic($conn, "hom_mav", "hom_mav_hash_id", $id, "hom_mav_category_id", $post['hom_mav_category_id']) ?>
                  <?php foreach ($trending_post as $key => $value): ?>
                    <div class="post-thumbnail-entry">
                      <img alt="" src="/uploads/POSTS/<?php echo $value['hom_mav_image'] ?>">
                      <div class="post-thumbnail-content">
                      <a href="/music/<?= $value['hom_mav_title_slug'] ?>-<?= $value['hom_mav_hash_id'] ?>"><?php echo $value['hom_mav_title'] ?></a>
                      <span class="post-date"><i class="icon-clock"></i>
                        <time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>">

                        </time>
                      </span>
                      <span class="post-category"><i class="fa fa-tag"></i> <?php echo $post_category_data[$value['hom_mav_category_id']] ?></span>
                      </div>
                    </div>
                  <?php endforeach; ?>

                </div>
              </div>
              <div class="tab-pane fade" id="recent" role="tabpanel" aria-labelledby="recent-tab">
                <div class="post-thumbnail-list">
                  <?php $recent_post = fetchRecentRecordWithL($conn, "hom_mav", "hom_mav_visibility", "show", "hom_mav_id", 3) ?>
                  <?php foreach ($recent_post as $key => $value): ?>
                    <div class="post-thumbnail-entry">
                       <img alt="" src="/uploads/POSTS/<?php echo $value['hom_mav_image'] ?>">
                      <div class="post-thumbnail-content">
                      <a href="/music/<?= $value['hom_mav_title_slug'] ?>-<?= $value['hom_mav_hash_id'] ?>"><?php echo $value['hom_mav_title'] ?></a>
                      <span class="post-date"><i class="icon-clock"></i>
                        <time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>">
                        </time>
                      </span>
                      <span class="post-category"><i class="fa fa-tag"></i> <?php echo $post_category_data[$value['hom_mav_category_id']] ?></span>
                      </div>
                    </div>
                  <?php endforeach; ?>

                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- <div class="widget widget-tweeter" data-username="envato" data-limit="2">
          <h4 class="widget-title">Recent Tweets</h4>
        </div> -->


        <!-- <div class="widget  widget-tags">
          <h4 class="widget-title">Tags</h4>
          <div class="tags">
            <a href="#">Design</a>
            <a href="#">Portfolio</a>
            <a href="#">Digital</a>
            <a href="#">Branding</a>
            <a href="#">HTML</a>
            <a href="#">Clean</a>
            <a href="#">Peace</a>
            <a href="#">Love</a>
            <a href="#">CSS3</a>
            <a href="#">jQuery</a>
          </div>
        </div> -->
        <div class="widget  widget-newsletter" id="newsletter">
          <form action="" method="post">
            <h4 class="widget-title">Newsletter</h4>
            <small>Stay informed on our latest updates!</small>
            <div class="input-group">
              <input type="email" required name="email" class="form-control required email" placeholder="Enter your Email">
              <span class="input-group-btn">
                <button type="submit" name="submit" class="btn"><i class="fa fa-paper-plane"></i>
                </button>
              </span>
            </div>
          </form>
        </div>

      </div>

    </div>
  </div>
</section>

 <?php include "includes/footer.php" ?>
