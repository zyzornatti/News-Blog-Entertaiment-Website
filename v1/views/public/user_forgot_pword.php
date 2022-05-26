<?php
$page_name = "Reset Password";
$error = [];

if (isset($_POST['submit'])){

  if(isset($_POST['email']) && empty($_POST['email'])){
    $error['msg'] = "Please Enter Your Email";
    // $_SESSION['failed'] = "Please Enter Your Email";
  }else{
    $email = $_POST['email'];
    $check = countContent2($conn, "public", "email", $email);
    // var_dump($check);

    if($check < 1){
      $_SESSION['failed'] = "This email is not registered to any user";
      header("Location: /forgotpassword");
      die;
    }else{
      $usr = fetchRecord2($conn, "public", "email", $email);
      $username = $usr['username'];
      $gen_code = rand(1000, 9999).time();
      $gen_code_hash = md5($gen_code);
      $st = 0;

      $stmt = $conn->prepare("INSERT INTO admin_auth VALUES (NULL,:gc,:st,:em,NULL, NOW(), NOW())");
      $stmt->bindParam(":gc", $gen_code_hash);
      $stmt->bindParam(":st", $st);
      $stmt->bindParam(":em", $email);
      $stmt->execute();

      header("Location: /passwordreset?rid=$gen_code_hash&&rem=$email");

      // require APP_PATH.'/phpm/PHPMailerAutoload.php';
      //
      // // If necessary, modify the path in the require statement below to refer to the
      // // location of your Composer autoload.php file.
      // // require 'phpm/PHPMailerAutoload.php';
      //
      //
      // // Instantiate a new PHPMailer
      // $mail = new PHPMailer;
      //
      // // Tell PHPMailer to use SMTP
      // $mail->isSMTP();
      //
      // // Replace sender@example.com with your "From" address.
      // // This address must be verified with Amazon SES.
      // $mail->setFrom($site_email, 'Home of Memes');
      // $mail->AddReplyTo($site_email, 'Home of Memes');
      //
      // // Replace recipient@example.com with a "To" address. If your account
      // // is still in the sandbox, this address must be verified.
      // // Also note that you can include several addAddress() lines to send
      // // email to multiple recipients.
      // $mail->addAddress($_POST['email']);
      //
      // // Replace smtp_username with your Amazon SES SMTP user name.
      // $mail->Username = $site_email;
      //
      // // Replace smtp_password with your Amazon SES SMTP password.
      // $mail->Password = getenv("EMAIL_PASSWORD");
      //
      // // Specify a configuration set. If you do not want to use a configuration
      // // set, comment or remove the next line.
      // // $mail->addCustomHeader('X-SES-CONFIGURATION-SET', 'ConfigSet');
      //
      // // If you're using Amazon SES in a region other than US West (Oregon),
      // // replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
      // // endpoint in the appropriate region.
      // $mail->Host = 'smtp.gmail.com';
      //
      // // The subject line of the email
      // $mail->Subject = 'Password Reset';
      //
      // // The HTML-formatted body of the email
      // $mail->Body = "<h3>Hi $username</h3>
      // <img src='https://homeofmemes.com/hom_logo-1.jpg'>
      // <p>
      //
      // <p>click on the link to complete reseting your password</p>
      // <p>https://homeofmemes.com/passwordreset?rid=$gen_code_hash</p>
      //
      //
      // <p>If you require any further information, feel free to contact us: homeofmemes51@gmail.com</p>
      // <p>Follow us on social media: </p>
      // <p>Twitter: https://twitter.com/the_homeofmemes</p>
      // <p>Facebook: https://facebook.com/homeofmemes51</p>
      // <p>Instagram: https://instagram.com/the_homeofmemes</p>
      // ";
      //
      // // Tells PHPMailer to use SMTP authentication
      // $mail->SMTPAuth = true;
      //
      // // Enable TLS encryption over port 587
      // $mail->SMTPSecure = 'tls';
      // $mail->Port = 587;
      //
      // // Tells PHPMailer to send HTML-formatted email
      // $mail->isHTML(true);
      //
      // // The alternative email body; this is only displayed when a recipient
      // // opens the email in a non-HTML email client. The \r\n represents a
      // // line break.
      // $mail->AltBody = "Do not send a reply to this mail";
      //
      // if(!$mail->send()) {
      //   // die(var_dump($mail->Body));
      //   // die(var_dump("Email not sent. " , $mail->ErrorInfo , PHP_EOL));
      // } else {
      //   // echo "Email sent!" , PHP_EOL;
      //   $_SESSION['success'] = "A link has been sent to your email for you to complete reseting your password";
      //   header("Location: /forgotpassword");
      //   die;
      // }


    }
  }

}

// $page_title = "Login";
include "includes/header.php";
 ?>

 <?php if(isset ($_SESSION['msg'])): ?>
   <div data-notify="container" id="closeit" undefined="" class="bootstrap-notify col-11 col-md-4 alert alert-success" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; right: 20px; visibility:visible;">
   <button type="button" aria-hidden="true" class="close" data-notify="" style="position: absolute; right: 10px; top: 5px; z-index: 1033;" onclick="closeMsg()">
     ×
   </button>
   <span data-notify="icon"></span>
   <span data-notify="title">Success</span>
   <span data-notify="message"> <?= $_SESSION['msg'] ?></span>
 </div>
 <?php unset ($_SESSION['msg']); ?>
 <?php endif ?>

 <?php if(isset ($_SESSION['failed'])): ?>
   <div data-notify="container" id="closeit" undefined="" class="bootstrap-notify col-11 col-md-4 alert alert-danger" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; right: 20px; visibility:visible;">
   <button type="button" aria-hidden="true" class="close" data-notify="" style="position: absolute; right: 10px; top: 5px; z-index: 1033;" onclick="closeMsg()">
     ×
   </button>
   <span data-notify="icon"></span>
   <span data-notify="title">Error</span>
   <span data-notify="message"> <?= $_SESSION['failed'] ?></span>
 </div>
 <?php unset ($_SESSION['failed']); ?>
 <?php endif ?>

 <section id="page-title" data-bg-parallax="">
   <div class="container">
   <div class="page-title">
   <h1>Reset Password</h1>
   <span>Fill in the details below to reset password</span>
   </div>
   <!-- <div class="breadcrumb">
     <ul>
       <li><a href="home">Home</a>
       </li>
       <li><a href="signin">Login</a>
       </li>
     </ul>
   </div> -->
   </div>
 </section>


 <section>
   <div class="container">
     <div class="row">
       <div class="col-lg-4 offset-4">
         <div class="panel ">
           <div class="panel-body">
             <h3>Reset Password</h3>
             <?php if(isset ($error['msg'])): ?>
               <?php $msg = str_replace("_", " ", $error['msg']) ?>
               <div class="" id="login-res" style="color:red;"><?= $msg ?></div>
             <?php else: ?>
               <div class="" id="login-res" style="visibility:hidden;"></div>
             <?php endif ?>

             <form action="" method="post" id="login-form">
               <div class="form-group">
                 <label class="sr-only">Enter Email</label>
                 <input type="text" placeholder="Enter Email" class="form-control" name="email">
               </div>
               <div class="form-group form-inline m-b-10 ">
                 <div class="form-check">
                   <!-- <label>
                     <input type="checkbox"><small class="m-l-10"> Remember me</small>
                   </label> -->
                 </div>
               </div>
               <div class="form-group">
                 <button class="btn" type="submit" name="submit">Reset Password</button>
               </div>
             </form>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>

 <?php include "includes/footer.php" ?>
