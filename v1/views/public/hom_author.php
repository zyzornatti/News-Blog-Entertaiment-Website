<?php

$error= [];
// $idd = $_GET['id'];

if (isset($_POST['submit'])) {
  $check = countContent2($conn, "hom_newsletter", "email", $_POST['email']);
  var_dump($check);
  if($check > 0){
    $_SESSION['failed'] = "Already subscribed";
    // $loc = "/author?id=".$idd."#newsletter";
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
<img src='https://homeofmemes.com/hom_logo-1.jpg'>
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
  // $loc = "/author?id=".$idd."#newsletter";
  $loc = $_SERVER['REQUEST_URI'];
  $loc .="#newsletter";
  header("Location:".$loc);
  die;

}
?>

<?php
$page_name = "Author";
// $page_title = "Author";

$post_category = fetchContent($conn, "web_category");
$post_category_data = [];
foreach ($post_category as $key => $value) {
  $post_category_data[$value['category_hash_id']] = $value['web_category_name'];
}

$post_category1 = fetchContent($conn, "web_category");
$post_category_slug = [];
foreach ($post_category1 as $key => $value) {
  $post_category_slug[$value['category_hash_id']] = $value['cat_slug'];
}

$post_author = fetchContent($conn, "admin");
$post_author_data = [];
foreach ($post_author as $key => $value) {
  $post_author_data[$value['admin_hash']] = $value['admin_username'];
}

$post_sect = fetchContent($conn, "admin");
$author_profile = [];
foreach ($post_sect as $key => $value) {
  $author_profile[$value['admin_hash']] = $value['admin_profile_pics'];
}

$post_section = fetchContent($conn, "web_section");
$post_section_data = [];
foreach ($post_section as $key => $value) {
  $post_section_data[$value['section_hash_id']] = $value['web_section_name'];
}

$post_section1 = fetchContent($conn, "web_section");
$post_section_slug = [];
foreach ($post_section1 as $key => $value) {
  $post_section_slug[$value['section_hash_id']] = $value['sec_slug'];
}

if(count($uri) == 3){
  $hid = explode("-", $uri[2]);
  $id = end($hid);
    $aut_count = countContent2($conn, "web_content", "author_id", $id);
    if($aut_count < 1){
      header("Location: /");
      exit();
    }else{
      $author = fetchRecentContentW2C($conn, "web_content", "author_id", $id, "visibility", "show", "web_content_id", 10);
      $author_name = $post_author_data[$id];
    }
}else{
  header("Location: /");
  exit();
}

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

<?php $aut = fetchRecord2($conn, "admin", "admin_hash", $id) ?>

 <section id="page-title" data-bg-parallax="">
   <div class="container">
   <div class="page-title">
     <img class="avatar avatar-lg" src="/uploads/admin/<?= $aut['admin_profile_pics'] ?>" alt="">
   <h1><?= $aut['name'] ?></h1>
   <span><?= $aut['admin_description'] ?></span>
    <div class="align-center">
      <a class="btn btn-xs btn-slide btn-light" href="https://<?= $aut['facebook_username'] ?>">
      <i class="fab fa-facebook-f"></i>
      <span>Facebook</span>
      </a>
      <a class="btn btn-xs btn-slide btn-light" href="https://<?= $aut['twitter_username'] ?>" data-width="100">
      <i class="fab fa-twitter"></i>
      <span>Twitter</span>
      </a>
      <a class="btn btn-xs btn-slide btn-light" href="https://<?= $aut['instagram_username'] ?>" data-width="118">
      <i class="fab fa-instagram"></i>
      <span>Instagram</span>
      </a>
      <a class="btn btn-xs btn-slide btn-light" href="mailto:<?= $aut['email'] ?>" data-width="80">
      <i class="icon-mail"></i>
      <span>Mail</span>
      </a>
    </div>

   </div>
   </div>
 </section>

<section id="page-content" class="sidebar-right">
  <div class="container">
    <div class="row">
      <div class="content col-lg-9">

        <div class="page-title">

         <h1>Posts by - <?php echo ucfirst($aut['name']) ?></h1>
         <div class="breadcrumb float-left">
           <ul>
           <li><a href="">Home</a>
           </li>
           <li><a href="#">Author</a>
           </li>
           <li class="active">
             <a href="/author/<?= $aut['admin_username'] ?>-<?= $aut['admin_hash'] ?>"><?php echo ucfirst($aut['admin_username']) ?>
             </a>
           </li>
           </ul>
         </div>
        </div>

        <div id="blog" class="post-thumbnails">
          <div id="loadrecord">

           <?php foreach ($author as $key => $value): ?>
             <div class="post-item">
               <div class="post-item-wrap">
                 <div class="post-image">
                   <a href="#">
                   <img alt="" src="/uploads/POSTS/<?php echo $value['image'] ?>" style="height: 202.39px">
                   </a>
                   <span class="post-meta-category"><a href="/category/<?= $post_section_slug[$value['section']] ?>/<?= $post_category_slug[$value['category_id']] ?>-<?php echo $value['category_id'] ?>"><?php echo $post_category_data[$value['category_id']] ?></a></span>
                 </div>
                 <div class="post-item-description">
                   <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?php echo date("F j, Y ", strtotime($value["date_created"])) ?></span>
                   <!-- <span class="post-meta-comments">
                     <a href="#"><i class="fa fa-comments-o"></i>33 Comments</a>
                   </span> -->
                   <h2><a href="/post/<?= $value['title_slug'] ?>-<?= $value['hash_id'] ?>"><?php echo $value['title'] ?>
                   </a></h2>
                   <?php $body = shortContent($value['body']) ?>
                   <p><?php echo $body ?></p>
                   <?php if($author_profile[$value['author_id']] == "NULL"): ?>
                   <div class="post-author"> <img src="/<?php echo $dummy ?>">
                   <p>by <a href="/author/<?= strtolower($post_author_data[$value['author_id']]) ?>-<?= $value['author_id'] ?>"><?php echo $post_author_data[$value['author_id']] ?></a> <time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>"></p>
                   </div>
                    <?php else: ?>
                   <div class="post-author"> <img src="/uploads/admin/<?= $author_profile[$value['author_id']] ?>">
                   <p>by <a href="/author/<?= strtolower($post_author_data[$value['author_id']]) ?>-<?= $value['author_id'] ?>"><?php echo $post_author_data[$value['author_id']] ?></a> <time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>"></p>
                   </div>
                   <?php endif ?>
                 </div>
               </div>
             </div>
           <?php endforeach; ?>
         </div>
         <?php if($aut_count > 10): ?>
           <div id="showMore">
             <a onclick="loadRecord('/ajax_aut', '<?= $id ?>')" class="btn btn-rounded btn-light"><i class="icon-refresh-cw"></i> Load More Posts</a>
           </div>
         <?php endif ?>

        </div>

      </div>


    <div class="sidebar sticky-sidebar col-lg-3">

      <div class="widget">
        <div class="tabs">
          <ul class="nav nav-tabs" id="tabs-posts" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#popular" role="tab" aria-controls="popular" aria-selected="true">Popular</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#featured" role="tab" aria-controls="featured" aria-selected="false">Trending</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#recent" role="tab" aria-controls="recent" aria-selected="false">Recent</a>
            </li>
          </ul>
          <div class="tab-content" id="tabs-posts-content">
            <div class="tab-pane fade show active" id="popular" role="tabpanel" aria-labelledby="popular-tab">
                  <div class="post-thumbnail-list">
                    <?php $popular_post = fetchRecordByOrder($conn, "web_content", "hits", 3) ?>
                    <?php foreach ($popular_post as $key => $value): ?>
                      <div class="post-thumbnail-entry">
                        <img alt="" src="/uploads/POSTS/<?php echo $value['image'] ?>">
                        <div class="post-thumbnail-content">
                          <a href="/post/<?= $value['title_slug'] ?>-<?= $value['hash_id'] ?>"><?= $value['title'] ?>
                          </a>
                          <span class="post-date"><i class="icon-clock"></i>
                            <time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>">
                            </time>
                          </span>
                          <span class="post-category"><i class="fa fa-tag"></i> <?php echo $post_category_data[$value['category_id']] ?>
                          </span>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
            </div>
            <div class="tab-pane fade" id="featured" role="tabpanel" aria-labelledby="featured-tab">
              <div class="post-thumbnail-list">
                <?php $date_created = date("Y-m-d") ?>
                <?php $trending_post = fetchContentWC($conn, "web_content", "visibility", "show", "date_created", $date_created, "hits", 3) ?>
                <?php foreach ($trending_post as $key => $value): ?>
                  <div class="post-thumbnail-entry">
                    <img alt="" src="/uploads/POSTS/<?php echo $value['image'] ?>">
                    <div class="post-thumbnail-content">
                    <a href="/post/<?= $value['title_slug'] ?>-<?= $value['hash_id'] ?>"><?php echo $value['title'] ?></a>
                    <span class="post-date"><i class="icon-clock"></i>
                      <time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>">

                      </time>
                    </span>
                    <span class="post-category"><i class="fa fa-tag"></i> <?php echo $post_category_data[$value['category_id']] ?></span>
                    </div>
                  </div>
                <?php endforeach; ?>

              </div>
            </div>
            <div class="tab-pane fade" id="recent" role="tabpanel" aria-labelledby="recent-tab">
              <div class="post-thumbnail-list">
                <?php $recent_post = fetchRecentRecordWithL($conn, "web_content", "visibility", "show", "web_content_id", 3) ?>
                <?php foreach ($recent_post as $key => $value): ?>
                  <div class="post-thumbnail-entry">
                     <img alt="" src="/uploads/POSTS/<?php echo $value['image'] ?>">
                    <div class="post-thumbnail-content">
                    <a href="/post/<?= $value['title_slug'] ?>-<?= $value['hash_id'] ?>"><?php echo $value['title'] ?></a>
                    <span class="post-date"><i class="icon-clock"></i>
                      <time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>">
                      </time>
                    </span>
                    <span class="post-category"><i class="fa fa-tag"></i> <?php echo $post_category_data[$value['category_id']] ?></span>
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
