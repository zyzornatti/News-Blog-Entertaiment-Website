<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>H.O.M | <?php echo $page_title ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Home of Memes Admin panel, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<link rel="icon" type="image/png" href="/hom.jpeg">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="adminasset/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="adminasset/css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<!-- <link href="fontawesome/css/all.css" rel="stylesheet"> -->
<link href="adminasset/css/font-awesome.css" rel="stylesheet">
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
<!-- webfonts--->
<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<!---//webfonts--->
 <!-- Meters graphs -->
<script src="adminasset/js/jquery-1.10.2.min.js"></script>
<script src="adminasset/js/sweetalert2.all.min.js"></script>
<script src="adminasset/js/hom.js"></script>
<script src="tinymce/jquery.tinymce.min.js"></script>
<script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
	selector: "textarea",
	plugins : "code image emoticons wordcount link code fullscreen insertdatetime",
	toolbar: 'undo redo | image code | save | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons',
	image_caption: true,
	images_upload_url: 'upload',
	images_upload_handler: function(blobInfo, success, failure){
		var xhr, formData;

			xhr = new XMLHttpRequest();
			xhr.withCredentials = false;
			xhr.open('POST', 'upload');

			xhr.onload = function(){

				if(xhr.status !== 200){
					failure('HTTP Error: ' + xhr.status);
					return;
				}

				json = JSON.parse(xhr.responseText);

				if(!json || typeof json.location != 'string'){
					failure('Invalid JSON: ' + xhr.responseText);
					return;
				}

				success(json.location);

			};

			xhr.onerror = function(){
				failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
				return;
			};

			formData = new FormData();
			formData.append('file', blobInfo.blob(), blobInfo.filename());
			formData.append('folder', "<?= $page_folder ?>");
			xhr.send(formData);

	}

});
	// tinymce.init({
	// 	selector: "textarea",
	// 	plugins : "save",
	//   menubar : false,
	//   toolbar: 'save | styleselect | bold italic | alignleft aligncenter alignright alignjustify',
	//   save_onsavecallback : "save"
	// });
