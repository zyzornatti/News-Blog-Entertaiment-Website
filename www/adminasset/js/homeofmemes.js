function randomNum(min, max){
  return Math.floor(Math.random() * (max - min) ) + min;
}

function generateAdminCode(){
  var show_code = document.getElementById("code-response");
  var show_text = document.getElementById("code");
  var genCode = randomNum(100000, 999999);

  var method = "POST";
  var url = "admin_aut";
  var param = "cd="+genCode;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
      var res = JSON.parse(xhr.responseText);

      if(res.success){
        show_code.innerHTML = "<strong><h1>Authentication Code: "+genCode+"</strong></h1>";
        show_code.style.color = "green";
        show_text.style.visibility = "visible";
        show_code.style.visibility = "visible";
      }
      if(res.failed){
        show_code.innerHTML = res.failed;
        show_code.style.color = "red";
        show_code.style.visibility = "show";
      }
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(param);
}

// function verifyAdminCode(){
//   var aut_code = document.getElementById("verify");
//   var response = document.getElementById("verify-response");
//
// if(aut_code.value.trim() == ""){
//   show_code.innerHTML = "You have not typed in an authentication code";
//   show_code.style.color = "red";
//   show_code.style.visibility = "show";
// }else{
//   var method = "POST";
//   var url = "admin_verify";
//   var param = "aut="+aut_code;
//   var xhr = new XMLHttpRequest();
//   xhr.onreadystatechange = function(){
//     if(xhr.readyState == 4 && xhr.status == 200){
//       var res = JSON.parse(xhr.responseText);
//
//       if(res.success){
//         // show_code.innerHTML = "<strong><h1>Authentication Code: "+genCode+"</strong></h1>";
//         // show_code.style.color = "green";
//         // show_text.style.visibility = "visible";
//         // show_code.style.visibility = "visible";
//       }
//       if(res.failed){
//         show_code.innerHTML = res.failed;
//         show_code.style.color = "red";
//         show_code.style.visibility = "show";
//       }
//     }
//   }
//   xhr.open(method, url, true);
//   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   xhr.send(param);
// }
//
// }

function adminForgotPassword(){
  var adm_email = document.getElementById('email');
  // var auc = document.getElementById('auc');
  var em_res = document.getElementById('reset-response');

  if(adm_email.value.trim() == ""){
    em_res.innerHTML = "You have not entered your email";
    em_res.style.color = "red";
    em_res.style.visibility = "visible";
  }else{
    var method = "POST";
    var url = "adminreset";
    var param = "email="+adm_email;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
        if(res.success){
          // window.location = res.success;
          em_res.innerHTML = res.success;
          em_res.style.color = "green";
          em_res.style.visibility = "visible";
        }
        if(res.failed){
          console.log(res.failed);
          em_res.innerHTML = res.failed;
          em_res.style.color = "red";
          em_res.style.visibility = "visible";

        }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }
}

function adminSignUp(){
  var adminForm = document.getElementById('signupform');
  var adminName = document.getElementById('admname');
  var adminEmail = document.getElementById('admemail');
  var adminPnum = document.getElementById('admpnum');
  var adminUser = document.getElementById('admuser');
  var adminPword = document.getElementById('admpassword');
  var adminCpword = document.getElementById('admcpassword');
  var aut_code = document.getElementById('auth');
  var signupRes = document.getElementById('signup-response');

// alert(aut_code.value);

  if(adminName.value.trim() == "" || adminEmail.value.trim() == "" || adminPnum.value.trim() == "" || adminUser.value.trim() == "" || adminPword.value.trim() == "" || adminName.value.trim() == "" || aut_code.value.trim() == ""){
    adminForm.reportValidity();
    signupRes.innerHTML = "All field Required!!!";
    signupRes.style.color = "red";
    signupRes.style.visibility = "visible";
  }else{
    var method = "POST";
    var url = "admsignup";
    var param = "name="+adminName.value;
        param+="&email="+adminEmail.value;
        param+="&pnum="+adminPnum.value;
        param+="&username="+adminUser.value;
        param+="&pword="+adminPword.value;
        param+="&cpword="+adminCpword.value;
        param+="&aut_code="+aut_code.value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
        // console.log(res);
        if(res.success){
          window.location = "adminlogin";
          // alert(res.success);
        }
        if(res.failed){
          console.log(res.failed);
          // signupRes.innerHTML = "something went wrong!!! Try Again";
          signupRes.innerHTML = res.failed;
          signupRes.style.color = "red";
          signupRes.style.visibility = "visible";
        }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }
}

function adminLogin(){
   var form = document.getElementById('loginform');
   var email = document.getElementById('email');
   var password = document.getElementById('password');
   var loginRes = document.getElementById('login-response');

    if(email.value.trim() == "" || password.value.trim() == ""){
      form.reportValidity();
      loginRes.innerHTML = "All fields required";
      loginRes.style.color = "red";
      loginRes.style.visibility = "visible";
      }else{
    var method = 'POST';
    var url = "login";
    var param = "email="+email.value;
        param +="&password="+password.value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
        // console.log(res);
        if(res.success){
          window.location = "adminhome";
        }
        if(res.failed){
          // console.log(res.failed);
          loginRes.innerHTML = res.failed;
          loginRes.style.color = "red";
          loginRes.style.visibility = "visible";
        }
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send(param);
  }
}

