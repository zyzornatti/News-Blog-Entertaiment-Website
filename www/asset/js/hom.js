$(document).ready(function() {
  $("time.timeago").timeago();
});

var postNumber = 10;
function loadRecord(url, id){
  postNumber = postNumber + 10;
  var record = document.getElementById('loadrecord');
  // var url = url;
  var method = "POST";
  var param = "page="+postNumber;
      param+="&id="+id;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
      // document.getElementById('loadgif').innerHTML = "lg.rotating-balls-spinner.gif";
       record.innerHTML = xhr.responseText;
       $("time.timeago").timeago();
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(param);
}

var postNumber = 2;
function loadComment(url, id){
  // alert(url +" : "+id)
  postNumber = postNumber +  2;
  var record = document.getElementById('loadcomment');
  var url = url;
  var method = "POST";
  var param = "page="+postNumber;
      param+="&id="+id;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
       record.innerHTML = xhr.responseText;
       $("time.timeago").timeago();

    }
  }
  // xhr.open(method, "ajax_lc?page="+postNumber+"&id="+id, true);
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(param);
  // xhr.send()
}


function submitComment(posturl, postid, user){
  // alert(postid+":"+user);
  var c_form_res = document.getElementById("c_form");
  var res = document.getElementById("lbl_body");
  var c_body = document.getElementById('c_body');

  if(c_body.value.trim() == ""){
    c_form_res.reportValidity();
    res.style.color = "red";
    res.style.visibility = "visible";
  }else{
    var method = "POST";
      var url = "/ajax_comment";
      var param ="c_body="+c_body.value;
        param+="&postid="+postid;
        param+="&user="+user;
      var cmt = new XMLHttpRequest();
      cmt.onreadystatechange = function(){
        if(cmt.readyState == 4 && cmt.status == 200){
          var res = JSON.parse(cmt.responseText);
          if(res.success){
            window.location = posturl;
          }

          if(res.failed){
            console.log(res.failed);
            document.getElementById('lbl_body').innerHTML = res.failed;
            document.getElementById('lbl_body').style.visibility = "visible";
          }
        }
      }
      cmt.open(method, url, true);
      cmt.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      cmt.send(param);
  }

}
// function submitComment(show){
//
//   var c_name = document.getElementById('c_name');
//   var c_email = document.getElementById('c_email');
//   var c_website = document.getElementById('c_website');
//   var c_body = document.getElementById('c_body');
//
//   if(c_name.value == ""){
//     c_name.style.border = "1px solid red";
//     document.getElementById('lbl_name').style.visibility = "visible";
//   }else{
//     c_name.style.border = "1px solid #E8EAED";
//     document.getElementById('lbl_name').style.visibility = "hidden";
//   }
//
//   if(c_email.value == ""){
//     c_email.style.border = "1px solid red";
//     document.getElementById('lbl_email').style.visibility = "visible";
//   }else{
//     c_email.style.border = "1px solid #E8EAED";
//     document.getElementById('lbl_email').style.visibility = "hidden";
//   }
//
//   if(c_body.value == ""){
//     c_body.style.border = "1px solid red";
//     document.getElementById('lbl_body').style.visibility = "visible";
//   }else{
//     c_body.style.border = "1px solid #E8EAED";
//     document.getElementById('lbl_body').style.visibility = "hidden";
//   }
//
//   if(c_name.value !== "" && c_email.value !== "" && c_body.value !== ""){
//     if(c_website.value !== ""){
//       var web = c_website.value;
//     }else{
//       var web = "NIL";
//     }
//       var method = "POST";
//       var url = "ajax_comment";
//       var param = "name="+c_name.value;
//         param+="&email="+c_email.value;
//         param+="&website="+web;
//         param+="&body="+c_body.value;
//         param+="&id="+show;
//       var cmt = new XMLHttpRequest();
//       cmt.onreadystatechange = function(){
//         if(cmt.readyState == 4 && cmt.status == 200){
//           var res = JSON.parse(cmt.responseText);
//           if(res.success){
//             window.location = "blog-post?id="+show;
//           }
//
//           if(res.failed){
//             // console.log(res.failed);
//             document.getElementById('lbl_body').innerHTML = res.failed;
//             document.getElementById('lbl_body').style.visibility = "visible";
//           }
//         }
//       }
//       cmt.open(method, url, true);
//       cmt.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//       cmt.send(param);
//
//   }
//
// }

