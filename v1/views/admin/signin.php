<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Home of Memes | Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<link rel="icon" type="image/png" href="/hom.jpeg">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="adminasset/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="adminasset/css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="adminasset/css/font-awesome.css" rel="stylesheet">
<link href="adminasset/css/homeofmemes.css" rel="stylesheet">
<!-- jQuery -->
<!-- lined-icons -->
<link rel="stylesheet" href="adminasset/css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<!-- chart -->
<script src="adminasset/js/Chart.js"></script>
<!-- //chart -->
<!--animate-->
<link href="adminasset/css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="adminasset/js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!----webfonts--->
<!-- <link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'> -->
<!---//webfonts--->
 <!-- Meters graphs -->
<script src="adminasset/js/jquery-1.10.2.min.js"></script>
<script src="adminasset/js/sweetalert2.all.min.js"></script>
<script src="adminasset/js/hom.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->

</head>

 <body class="sign-in-up">
	 <?php if(isset ($_SESSION['msg'])){ ?>
	   <div style="visibility:hidden" id="msg" data-msg="<?php echo $_SESSION['msg']; ?>"></div>
	 <?php unset ($_SESSION['msg']); ?>
	 <?php } ?>

	 <script type="text/javascript">popUpShow()</script>

    <section>
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
					<div class="sign-in-form">
						<div class="sign-in-form-top">
							<p><span><img src="<?= $hom_logo ?>"></span></p><br>
							<p><span>Sign In to</span> <a href="adminlogin">Admin</a></p>
						</div>
						<div class="signin">
							<div class="signin-rit">
								<div class="clearfix"> </div>
							</div>
							<form id="loginform" action="" method="post">
								<?php
				        if (isset ($_GET['msg'])){ ?>
				          <?php $msg = str_replace("_", " ", $_GET['msg']); ?>
									<div id="login-response" class="alert alert-danger" role="alert"><p style="color:red"><?php echo $msg; ?></p></div>
				       <?php }else{ ?>
								 <div id="login-response" style="visibility:hidden" class="alert alert-danger" role="alert"></div>
							<?php } ?>
							<div class="log-input">
								<div class="log-input-left">
								   <input type="text" class="user" value="" id="email" placeholder="Enter Username or Email" required/>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="log-input">
								<div class="log-input-left">
								   <input type="password" class="lock" value="" id="password" placeholder="Enter Password" required/>
								</div>
								<div class="clearfix"> </div>
							</div>
							<input type="button" class='btn btn-success' id="adminlogin" onclick="adminLogin()" value="Login to your account">
							<span> <a href="adminsignup">Sign Up here</a></span> <span>or <a href="adminforgotpassword">Forgot Password</a></span>
              <!-- <button type="button" id="submit" name="button">Login to your account</button> -->
						</form>
						</div>
					</div>
				</div>
			</div>
		<!--footer section start-->
			<footer>
			   <p>&copy 2020 Home Of Memes. All Rights Reserved | Developed By ZyzorNatti</p>
			</footer>
        <!--footer section end-->
	</section>
<script src="adminasset/js/jquery.nicescroll.js"></script>
<script src="adminasset/js/scripts.js"></script>
<script src="adminasset/js/homeofmemes.js"></script>
<!-- <script src="js/hom.js"></script> -->
<!-- Bootstrap Core JavaScript -->
   <script src="adminasset/js/bootstrap.min.js"></script>
</body>
</html>
