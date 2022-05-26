function loadData(page, query, url, admin_id){
  // alert(page+":"+query+":"+url+":"+admin);
  var f_limit = document.getElementById('limit');
  var blogLimit = f_limit.value;
  if(blogLimit > 10){
    var filter_limit = blogLimit;
  }else{
    var filter_limit = 10;
  }

  var sortIt = document.getElementById('sort');
  var sortRecord = sortIt.value;
  if(sortRecord != ''){
    var sort_record = sortRecord;
  }

  if(url == 1){
    var urllink = "vb"; //blog
  }
  if(url == 2){
    var urllink = "vcat"; //category
  }
  // if(url == 3){
  //   var urllink = "vu"; //manageusers
  // }
  // if(url == 4){
  //   var urllink = "vad"; //manageadmin
  // }
  if(url == 5){
    var urllink = "vc"; //contact
  }
  if(url == 6){
    var urllink = "va"; //about
  }
  if(url == 7){
    var urllink = "vncat"; //viewnewscategory
  }
  if(url == 8){
    var urllink = "vn"; //view News
  }
  if(url == 9){
    var urllink = "vsec"; //view News
  }
  if(url == 10){
    var urllink = "admin_act"; //admin Activities
  }
  if(url == 11){
    var urllink = "user_act"; //user Activities
  }
  if(url == 15){
    var urllink = "vmusics"; //view musics
  }

  var record = document.getElementById('loadrecord');
  var method = "POST";
  // var url = urllink;
  var param = "page="+page;
  param +="&query="+query;
  param +="&limit="+filter_limit;
  param +="&sort="+sort_record;
  param +="&admin="+admin_id;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
       record.innerHTML = xhr.responseText;
    }
  }
  xhr.open(method, urllink, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(param);
}

function postAct(page, id){
  var f_limit = document.getElementById('limit');
  var blogLimit = f_limit.value;
  if(blogLimit > 1){
    var filter_limit = blogLimit;
  }else{
    var filter_limit = 1;
  }
  var record = document.getElementById('loadrecord');
  var method = "POST";
  var url = "post_act";
  var param = "page="+page;
      param +="&limit="+filter_limit;
      param +="&id="+id;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
       record.innerHTML = xhr.responseText;
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(param);
}

function musicAct(page, id){
  var f_limit = document.getElementById('limit');
  var blogLimit = f_limit.value;
  if(blogLimit > 1){
    var filter_limit = blogLimit;
  }else{
    var filter_limit = 1;
  }
  var record = document.getElementById('loadrecord');
  var method = "POST";
  var url = "music_act";
  var param = "page="+page;
      param +="&limit="+filter_limit;
      param +="&id="+id;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
       record.innerHTML = xhr.responseText;
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(param);
}

function filterLimit(url, admin_id){
  var searchq = document.getElementById('search');
  if(searchq.value !== ''){
    var q = searchq.value;
  }else{
    var q = '';
  }
  loadData(1, q, url, admin_id);
}

function sortRecord(url, admin_id){
  var searchq = document.getElementById('search');
  if(searchq.value !== ''){
    var q = searchq.value;
  }else{
    var q = '';
  }
  loadData(1, q, url, admin_id);
}

function loadThis(page, url, admin_id){
  var searchq = document.getElementById('search');
  if(searchq.value !== ''){
    var q = searchq.value;
  }else{
    var q = '';
  }
  loadData(page, q, url, admin_id);
}

function searchQuery(url, admin_id){
  var searchq = document.getElementById('search');
  var q = searchq.value;
  // alert(url+":"+q+":"+admin_id);
  loadData(1, q, url, admin_id);
}

function loadUser(page, query, url){

  var f_limit = document.getElementById('limit');
  var blogLimit = f_limit.value;
  if(blogLimit > 1){
    var filter_limit = blogLimit;
  }else{
    var filter_limit = 1;
  }

  var sortIt = document.getElementById('sort');
  var sortRecord = sortIt.value;
  if(sortRecord != ''){
    var sort_record = sortRecord;
  }

  if(url == 3){
    var urllink = "vu"; //manageusers
  }
  if(url == 4){
    var urllink = "vad"; //manageadmin
  }

  var record = document.getElementById('loadrecord');
  var method = "POST";
  // var url = urllink;
  var param = "page="+page;
  param +="&query="+query;
  param +="&limit="+filter_limit;
  param +="&sort="+sort_record;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
       record.innerHTML = xhr.responseText;
    }
  }
  xhr.open(method, urllink, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(param);
}