function changePass(admin_id){
  var oldPass = document.getElementById('oldpword');
  var newPass = document.getElementById('newpword');
  var newCpass = document.getElementById('newcpword');
  var cRes = document.getElementById('changepassword-response');

  if(oldPass.value.trim() == "" || newPass.value.trim() == "" || newCpass.value.trim() == ""){
    cRes.innerHTML = "All field Required!!!";
    cRes.style.color = "red";
    cRes.style.visibility = "visible";
  }else{
    var method = "POST";
    var url = "pass";
    var param ="oldpword="+oldPass.value;
        param+="&newpword="+newPass.value;
        param+="&newcpword="+newCpass.value;
        param+="&admin_id="+admin_id;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
        // console.log(res);

        if(res.success){
          window.location = "adminhome";
        }
        if(res.failed){
          // console.log(res.failed);
          cRes.innerHTML = res.failed;
          cRes.style.color = "red";
          cRes.style.visibility = "visible";
        }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }
}

function hideImageBoard(){
  var showImage = document.getElementById('viewImage');
  showImage.style.display = "none";
}

function loadImage(event){
  var showImage = document.getElementById('viewImage');
  showImage.style.display = "block";
  showImage.src = URL.createObjectURL(event.target.files[0]);
}

// function loadImages(event){
//   var showBoard = document.getElementById('showboard');
//   // var showboard = document.getElementById('showboard');
//   var meme_img = document.getElementById('image');
//   var total_img = meme_img.files.length
//   // var showImage = document.getElementById('viewImage');
//   // showImage.style.display = "block";
//   // alert(showImage.src = URL.createObjectURL(event.target.files[0])+"<br>");
//   for (var i = 0; i < total_img; i++) {
//     // showBoard.innerHTML = '<img class="col-sm-3" src="" id="viewImage" width="200px" height="200px"/>';
//     showBoard.innerHTML = '<img class="col-sm-3" id="viewImage" width="200px" height="200px"/>';
//     var showImages = document.getElementById('viewImage');
//     showImages.style.display = "block";
//     showImages.src = URL.createObjectURL(event.target.files[0]);
//   }
//
// }

function addBlog(admin){
  var blogtitle = document.getElementById('blogtitle');
  var section = document.getElementById('section');
  var category = document.getElementById('category');
  // var body = document.getElementById('body');
  var body = tinyMCE.get('body');
  var images = document.getElementById('image');
  var blogResponse = document.getElementById('addblog-response');

  if(blogtitle.value.trim() == "" || section.value == "" || category.value == "" || body.getContent() == "" || !images.files[0]){
    blogResponse.innerHTML = "All Field Required!!!";
    blogResponse.style.color = "red";
    blogResponse.style.visibility = "visible";

  }else{

    var method = "POST";
    var url = "blog";
    var formData = new FormData();
    formData.append("title", blogtitle.value);
    formData.append("admin_id", admin);
    formData.append("section", section.value);
    formData.append("category", category.value);
    formData.append("body", body.getContent());
    formData.append("image", images.files[0]);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
        console.log(res);
        if(res.success){
          window.location = "viewpost";
        }
        if(res.failed){
            console.log(res.failed);
            blogResponse.innerHTML = res.failed;
            blogResponse.style.color = "red";
            blogResponse.style.visibility = "visible";
        }
      }
    }
    xhr.open(method, url, true);
    xhr.send(formData);
  }
}

function addMusic(admin){
  var musictitle = document.getElementById('musictitle');
  var category = document.getElementById('musiccategory');
  var body = tinyMCE.get('body');
  var uploadlink = document.getElementById('musiclink');
  var images = document.getElementById('image');
  var addmusicResponse = document.getElementById('addmusic-response');
  var myform = document.getElementById('myform');

  if(musictitle.value.trim() == "" || category.value == "" || body.getContent() == "" || uploadlink.value.trim() == "" || !images.files[0]){
    myform.reportValidity();
    addmusicResponse.innerHTML = "All Field Required!!!";
    addmusicResponse.style.color = "red";
    // addmusicResponse.style.visibility = "visible";

  }else{

    var method = "POST";
    var url = "musicadd";
    var formData = new FormData();
    formData.append("musictitle", musictitle.value);
    formData.append("admin_id", admin);
    formData.append("category", category.value);
    formData.append("body", body.getContent());
    formData.append("uploadlink", uploadlink.value);
    formData.append("image", images.files[0]);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
        console.log(res);
        if(res.success){
          window.location = "musics";
        }
        if(res.failed){
            // console.log(res.failed);
            addmusicResponse.innerHTML = res.failed;
            addmusicResponse.style.color = "red";
            addmusicResponse.style.visibility = "visible";
        }
      }
    }
    xhr.open(method, url, true);
    xhr.send(formData);
  }
  // alert("i worked");
}

function hideLink(){
  var linkform = document.getElementById("musiclink");
  var linklabel = document.getElementById("ml");
  linklabel.style.visibility = "hidden";
  linkform.style.visibility = "hidden";
  linkform.value = "ALBUM";
}

function showLink(){
  var linkform = document.getElementById("musiclink");
  var linklabel = document.getElementById("ml");
  linklabel.style.visibility = "visible";
  linkform.style.visibility = "visible";
}

