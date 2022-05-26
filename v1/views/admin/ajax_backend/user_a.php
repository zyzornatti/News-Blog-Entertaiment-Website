<?php
// $limit = 1;
if(isset ($_POST['admin'])){
  $id = $_POST['admin'];
}
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

$query = 'SELECT * FROM public_activities ';

if($_POST['query'] != ''){
  $query .= 'WHERE user = :usr ';
  $query .= 'AND description LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';
}
if($_POST['query'] == ''){
  $query .= 'WHERE user = :usr ';
}

$query .= 'ORDER BY public_activities_id DESC ';
$filter_query = $query. 'LIMIT '.$start.', '.$limit.'';

$stmt = $conn->prepare($query);
$stmt->bindParam(":usr", $id);
$stmt->execute();
$total_data = $stmt->rowCount();

$stmt = $conn->prepare($filter_query);
$stmt->bindParam(":usr", $id);
$stmt->execute();
$paginated_data = $stmt->rowCount();

$result = $stmt->fetchAll();

$output = '
<label>Total Activities - '.$paginated_data.'<span> of </span>'.$total_data.'</label>
<table class="table table-bordered">
          <thead>
            <tr>
            <th>S/N</th>
            <th>Activities & Date</th>
          </thead>
  ';
$x = 1;
if($total_data > 0){
  foreach ($result as $key => $value) {
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
  $output .= '
  <tr>
    <th colspan="2" align="center">No activities yet</th>
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
          <a class="page-link" href="javascript:void(0)" onclick="loadThis('.$previous_id.', 11, '.$id.')" data-page="'.$previous_id.'">Previous</a>
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
          <a class="page-link" href="javascript:void(0)" onclick="loadThis('.$next_id.', 11, '.$id.')" data-page="'.$next_id.'">Next</a>
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
          <a class="page-link" href="javascript:void(0)" onclick="loadThis('.$page_array[$count].', 11, '.$id.')" data-page="'.$page_array[$count].'">'.$page_array[$count].'</a>
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
