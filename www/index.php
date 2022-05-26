<?php
$site_name = "Home of Memes";
$site_email = "homeofmemes51@gmail.com";
$site_description = "Home Of Memes is a new entertainment website in Nigeria where you can view lots of memes, read news, gist and also checkout different categories of entertainments.";
// $logo_directory = "hom_logo-1.jpg";
$logo = "hom.jpeg";
$hom_logo = "HOM-2.jpg";
$spinner = "lg.rotating-balls-spinner.gif";
session_start();
$dummy = "dummy.png";
// $description = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

// define("APP_PATH",dirname(dirname(__FILE__)));
define("D_PATH", dirname(dirname(__FILE__)));
CONST APP_PATH = D_PATH."/v1";
#env
include D_PATH."/.env/config.php";

#db,classes and controllers
include APP_PATH."/models/model.php";
include APP_PATH."/controller/controller.php";

##all routes
include APP_PATH."/routes/router.php";
// include APP_PATH."/ajax/ajax_routes/router.php";


?>