function editBlog(){
  var blogtitle = document.getElementById('blogtitle');
  var category = document.getElementById('category');
  var section = document.getElementById('section');
  // var body = document.getElementById('body');
  var body = tinyMCE.get('body');
  // var images = document.getElementById('image');
  var dataId = document.getElementById('p');
  var editResponse = document.getElementById('editblog-response');

  if(blogtitle.value.trim() == "" || section.value == "" || category.value == "" || body.getContent() == ""){
    editResponse.innerHTML = "All Field Required!!!";
    editResponse.style.color = "red";
    editResponse.style.visibility = "visible";

  }else{
    var blogId = dataId.getAttribute('data-id');
    var method = "POST";
    var url = "editblog";
    var formData = new FormData();
    formData.append("title", blogtitle.value);
    formData.append("section", section.value);
    formData.append("category", category.value);
    formData.append("body", body.getContent());
    // formData.append("image", image.files[0]);
    formData.append("id", blogId);

    var blog = new XMLHttpRequest();
    blog.onreadystatechange = function(){
      if(blog.readyState == 4 && blog.status == 200){
        var res = JSON.parse(blog.responseText);
        // console.log(res);
        if(res.success){
          window.location = "viewpost";
        }
        if(res.failed){
          console.log(res.failed);
          editResponse.innerHTML = res.failed;
          editResponse.style.color = "red";
          editResponse.style.visibility = "visible";
        }
      }
    }
    blog.open(method, url, true);
    // blog.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    blog.send(formData);
  }
// alert("i worked");
}

function editMusic(){
  var musictitle = document.getElementById('musictitle');
  var category = document.getElementById('category');
  var body = tinyMCE.get('body');
  var uploadlink = document.getElementById('musiclink');
  var dataId = document.getElementById('p');
  var editResponse = document.getElementById('editmusic-response');

  if(musictitle.value.trim() == "" || category.value == "" || body.getContent() == "" || uploadlink.value.trim() == ""){
    editResponse.innerHTML = "All Field Required!!!";
    editResponse.style.color = "red";
    editResponse.style.visibility = "visible";

  }else{
    var blogId = dataId.getAttribute('data-id');
    var method = "POST";
    var url = "emusic";
    var formData = new FormData();
    formData.append("musictitle", musictitle.value);
    formData.append("category", category.value);
    formData.append("uploadlink", uploadlink.value);
    formData.append("body", body.getContent());
    // formData.append("image", image.files[0]);
    formData.append("id", blogId);

    var blog = new XMLHttpRequest();
    blog.onreadystatechange = function(){
      if(blog.readyState == 4 && blog.status == 200){
        var res = JSON.parse(blog.responseText);
        // console.log(res);
        if(res.success){
          window.location = "musics";
        }
        if(res.failed){
          console.log(res.failed);
          editResponse.innerHTML = res.failed;
          editResponse.style.color = "red";
          editResponse.style.visibility = "visible";
        }
      }
    }
    blog.open(method, url, true);
    // blog.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    blog.send(formData);
  }
// alert("i worked");
}

function addCategory(){
  var cat = document.getElementById('category');
  var sec = document.getElementById('selector1');
  var catRes = document.getElementById('category-response');

  if(cat.value.trim() == "" || sec.value == ""){
    catRes.innerHTML = "All Fields Required!!!";
    catRes.style.color = "red";
    catRes.style.visibility = "visible";
  }else{
    var method = "POST";
    var url = "cat";
    var param = "category="+cat.value;
      param+="&section="+sec.value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
          if(res.success){
            window.location = "viewcategory";
          }
          if(res.failed){
            // console.log(res.failed);
            catRes.innerHTML = res.failed;
            catRes.style.color = "red";
            catRes.style.visibility = "visible";

          }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }
}

function addMeme(admin){
  var meme_res = document.getElementById('addmeme-response');
  var meme_cat = document.getElementById('selector1');
  var meme_img = document.getElementById('image');
  var total_img = meme_img.files.length;

  if(meme_cat.value.trim() == "" || meme_img.files[0] == ""){
    meme_res.innerHTML = "All field Required";
    meme_res.style.color = "red";
    meme_res.style.visibility = "visible";
  }else{
    var method = "POST";
    var url = "admeme";
    var formData = new FormData();
      formData.append("admin_id", admin);
      formData.append("meme_cat", meme_cat.value);
      for (var i = 0; i < total_img; i++) {
        formData.append("meme_img[]", meme_img.files[i]);
      }
      // formData.append("meme_img", meme_img.files[0]);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res= JSON.parse(xhr.responseText);
        if(res.success){
          window.location = "viewmemes";
        }
        if(res.failed){
          console.log(res.failed);
          meme_res.innerHTML = "All field Required";
          meme_res.style.color = "red";
          meme_res.style.visibility = "visible";
        }
      }
    }
    xhr.open(method, url, true);
    xhr.send(formData);
  }
}

function addMemeCategory(){

  var cat = document.getElementById('category');
  var sec = document.getElementById('selector1');
  var catRes = document.getElementById('category-response');

  if(cat.value.trim() == ""){
    catRes.innerHTML = "All Fields Required!!!";
    catRes.style.color = "red";
    catRes.style.visibility = "visible";
  }else{
    var method = "POST";
    var url = "memecat";
    var param = "category="+cat.value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
          if(res.success){
            window.location = "memecategory";
          }
          if(res.failed){
            // console.log(res.failed);
            catRes.innerHTML = res.failed;
            catRes.style.color = "red";
            catRes.style.visibility = "visible";

          }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }
}

