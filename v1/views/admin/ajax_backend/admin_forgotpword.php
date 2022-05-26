<?php
$status = [];

try{
  if(isset ($_POST['email'])){
    $email = $_POST['email'];

    // $check = $conn->prepare("SELECT * FROM admin WHERE email = :em");
    // $check->bindParam(":em", $email);
    // $check->execute();
    //
    // $chk = $check->fetch(PDO::FETCH_BOTH);
    $check_admin = countContent2($conn, "admin", "email", $email);

      if($check_admin < 1){
        $status['failed'] = "This email is not registered to any user";
      }

      if(empty ($status['failed'])){
        $chk = fetchRecord2($conn, "admin", "email", $email);
        $username = $chk['admin_username'];
        $gen_code = rand(1000, 9999).time();
        $gen_code_hash = md5($gen_code);
        $st = 0;

        $stmt = $conn->prepare("INSERT INTO admin_auth VALUES (NULL,:gc,:st,:em,NULL, NOW(), NOW())");
        $stmt->bindParam(":gc", $gen_code_hash);
        $stmt->bindParam(":st", $st);
        $stmt->bindParam(":em", $email);
        $stmt->execute();

        // header("Location: /passwordreset?rid=$gen_code_hash&&rem=$email");

        // $link = "/adminpasswordreset?rid=".$gen_code_hash."&&rem=".$email;
        $link = "I worked";
        $status['success'] = $link;

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

} catch(Exception $e){
  $status['failed'] = $e;
  // $status['failed'] = "Something went wrong, try again later!!";
}

$res = json_encode($status);
echo $res;

 ?>
