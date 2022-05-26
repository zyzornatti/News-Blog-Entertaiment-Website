<?php

$error= [];

if (isset($_POST['submit'])) {
  $check = countContent2($conn, "hom_newsletter", "email", $_POST['email']);
  // var_dump($check);
  if($check > 0){
    $_SESSION['failed'] = "Already subscribed";
    header("Location:/home#newsletter");
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
<img src='https://homeofmemes.com/new_homlogo.jpg'>
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
  header("Location:/home#newsletter");
  die;

}
?>

<?php
$page_name = "Home";
// $page_title = "Home";
include "includes/header.php";

$slider_post = fetchRecentContent2($conn, "web_content", "visibility", "show", "web_content_id", 10);

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

$music_category = fetchContent($conn, "hom_mav_category");
$music_category_slug = [];
foreach ($music_category as $key => $value) {
  $music_category_slug[$value['hom_mav_category_hash_id']] = $value['hom_mav_category_slug'];
}

$music_category1 = fetchContent($conn, "hom_mav_category");
$music_category_data = [];
foreach ($music_category1 as $key => $value) {
  $music_category_data[$value['hom_mav_category_hash_id']] = $value['hom_mav_category_name'];
}

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

 <section class="no-padding">
   <div class="grid-articles carousel arrows-visibile" data-items="3" data-margin="0" data-dots="false">
      <?php foreach($slider_post as $key => $value):?>
        <article class="post-entry">
          <a href="#" class="post-image"><img alt="" style="height: 275.33px" src="/uploads/POSTS/<?php echo $value['image'] ?>"></a>
          <div class="post-entry-overlay">
            <div class="post-entry-meta">
              <div class="post-entry-meta-category">
                <span class="badge badge-danger"><?php echo $post_category_data[$value['category_id']] ?></span>
              </div>
              <div class="post-entry-meta-title">
                <h2><a href="/post/<?= $value['title_slug'] ?>-<?= $value['hash_id'] ?>"><?php echo $value['title'] ?></a></h2>
              </div>
                <span class="post-date"><i class="far fa-clock"></i>
                  <time class="timeago" datetime="<?php echo $value['date_created'] ?> <?php echo $value['time_created'] ?>">
                  </time>
                </span>
            </div>
          </div>
        </article>
      <?php endforeach ?>
   </div>
 </section>

 <section id="page-content" class="sidebar-right">
    <div class="container">
      <div class="row">

        <div class="content col-lg-9">
          <?php
          $grp_section = $conn->prepare("SELECT section FROM web_content GROUP BY section");
          $grp_section->execute();
          ?>
          <?php foreach ($grp_section as $key1 => $value1): ?>
            <?php
            $vs = "show";
            $ss = $conn->prepare("SELECT * FROM web_content WHERE visibility = :vs AND section = :sc ORDER BY web_content_id DESC LIMIT 5");
            $ss->bindParam(":vs", $vs);
            $ss->bindParam(":sc", $value1['section']);
            $ss->execute();
            ?>
            <div class="heading-text heading-line">
              <h4><?= $post_section_data[$value1['section']] ?></h4>
            </div>

            <div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">

              <?php foreach ($ss as $key2 => $value2): ?>
                <div class="post-item border">
                  <div class="post-item-wrap">
                    <div class="post-image">
                      <a href="/post/<?= $value['title_slug'] ?>-<?= $value['hash_id'] ?>">
                        <img alt="" src="/uploads/POSTS/<?php echo $value2['image'] ?>">
                      </a>

                      <span class="post-meta-category">
                        <a href="/category/<?= $post_section_slug[$value2['section']] ?>/<?= $post_category_slug[$value2['category_id']] ?>-<?= $value2['category_id'] ?>"><?php echo $post_category_data[$value2['category_id']] ?>
                        </a>
                      </span>
                    </div>
                    <div class="post-item-description">
                      <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?php echo date("F j, Y ", strtotime($value2["date_created"])) ?></span>
                      <span class="post-meta-comments"><a href="#"><i class="fa fa-comments-o"></i>by <?php echo $post_author_data[$value2['author_id']] ?></a></span>
                      <h2><a href="/post/<?= $value2['title_slug'] ?>-<?= $value2['hash_id'] ?>"><?php echo $value2['title'] ?>
                      </a></h2>
                      <?php $body = shortContent($value2['body']) ?>
                      <p><?php echo $body ?></p>
                      <a href="/post/<?= $value2['title_slug'] ?>-<?= $value2['hash_id'] ?>" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                    </div>
                  </div>
                </div>

              <?php endforeach; ?>

            </div>

              <a href="/category/<?= $post_section_slug[$value2['section']] ?>-<?= $value2['section'] ?>" class="btn">View All</a><br><br>

          <?php endforeach; ?>


          <div class="heading-text heading-line">
            <h4>Music</h4>
          </div>

          <div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">
            <?php
            $mvs = "show";
            $musics = $conn->prepare("SELECT * FROM hom_mav WHERE hom_mav_visibility = :vs ORDER BY hom_mav_id DESC LIMIT 5");
            $musics->bindParam(":vs", $mvs);
            $musics->execute();

             ?>
            <?php foreach ($musics as $key => $value): ?>
              <div class="post-item border">
                <div class="post-item-wrap">
                  <div class="post-image">
                    <a href="/music/<?= $value['hom_mav_title_slug'] ?>-<?= $value['hom_mav_hash_id'] ?>">
                      <img alt="" src="/uploads/POSTS/<?php echo $value['hom_mav_image'] ?>">
                    </a>

                    <span class="post-meta-category">
                      <a href="/musiccategory/<?= $music_category_slug[$value['hom_mav_category_id']] ?>-<?= $value['hom_mav_category_id'] ?>"><?php echo $music_category_data[$value['hom_mav_category_id']] ?>
                      </a>
                    </span>
                  </div>
                  <div class="post-item-description">
                    <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?php echo date("F j, Y ", strtotime($value["date_created"])) ?></span>
                    <span class="post-meta-comments"><a href="#"><i class="fa fa-comments-o"></i>by <?php echo $post_author_data[$value['hom_mav_added_by']] ?></a></span>
                    <h2><a href="/music/<?= $value['hom_mav_title_slug'] ?>-<?= $value['hom_mav_hash_id'] ?>"><?php echo $value['hom_mav_title'] ?>
                    </a></h2>

                  </div>
                </div>
              </div>

            <?php endforeach; ?>

          </div>

            <a href="/musiccategory/All" class="btn">View All</a>
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
                            <img alt="" src="uploads/POSTS/<?php echo $value['image'] ?>">
                            <div class="post-thumbnail-content">
                              <a href="/post/<?= $value['title_slug'] ?>-<?= $value['hash_id'] ?>"><?php echo $value['title'] ?>
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
                        <img alt="" src="uploads/POSTS/<?php echo $value['image'] ?>">
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
                         <img alt="" src="uploads/POSTS/<?php echo $value['image'] ?>">
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
