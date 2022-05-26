<?php
// $limit = 1;
if(isset ($_POST['limit'])){
  $limit = $_POST['limit'];
}
$page = 1;

if($_POST['page'] > 1){
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
}else{
  $start = 0;
}

$query = 'SELECT * FROM public ';

if($_POST['query'] != ''){
  $query .= 'WHERE name LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR email LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR phone_number LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR username LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';
  }

$query .= 'ORDER BY user_id DESC ';
$filter_query = $query. 'LIMIT '.$start.', '.$limit.'';

$stmt = $conn->prepare($query);
$stmt->execute();
$total_data = $stmt->rowCount();

$stmt = $conn->prepare($filter_query);
$stmt->execute();

$result = $stmt->fetchAll();

$output = '
<label>Total Users - '.$total_data.'</label>
      <table class="table table-bordered">
                <thead>
                  <tr>
                  <th>S/N</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Username</th>
                  <th>View Activities</th>
                  <th>Registration Date</th>
                  <th>Account Status</th>
                  <th scope="col" colspan="3">Action</th>
                  </tr>
                </thead>
  ';
$x = 1;
if($total_data > 0){
  foreach ($result as $row){
    if($row['status'] == "OK"){
      $button = "Suspend";
      $status = 1;
    }
    if($row['status'] == "SUSPENDED"){
      $button = "Unsuspend";
      $status = 2;
    }
    $output .= '
    <tbody>
      <tr>
      <td>'.$x.'</td>
      <td>'.$row['name'].'</td>
      <td>'.$row['email'].'</td>
      <td>'.$row['phone_number'].'</td>
      <td>'.$row['username'].'</td>
      <td><a href="user_activity?id='.$row['user_hash'].'"><button><i class="fa fa-eye"></i></button></a></td>
      <td>'.date("F j, Y", strtotime($row['date_created'])). ' at ' .$row['time_created'].'</td>
      <td>'.$row['status'].'</td>
      <td><a onclick="suspend('.$row['user_id'].', 3, '.$status.', '.$_SESSION['admin_id'].')" href="javascript:void(0)" class="btn btn-success">'.$button.'</a></td>
      <td><a onclick="deleteAccount('.$row['user_id'].', 3)" class="btn btn-danger" href="javascript:void(0)">Delete Account</a></td>
      </tr>
      </tr>
   ';
   $x++;
  }
}else{
  $output .= '
  <tr>
    <th colspan="8" align="center">No Data Found</th>
  </tr>
  ';
}

$output .= '
  </tbody>
  </table>
  <div align="center">
    <ul class="pagination">
';

$total_links = ceil($total_data/$limit);

$previous_link = '';

$next_link = '';

$page_link = '';

$page_array = [];

if($total_links > 4){
  if($page < 5){
    for ($count = 1; $count <= 5 ; $count++) {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  }else{
    $end_limit = $total_links - 5;
    if($page > $end_limit){
      $page_array[] = 1;
      $page_array[] = '...';
      for ($count = $end_limit; $count <= $total_links; $count++) {
        $page_array[] = $count;
      }
    }else{
      $page_array[] = 1;
      $page_array[] = '...';
      for ($count = $page - 1; $count <= $page + 1 ; $count++) {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
  }
}else{
  for ($count = 1; $count <= $total_links ; $count++) {
    $page_array[] = $count;
  }
}

for ($count = 0; $count < count($page_array); $count++) {
  if($page == $page_array[$count]){
    $page_link .='
    <li class="page-item active">
      <a class="page-link" href="javascript:void(0)">'.$page_array[$count].'<span class="sr-only">(current)</span></a>
    </li>
    ';
    $previous_id = $page_array[$count] - 1;
    if($previous_id > 0){
      $previous_link = '
        <li class="page-item">
          <a class="page-link" href="javascript:void(0)" onclick="loadThisUser('.$previous_id.', 3)" data-page="'.$previous_id.'">Previous</a>
        </li>
      ';
    }else{
      $previous_link = '
        <li class="page-item disabled">
          <a class="page-link" href="javascript:void(0)">Previous</a>
        </li>
      ';
    }

    $next_id = $page_array[$count] + 1;
    if($next_id >= $total_links){
      $next_link = '
        <li class="page-item disabled">
          <a class="page-link" href="javascript:void(0)">Next</a>
        </li>
      ';
    }else{
      $next_link = '
        <li class="page-item">
          <a class="page-link" href="javascript:void(0)" onclick="loadThisUser('.$next_id.', 3)" data-page="'.$next_id.'">Next</a>
        </li>
      ';
    }

  }else{
    if($page_array[$count] == '...'){
      $page_link .= '
        <li class="page-item disabled">
          <a class="page-link" href="javascript:void(0)">...</a>
        </li>
      ';
    }else{
      $page_link .= '
        <li class="page-item">
          <a class="page-link" href="javascript:void(0)" onclick="loadThisUser('.$page_array[$count].', 3)" data-page="'.$page_array[$count].'">'.$page_array[$count].'</a>
        </li>
      ';
    }
  }
}

$output .= $previous_link . $page_link . $next_link;
$output.= '
  </ul>
  </div>
';
echo $output;
 ?>