// function getReply(comment_id, post_id){
//
//   var showReplyForm = document.getElementById('comment-reply');
//   var rep = new XMLHttpRequest();
//   rep.onreadystatechange = function(){
//     if(rep.readyState == 4 && rep.status == 200){
//       showReplyForm.innerHTML = rep.responseText;
//       var reply_btn = document.getElementById('reply');
//       reply_btn.setAttribute('data-id', comment_id);
//       reply_btn.setAttribute('data-post-id', post_id);
//       location.href = "#comment-reply";
//     }
//   }
//   rep.open("GET", "ajax_getreply", true);
//   rep.send();
// }

// function getReply(posturl, comment_id, post_id, user_id){
//   // alert(comment_id+""+post_id)
//   var showReplyForm = document.getElementById('respond');
//   var rep = new XMLHttpRequest();
//   var param = "posturl="+posturl;
//     param+="&cid="+comment_id;
//     param+="&pid="+post_id;
//     param+="&uid="+user_id;
//   rep.onreadystatechange = function(){
//     if(rep.readyState == 4 && rep.status == 200){
//       showReplyForm.innerHTML = rep.responseText;
//       // var reply_btn = document.getElementById('reply');
//       // reply_btn.setAttribute('data-post-url', posturl);
//       // reply_btn.setAttribute('data-id', comment_id);
//       // reply_btn.setAttribute('data-post-id', post_id);
//       // reply_btn.setAttribute('data-user', user_id);
//       location.href = "#respond";
//     }
//   }
//   rep.open("POST", "/ajax_getreply", true);
//   rep.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   rep.send(param);
// }

function getReply(posturl, comment_id, post_id, user_id){
  // alert(comment_id+""+post_id)
  var showReplyForm = document.getElementById('respond');
  var rep = new XMLHttpRequest();
  rep.onreadystatechange = function(){
    if(rep.readyState == 4 && rep.status == 200){
      showReplyForm.innerHTML = rep.responseText;
      var reply_btn = document.getElementById('reply');
      reply_btn.setAttribute('data-post-url', posturl);
      reply_btn.setAttribute('data-id', comment_id);
      reply_btn.setAttribute('data-post-id', post_id);
      reply_btn.setAttribute('data-user', user_id);
      location.href = "#respond";
    }
  }
  rep.open("GET", "/ajax_getreply", true);
  rep.send();
}

function submitReply(posturl){
  var res = document.getElementById('lbl_body');
  var btn = document.getElementById('reply');
  var post_url = btn.getAttribute('data-post-url');
  var post_id = btn.getAttribute('data-post-id');
  var comment_id = btn.getAttribute('data-id');
  var user_id = btn.getAttribute('data-user');
  var c_body = document.getElementById('c_body');

  if(c_body.value.trim() == ""){

    res.style.color = "red";
    res.style.visibility = "visible";

    }else{
      var method = "POST";
      var url = "/ajax_reply";
      var param = "body="+c_body.value;
        param+="&comment_id="+comment_id;
        param+="&post_id="+post_id;
        param+="&user="+user_id;
      var cmt = new XMLHttpRequest();
      cmt.onreadystatechange = function(){
        if(cmt.readyState == 4 && cmt.status == 200){
          var res = JSON.parse(cmt.responseText);
          if(res.success){
            window.location = post_url;
          }
          if(res.failed){
            console.log(res.failed);
            document.getElementById('lbl_body').innerHTML = res.failed;
            document.getElementById('lbl_body').style.visibility = "visible";
          }
        }
      }
      cmt.open(method, url, true);
      cmt.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      cmt.send(param);

  }

}
function submitNewsComment(show){

  var c_name = document.getElementById('c_name');
  var c_email = document.getElementById('c_email');
  var c_website = document.getElementById('c_website');
  var c_body = document.getElementById('c_body');

  if(c_name.value == ""){
    c_name.style.border = "1px solid red";
    document.getElementById('lbl_name').style.visibility = "visible";
  }else{
    c_name.style.border = "1px solid #E8EAED";
    document.getElementById('lbl_name').style.visibility = "hidden";
  }

  if(c_email.value == ""){
    c_email.style.border = "1px solid red";
    document.getElementById('lbl_email').style.visibility = "visible";
  }else{
    c_email.style.border = "1px solid #E8EAED";
    document.getElementById('lbl_email').style.visibility = "hidden";
  }

  if(c_body.value == ""){
    c_body.style.border = "1px solid red";
    document.getElementById('lbl_body').style.visibility = "visible";
  }else{
    c_body.style.border = "1px solid #E8EAED";
    document.getElementById('lbl_body').style.visibility = "hidden";
  }

  if(c_name.value !== "" && c_email.value !== "" && c_body.value !== ""){
    if(c_website.value !== ""){
      var web = c_website.value;
    }else{
      var web = "NIL";
    }
      var method = "POST";
      var url = "ajax_newscomment";
      var param = "name="+c_name.value;
        param+="&email="+c_email.value;
        param+="&website="+web;
        param+="&body="+c_body.value;
        param+="&id="+show;
      var cmt = new XMLHttpRequest();
      cmt.onreadystatechange = function(){
        if(cmt.readyState == 4 && cmt.status == 200){
          var res = JSON.parse(cmt.responseText);
          if(res.success){
            window.location = "news?id="+show;
          }

          if(res.failed){
            // console.log(res.failed);
            document.getElementById('lbl_body').innerHTML = res.failed;
            document.getElementById('lbl_body').style.visibility = "visible";
          }
        }
      }
      cmt.open(method, url, true);
      cmt.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      cmt.send(param);

  }

}

