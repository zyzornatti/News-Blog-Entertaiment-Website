<!DOCTYPE html>
<html lang="en">

<head>
  <script data-ad-client="ca-pub-9220759623427924" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <meta name="yandex-verification" content="3a0923fd464195ef" />
  <?php include "seo/metas.php" ?>
<!-- <meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> <meta name="author" content="INSPIRO" />
<meta name="description" content="Themeforest Template Polo, html template">
<link rel="icon" type="image/png" href="images/favicon.png">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>Home of Memes | <?php //echo $page_name ?></title> -->

<link href="/asset/css/plugins.css" rel="stylesheet">
<link href="/asset/css/style.css" rel="stylesheet">

<link href="/asset/css/color-variations/red-dark.html" rel="stylesheet" type="text/css" media="screen" title="blue">
<script src="/asset/js/jquery-1.10.2.min.js"></script>
<script src="/asset/js/hom.js"></script>

<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=60395c0d6f7ab900129ce564&product=inline-share-buttons" async="async"></script>
<script src="https://accounts.google.com/gsi/client" async defer></script>
</head>
<!-- <script>
document.write('<script src="https://sharehulk.com/api/sharingbutton.php?type=horizontal&u=' + encodeURIComponent(document.location.href) + '"></scr' + 'ipt>');
</script> -->
<body>

<div class="body-inner">

<div id="topbar" class="d-none d-xl-block d-lg-block">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <!-- <div class="topbar-dropdown">
          <a class="title">English <i class="fa fa-caret-down"></i></a>
          <div class="dropdown-list">
            <a class="list-entry" href="#">French</a>
            <a class="list-entry" href="#">Spanish</a>
          </div>
        </div> -->
          <?php if(!isset ($_SESSION['user'])): ?>
            <div class="topbar-dropdown">
              <div class="title"><i class="fa fa-user"></i><a href="#">Login</a></div>
              <div class="topbar-form">
                <div class="" id="login-res1" style="visibility:hidden;"></div>
                <form action="" method="post">
                  <div class="form-group">
                    <label class="sr-only">Username or Email</label>
                    <input type="text" placeholder="Username or Email" class="form-control" id="user-details1">
                  </div>
                  <div class="form-group">
                    <label class="sr-only">Password</label>
                    <input type="password" placeholder="Password" class="form-control" id="user-password1">
                  </div>
                  <div class="form-inline form-group">
                    <div class="form-check">
                      <!-- <label>
                        <input type="checkbox">
                        <small class="m-l-10"> Remember me</small>
                      </label> -->
                    </div>
                    <button type="button" class="btn btn-primary btn-block" onclick="loginUser1();">Login</button>
                  </div>
                </form>
              </div>
            </div>
            <?php else: ?>
              <?php $user_name1 = fetchRecord2($conn, "public", "user_hash", $_SESSION['user']) ?>
              <div class="topbar-dropdown">
                <div class="title"><i class="fa fa-user"></i><a href="#"><?php echo $user_name1['username'] ?></a></div>
                <div class="topbar-form">
                  <div class="title"><i class="fa fa-angle-right"></i><a href="/editprofile">Edit Profile</a>
                  </div>
                  <div class="title"><i class="fa fa-angle-right"></i><a href="/logout">Logout</a>
                  </div>
                </div>
              </div>
          <?php endif ?>

        <!-- <div class="topbar-dropdown">
          <div class="title"><i class="fa fa-sun-o"></i>Melburne 15°</div>
        </div> -->
      </div>
      <div class="col-md-6 d-none d-sm-block">
        <div class="social-icons social-icons-colored-hover">
          <ul>
            <li class="social-facebook"><a href="https://facebook.com/homeofmemes51"><i class="fab fa-facebook-f"></i></a></li>
            <li class="social-twitter"><a href="https://twitter.com/the_homeofmemes"><i class="fab fa-twitter"></i></a></li>
            <li class="social-instagram"><a href="https://instagram.com/the_homeofmemes"><i class="fab fa-instagram"></i></a></li>
            <!-- <li class="social-google"><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
            <li class="social-pinterest"><a href="#"><i class="fab fa-pinterest"></i></a></li>
            <li class="social-vimeo"><a href="#"><i class="fab fa-vimeo"></i></a></li>
            <li class="social-linkedin"><a href="#"><i class="fab fa-linkedin"></i></a></li>
            <li class="social-dribbble"><a href="#"><i class="fab fa-dribbble"></i></a></li> -->
            <!-- <li class="social-youtube"><a href="https://www.youtube.com/the_homeofmemes"><i class="fab fa-youtube"></i></a></li> -->
            <!-- <li class="social-rss"><a href="#"><i class="fa fa-rss"></i></a></li> -->
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>