function filterLimitUser(url){
  var searchq = document.getElementById('search');
  if(searchq.value !== ''){
    var q = searchq.value;
  }else{
    var q = '';
  }
  loadUser(1, q, url);
}

// function filterPostAct(id){
//   postAct(1, id);
// }

function sortRecordUser(url){
  var searchq = document.getElementById('search');
  if(searchq.value !== ''){
    var q = searchq.value;
  }else{
    var q = '';
  }
  loadUser(1, q, url);
}

function loadThisUser(page, url){
  var searchq = document.getElementById('search');
  if(searchq.value !== ''){
    var q = searchq.value;
  }else{
    var q = '';
  }
  loadUser(page, q, url);
}

function searchQueryUser(url, admin_id){
  var searchq = document.getElementById('search');
  var q = searchq.value;
  // alert(url+":"+q+":"+admin_id);
  loadUser(1, q, url);
}

function popUpShow(){
  var msg = document.getElementById('msg');
  var dataMsg = msg.getAttribute('data-msg');
  if(dataMsg){
    swal.fire({
      icon: 'success',
      title: 'Done!',
      text: dataMsg

    })
  }
}
function popUpShow2(title){
  var msg = document.getElementById('msg');
  var dataMsg = msg.getAttribute('data-msg');
  var text = title;
  if(dataMsg){
    swal.fire({
      icon: 'success',
      title: text,
      text: dataMsg

    })
  }
}

function loadMeme(page, query, url, admin){
  var sortIt = document.getElementById('sort');
  var sortRecord = sortIt.value;
  if(sortRecord != ''){
    var sort_record = sortRecord;
  }

  var f_limit = document.getElementById('limit');
  var blogLimit = f_limit.value;
  if(blogLimit > 1){
    var filter_limit = blogLimit;
  }else{
    var filter_limit = 1;
  }

  if(url == 12){
    var urllink = "vmemecat"; //View memes category
  }

  if(url == 13){
    var urllink = "vmeme"; //View memes
  }

  if(url == 14){
    var urllink = "vmusiccat"; //View music category
  }

  var record = document.getElementById('loadrecord');
  var method = "POST";
  var param = "page="+page;
    param +="&query="+query;
    param +="&limit="+filter_limit;
    param +="&sort="+sortRecord;
    param +="&admin_id="+admin;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
       record.innerHTML = xhr.responseText;
    }
  }
  xhr.open(method, urllink, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(param);
}

function searchMeme(url, admin_id){
  var searchq = document.getElementById('search');
  var q = searchq.value;

  loadMeme(1, q, url, admin_id);
}

function filterMemeLimit(url, admin_id){
  var searchq = document.getElementById('search');
  if(searchq.value !== ''){
    var q = searchq.value;
  }else{
    var q = '';
  }
  loadMeme(1, q, url, admin_id);
}

// function sortMeme(url, admin){
  // var searchq = document.getElementById('search');
  // if(searchq.value !== ''){
  //   var q = searchq.value;
  // }else{
  //   var q = '';
  // }
  // loadMeme(1, '', url, admin);
// }

function loadThisMeme(page, url, admin_id){
  var searchq = document.getElementById('search');
  if(searchq.value !== ''){
    var q = searchq.value;
  }else{
    var q = '';
  }
  loadMeme(page, q, url, admin_id);
}
// function alat(){
//   alert("I worked")
//   var
// }

// var postNumber = 5;
// function loadRecord(url, id){
//   postNumber = postNumber + 5;
//   var record = document.getElementById('loadrecord');
//   // var url = url;
//   var method = "POST";
//   var param = "page="+postNumber;
//       param+="&id="+id;
//   var xhr = new XMLHttpRequest();
//   xhr.onreadystatechange = function(){
//     if(xhr.readyState == 4 && xhr.status == 200){
//        record.innerHTML = xhr.responseText;
//        // swal.fire('Admin Activities', xhr.responseText);
//        // adminActivity(id);
//     }
//   }
//   xhr.open(method, url, true);
//   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   xhr.send(param);
// }
// var postNumber = 5;
// function paginateAdminAct(id){
//   postNumber = postNumber + 5;
//   // var record = document.getElementById('paginateadminact');
//   // var url = url;
//   var url = "ajax_aa";
//   var method = "POST";
//   var param = "page="+postNumber;
//       param+="&admin_id="+id;
//   var xhr = new XMLHttpRequest();
//   xhr.onreadystatechange = function(){
//     if(xhr.readyState == 4 && xhr.status == 200){
//        // record.innerHTML = xhr.responseText;
//        swal.fire('Admin Activities', xhr.responseText);
//
//        // adminActivity(id);
//     }
//   }
//   xhr.open(method, url, true);
//   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   xhr.send(param);
// }

