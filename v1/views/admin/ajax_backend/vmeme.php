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

$query = 'SELECT * FROM hom_memes_category ';

if($_POST['query'] != ''){
  $query .= 'WHERE memes_category_name LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';
  }

$query .= 'ORDER BY hom_memes_category_id DESC ';

$stmt = $conn->prepare($query);
$stmt->bindParam(":hmc", $_POST['query']);
$stmt->execute();
$total_data = $stmt->rowCount();

$filter_query = $query. 'LIMIT '.$start.', '.$limit.'';
$stmt = $conn->prepare($filter_query);
$stmt->bindParam(":hmc", $_POST['query']);
$stmt->execute();
$paginated_data = $stmt->rowCount();

$result = $stmt->fetchAll();

$output = '
<label>Total Records - '.$paginated_data.' of '.$total_data.'</label>
      <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Meme Category</th>
                    <th>Date Created</th>
                    <th scope="col" colspan="2">Action</th>
                  </tr>
                </thead>
  ';
$x = 1;
if($total_data > 0){
  foreach ($result as $row){
    $output .= '
    <tbody>
      <tr>
      <td>'.$x.'</td>
      <td>'.$row['memes_category_name'].'</td>
      <td>'.date("F j, Y", strtotime($row['date_created'])). ' at ' .$row['time_created'].'</td>
      <td><a class="btn btn-success" href="editmemecat?id='.$row['memes_category_hash_id'].'" class="edit">Edit</a></td>
      <td><a onclick="deleteMeme('.$row['hom_memes_category_id'].', 12, '.$_SESSION['admin_id'].')" class="btn btn-danger" href="javasript:void(0)" class="del">Delete</a></td>
      </tr>
   ';
   $x++;
  }
}else{
  $output .= '
  <tr>
    <th colspan="5" align="center">No Data Found</th>
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
          <a class="page-link" href="javascript:void(0)" onclick="loadThisMeme('.$previous_id.', 12)" data-page="'.$previous_id.'">Previous</a>
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
          <a class="page-link" href="javascript:void(0)" onclick="loadThisMeme('.$next_id.', 12)" data-page="'.$next_id.'">Next</a>
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
          <a class="page-link" href="javascript:void(0)" onclick="loadThisMeme('.$page_array[$count].', 12)" data-page="'.$page_array[$count].'">'.$page_array[$count].'</a>
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