function getNewsReply(comment_id, post_id){

  var showReplyForm = document.getElementById('comment-reply');
  var rep = new XMLHttpRequest();
  rep.onreadystatechange = function(){
    if(rep.readyState == 4 && rep.status == 200){
      showReplyForm.innerHTML = rep.responseText;
      var reply_btn = document.getElementById('reply');
      reply_btn.setAttribute('data-id', comment_id);
      reply_btn.setAttribute('data-post-id', post_id);
      location.href = "#comment-reply";
    }
  }
  rep.open("GET", "ajax_getnewsreply", true);
  rep.send();
}

function submitNewsReply(){

  var btn = document.getElementById('reply');
  var post_id = btn.getAttribute('data-post-id');
  var comment_id = btn.getAttribute('data-id');
  var c_name = document.getElementById('c_name');
  var c_email = document.getElementById('c_email');
  var c_website = document.getElementById('c_website');
  var c_body = document.getElementById('c_body');

  if(c_name.value == ""){
    c_name.style.border = "1px solid red";
    document.getElementById('lbl_name').style.visibility = "visible";
  }else{
    c_name.style.border = "1px solid #E8EAED";
    document.getElementById('lbl_name').style.visibility = "hidden";
  }

  if(c_email.value == ""){
    c_email.style.border = "1px solid red";
    document.getElementById('lbl_email').style.visibility = "visible";
  }else{
    c_email.style.border = "1px solid #E8EAED";
    document.getElementById('lbl_email').style.visibility = "hidden";
  }

  if(c_body.value == ""){
    c_body.style.border = "1px solid red";
    document.getElementById('lbl_body').style.visibility = "visible";
  }else{
    c_body.style.border = "1px solid #E8EAED";
    document.getElementById('lbl_body').style.visibility = "hidden";
  }

  if(c_name.value !== "" && c_email.value !== "" && c_body.value !== ""){
    if(c_website.value !== ""){
      var web = c_website.value;
    }else{
      var web = "NIL";
    }
      var method = "POST";
      var url = "ajax_newsreply";
      var param = "name="+c_name.value;
        param+="&email="+c_email.value;
        param+="&website="+web;
        param+="&body="+c_body.value;
        param+="&comment_id="+comment_id;
        param+="&post_id="+post_id;
      var cmt = new XMLHttpRequest();
      cmt.onreadystatechange = function(){
        if(cmt.readyState == 4 && cmt.status == 200){
          var res = JSON.parse(cmt.responseText);
          if(res.success){
            window.location = "news?id="+post_id;
          }
          if(res.failed){
            console.log(res.failed);
            document.getElementById('lbl_body').innerHTML = res.failed;
            document.getElementById('lbl_body').style.visibility = "visible";
          }
        }
      }
      cmt.open(method, url, true);
      cmt.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      cmt.send(param);

  }

}

function popUpShow(){
  var msg = document.getElementById('msg');
  var dataMsg = msg.getAttribute('data-msg');
  if(dataMsg){
    swal.fire({
      icon: 'success',
      title: 'Successful!',
      text: dataMsg

    })
  }
}