function addMusicCategory(){

  var cat = document.getElementById('category');
  var sec = document.getElementById('selector1');
  var catRes = document.getElementById('musiccat-response');
  if(cat.value.trim() == ""){
    catRes.innerHTML = "All Fields Required!!!";
    catRes.style.color = "red";
    catRes.style.visibility = "visible";
  }else{
    var method = "POST";
    var url = "musiccat";
    var param = "category="+cat.value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
          if(res.success){
            window.location = "musiccategory";
          }
          if(res.failed){
            // console.log(res.failed);
            catRes.innerHTML = res.failed;
            catRes.style.color = "red";
            catRes.style.visibility = "visible";

          }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }
}

function editMemeCategory(catid){

  var cat = document.getElementById('category');
  var sec = document.getElementById('selector1');
  var catRes = document.getElementById('category-response');

  if(cat.value.trim() == ""){
    catRes.innerHTML = "All Fields Required!!!";
    catRes.style.color = "red";
    catRes.style.visibility = "visible";
  }else{
    var method = "POST";
    var url = "editmemec";
    var param = "category="+cat.value;
      param+="&cat_id="+catid;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
          if(res.success){
            window.location = "memecategory";
          }
          if(res.failed){
            // console.log(res.failed);
            catRes.innerHTML = res.failed;
            catRes.style.color = "red";
            catRes.style.visibility = "visible";

          }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }
}

function editMusicCategory(catid){

  var cat = document.getElementById('category');
  var sec = document.getElementById('selector1');
  var catRes = document.getElementById('musiccat-response');

  if(cat.value.trim() == ""){
    catRes.innerHTML = "All Fields Required!!!";
    catRes.style.color = "red";
    catRes.style.visibility = "visible";
  }else{
    var method = "POST";
    var url = "emusiccat";
    var param = "category="+cat.value;
      param+="&cat_id="+catid;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
          if(res.success){
            window.location = "musiccategory";
          }
          if(res.failed){
            // console.log(res.failed);
            catRes.innerHTML = res.failed;
            catRes.style.color = "red";
            catRes.style.visibility = "visible";

          }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }
}

function editCategory(){
  var cat = document.getElementById('category');
  var dataId = document.getElementById('p');
  var catResponse = document.getElementById('category-response');

  if(cat.value.trim() == ""){
    catResponse.innerHTML = "You have not entered a category";
    catResponse.style.color = "red";
    catResponse.style.visibility = "visible";
  }else{
    var catId = dataId.getAttribute('data-id');
    var secId = dataId.getAttribute('data-section');
    var method = "POST";
    var url = "editcategory";
    var param = "category="+cat.value;
        param+="&id="+catId;
        param+="&section="+secId;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
          if(res.success){
            window.location = "viewcategory";
          }
          if(res.failed){
            catResponse.innerHTML = res.failed;
            catResponse.style.color = "red";
            catResponse.style.visibility = "visible";

          }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }
}

function addContact(){
  // var contact_body = document.getElementById('ctbody');
  var contact_body = tinyMCE.get('ctbody');
  var images = document.getElementById('image');
  var contactRes = document.getElementById('about-response');

  if(contact_body.getContent() == "" || !images.files[0]){
    contactRes.innerHTML = "All Field Required!!!";
    contactRes.style.color = "red";
    contactRes.style.visibility = "visible";

  }else{
    // alert(contact_body.value);
    // console.log(contact_body.value);
    // console.log(image.files[0]);
    var method = "POST";
    var url = "addcont";
    var formData = new FormData();
    // formData.append("ctbody", contact_body.value);
    formData.append("ctbody", contact_body.getContent());
    formData.append("image", images.files[0]);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var resCont = JSON.parse(xhr.responseText);
        // console.log(resCont);
        if(resCont.success){
          window.location = "viewcontact";
        }
        if(resCont.failed){
          console.log(resCont.failed);
          contactRes.innerHTML = resCont.failed;
          contactRes.style.color = "red";
          contactRes.style.visibility = "visible";
        }
      }
    }
    xhr.open(method, url, true);
    xhr.send(formData);
  }
}

function editContact(){
  // var contact_body = document.getElementById('ctbody');
  var contact_body = tinyMCE.get('ctbody');
  // var images = document.getElementById('image');
  var dataId = document.getElementById('p');
  var contactRes = document.getElementById('contact-response');

  if(contact_body.getContent() == ""){
    contactRes.innerHTML = "You have Not Typed In Anything!!!";
    contactRes.style.color = "red";
    contactRes.style.visibility = "visible";

  }else{
    var contId = dataId.getAttribute('data-id');
    var method = "POST";
    var url = "editcontact";
    var formData = new FormData();
    // formData.append("ctbody", contact_body.value);
    formData.append("ctbody", contact_body.getContent());
    // formData.append("image", image.files[0]);
    formData.append("id", contId);

    var blog = new XMLHttpRequest();
    blog.onreadystatechange = function(){
      if(blog.readyState == 4 && blog.status == 200){
        var res = JSON.parse(blog.responseText);
        // console.log(res);
        if(res.success){
          window.location = "viewcontact";
        }
        if(res.failed){
          contactRes.innerHTML = res.failed;
          contactRes.style.color = "red";
          contactRes.style.visibility = "visible";
        }
      }
    }
    blog.open(method, url, true);
    blog.send(formData);
  }
}

