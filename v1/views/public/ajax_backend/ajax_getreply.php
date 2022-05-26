<?php
// $posturl = $_POST['posturl'];
// $cid = $_POST['cid'];
// $pid = $_POST['pid'];
// $uid = $_POST['uid'];
// $output = "
// <form class='form-gray-fields' id='c_form'>
//   <div class='row'>
//     <div class='col-lg-12'>
//       <div class='form-group'>
//         <label style='visibility:hidden' id='lbl_body'>You haven't type in anything</label>
//         <label class='upper' for='comment'>Your comment</label>
//         <textarea class='form-control required' name='comment' rows='9' placeholder='Enter comment' id='c_body' aria-required='true'></textarea>
//       </div>
//     </div>
//   </div>
//   <div class='row'>
//     <div class='col-lg-12'>
//       <div class='form-group text-center'>
//         <button class='btn' type='button' id='reply' data-id='$cid' data-post-id='$pid' data-user='$uid' onclick='submitReply('.$posturl.')'>Submit Reply</button>
//       </div>
//     </div>
//   </div>
// </form>
// ";
//
// echo $output;
 ?>



<form class="form-gray-fields" id="c_form">
  <div class="row">
    <div class="col-lg-12">
      <div class="form-group">
        <label style="visibility:hidden" id="lbl_body">You haven't type in anything</label>
        <label class="upper" for="comment">Your comment</label>
        <textarea class="form-control required" name="comment" rows="9" placeholder="Enter comment" id="c_body" aria-required="true"></textarea>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="form-group text-center">
        <button class="btn" type="button" id="reply" data-post-url="" data-id="" data-post-id="" data-user="" onclick="submitReply()">Submit Reply</button>
      </div>
    </div>
  </div>
</form>