//USER REGISTER AND LOGIN
function registerUser(rd){
  // alert("I worked")
  var signupForm = document.getElementById('usersignup-form');
  var response = document.getElementById('signup-res');

  var user_name = document.getElementById('user-name');
  var user_email = document.getElementById('user-email');
  var user_pnum = document.getElementById('pnumber');
  var user_username = document.getElementById('username');
  var pword = document.getElementById('pword');
  var cpword = document.getElementById('cpword');

  if(user_name.value.trim() == "" || user_email.value.trim() == "" || user_pnum.value.trim() == "" || user_username.value.trim() == "" || pword.value.trim() == "" || cpword.value.trim() == ""){
    signupForm.reportValidity();
    response.innerHTML = "All field required!!!";
    response.style.color = "red";
    response.style.visibility = "visible";
  }else{
    if(pword.value !== cpword.value){
      response.innerHTML = "Password Mismatch!!!";
      response.style.color = "red";
      response.style.visibility = "visible";
    }else{
      var method = "POST";
      var url = "registeruser";
      var param = "name="+user_name.value;
        param+="&email="+user_email.value;
        param+="&pnum="+user_pnum.value;
        param+="&username="+user_username.value;
        param+="&pword="+pword.value;

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
          var res = JSON.parse(xhr.responseText);
          // console.log(res);
          if(res.success){
            if(rd){
              window.location = "/signin?rd="+rd;
            }else{
              window.location = "/signin";
            }
          }
          if(res.failed){
            // console.log(res.failed);
            response.innerHTML = res.failed;
            response.style.color = "red";
            response.style.visibility = "visible";
          }
        }
      }
      xhr.open(method, url, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send(param);
      }

    }

}

function loginUser(rd){
   // var rdd = rd;
  // var login_form = document.getElementById('login-form');
    var response = document.getElementById('login-res');
    var user_login = document.getElementById('user-details');
    var user_password = document.getElementById('user-password');

    // alert(user_login.value+" with this password "+user_password.value);
    if(user_login.value.trim() == "" || user_password.value.trim() == ""){
      // login_form.reportValidity();
      response.innerHTML = "All field required!!!";
      response.style.color = "red";
      response.style.visibility = "visible";
    }else{
      // alert("I worked");
      var method = "POST";
      var url = "loginuser";
      var param = "username="+user_login.value;
          param+="&pword="+user_password.value;
      if(rd){
        param+="&rd="+rd;
      }
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
          var res = JSON.parse(xhr.responseText);
          if(res.success){
            if(res.rdt != null){
              window.location = res.rdt;
            }else{
              window.location = "/";
            }

          }
          if(res.failed){
            // console.log(res.failed);
            response.innerHTML = res.failed;
            response.style.color = "red";
            response.style.visibility = "visible";
          }
        }
      }
      xhr.open(method, url, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send(param);

    }

}

function loginUser1(){
  // var login_form = document.getElementById('login-form');
  var response = document.getElementById('login-res1');
  var user_login = document.getElementById('user-details1');
  var user_password = document.getElementById('user-password1');

  // alert(user_login.value+" with this password "+user_password.value);
  if(user_login.value.trim() == "" || user_password.value.trim() == ""){
    // login_form.reportValidity();
    response.innerHTML = "All field required!!!";
    response.style.color = "red";
    response.style.visibility = "visible";
  }else{
    // alert("I worked");
    var method = "POST";
    var url = "loginuser";
    var param = "username="+user_login.value;
        param+="&pword="+user_password.value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
        if(res.success){
          window.location = "home";
        }
        if(res.failed){
          // console.log(res.failed);
          response.innerHTML = res.failed;
          response.style.color = "red";
          response.style.visibility = "visible";
        }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(param);

  }

}

function closeMsg(){
  var close_it = document.getElementById('closeit');
  close_it.style.opacity = 0;

}

//EDIT USER DETAILS
function editUserName(id){
  // var name_form = document.getElementById("name-form");
  var form_res = document.getElementById("name-res");
  var name = document.getElementById("user-name");
  if(name.value.trim() == ""){
    // name_form.reportValidity();
    form_res.innerHTML = "You haven't entered your name";
    form_res.style.color = "red";
    form_res.style.visibility = "visible";
  }else{
    var method = "POST";
    var url = "edituser";
    var param = "name="+name.value;
      param+="&id="+id;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
        if(res.success){
          window.location = "editprofile";
        }
        if(res.failed){
          form_res.innerHTML = res.failed;
          form_res.style.color = "red";
          form_res.style.visibility = "visible";
        }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }

}