//My functions before i added manual limit
// function loadData(page, query, url, filter_limit){
//   if(url == 1){
//     var urllink = "vb"; //blog
//   }
//   if(url == 2){
//     var urllink = "vcat"; //category
//   }
//   if(url == 3){
//     var urllink = "vu"; //manageusers
//   }
//   if(url == 4){
//     var urllink = "vad"; //manageadmin
//   }
//   if(url == 5){
//     var urllink = "vc"; //contact
//   }
//   if(url == 6){
//     var urllink = "va"; //about
//   }
//   var record = document.getElementById('loadrecord');
//   var method = "POST";
//   // var url = urllink;
//   param = "page="+page;
//   param +="&query="+query;
//   param +="&limit="+filter_limit;
//   var xhr = new XMLHttpRequest();
//   xhr.onreadystatechange = function(){
//     if(xhr.readyState == 4 && xhr.status == 200){
//        record.innerHTML = xhr.responseText;
//     }
//   }
//   xhr.open(method, urllink, true);
//   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   xhr.send(param);
// }
//
// function loadThis(page, url){
//   var searchq = document.getElementById('search');
//   if(searchq.value !== ''){
//     var q = searchq.value;
//   }else{
//     var q = '';
//   }
//   var f_limit = document.getElementById('limit');
//   if(f_limit.value !== ''){
//     var f = f_limit.value;
//   }else{
//     var f = 1;
//   }
//   loadData(page, q, url, f);
// }

// function searchQuery(url){
//   var searchq = document.getElementById('search');
//   var q = searchq.value;
//   loadData(1, q, url);
// }

// function loadRecord(pagenumber, url){
//   var record = document.getElementById('loadrecord');
//   var method = "GET";
//   var xhr = new XMLHttpRequest();
//   xhr.onreadystatechange = function(){
//     if(xhr.readyState == 4 && xhr.status == 200){
//        record.innerHTML = xhr.responseText;
//     }
//   }
//   xhr.open(method, url+pagenumber, true);
//   xhr.send();
// }


function showHide(postid, admin){
    // alert(id);
    var method = "POST";
    var url = "showhide";
    var param = "postid="+postid;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (){
      if(xhr.readyState == 4 && xhr.status == 200){
        // swal.fire('Done', xhr.responseText);
        var res = JSON.parse(xhr.responseText);
        // console.log(res);
        if(res.success){
          loadData(1, '', 1, admin);
          swal.fire('Done!', res.success, 'success');
        }
        if(res.failed){
          swal.fire('Oops...!', res.failed, 'error');
        }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(param);
}

function showHideMusic(musicid, admin){
    // alert(id);
    var method = "POST";
    var url = "showhide";
    var param = "musicid="+musicid;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (){
      if(xhr.readyState == 4 && xhr.status == 200){
        // swal.fire('Done', xhr.responseText);
        var res = JSON.parse(xhr.responseText);
        // console.log(res);
        if(res.success){
          loadData(1, '', 15, admin);
          swal.fire('Done!', res.success, 'success');
        }
        if(res.failed){
          swal.fire('Oops...!', res.failed, 'error');
        }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(param);
}

function showHideMeme(memeid, admin){
  // alert(postid+" to "+admin);
    var method = "POST";
    var url = "showhide";
    var param = "memeid="+memeid;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (){
      if(xhr.readyState == 4 && xhr.status == 200){
        // swal.fire('Done', xhr.responseText);
        var res = JSON.parse(xhr.responseText);
        // console.log(res);
        if(res.success){
          loadMeme(1, '', 13, admin);
          swal.fire('Done!', res.success, 'success');
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
}
