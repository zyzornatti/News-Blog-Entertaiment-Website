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

if(isset ($_POST['admin_id'])){
  $ad = fetchRecord2($conn, "admin", "admin_hash", $_POST['admin_id']);
  $admin = $ad['admin_hash'];

  if($ad['rank'] != 1){
    $query = 'SELECT hom_memes.hom_memes_id, admin.admin_username, hom_memes_category.memes_category_name, hom_memes.memes_image, hom_memes.visibility, hom_memes.meme_hash_id, hom_memes.date_created, hom_memes.time_created FROM hom_memes INNER JOIN hom_memes_category ON hom_memes.memes_category = hom_memes_category.memes_category_hash_id INNER JOIN admin ON hom_memes.added_by = admin.admin_hash ';

    //sort record without search query
    if(isset ($_POST['sort'])){
      $query .= 'WHERE hom_memes.memes_category = :hmc ';
      $query .= 'AND hom_memes.added_by = :adm ';
    }


    //execute stmt without search query
    $query .= 'ORDER BY hom_memes.hom_memes_id DESC ';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":hmc", $_POST['sort']);
    $stmt->bindParam(":adm", $admin);
    $stmt->execute();
    $total_data = $stmt->rowCount();

    $limit_query = $query. 'LIMIT '.$start.', '.$limit.'';
    $stmt = $conn->prepare($limit_query);
    $stmt->bindParam(":hmc", $_POST['sort']);
    $stmt->bindParam(":adm", $admin);
    $stmt->execute();
    $paginated_data = $stmt->rowCount();


    $result = $stmt->fetchAll();
  }else{
    $query = 'SELECT hom_memes.hom_memes_id, admin.admin_username, hom_memes_category.memes_category_name, hom_memes.memes_image, hom_memes.visibility, hom_memes.meme_hash_id, hom_memes.date_created, hom_memes.time_created FROM hom_memes INNER JOIN hom_memes_category ON hom_memes.memes_category = hom_memes_category.memes_category_hash_id INNER JOIN admin ON hom_memes.added_by = admin.admin_hash ';

    //sort record without search query
    if(isset ($_POST['sort'])){
      $query .= 'WHERE hom_memes.memes_category = :hmc ';
    }

    //execute stmt without search query
    $query .= 'ORDER BY hom_memes.hom_memes_id DESC ';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":hmc", $_POST['sort']);
    $stmt->execute();
    $total_data = $stmt->rowCount();

    $limit_query = $query. 'LIMIT '.$start.', '.$limit.'';
    $stmt = $conn->prepare($limit_query);
    $stmt->bindParam(":hmc", $_POST['sort']);
    $stmt->execute();
    $paginated_data = $stmt->rowCount();

    $result = $stmt->fetchAll();
  }
}

$output = '
<label>Total Memes -'.$paginated_data.' <span>of</span> '.$total_data.'</label>
      <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Posted By</th>
                    <th>Meme</th>
                    <th>Category</th>
                    <th>Date Created</th>
                    <th>Visibility</th>
                    <th>Action</th>
                  </tr>
                </thead>
  ';
  $x = 1;
if($total_data > 0){
  foreach ($result as $row){
    if($row['visibility'] == "show"){
      $visibility = "Hide";
    }else{
      $visibility = "Show";
    }
    $output .= '
    <tbody>
      <tr>
      <td>'.$x.'</td>
      <td>'.$row['admin_username'].'</td>
      <td><img src="uploads/MEMES/'.$row['memes_image'].'" style="width: 50%; max-height:5cm"/></td>
      <td>'.$row['memes_category_name'].'</td>
      <td>'.date("F j, Y", strtotime($row['date_created'])). ' at ' .$row['time_created'].'</td>
      <td><a onclick="showHideMeme('.$row['hom_memes_id'].', '.$admin.')" class="btn btn-info" href="javasript:void(0)" class="del">'.$visibility.' meme</a></td>
      <td><a onclick="deleteMeme('.$row['hom_memes_id'].', 13, '.$admin.')" class="btn btn-danger" href="javasript:void(0)" class="del">Delete</a></td>
      </tr>
   ';
   $x++;
  }
}else{
  $output .= '
  <tr>
    <th colspan="10" align="center">No Meme Found</th>
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
          <a class="page-link" href="javascript:void(0)" onclick="loadThisMeme('.$previous_id.', 13, '.$_POST['admin_id'].')" data-page="'.$previous_id.'">Previous</a>
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
          <a class="page-link" href="javascript:void(0)" onclick="loadThisMeme('.$next_id.', 13, '.$_POST['admin_id'].')" data-page="'.$next_id.'">Next</a>
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
          <a class="page-link" href="javascript:void(0)" onclick="loadThisMeme('.$page_array[$count].', 13, '.$_POST['admin_id'].')" data-page="'.$page_array[$count].'">'.$page_array[$count].'</a>
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