function addAbout(){
  // var about_body = document.getElementById('abtbody');
  var about_body = tinyMCE.get('abtbody');
  var images = document.getElementById('image');
  var aboutRes = document.getElementById('about-response');

  if(about_body.getContent() == "" || !images.files[0]){
    aboutRes.innerHTML = "All Field Required!!!";
    aboutRes.style.color = "red";
    aboutRes.style.visibility = "visible";

  }else{

    var method = "POST";
    var url = "addabt";
    var formData = new FormData();
    // formData.append("abtbody", about_body.value);
    formData.append("abtbody", about_body.getContent());
    formData.append("image", image.files[0]);

    var blog = new XMLHttpRequest();
    blog.onreadystatechange = function(){
      if(blog.readyState == 4 && blog.status == 200){
        var res = JSON.parse(blog.responseText);
        // console.log(res);
        if(res.success){
          window.location = "viewabout";
        }
        if(res.failed){
          aboutRes.innerHTML = res.failed;
          aboutRes.style.color = "red";
          aboutRes.style.visibility = "visible";
        }
      }
    }
    blog.open(method, url, true);
    blog.send(formData);
  }
}

function editAbout(){
  // var about_body = document.getElementById('abtbody');
  var about_body = tinyMCE.get('abtbody');
  // var images = document.getElementById('image');
  var dataId = document.getElementById('p');
  var aboutResponse = document.getElementById('about-response');

  if(about_body.getContent() == ""){
    aboutResponse.innerHTML = "You have Not Typed In Anything!!!";
    aboutResponse.style.color = "red";
    aboutResponse.style.visibility = "visible";

  }else{
    var abtId = dataId.getAttribute('data-id');
    var method = "POST";
    var url = "editabt";
    var formData = new FormData();
    // formData.append("abtbody", about_body.value);
    formData.append("abtbody", about_body.getContent());
    // formData.append("image", image.files[0]);
    formData.append("id", abtId);

    var blog = new XMLHttpRequest();
    blog.onreadystatechange = function(){
      if(blog.readyState == 4 && blog.status == 200){
        var res = JSON.parse(blog.responseText);
        // console.log(res);
        if(res.success){
          window.location = "viewabout";
          // window.location = "viewabout?msg=edited";
        }
        if(res.failed){
          aboutResponse.innerHTML = res.failed;
          aboutResponse.style.color = "red";
          aboutResponse.style.visibility = "visible";
        }
      }
    }
    blog.open(method, url, true);
    blog.send(formData);
  }
}

function editProfile(id){
  var prfName = document.getElementById('pname');
  var prfEmail = document.getElementById('pemail');
  var prfPnum = document.getElementById('ppnum');
  var prfUsername = document.getElementById('pusername');
  var prfoBtn = document.getElementById('prfbtn');
  var response = document.getElementById('profile-response');
  // var prfId = prfName.getAttribute('data-id');

  if(prfName.value.trim() == "" || prfEmail.value.trim() == "" || prfPnum.value.trim() == "" || prfUsername.value.trim() == ""){
    response.innerHTML = "All field Required!!!";
      response.style.color = "red";
      response.style.visibility = "visible";
  }else{
      var method = "POST";
      var url = "prf";
      var param ="admin_id="+id;
        param+="&name="+prfName.value;
        param+="&email="+prfEmail.value;
        param+="&pnum="+prfPnum.value;
        param+="&username="+prfUsername.value;

      var xhr = new XMLHttpRequest();;
      xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
          var res = JSON.parse(xhr.responseText);

          if(res.success){
            window.location = "adminhome";
          }
          if(res.failed){
            response.innerHTML = res.failed;
            response.style.color = "red";
            response.visibility = "visible";
          }
        }
      }
      xhr.open(method, url, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send(param);
  }
}

// function gethandles(){
//   var handlesForm = document.getElementById('geth');
//   var rep = new XMLHttpRequest();
//   rep.onreadystatechange = function(){
//     if(rep.readyState == 4 && rep.status == 200){
//       handlesForm.innerHTML = rep.responseText;
//     }
//   }
//   rep.open("GET", "/gethandle", true);
//   rep.send();
// }

function editSmh(id){
  // alert(id);
  var fbu = document.getElementById('fbu');
  var twu = document.getElementById('twu');
  var igu = document.getElementById('igu');
  // var ehtn = document.getElementById('ehbtn');
  var ehres = document.getElementById('handles-response');

  if(fbu.value.trim() == "" || twu.value.trim() == "" || igu.value.trim() == ""){
      ehres.innerHTML = "All field Required!!!";
      ehres.style.color = "red";
      ehres.style.visibility = "visible";
  }else{
      var method = "POST";
      var url = "edithandle";
      var param ="id="+id;
        param+="&fbu="+fbu.value;
        param+="&twu="+twu.value;
        param+="&igu="+igu.value;

      var xhr = new XMLHttpRequest();;
      xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
          var res = JSON.parse(xhr.responseText);

          if(res.success){
            window.location = "adminhome";
          }
          if(res.failed){
            ehres.innerHTML = res.failed;
            ehres.style.color = "red";
            ehres.visibility = "visible";
          }
        }
      }
      xhr.open(method, url, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send(param);
  }
}

