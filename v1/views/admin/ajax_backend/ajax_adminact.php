<?php

$id = $_POST['admin_id'];
$page = $_POST['page'];
// $activities = fetchAdminActivities($conn, "admin_activities", "admin", $id, 2);
$activities = pagiNateRecord($conn, "admin_activities", "admin", $id, "admin_activities_id", $page, 5);
$countAct = countPaginatedRecord($conn, "admin_activities", "admin", $id, "admin_activities_id", $page, 5);
$output = '<br>';
$output = '

      <table class="table table-bordered">
                <thead>
                  <tr>
                  <th>S/N</th>
                  <th>Activities & Date</th>
                </thead>
  ';
$x = 1;
if($countAct > 0){
  foreach ($activities as $key => $value) {
    // $output .= '
    // <p>'.$value['description'].' on '.date("F j, Y", strtotime($value['date_created'])).' at '.$value['time_created'].'</p><hr/>
    // ';
    $output .= '
    <tbody>
      <tr>
      <td>'.$x.'</td>
      <td><p>'.$value['description'].' on '.date("F j, Y", strtotime($value['date_created'])).' at '.$value['time_created'].'</p></td>
      </tr>

   ';
   $x++;
  }

}else{
  // $output .= '
  // <p>No Activites Yet</p>
  // ';
  $output .= '
  <tr>
    <th colspan="2" align="center">No More Activities</th>
  </tr>
  ';
}

$output .= '
  </tbody>
  </table>
';

if($countAct > 0){
  $output .= '
  <div class="section-row loadmore text-center">
    <button onclick="paginateAdminAct('.$id.')" class="primary-button">See Older Activities</button>
  </div>
  ';
}else{
  $output .= '';
}
echo $output;


 ?>