<header id="header">
  <div class="header-inner">
    <div class="container">

      <div id="logo"> <a href="/"><span class="logo-default"><img src="/<?= $hom_logo  ?>"></span><span class="logo-dark"><img src="/hom_logo-1.jpg"></span></a> </div>


      <div id="search">
        <a id="btn-search-close" class="btn-search-close" aria-label="Close search form"><i class="icon-x"></i>
        </a>
        <?php if($page_name == "Music" || $page_name == "Music Category"){
          $search_url = "msearch";
        }else{
          $search_url = "search";
        } ?>
        <form class="search-form" action="/<?= $search_url ?>" method="get">
          <input class="form-control" name="q" type="text" placeholder="Type & Search..." />
          <span class="text-muted">Start typing & press "Enter" or "ESC" to close</span>
        </form>
      </div>

      <div class="header-extras">
        <ul>
          <li> <a id="btn-search" href="#"> <i class="icon-search"></i></a> </li>
          <!-- <li>
          <div class="p-dropdown"> <a href="#"><i class="icon-globe"></i><span>EN</span></a>
          <ul class="p-dropdown-content">
          <li><a href="#">French</a></li>
          <li><a href="#">Spanish</a></li>
          <li><a href="#">English</a></li>
          </ul>
          </div>
          </li> -->
        </ul>
      </div>


      <div id="mainMenu-trigger"> <a class="lines-button x"><span class="lines"></span></a> </div>


      <div id="mainMenu">
        <div class="container">
          <nav>
            <ul>
              <li><a href="/">Home</a></li>
              <li class="dropdown"><a href="#">Memes</a>
                <ul class="dropdown-menu">
                  <?php $memes_cat = fetchContent($conn, "hom_memes_category") ?>
                  <?php foreach ($memes_cat as $key => $value): ?>
                    <li><a href="/memes/<?= strtolower($value['memes_category_name']) ?>-<?= $value['memes_category_hash_id'] ?>"><?= $value['memes_category_name'] ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
              <li class="dropdown"><a href="#">H.O.M categories</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-submenu">
                      <a href="#">Music</a>
                    <?php $music_cat = fetchContent($conn, "hom_mav_category") ?>
                    <ul class="dropdown-menu">
                      <?php foreach ($music_cat as $key => $value): ?>
                          <li><a href="/musiccategory/<?= $value['hom_mav_category_slug'] ?>-<?= $value['hom_mav_category_hash_id'] ?>"><?= $value['hom_mav_category_name'] ?></a></li>
                      <?php endforeach; ?>
                    </ul>
                  </li>

                  <?php $sec1 = fetchContent($conn, "web_section") ?>
                  <?php foreach ($sec1 as $key1 => $value1): ?>

                    <?php $sec2 = fetchContent2($conn, "web_category", "web_section_id", $value1['section_hash_id']) ?>


                    <li class="dropdown-submenu">
                      <a href="#"><?php echo $value1['web_section_name'] ?></a>


                          <ul class="dropdown-menu">
                            <?php foreach ($sec2 as $key2 => $value2): ?>
                            <li>

                              <a href="/category/<?= $value1['sec_slug'] ?>/<?= $value2['cat_slug'] ?>-<?= $value2['category_hash_id'] ?>"><?php echo $value2['web_category_name'] ?></a>

                            </li>
                            <?php endforeach ?>
                          </ul>

                    </li>

                  <?php endforeach ?>
                </ul>
              </li>
              <?php if(!isset ($_SESSION['user'])): ?>
                <li class="dropdown"><a href="#">Sign Up/Login</a>
                  <ul class="dropdown-menu">
                    <li><a href="/register">Sign Up</a></li>
                    <li><a href="/signin">Login</a></li>
                  </ul>
                </li>
              <?php endif ?>
              <!-- <li><a href="/about">About us</a></li> -->
              <li><a href="/contact">Contact us</a></li>
              <!-- <li><a href="#">Advertise</a></li> -->
              <?php if(isset ($_SESSION['user'])): ?>
                <?php $user_name = fetchRecord2($conn, "public", "user_hash", $_SESSION['user']) ?>
                <li class="dropdown"><a href="#"><?php echo $user_name['username'] ?></a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-submenu"><a href="/editprofile">Edit Profile</a></li>
                    <li class="dropdown-submenu"><a href="/logout">Logout</a></li>
                  </ul>
                </li>
              <?php endif ?>
            </ul>
          </nav>
        </div>
      </div>

    </div>
  </div>
</header>