// function about(){
//   var loadAb = document.getElementById('viewabout');
//   var delId = document.getElementById('delbtn');
//   var abt = new XMLHttpRequest();
//   abt.onreadystatechange = function(){
//     loadAb.innerHTML = abt.responseText;
//   }
//   abt.open("GET", "va", true);
//   abt.send()
// }
// function about(){
//   var del = document.getElementById('delbtn');
//   var delId = del.getAttribute('data-id');
//   var del.delEvent = del.getAttribute('onclick');
//    del.delEvent();
//   loadAboutRecord(delId);
// }

function deleteRecord(postId, link, admin){
  if(link == 1){
    var urllink = "blog="; //blog
    var text = "This Post Will Be Deleted!";
  }
  if(link == 2){
    var urllink = "cat="; //category
    var text = "This Category Will Be Deleted!";
  }
  // if(link == 3){
  //   var urllink = "usr="; //manageusers
  //   var text = "This User Will Be Deleted Permanently!";
  // }
  // if(link == 4){
  //   var urllink = "amdid="; //manageadmin
  //   var text = "This Admin Will Be Deleted Permanently!";
  // }
  if(link == 5){
    var urllink = "ct="; //contact
    var text = "This Post Will Be Deleted Permanently!";
  }
  if(link == 6){
    var urllink = "abt="; //about
    var text = "This Post Will Be Deleted Permanently!";
  }
  if(link == 7){
    var urllink = "vncat="; //News category
    var text = "This News Catgeory Will Be Deleted Permanently!";
  }
  if(link == 8){
    var urllink = "news="; //News
    var text = "This News Post Will Be Deleted Permanently!";
  }
  if(link == 9){
    var urllink = "sec="; //Section
    var text = "This Web Section Will Be Deleted Permanently!";
  }
  if(link == 15){
    var urllink = "music="; //Music
    var text = "This Music Will Be Deleted Permanently!";
  }
swal.fire({
  title: 'Are you sure?',
  text: text,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  preConfirm: function(){
    return new Promise(function(){
      var method = "POST";
      var url = "delete";
      var param = urllink+postId;
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){

          var res = JSON.parse(xhr.responseText);
          // console.log(res);
          if(res.success){
            swal.fire('Done!', res.success, 'success');
            // console.log(postId);
            loadData(1, '', link, admin);

          }
          if(res.failed){
            swal.fire('Oops...!', res.failed, 'error');
          }
        }
      }
      xhr.open(method, url, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send(param);
    })
  },
  allowOutsideClick: false
})

}

function deleteMeme(postId, link, admin){
  // alert("I worked");
  if(link == 12){
    var idd = "memec="; //Memes Category
    var text = "This Meme Catgeory Will Be Deleted Permanently!";
  }
  if(link == 13){
    var idd = "meme="; //Memes
    var text = "This Meme Will Be Deleted Permanently!";
  }
  if(link == 14){
    var idd = "musiccat="; //Memes
    var text = "This Music Will Be Deleted Permanently!";
  }
  swal.fire({
    title: 'Are you sure?',
    text: text,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!',
    preConfirm: function(){
      return new Promise(function(){
        var method = "POST";
        var url = "delete";
        var param = idd+postId;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
          if(xhr.readyState == 4 && xhr.status == 200){

            var res = JSON.parse(xhr.responseText);
            // console.log(res);
            if(res.success){
              swal.fire('Deleted!', res.success, 'success');
              // console.log(postId);
              loadMeme(1, '', link, admin);

            }
            if(res.failed){
              swal.fire('Oops...!', res.failed, 'error');
            }
          }
        }
        xhr.open(method, url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(param);
      })
    },
    allowOutsideClick: false
  })
}

function deleteAccount(postId, link){
  if(link == 3){
    var idd = "usr="
    var text =  "This User Account Will Be Deleted Permanently!";
  }
  if(link == 4){
    var idd = "admid="
    var text =  "This Admin Account Will Be Deleted Permanently!";
  }
swal.fire({
  title: 'Are you sure?',
  text: text,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete Account!',
  cancelButtonText: 'No, cancel!',
  preConfirm: function(){
    return new Promise(function(){
      var method = "POST";
      var url = "delete";
      var param = idd+postId;
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){

          var res = JSON.parse(xhr.responseText);
          // console.log(res);
          if(res.success){
            swal.fire('Deleted!', res.success, 'success');
            // console.log(postId);
            loadUser(1, '', link);

          }
          if(res.failed){
            // console.log(res.failed);
            swal.fire('Oops...!', res.failed, 'error');
          }
        }
      }
      xhr.open(method, url, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send(param);
    })
  },
  allowOutsideClick: false
})

}

function suspend(postId, type, status, admin_id){
  if(type == 3){
    if(status == 1){
      var urllink = "usr=";
      var text =  "This user will be suspended temporarily!";
      var cbt = 'Yes, Suspend User!';
      var msg = 'Suspended!';
    }else{
      var urllink = "usr=";
      var text =  "This user will now have access to the account!";
      var cbt = 'Yes, Unsuspend user!';
      var msg = 'Pardoned!';
    }
  }
  if(type == 4){
    if(status == 1){
      var urllink = "admid=";
      var text =  "This admin will be suspended temporarily!";
      var cbt = 'Yes, Suspend Admin!';
      var msg = 'Suspended!';
    }else{
      var urllink = "admid=";
      var text =  "This admin will now have access to the account!";
      var cbt = 'Yes, Unsuspend Admin!';
      var msg = 'Pardoned!';
    }
  }
swal.fire({
  title: 'Are you sure?',
  text: text,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: cbt,
  cancelButtonText: 'No, cancel!',
  preConfirm: function(){
    return new Promise(function(){
      var method = "POST";
      var url = "sus";
      var param = urllink+postId;
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){

          var res = JSON.parse(xhr.responseText);
          // console.log(res);
          if(res.success){
            swal.fire(msg, res.success, 'success');
            // console.log(postId);
            loadUser(1, '', type);

          }
          if(res.failed){
            swal.fire('Oops...!', res.failed, 'error');
          }
        }
      }
      xhr.open(method, url, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send(param);
    })
  },
  allowOutsideClick: false
})

}

