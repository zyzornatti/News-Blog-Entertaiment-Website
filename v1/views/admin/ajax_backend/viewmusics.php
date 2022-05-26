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

if(isset ($_POST['admin'])){
  $ad = fetchRecord2($conn, "admin", "admin_hash", $_POST['admin']);
  $admin = $ad['admin_hash'];

  if($ad['rank'] != 1){
    $query = 'SELECT hom_mav.hom_mav_id, hom_mav.hom_mav_hash_id AS music_hash, hom_mav.hom_mav_title, admin.admin_username AS author, hom_mav_category.hom_mav_category_name AS category, hom_mav.hom_mav_content AS body, hom_mav.hom_mav_link, hom_mav.hom_mav_image, hom_mav.date_created, hom_mav.hom_mav_visibility, hom_mav.time_created FROM hom_mav INNER JOIN hom_mav_category ON hom_mav.hom_mav_category_id = hom_mav_category.hom_mav_category_hash_id INNER JOIN admin ON hom_mav.hom_mav_added_by = admin.admin_hash ';

    //sort record without search query
    if((isset ($_POST['sort'])) && $_POST['query'] == ''){
      $query .= 'WHERE hom_mav.hom_mav_category_id = :wcs ';
      $query .= 'AND hom_mav.hom_mav_added_by = :adm ';
    }

    //sort record with search query
    if((isset ($_POST['sort'])) && $_POST['query'] != ''){

      $query .= 'WHERE hom_mav.hom_mav_category_id = :wcs ';

      $query .= 'AND (hom_mav.hom_mav_title LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR admin.admin_username LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR hom_mav.hom_mav_content LIKE "%'.str_replace(' ', '%', $_POST['query']).'%") ';

      $query .= 'AND hom_mav.hom_mav_added_by = :adm ';

    }

    //execute stmt without search query
    $query .= 'ORDER BY hom_mav.hom_mav_id DESC ';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":wcs", $_POST['sort']);
    $stmt->bindParam(":adm", $admin);
    $stmt->execute();
    $total_data = $stmt->rowCount();

    //execute stmt with search query
    $filter_query = $query. 'LIMIT '.$start.', '.$limit.'';
    $stmt = $conn->prepare($filter_query);
    $stmt->bindParam(":wcs", $_POST['sort']);
    $stmt->bindParam(":adm", $admin);
    $stmt->execute();
    $paginated_data = $stmt->rowCount();

    $result = $stmt->fetchAll();
  }else{
    $query = 'SELECT hom_mav.hom_mav_id, hom_mav.hom_mav_hash_id AS music_hash, hom_mav.hom_mav_title, admin.admin_username AS author, hom_mav_category.hom_mav_category_name AS category, hom_mav.hom_mav_content AS body, hom_mav.hom_mav_link, hom_mav.hom_mav_image, hom_mav.date_created, hom_mav.hom_mav_visibility, hom_mav.time_created FROM hom_mav INNER JOIN hom_mav_category ON hom_mav.hom_mav_category_id = hom_mav_category.hom_mav_category_hash_id INNER JOIN admin ON hom_mav.hom_mav_added_by = admin.admin_hash ';

    //sort record without search query
    if((isset ($_POST['sort'])) && $_POST['query'] == ''){
      $query .= 'WHERE hom_mav.hom_mav_category_id = :wcs ';
    }

    //sort record with search query
    if((isset ($_POST['sort'])) && $_POST['query'] != ''){

      $query .= 'WHERE hom_mav.hom_mav_category_id = :wcs ';

      $query .= 'AND (hom_mav.hom_mav_title LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR admin.admin_username LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR hom_mav.hom_mav_content LIKE "%'.str_replace(' ', '%', $_POST['query']).'%") ';

    }

    //execute stmt without search query
    $query .= 'ORDER BY hom_mav.hom_mav_id DESC ';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":wcs", $_POST['sort']);
    $stmt->execute();
    $total_data = $stmt->rowCount();

    //execute stmt with search query
    $filter_query = $query. 'LIMIT '.$start.', '.$limit.'';
    $stmt = $conn->prepare($filter_query);
    $stmt->bindParam(":wcs", $_POST['sort']);
    $stmt->execute();
    $paginated_data = $stmt->rowCount();

    $result = $stmt->fetchAll();
  }
}

$output = '
<label>Total Musics -'.$paginated_data.' <span>of</span> '.$total_data.'</label>
      <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Music Title</th>
                    <th>Uploaded By</th>
                    <th>Music Category</th>
                    <th>Music Info</th>
                    <th>Music link</th>
                    <th>Cover Image</th>
                    <th>Date Created</th>
                    <th scope="col" colspan="2">Visibility & Activities</th>
                    <th scope="col" colspan="2">Action</th>
                  </tr>
                </thead>
  ';
  $x = 1;
$urllink = "'updatemusicimage'";
if($total_data > 0){
  foreach ($result as $row){
    if($row['hom_mav_visibility'] == "show"){
      $visibility = "hide";
    }else{
      $visibility = "show";
    }
    $output .= '
    <tbody>
      <tr>
      <td>'.$x.'</td>
      <td>'.$row['hom_mav_title'].'</td>
      <td>'.$row['author'].'</td>
      <td>'.$row['category'].'</td>
      <td>'.shortContent($row['body']).'</td>
      <td>'.shortlink($row['hom_mav_link']).'</td>
      <td><img onclick="updateImage('.$row['hom_mav_id'].', '.$urllink.')" src="uploads/POSTS/'.$row['hom_mav_image'].'" style="width: 50%; max-height:5cm"/></td>
      <td>'.date("F j, Y", strtotime($row['date_created'])). ' at ' .$row['time_created'].'</td>
      <td><a onclick="showHideMusic('.$row['music_hash'].', '.$admin.')" class="btn btn-info" href="javasript:void(0)" class="del">'.$visibility.' music</a></td>
      <td><a href="music_activity?id='.$row['music_hash'].'" class="btn btn-info">View Activities</a></td>
      <td><a class="btn btn-success" href="editmusic?id='.$row['music_hash'].'" class="edit">Edit</a></td>
      <td><a onclick="deleteRecord('.$row['hom_mav_id'].', 15, '.$admin.')" class="btn btn-danger" href="javasript:void(0)" class="del">Delete</a></td>
      </tr>
   ';
   $x++;
  }
}else{
  $output .= '
  <tr>
    <th colspan="11" align="center">No Music Yet</th>
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
          <a class="page-link" href="javascript:void(0)" onclick="loadThis('.$previous_id.', 15, '.$_POST['admin'].')" data-page="'.$previous_id.'">Previous</a>
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
          <a class="page-link" href="javascript:void(0)" onclick="loadThis('.$next_id.', 15, '.$_POST['admin'].')" data-page="'.$next_id.'">Next</a>
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
          <a class="page-link" href="javascript:void(0)" onclick="loadThis('.$page_array[$count].', 15, '.$_POST['admin'].')" data-page="'.$page_array[$count].'">'.$page_array[$count].'</a>
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
