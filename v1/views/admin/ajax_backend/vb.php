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
    $query = 'SELECT web_content.web_content_id, web_content.hash_id AS content_hash, web_content.title, admin.admin_username AS author, web_section.web_section_name AS section, web_category.web_category_name AS category, web_content.body, web_content.image, web_content.date_created, web_content.visibility, web_content.time_created FROM web_content INNER JOIN web_category ON web_content.category_id = web_category.category_hash_id INNER JOIN admin ON web_content.author_id = admin.admin_hash INNER JOIN web_section ON web_content.section = web_section.section_hash_id ';

    //sort record without search query
    if((isset ($_POST['sort'])) && $_POST['query'] == ''){
      $query .= 'WHERE web_content.section = :wcs ';
      $query .= 'AND web_content.author_id = :adm ';
    }

    //sort record with search query
    if((isset ($_POST['sort'])) && $_POST['query'] != ''){

      $query .= 'WHERE web_content.section = :wcs ';

      $query .= 'AND (web_content.title LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR admin.admin_username LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR web_category.web_category_name LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR web_content.body LIKE "%'.str_replace(' ', '%', $_POST['query']).'%") ';

      $query .= 'AND web_content.author_id = :adm ';

    }

    //execute stmt without search query
    $query .= 'ORDER BY web_content.web_content_id DESC ';
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
    $query = 'SELECT web_content.web_content_id, web_content.hash_id AS content_hash, web_content.title, admin.admin_username AS author, web_section.web_section_name AS section, web_category.web_category_name AS category, web_content.body, web_content.image, web_content.date_created, web_content.visibility, web_content.time_created FROM web_content INNER JOIN web_category ON web_content.category_id = web_category.category_hash_id INNER JOIN admin ON web_content.author_id = admin.admin_hash INNER JOIN web_section ON web_content.section = web_section.section_hash_id ';

    //sort record without search query
    if((isset ($_POST['sort'])) && $_POST['query'] == ''){
      $query .= 'WHERE web_content.section = :wcs ';
    }

    //sort record with search query
    if((isset ($_POST['sort'])) && $_POST['query'] != ''){

      $query .= 'WHERE web_content.section = :wcs ';

      $query .= 'AND (web_content.title LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR admin.admin_username LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR web_category.web_category_name LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR web_content.body LIKE "%'.str_replace(' ', '%', $_POST['query']).'%") ';

    }

    //execute stmt without search query
    $query .= 'ORDER BY web_content.web_content_id DESC ';
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

// $query = 'SELECT web_content.web_content_id, web_content.hash_id AS content_hash, web_content.title, admin.admin_username AS author, web_section.web_section_name AS section, web_category.web_category_name AS category, web_content.body, web_content.image, web_content.date_created, web_content.visibility, web_content.time_created FROM web_content INNER JOIN web_category ON web_content.category_id = web_category.category_hash_id INNER JOIN admin ON web_content.author_id = admin.admin_hash INNER JOIN web_section ON web_content.section = web_section.section_hash_id ';
//
// //sort record without search query
// if((isset ($_POST['sort'])) && $_POST['query'] == ''){
//   $query .= 'WHERE web_content.section = :wcs ';
// }
//
// //sort record with search query
// if((isset ($_POST['sort'])) && $_POST['query'] != ''){
//
//   $query .= 'WHERE web_content.section = :wcs ';
//
//   $query .= 'AND (web_content.title LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR admin.admin_username LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR web_category.web_category_name LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR web_content.body LIKE "%'.str_replace(' ', '%', $_POST['query']).'%") ';
//
// }
//
// //execute stmt without search query
// $query .= 'ORDER BY web_content.web_content_id DESC ';
// $stmt = $conn->prepare($query);
// $stmt->bindParam(":wcs", $_POST['sort']);
// $stmt->execute();
// $total_data = $stmt->rowCount();
//
// //execute stmt with search query
// $filter_query = $query. 'LIMIT '.$start.', '.$limit.'';
// $stmt = $conn->prepare($filter_query);
// $stmt->bindParam(":wcs", $_POST['sort']);
// $stmt->execute();
//
// $result = $stmt->fetchAll();

$output = '
<label>Total Posts -'.$paginated_data.' <span>of</span> '.$total_data.'</label>
      <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Section</th>
                    <th>Category</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Date Created</th>
                    <th scope="col" colspan="2">Visibility & Activities</th>
                    <th scope="col" colspan="2">Action</th>
                  </tr>
                </thead>
  ';
  $x = 1;
$urllink = "'updatepostimage'";
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
      <td>'.$row['title'].'</td>
      <td>'.$row['author'].'</td>
      <td>'.$row['section'].'</td>
      <td>'.$row['category'].'</td>
      <td>'.shortContent($row['body']).'</td>
      <td><img onclick="updateImage('.$row['web_content_id'].', '.$urllink.')" src="uploads/POSTS/'.$row['image'].'" style="width: 50%; max-height:5cm"/></td>
      <td>'.date("F j, Y", strtotime($row['date_created'])). ' at ' .$row['time_created'].'</td>
      <td><a onclick="showHide('.$row['web_content_id'].', '.$admin.')" class="btn btn-info" href="javasript:void(0)" class="del">'.$visibility.' post</a></td>
      <td><a href="post_activity?id='.$row['content_hash'].'" class="btn btn-info">View Activities</a></td>
      <td><a class="btn btn-success" href="edit?id='.$row['content_hash'].'" class="edit">Edit</a></td>
      <td><a onclick="deleteRecord('.$row['web_content_id'].', 1, '.$admin.')" class="btn btn-danger" href="javasript:void(0)" class="del">Delete</a></td>
      </tr>
   ';
   $x++;
  }
}else{
  $output .= '
  <tr>
    <th colspan="11" align="center">No Post Yet</th>
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
          <a class="page-link" href="javascript:void(0)" onclick="loadThis('.$previous_id.', 1, '.$_POST['admin'].')" data-page="'.$previous_id.'">Previous</a>
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
          <a class="page-link" href="javascript:void(0)" onclick="loadThis('.$next_id.', 1, '.$_POST['admin'].')" data-page="'.$next_id.'">Next</a>
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
          <a class="page-link" href="javascript:void(0)" onclick="loadThis('.$page_array[$count].', 1, '.$_POST['admin'].')" data-page="'.$page_array[$count].'">'.$page_array[$count].'</a>
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