function UpdateAuthorProfile(id){
  // var lbl = document.getElementById('lbl');
  // var lbl_id = lbl.getAttribute('data-id');
  var author_desc = tinyMCE.get('body');
  var response = document.getElementById('aut-response');

  if(author_desc.getContent() == ""){
    response.innerHTML = "You haven't typed in anything!!!";
    response.style.color = "red";
    response.style.visibility = "visible";
  }else{
    var method = "POST";
    var url = "authorprf";
    var param = "admin_description="+author_desc.getContent();
        param+="&admin_id="+id;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);

        if(res.success){
          window.location = "adminhome";
        }
        if(res.failed){
          console.log(res.failed);
          response.innerHTML = res.failed;
        }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }
}

// swal.fire({
//   title: 'No Image Selected',
//   icon: 'error'
// })
function uploadProfile(id){

  swal.fire({
    title: 'Upload Profile Image',
    html: '<br><input id="prfupload" onchange="loadImage(event);" type="file" name="prfimage"/><br><img id="viewImage" width="200px" height="200px"><br>',

    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Upload',
    cancelButtonText: 'cancel',
    preConfirm: function(){
      return new Promise(function(){
        var images = document.getElementById('prfupload');
        var method = "POST";
        var url = "prfimage";
        var formData = new FormData();
        formData.append('image', images.files[0]);
        formData.append('admid', id);
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
          if(xhr.readyState == 4 && xhr.status == 200){

            var res = JSON.parse(xhr.responseText);

            if(res.success){
              swal.fire('Done!', res.success, 'success');

            }
            if(res.failed){
              console.log(res.failed);
              swal.fire('Oops...!', 'something went wrong, try again!!!', 'error');
            }
          }
        }
        xhr.open(method, url, true);
        // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(formData);
      })
    },
    allowOutsideClick: true
  })

}
function updateImage(idd, url){

  if(url == "updatepostimage"){
    var title = 'Change Post Title Image';
    var loc = "viewpost";
  }
  if(url == "updatecontactimage"){
    var title = 'Change Contact Image';
    var loc = "viewcontact";
  }
  if(url == "updateaboutimage"){
    var title = 'Change About Image';
    var loc = "viewabout";
  }
  if(url == "updatemusicimage"){
    var title = 'Change Music Cover Image';
    var loc = "musics";
  }

  swal.fire({
    title: title,
    html: '<br><input type="file" id="image" onchange="loadImage(event);"><br><img id="viewImage" width="200px" height="200px"><br>',

    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Upload',
    cancelButtonText: 'cancel',
    preConfirm: function(){
      return new Promise(function(){
        var images = document.getElementById('image');
        var method = "POST";
        var urllink = url;
        // var url = "updateblogimage";
        var formData = new FormData();
        formData.append('image', images.files[0]);
        formData.append('id', idd);
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
          if(xhr.readyState == 4 && xhr.status == 200){

            var res = JSON.parse(xhr.responseText);
            // console.log(res);
            if(res.success){
              window.location = loc;

            }
            if(res.failed){
              console.log(res.failed);
              swal.fire('Oops...!', 'something went wrong, try again!!!', 'error');
            }
          }
        }
        xhr.open(method, urllink, true);
        // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(formData);
      })
    },
    allowOutsideClick: true
  })

}
// function uploadProfile(){
//   const { value: file } = await Swal.fire({
//   title: 'Upload Profile image',
//   input: 'file',
//   inputAttributes: {
//     'accept': 'image/*',
//     'aria-label': 'Upload your profile picture'
//   }
// })
//
// if (file) {
//   const reader = new FileReader();
//   reader.onload = (e) => {
//     Swal.fire({
//       title: 'Your uploaded picture',
//       imageUrl: e.target.result,
//       imageAlt: 'The uploaded picture'
//     })
//   }
//   reader.readAsDataURL(file);
// }
// }

function addNewsCategory(){

  var cat = document.getElementById('newscategory');
  var catRes = document.getElementById('newscategory-response');

  if(cat.value.trim() == ""){
    catRes.innerHTML = "You have not entered a news category";
    catRes.style.color = "red";
    catRes.style.visibility = "visible";
  }else{
    var method = "POST";
    var url = "anc";
    var param = "news_category="+cat.value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
          if(res.success){
            window.location = "newscategory";
          }
          if(res.failed){
            // console.log(res.failed);
            catRes.innerHTML = res.failed;
            catRes.style.color = "red";
            catRes.style.visibility = "visible";

          }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }
}