</script>
</head>

 <body class="sticky-header left-side-collapsed" onload="hideImageBoard()">
	 <?php $chk = fetchRecord2($conn, "admin", "admin_hash", $_SESSION['admin_id'])  ?>
  <section>
    <!-- left side start-->
		<div class="left-side sticky-left-side">

			<!--logo and iconic logo start-->
			<div class="logo">
				<h1><a href="adminhome">H.O.M <span>Admin</span></a></h1>
			</div>
			<div class="logo-icon text-center">
				<a href="adminhome"><i class="fa fa-home"></i> </a>
			</div>

			<!--logo and iconic logo end-->
			<div class="left-side-inner">

				<!--sidebar nav start-->
					<ul class="nav nav-pills nav-stacked custom-nav">
						<li class="active"><a href="adminhome"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
						<li class="menu-list">
							<a href="#"><i class="fa fa-picture-o"></i>
								<span>Memes</span></a>
								<ul class="sub-menu-list">
									<li><a href="viewmemes">Manage Memes</a> </li>
									<li><a href="addmeme">Add Memes</a> </li>
									<?php if($chk['rank'] == 1): ?>
										<li><a href="memecategory">Manage Memes Category</a> </li>
										<li><a href="addmemecat">Add Memes Category</a> </li>
									<?php endif ?>
								</ul>
						</li>
						<li class="menu-list">
							<a href="#"><i class="fa fa-book"></i>
								<span>Web Posts</span></a>
								<ul class="sub-menu-list">
									<li><a href="viewpost">Manage Posts</a> </li>
									<li><a href="add">Add Posts</a> </li>
								</ul>
						</li>
						<?php if($chk['rank'] == 1): ?>
						<li class="menu-list">
							<a href="#"><i class="fa fa-music"></i>
								<span>Music</span></a>
								<ul class="sub-menu-list">
									<li><a href="musics">Manage Musics</a> </li>
									<li><a href="addmusic">Add Music</a> </li>
									<li><a href="musiccategory">Manage music categories</a> </li>
									<li><a href="addmusiccat">Add music category</a> </li>
								</ul>
						</li>
					<?php endif ?>
						<?php if($chk['rank'] == 1): ?>
							<li class="menu-list">
								<a href="#"><i class="fa fa-pencil-square-o"></i>
									<span>Web Category</span></a>
									<ul class="sub-menu-list">
										<li><a href="viewcategory">Manage Web Category</a> </li>
										<li><a href="addcat">Add Category</a> </li>
									</ul>
							</li>
							<li class="menu-list">
								<a href="#"><i class="fa fa-pencil"></i>
									<span>Web Section</span></a>
									<ul class="sub-menu-list">
										<li><a href="websection">Manage Web Section</a> </li>
										<li><a href="addsection">Add Web Section</a></li>
									</ul>
							</li>
						<?php endif ?>
						<!-- <li class="menu-list">
							<a href="#"><i class="lnr lnr-spell-check"></i>
								<span>News</span></a>
								<ul class="sub-menu-list">
									<li><a href="viewnews">Manage News</a> </li>
									<li><a href="newscategory">Manage News Category</a></li>
								</ul>
						</li> -->
						<!-- <li class="menu-list">
							<a href="#"><i class="lnr lnr-indent-increase"></i>
								<span>Category</span></a>
								<ul class="sub-menu-list">
									<li><a href="viewcategory">Manage Category</a> </li>
									<li><a href="category">Add Category</a></li>
								</ul>
						</li> -->
						<?php if($chk['rank'] == 1){ ?>
							<!-- <li><a href="authenticate"><i class="fa fa-plus"></i><span>Add Admin</span></a></li> -->
							<li class="menu-list"><a href="#"><i class="fa fa-plus"></i> <span>Auth Code</span></a>
								<ul class="sub-menu-list">
									<!-- <li><a href="manageaut">Manage Code</a></li> -->
									<li><a href="authenticate">Generate</a> </li>
								</ul>
							</li>
						<?php }?>
						<li class="menu-list"><a href="#"><i class="fa fa-user"></i> <span>Manage Accounts</span></a>
							<ul class="sub-menu-list">
								<li><a href="user">Manage Users</a> </li>
								<?php if($chk['rank'] == 1){ ?>
									<li><a href="admin">Manage Admins</a> </li>
								<?php }?>
							</ul>
						</li>

						<!-- <li class="menu-list"><a href="#"><i class="lnr lnr-envelope"></i> <span>Deleted Posts</span></a>

						</li> -->
						<?php if($chk['rank'] == 1): ?>
							<li class="menu-list"><a href="#"><i class="fa fa-envelope"></i> <span>Contact</span></a>
								<ul class="sub-menu-list">
									<li><a href="viewcontact">Manage Contact</a> </li>
									<li><a href="addcontact">Add Contact</a></li>
								</ul>
							</li>
							<li class="menu-list"><a href="#"><i class="fa fa-tasks"></i> <span>About</span></a>
								<ul class="sub-menu-list">
									<li><a href="viewabout">Manage About</a> </li>
									<li><a href="addabout">Add About</a></li>
								</ul>
							</li>

						<?php endif ?>
					</ul>
				<!--sidebar nav end-->
			</div>
		</div>
		<!-- left side end-->

		<!-- main content start-->
		<div class="main-content">
			<!-- header-starts -->
			<div class="header-section">

			<!--toggle button start-->
			<a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
			<!--toggle button end-->

			<!--notification menu start -->
			<div class="menu-right">
				<div class="user-panel-top">
					<div class="profile_details">
						<ul>
							<li class="dropdown profile_details_drop">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<div class="profile_img">
										<!-- <span style="background:url(images/1.jpg) no-repeat center"> </span> -->
										<?php $admin_details = fetchRecord2($conn, 'admin', 'admin_hash', $_SESSION['admin_id']) ?>
										<span onclick="uploadProfile(<?php echo $_SESSION['admin_id'] ?>)" style="background:url(uploads/admin/<?php echo $admin_details['admin_profile_pics']; ?>) no-repeat center; border-radius:50%"></span>
										 <div class="user-name">
											<p><?php echo $admin_details['admin_username']; ?><span>Administrator</span></p>
										 </div>
										 <i class="lnr lnr-chevron-down"></i>
										 <i class="lnr lnr-chevron-up"></i>
										 <!-- <i class="fa fa-angle-down"></i> -->
										 <!-- <i class="fa fa-angle-up"></i> -->
										<div class="clearfix"></div>
									</div>
								</a>
								<ul class="dropdown-menu drp-mnu">
									<li> <a href="profile"><i class="fa fa-user"></i>Admin Profile</a> </li>
									<li> <a href="authorprofile"><i class="fa fa-eye"></i>Author Bio</a> </li>
									<li> <a href="password"><i class="fa fa-cog"></i>Change password</a> </li>
									<li> <a href="adminlogout"><i class="fa fa-sign-out"></i> Logout</a> </li>
								</ul>
							</li>
							<div class="clearfix"> </div>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			  </div>
			<!--notification menu end -->
			</div>
		<!-- //header-ends -->
