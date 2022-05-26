<?php

$error = [];

if(array_key_exists('submit', $_POST)){
   if(empty($error)){
     $to = $site_email;
     $subject = "Message from Home of Memes";


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
     $mail->setFrom($site_email, $site_name);
     $mail->AddReplyTo($site_email, $site_name);

     // Replace recipient@example.com with a "To" address. If your account
     // is still in the sandbox, this address must be verified.
     // Also note that you can include several addAddress() lines to send
     // email to multiple recipients.
     $mail->addAddress($to);

     // Replace smtp_username with your Amazon SES SMTP user name.
     $mail->Username = $site_email;

     // Replace smtp_password with your Amazon SES SMTP password.
     $mail->Password = getenv("EMAIL_PASSWORD");
      // die(var_dump($mail->Password));

     // Specify a configuration set. If you do not want to use a configuration
     // set, comment or remove the next line.
     // $mail->addCustomHeader('X-SES-CONFIGURATION-SET', 'ConfigSet');

     // If you're using Amazon SES in a region other than US West (Oregon),
     // replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
     // endpoint in the appropriate region.
     $mail->Host = 'smtp.gmail.com';

     // The subject line of the email
     $mail->Subject = $subject;

     // The HTML-formatted body of the email
     $mail->Body = "
     <img src='https://homeofmemes.com/hom_logo-1.jpg'>
     <p>Message from Home of Memes </p>";

 if (isset($_POST['name']) && !empty($_POST['name'])) {
     $mail->Body.="<p>Name: ".$_POST['name']."</p>";
 }
 if (isset($_POST['email']) && !empty($_POST['email'])) {
     $mail->Body.="<p>Email: ".$_POST['email']."</p>";
 }
 if (isset($_POST['subject']) && !empty($_POST['subject'])) {
     $mail->Body.="<p>Subject: ".$_POST['subject']."</p>";
 }
 // if (isset($_POST['phone']) && !empty($_POST['phone'])) {
 //     $mail->Body.="<p>Phone: ".$_POST['phone']."</p>";
 if (isset($_POST['message']) && !empty($_POST['message'])) {
     $mail->Body.="<p>Message: ".$_POST['message']."</p>";
 }





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
       $_SESSION['failed'] = "Message not sent. Please try again after some time";
       header("Location:".$_SERVER['REQUEST_URI']);
       // header("Location: contactus");
         exit();
          // die(var_dump("Email not sent. " , $mail->ErrorInfo , PHP_EOL));
     } else {
        $_SESSION['success'] = "Message Sent. Thanks for contacting";
        header("Location:".$_SERVER['REQUEST_URI']);
        // header("Location: contactus");
         exit();
        // echo "Email sent!" , PHP_EOL;
        // exit();
     }

   }

 }
?>

<?php
$page_name = "Contact Us";
// $page_title = "Contact Us";
include "includes/header.php";
$post_category = fetchContent($conn, "web_category");
$post_category_data = [];
foreach ($post_category as $key => $value) {
  $post_category_data[$value['category_hash_id']] = $value['web_category_name'];
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

 ?>

 <?php if(isset ($_SESSION['failed'])): ?>
   <div data-notify="container" id="closeit" undefined="" class="bootstrap-notify col-11 col-md-4 alert alert-danger" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; right: 20px; visibility:visible;">
   <button type="button" aria-hidden="true" class="close" data-notify="" style="position: absolute; right: 10px; top: 5px; z-index: 1033;" onclick="closeMsg()">
     ×
   </button>
   <span data-notify="icon"></span>
   <span data-notify="title">Failed</span>
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

 <section id="page-title" data-bg-parallax="images/parallax/5.jpg">
   <div class="container">
     <div class="page-title">
       <h1>Contact Us</h1>
       <span>To make any enquiry, complain or you want to get featured on our website. Contact us today!</span>
     </div>
     <!-- <div class="breadcrumb">
       <ul>
         <li><a href="home">Home</a> </li>
         <li class="active"><a href="contactus">Contact Us</a> </li>
       </ul>
     </div> -->
   </div>
 </section>

 <section>
   <div class="container">
     <div class="row">
         <div class="col-lg-6">
           <h3 class="text-uppercase">Get In Touch</h3>
           <p>To make any enquiry, complain or you want to get featured on our website. Contact us today!</p>
           <div class="m-t-30">
             <form action="" method="post">
               <div class="row">
                 <div class="form-group col-md-6">
                   <label for="name">Name</label>
                   <input type="text" aria-required="true" name="name" required class="form-control required name" placeholder="Enter your Name">
                 </div>
                 <div class="form-group col-md-6">
                   <label for="email">Email</label>
                   <input type="email" aria-required="true" name="email" required class="form-control required email" placeholder="Enter your Email">
                 </div>
               </div>
               <div class="row">
                 <div class="form-group col-md-12">
                   <label for="subject">Your Subject</label>
                   <input type="text" name="subject" required class="form-control required" placeholder="Subject...">
                 </div>
               </div>
               <div class="form-group">
                 <label for="message">Message</label>
                 <textarea type="text" name="message" required rows="5" class="form-control required" placeholder="Enter your Message"></textarea>
               </div>

               <button class="btn" type="submit" name="submit"><i class="fa fa-paper-plane"></i>&nbsp;Send message</button>
             </form>
           </div>
         </div>
         <!-- <div class="col-lg-6">
           <h3 class="text-uppercase">Address & Map</h3>
           <div class="row">
             <div class="col-lg-6">
              <address>
                 <strong>Polo, Inc.</strong><br>
                 795 Folsom Ave, Suite 600<br>
                 San Francisco, CA 94107<br>
                 <abbr title="Phone">P:</h4> (123) 456-7890
               </address>
             </div>
             <div class="col-lg-6">
               <address>
                 <strong>Polo Office</strong><br>
                 795 Folsom Ave, Suite 600<br>
                 San Francisco, CA 94107<br>
                 <abbr title="Phone">P:</h4> (123) 456-7890
               </address>
              </div>
           </div> -->
        </div>
     </div>
 </section>

 <?php include "includes/footer.php" ?>