function editNewsCategory(){
  var cat = document.getElementById('news_category');
  var dataId = document.getElementById('p');
  var catResponse = document.getElementById('news_category-response');

  if(cat.value.trim() == ""){
    catResponse.innerHTML = "You have not entered a news category";
    catResponse.style.color = "red";
    catResponse.style.visibility = "visible";
  }else{
    var catId = dataId.getAttribute('data-id');
    var method = "POST";
    var url = "enc";
    var param = "news_category="+cat.value;
        param+="&id="+catId;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
          if(res.success){
            window.location = "newscategory";
          }
          if(res.failed){
            catResponse.innerHTML = res.failed;
            catResponse.style.color = "red";
            catResponse.style.visibility = "visible";

          }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }
}

function addNews(){
  // alert(" iw wokred")
  var newstitle = document.getElementById('newstitle');
  var newscategory = document.getElementById('news_cat');
  // var body = document.getElementById('body');
  var newsbody = tinyMCE.get('news_body');
  var images = document.getElementById('news_image');
  var newsResponse = document.getElementById('news-response');

  if(newstitle.value.trim() == "" || newscategory.value.trim() == "" || newsbody.getContent() == "" || !images.files[0]){
    newsResponse.innerHTML = "All Field Required!!!";
    newsResponse.style.color = "red";
    newsResponse.style.visibility = "visible";

  }else{

    var method = "POST";
    var url = "an";
    var formData = new FormData();
    formData.append("news_title", newstitle.value);
    formData.append("news_category", newscategory.value);
    formData.append("news_body", newsbody.getContent());
    formData.append("news_image", images.files[0]);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
        console.log(res);
        if(res.success){
          window.location = "viewnews";
        }
        if(res.failed){
            console.log(res.failed);
            newsResponse.innerHTML = res.failed;
            newsResponse.style.color = "red";
            newsResponse.style.visibility = "visible";
        }
      }
    }
    xhr.open(method, url, true);
    xhr.send(formData);
  }
}

function editNews(){
  var newstitle = document.getElementById('newstitle');
  var newscategory = document.getElementById('newscat');
  // var body = document.getElementById('body');
  var newsbody = tinyMCE.get('newsbody');
  // var images = document.getElementById('image');
  var dataId = document.getElementById('p');
  var editResponse = document.getElementById('editnews-response');

  if(newstitle.value.trim() == "" || newscategory.value.trim() == "" || newsbody.getContent() == ""){
    editResponse.innerHTML = "All Field Required!!!";
    editResponse.style.color = "red";
    editResponse.style.visibility = "visible";

  }else{
    var blogId = dataId.getAttribute('data-id');
    var method = "POST";
    var url = "en";
    var formData = new FormData();
    formData.append("newstitle", newstitle.value);
    formData.append("newscategory", newscategory.value);
    formData.append("newsbody", newsbody.getContent());
    // formData.append("image", image.files[0]);
    formData.append("id", blogId);

    var blog = new XMLHttpRequest();
    blog.onreadystatechange = function(){
      if(blog.readyState == 4 && blog.status == 200){
        var res = JSON.parse(blog.responseText);
        // console.log(res);
        if(res.success){
          window.location = "viewnews";
        }
        if(res.failed){
          // console.log(res.failed);
          editResponse.innerHTML = res.failed;
          editResponse.style.color = "red";
          editResponse.style.visibility = "visible";
        }
      }
    }
    blog.open(method, url, true);
    // blog.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    blog.send(formData);
  }
}

function addSection(){
  var sec = document.getElementById('section');
  var secRes = document.getElementById('section-response');

  if(sec.value.trim() == ""){
    secRes.innerHTML = "You have not entered a web section";
    secRes.style.color = "red";
    secRes.style.visibility = "visible";
  }else{
    var method = "POST";
    var url = "sec";
    var param = "section="+sec.value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
          if(res.success){
            window.location = "websection";
          }
          if(res.failed){
            // console.log(res.failed);
            secRes.innerHTML = res.failed;
            secRes.style.color = "red";
            secRes.style.visibility = "visible";

          }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }
}

function editSection(){
  var sec = document.getElementById('section');
  var dataId = document.getElementById('p');
  var secRes = document.getElementById('section-response');

  if(sec.value.trim() == ""){
    secRes.innerHTML = "You have not entered a web section";
    secRes.style.color = "red";
    secRes.style.visibility = "visible";
  }else{
    var secId = dataId.getAttribute('data-id');
    var method = "POST";
    var url = "esec";
    var param = "section="+sec.value;
        param +="&id="+secId;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var res = JSON.parse(xhr.responseText);
          if(res.success){
            window.location = "websection";
          }
          if(res.failed){
            // console.log(res.failed);
            secRes.innerHTML = res.failed;
            secRes.style.color = "red";
            secRes.style.visibility = "visible";

          }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(param);
  }
}

function changeCatSelection(){
  var catSelect = document.getElementById('section');
  // alert(catSelect.value);
  var method = "POST";
  var url = "catselect";
  var param = "section="+catSelect.value;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
      document.getElementById('category').innerHTML = xhr.responseText;
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send(param);
}


// function adminActivity(id){
//   var method = "POST";
//   var url = "admin_act";
//   var param = "admin_id="+id;
//   var xhr = new XMLHttpRequest();
//   xhr.onreadystatechange = function(){
//     if(xhr.readyState == 4 && xhr.status == 200){
//       // document.getElementById('category').innerHTML = xhr.responseText;
//       swal.fire('Admin Activities', xhr.responseText);
//     }
//   }
//   xhr.open(method, url, true);
//   xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//   xhr.send(param);
// }
