<?php

$uri = explode("/", $_SERVER['REQUEST_URI']);

if (count($uri) > 2) {
  // if (!empty($_GET)) {
  // $query_string = explode("?",$uri[2])[1];
  // }else{
  //   $query_string = "";
  // }
  $query_string = explode("/", $uri[2])[0];

  switch ($uri[1]."/".$uri[2]) {
    case 'post/'.$query_string:
      include APP_PATH."/views/public/hom_single_post.php";
      break;

    case 'section/'.$query_string:
      include APP_PATH."/views/public/hom_sec.php";
      break;

    case 'category/'.$query_string:
      include APP_PATH."/views/public/hom_cat.php";
      break;

    case 'author/'.$query_string:
      include APP_PATH."/views/public/hom_author.php";
      break;

    case 'memes/'.$query_string:
      include APP_PATH."/views/public/hom_memes.php";
      break;

    case 'music/'.$query_string:
      include APP_PATH."/views/public/musicpage.php";
      break;

    case 'musiccategory/'.$query_string:
      include APP_PATH."/views/public/music_cat.php";
      break;

    default :
      include APP_PATH."/views/public/404.php";
      break;

  }

}else{
  if (!empty($_GET)) {
  $query_string = explode("?", $uri[1])[1];
  }else{
    $query_string = "";
  }

switch ($uri[1]) {
    case '':
    	include APP_PATH."/views/public/home.php";
    	break;

    case 'home':
    	include APP_PATH."/views/public/home.php";
    	break;

// Mail Sending App Starts
    // case 'xxx':
    // 	include APP_PATH."/views/public/mail.php";
    // 	break;
    //
    // case 'del_mail':
    // 	include APP_PATH."/views/public/del_mail.php";
    // 	break;
    //
    // case 'send_mail':
    // 	include APP_PATH."/views/public/send_mail.php";
    // 	break;
    //
    // case 'xxy':
    // 	include APP_PATH."/views/public/addmail.php";
    // 	break;
    //
    // case 'xxy?'.$query_string:
    // 	include APP_PATH."/views/public/addmail.php";
    // 	break;
// Mail Sending App Ends

    case 'search':
      include APP_PATH."/views/public/hom_search.php";
      break;

    case 'search?'.$query_string:
      include APP_PATH."/views/public/hom_search.php";
      break;

    case 'msearch':
      include APP_PATH."/views/public/musicsearch.php";
      break;

    case 'msearch?'.$query_string:
      include APP_PATH."/views/public/musicsearch.php";
      break;

    // case 'cat?'.$query_string:
    //   include APP_PATH."/views/public/hom_cat.php";
    //   break;

    case 'ajax_cat':
      include APP_PATH."/views/public/ajax_backend/ajax_category.php";
      break;

    case 'ajax_musiccat':
      include APP_PATH."/views/public/ajax_backend/ajax_musiccategory.php";
      break;

    case 'ajax_aut':
      include APP_PATH."/views/public/ajax_backend/ajax_author.php";
      break;

    // case 'ajax_cat?'.$query_string:
    // 	include APP_PATH."/views/public/ajax_backend/ajax_category.php";
    // 	break;

    // case 'author?'.$query_string:
    //   include APP_PATH."/views/public/hom_author.php";
    //   break;


    case 'about':
      include APP_PATH."/views/public/hom_about.php";
      break;

    case 'contact':
      include APP_PATH."/views/public/hom_contact.php";
      break;

    // case 'post/'.$query_string:
    //   include APP_PATH."/views/public/hom_single_post.php";
    //   break;

    case 'readpost?'.$query_string:
    	include APP_PATH."/views/public/hom_single_post.php";
    	break;

    case 'authenticate':
      include APP_PATH."/views/admin/admin_authenticate.php";
      break;

    // case 'auth_verify':
    //   include APP_PATH."/views/admin/aut_verify.php";
    //   break;
    //
    // case 'admin_verify':
    //   include APP_PATH."/views/admin/ajax_backend/admin_verify.php";
    //   break;

    case 'admin_aut':
      include APP_PATH."/views/admin/ajax_backend/admin_aut.php";
      break;

    case 'adminsignup':
      include APP_PATH."/views/admin/adminsignup.php";
      break;

    case 'admsignup':
      include APP_PATH."/views/admin/ajax_backend/admsignup.php";
      break;

    case 'adminlogin':
      include APP_PATH."/views/admin/signin.php";
      break;

    case 'adminlogin?'.$query_string:
      include APP_PATH."/views/admin/signin.php";
      break;

    case 'authenticate':
      include APP_PATH."/views/admin/authenticate.php";
      break;

    case 'adminlogout':
      include APP_PATH."/views/admin/signout.php";
      break;

    case 'logout':
      include APP_PATH."/views/public/hom_logout.php";
      break;

    case 'adminhome':
      include APP_PATH."/views/admin/adminhome.php";
      break;

    case 'add':
      include APP_PATH."/views/admin/addblog.php";
      break;

    case 'editblog':
      include APP_PATH."/views/admin/ajax_backend/edit.php";
      break;

    case 'edit?'.$query_string:
      include APP_PATH."/views/admin/editblog.php";
      break;

    case 'delete':
      include APP_PATH."/views/admin/ajax_backend/del.php";
      break;

    // case 'delete?'.$query_string:
    // 	include APP_PATH."/views/admin/delete.php";
    // 	break;

    case 'blog':
      include APP_PATH."/views/admin/ajax_backend/blog.php";
      break;

    case 'viewpost':
      include APP_PATH."/views/admin/viewblog.php";
      break;

    // case 'view?'.$query_string:
    // 	include APP_PATH."/views/admin/viewblog.php";
    // 	break;

    case 'addcontact':
      include APP_PATH."/views/admin/addcontact.php";
      break;

    case 'addcont':
      include APP_PATH."/views/admin/ajax_backend/cont.php";
      break;

    case 'viewcontact':
      include APP_PATH."/views/admin/viewcontact.php";
      break;

    case 'viewcontact?'.$query_string:
      include APP_PATH."/views/admin/viewcontact.php";
      break;

    case 'addabout':
      include APP_PATH."/views/admin/addabout.php";
      break;

    case 'addabt':
      include APP_PATH."/views/admin/ajax_backend/abt.php";
      break;

    case 'va':
      include APP_PATH."/views/admin/ajax_backend/va.php";
      break;

    case 'vb':
      include APP_PATH."/views/admin/ajax_backend/vb.php";
      break;

    case 'vc':
      include APP_PATH."/views/admin/ajax_backend/vc.php";
      break;

    case 'vu':
      include APP_PATH."/views/admin/ajax_backend/vu.php";
      break;

    case 'vcat':
      include APP_PATH."/views/admin/ajax_backend/vcat.php";
      break;

    case 'vad':
      include APP_PATH."/views/admin/ajax_backend/vad.php";
      break;

    case 'vad?'.$query_string:
      include APP_PATH."/views/admin/ajax_backend/vad.php";
      break;

    case 'vcat?'.$query_string:
      include APP_PATH."/views/admin/ajax_backend/vcat.php";
      break;

    case 'vc?'.$query_string:
      include APP_PATH."/views/admin/ajax_backend/vc.php";
      break;

    case 'vu?'.$query_string:
      include APP_PATH."/views/admin/ajax_backend/vu.php";
      break;

    case 'vb?'.$query_string:
      include APP_PATH."/views/admin/ajax_backend/vb.php";
      break;

    case 'va?'.$query_string:
      include APP_PATH."/views/admin/ajax_backend/va.php";
      break;

    case 'viewabout':
      include APP_PATH."/views/admin/viewabout.php";
      break;

    case 'viewabout?'.$query_string:
      include APP_PATH."/views/admin/viewabout.php";
      break;

    case 'addcat':
      include APP_PATH."/views/admin/addcategory.php";
      break;

    case 'editcont?'.$query_string:
      include APP_PATH."/views/admin/editcontact.php";
      break;

    case 'editcontact':
      include APP_PATH."/views/admin/ajax_backend/editcont.php";
      break;

    case 'editabout?'.$query_string:
      include APP_PATH."/views/admin/editabout.php";
      break;

    case 'editabt':
      include APP_PATH."/views/admin/ajax_backend/editabt.php";
      break;

    case 'editcat?'.$query_string:
      include APP_PATH."/views/admin/editcategory.php";
      break;

    case 'editcategory':
      include APP_PATH."/views/admin/ajax_backend/editcat.php";
      break;

    case 'cat':
      include APP_PATH."/views/admin/ajax_backend/cat.php";
      break;

    case 'viewcategory':
      include APP_PATH."/views/admin/viewcategory.php";
      break;

    case 'viewcategory?'.$query_string:
      include APP_PATH."/views/admin/viewcategory.php";
      break;

    case 'login':
      include APP_PATH."/views/admin/ajax_backend/login.php";
      break;

    case 'user':
      include APP_PATH."/views/admin/manageuser.php";
      break;

    case 'user?'.$query_string:
      include APP_PATH."/views/admin/manageuser.php";
      break;

    case 'admin':
      include APP_PATH."/views/admin/manageadmin.php";
      break;

    case 'admin?'.$query_string:
      include APP_PATH."/views/admin/manageadmin.php";
      break;

    // case 'signup':
    // 	include APP_PATH."/views/usersignup.php";
    // 	break;

    case 'confirm':
      include APP_PATH."/views/admin/confirmdel.php";
      break;

    case 'sus':
      include APP_PATH."/views/admin/ajax_backend/suspend.php";
      break;

    case 'profile':
      include APP_PATH."/views/admin/adminprofile.php";
      break;

    case 'prf':
      include APP_PATH."/views/admin/ajax_backend/profile.php";
      break;

    case 'password':
      include APP_PATH."/views/admin/changepassword.php";
      break;

    case 'pass':
      include APP_PATH."/views/admin/ajax_backend/pass.php";
      break;

    case 'tiny':
      include APP_PATH."/views/admin/tinymce.php";
      break;

    case 'tiny?'.$query_string:
      include APP_PATH."/views/admin/tinymce.php";
      break;

    case 'ajax_comment':
      include APP_PATH."/views/public/ajax_backend/ajax_comment.php";
      break;

    case 'ajax_getreply':
      include APP_PATH."/views/public/ajax_backend/ajax_getreply.php";
      break;

    case 'ajax_reply':
      include APP_PATH."/views/public/ajax_backend/ajax_reply.php";
      break;

    case 'testtinyimage':
      include APP_PATH."/views/admin/testtinyimage.php";
      break;

    case 'upload':
      include APP_PATH."/views/admin/upload.php";
      break;

    // case 'time':
    // 	include APP_PATH."/views/time.php";
    // 	break;

    case 'authorprofile':
      include APP_PATH."/views/admin/authorprofile.php";
      break;

    case 'authorprf':
      include APP_PATH."/views/admin/ajax_backend/authorprf.php";
      break;

    case 'edithandle':
      include APP_PATH."/views/admin/ajax_backend/edithandles.php";
      break;

    case 'prfimage':
      include APP_PATH."/views/admin/ajax_backend/prfimage.php";
      break;

    case 'updateblogimage':
      include APP_PATH."/views/admin/ajax_backend/updateblogimage.php";
      break;

    case 'updatecontactimage':
      include APP_PATH."/views/admin/ajax_backend/updatecontactimage.php";
      break;

    case 'updateaboutimage':
      include APP_PATH."/views/admin/ajax_backend/updateaboutimage.php";
      break;

    case 'updatemusicimage':
      include APP_PATH."/views/admin/ajax_backend/updatemusicimage.php";
      break;

    //Section link
    case 'addsection':
      include APP_PATH."/views/admin/addsection.php";
      break;

    case 'sec':
      include APP_PATH."/views/admin/ajax_backend/sec.php";
      break;

    // case 'section?'.$query_string:
    //   include APP_PATH."/views/public/hom_sec.php";
    //   break;

    case 'websection':
      include APP_PATH."/views/admin/viewsection.php";
      break;

    case 'vsec':
      include APP_PATH."/views/admin/ajax_backend/vsec.php";
      break;

    case 'editsec?'.$query_string:
      include APP_PATH."/views/admin/editsec.php";
      break;

    case 'esec':
      include APP_PATH."/views/admin/ajax_backend/esec.php";
      break;

    case 'catselect':
      include APP_PATH."/views/admin/ajax_backend/catselect.php";
      break;

    case 'admin_act':
      include APP_PATH."/views/admin/ajax_backend/admin_a.php";
      break;

    case 'admin_activity?'.$query_string:
      include APP_PATH."/views/admin/admin_activities.php";
      break;

    case 'user_act':
      include APP_PATH."/views/admin/ajax_backend/user_a.php";
      break;

    case 'user_activity?'.$query_string:
      include APP_PATH."/views/admin/user_activities.php";
      break;

    case 'post_act':
      include APP_PATH."/views/admin/ajax_backend/post_a.php";
      break;

    case 'music_act':
      include APP_PATH."/views/admin/ajax_backend/music_a.php";
      break;

    case 'test':
      include APP_PATH."/views/admin/test.php";
      break;

    case 'post_activity?'.$query_string:
      include APP_PATH."/views/admin/post_activities.php";
      break;

    case 'music_activity?'.$query_string:
      include APP_PATH."/views/admin/music_activities.php";
      break;

    case 'ajax_lc':
      include APP_PATH."/views/public/ajax_backend/ajax_loadcomments.php";
      break;

    case 'ajax_sc':
      include APP_PATH."/views/public/ajax_backend/ajax_section.php";
      break;

    case 'ajax_aa':
      include APP_PATH."/views/admin/ajax_backend/ajax_adminact.php";
      break;

    case 'showhide':
      include APP_PATH."/views/admin/ajax_backend/showandhide.php";
      break;

    case 'register':
      include APP_PATH."/views/public/hom_usersignup.php";
      break;

    case 'register?'.$query_string:
      include APP_PATH."/views/public/hom_usersignup.php";
      break;

    case 'signin':
      include APP_PATH."/views/public/hom_userlogin.php";
      break;

    case 'signin?'.$query_string:
      include APP_PATH."/views/public/hom_userlogin.php";
      break;

    case 'gsignin':
      include APP_PATH."/views/public/includes/gauth/signinwithgoogle.php";
      break;

    case 'gsignin?'.$query_string:
      include APP_PATH."/views/public/includes/gauth/signinwithgoogle.php";
      break;

    case 'registeruser':
      include APP_PATH."/views/public/ajax_backend/signupuser.php";
      break;

    case 'loginuser':
      include APP_PATH."/views/public/ajax_backend/logintheuser.php";
      break;

    case 'forgotpassword':
      include APP_PATH."/views/public/user_forgot_pword.php";
      break;

    case 'adminforgotpassword':
      include APP_PATH."/views/admin/admin_forgot_pword.php";
      break;

    case 'adminpasswordreset?'.$query_string:
      include APP_PATH."/views/admin/admin_forgot_pword.php";
      break;

    case 'adminreset':
      include APP_PATH."/views/admin/ajax_backend/admin_forgotpword.php";
      break;

    // case 'forgotpword':
    //   include APP_PATH."/views/public/ajax_backend/forgot_pword.php";
    //   break;

    case 'adminpasswordreset?'.$query_string:
      include APP_PATH."/views/admin/admin_forgot_pword.php";
      break;

    case 'passwordreset?'.$query_string:
      include APP_PATH."/views/public/forgot_pword.php";
      break;

    case 'editprofile':
      include APP_PATH."/views/public/edituser.php";
      break;

    case 'edituser':
      include APP_PATH."/views/public/ajax_backend/edituserprofile.php";
      break;

    case 'addmeme':
      include APP_PATH."/views/admin/addmemes.php";
      break;

    case 'addmemecat':
      include APP_PATH."/views/admin/addmemescategory.php";
      break;

    case 'memecat':
      include APP_PATH."/views/admin/ajax_backend/memecat.php";
      break;

    case 'memecategory':
      include APP_PATH."/views/admin/viewmemecat.php";
      break;

    case 'vmemecat':
      include APP_PATH."/views/admin/ajax_backend/vmeme.php";
      break;

    case 'editmemecat?'.$query_string:
      include APP_PATH."/views/admin/editmemecategory.php";
      break;

    case 'editmemec':
      include APP_PATH."/views/admin/ajax_backend/editmemecat.php";
      break;

    case 'admeme':
      include APP_PATH."/views/admin/ajax_backend/admeme.php";
      break;

    case 'vmeme':
      include APP_PATH."/views/admin/ajax_backend/vm.php";
      break;

    case 'viewmemes':
      include APP_PATH."/views/admin/viewm.php";
      break;

    case 'addmusic':
      include APP_PATH."/views/admin/addmusic.php";
      break;

    case 'editmusic?'.$query_string:
      include APP_PATH."/views/admin/editmusic.php";
      break;

    case 'emusic':
      include APP_PATH."/views/admin/ajax_backend/emusic.php";
      break;

    case 'musics':
      include APP_PATH."/views/admin/viewmusics.php";
      break;

    case 'vmusics':
      include APP_PATH."/views/admin/ajax_backend/viewmusics.php";
      break;

    case 'musicadd':
      include APP_PATH."/views/admin/ajax_backend/addmusic.php";
      break;

    case 'addmusiccat':
      include APP_PATH."/views/admin/addmusiccat.php";
      break;

    case 'musiccat':
      include APP_PATH."/views/admin/ajax_backend/addmusiccat.php";
      break;

    case 'musiccategory':
      include APP_PATH."/views/admin/viewmusiccat.php";
      break;

    case 'vmusiccat':
      include APP_PATH."/views/admin/ajax_backend/vmusiccat.php";
      break;

    case 'editmusiccat?'.$query_string:
      include APP_PATH."/views/admin/editmusiccat.php";
      break;

    case 'emusiccat':
      include APP_PATH."/views/admin/ajax_backend/editmusiccat.php";
      break;

    // case 'catupdate':
    //   include APP_PATH."/views/admin/updatecat.php";
    //   break;

    default :
      include APP_PATH."/views/public/404.php";
      break;

  }
}



?>