function editUserEmail(id){
  // var email_form = document.getElementById("email-form");
  var form_res = document.getElementById("email-res");
  var email = document.getElementById("user-email");

  if(email.value.trim() == ""){
    form_res.innerHTML = "You haven't entered your email";
    form_res.style.color = "red";
    form_res.style.visibility = "visible";
    // email_form.reportValidity();
  }else{
    var method = "POST";
    var url = "edituser";
    var param = "email="+email.value;
      param+="&id="+id;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
        if(res.success){
          window.location = "editprofile";
        }
        if(res.failed){
          form_res.innerHTML = res.failed;
          form_res.style.color = "red";
          form_res.style.visibility = "visible";
        }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(param);

    //Validating email format(Regular Expression) with javascript
    // var regx = /^([a-zA-Z0-9\.-]+)@([a-zA-Z0-9]+).([a-z]{2,8})(.[a-z]{2,8})?$/;
    // if(regx.test(email.value)){
    //   var method = "POST";
    //   var url = "edituser";
    //   var param = "email="+email.value;
    //     param+="&id="+id;
    //   var xhr = new XMLHttpRequest();
    //   xhr.onreadystatechange = function(){
    //     if(xhr.readyState == 4 && xhr.status == 200){
    //       var res = JSON.parse(xhr.responseText);
    //       if(res.success){
    //         window.location = "editprofile";
    //       }
    //       if(res.failed){
    //         form_res.innerHTML = res.failed;
    //         form_res.style.color = "red";
    //         form_res.style.visibility = "visible";
    //       }
    //     }
    //   }
    //   xhr.open(method, url, true);
    //   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //   xhr.send(param);
    // }else{
    //   form_res.innerHTML = "Enter a valid email";
    //   form_res.style.color = "red";
    //   form_res.style.visibility = "visible";
    // }
  }
}

function editUserNum(id){
  // var name_form = document.getElementById("name-form");
  var form_res = document.getElementById("pnum-res");
  var pnum = document.getElementById("pnumber");
  if(pnum.value.trim() == ""){
    // name_form.reportValidity();
    form_res.innerHTML = "You haven't entered your phone number";
    form_res.style.color = "red";
    form_res.style.visibility = "visible";
  }else{
    var method = "POST";
    var url = "edituser";
    var param = "pnum="+pnum.value;
      param+="&id="+id;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
        if(res.success){
          window.location = "editprofile";
        }
        if(res.failed){
          form_res.innerHTML = res.failed;
          form_res.style.color = "red";
          form_res.style.visibility = "visible";
        }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }

}

function editUserUsername(id){
  // var name_form = document.getElementById("name-form");
  var form_res = document.getElementById("uname-res");
  var username = document.getElementById("username");
  if(username.value.trim() == ""){
    // name_form.reportValidity();
    form_res.innerHTML = "You haven't entered your username";
    form_res.style.color = "red";
    form_res.style.visibility = "visible";
  }else{
    var method = "POST";
    var url = "edituser";
    var param = "username="+username.value;
      param+="&id="+id;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
        if(res.success){
          window.location = "editprofile";
        }
        if(res.failed){
          form_res.innerHTML = res.failed;
          form_res.style.color = "red";
          form_res.style.visibility = "visible";
        }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }

}
//Change Password
function changeUserPword(id){
  var form_res = document.getElementById('pword-res');
  var oldpword = document.getElementById('pword');
  var newpword = document.getElementById('npword');
  var cpword = document.getElementById('cpword');

  if(oldpword.value.trim() == "" || newpword.value.trim() == "" || cpword.value.trim() == ""){
    form_res.innerHTML = "All field required to change password!!!";
    form_res.style.color = "red";
    form_res.style.visibility = "visible";

  }else{
    var method = "POST";
    var url = "edituser";
    var param = "oldpword="+oldpword.value;
      param+="&newpword="+newpword.value;
      param+="&cpword="+cpword.value;
      param+="&id="+id;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
        if(res.success){
          window.location = "editprofile";
        }
        if(res.failed){
          form_res.innerHTML = res.failed;
          form_res.style.color = "red";
          form_res.style.visibility = "visible";
        }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }
}
