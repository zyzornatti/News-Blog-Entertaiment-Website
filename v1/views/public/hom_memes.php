<?php
$page_name = "Memes";
// $url = "http://192.168.33.18/memes/savage-ed82760de62828854a3dc9971ffbde7dmct/page=2";
$url = explode('/', $_SERVER['REQUEST_URI']);
$hash = $url[2];
$hash_id = explode('-', $hash);
$id = end($hash_id);
$limit = 10;

if(count($url) == 2 || count($url) > 4){
  header("Location: /home");
  exit();
 }

if(count ($url) == 3){ //page is not set
    $page = 1;
    $start = (($page - 1) * $limit);
    $total_data = countW2C($conn, "hom_memes", "visibility", "show", "memes_category", $id);
    $total_links = ceil($total_data/$limit);

    if($total_data < 1){
      header("Location: /home");
      exit();
    }else{
      $record = pagiNateRecord2($conn, "hom_memes", "visibility", "show", "memes_category", $id, "hom_memes_id", $start, $limit);
    }
}

if(count ($url) == 4){ //if page is set

  $pag = explode('=', $url[3]);
  $page = end($pag);
  $ck_str = "page=".$page;

  if(strpos($url[3], $ck_str) !== false){ //if page="pagenumber" exist

    if($page != ''){ // if deres page number i.e page=
      if(!is_numeric ($page)){
        header("Location: /home");
        exit();
      }else{
        $start = (($page - 1) * $limit);

        $total_data = countW2C($conn, "hom_memes", "visibility", "show", "memes_category", $id);
        $total_links = ceil($total_data/$limit);

        if($total_data < 1){
          header("Location: /home");
          exit();
        }else{
          $record = pagiNateRecord2($conn, "hom_memes", "visibility", "show", "memes_category", $id, "hom_memes_id", $start, $limit);
        }
      }

    }else{
      header("Location: /home");
      exit();
    }


  }else{
    header("Location: /home");
    exit();
  }


}

// $hash = $uri[2];
// $hash_id = explode('-', $hash);
// $id = end($hash_id);
// $memes_post = fetchRecentContentW2C($conn, "hom_memes", "memes_category", $id, "visibility", "show", "hom_memes_id", 10);
// if($memes_post->rowCount() < 1){
//     header("Location: /home");
//     exit();
//}

 include "includes/header.php";

 ?>

 <section id="page-content">
   <div class="container">

     <nav class="grid-filter gf-outline" data-layout="#portfolio">
       <ul>
         <?php $mc = fetchRecord2($conn, "hom_memes_category", "memes_category_hash_id", $id) ?>
         <li class="active"><a href="#"><?= $mc['memes_category_name'] ?></a></li>
         <!-- <li class="active"><a href="#" data-category="*">Show All</a></li> -->
         <!-- <li><a href="#" data-category=".ct-branding">Branding</a></li>
         <li><a href="#" data-category=".ct-photography">Photography</a></li>
         <li><a href="#" data-category=".ct-marketing">Marketing</a></li>
         <li><a href="#" data-category=".ct-media">Media</a></li>
         <li><a href="#" data-category=".ct-webdesign">Web design</a></li> -->
       </ul>
       <!-- <div class="grid-active-title">Show All</div> -->
     </nav>


     <div id="portfolio" class="grid-layout portfolio-4-columns" data-margin="0">

       <!-- <div class="portfolio-item ct-photography ct-media ct-branding ct-Media ct-marketing ct-webdesign">
         <div class="portfolio-item-wrap">
           <div class="portfolio-slider">
            <div class="carousel" data-items="1" data-loop="true" data-autoplay="true" data-animate-in="fadeIn" data-animate-out="fadeOut" data-autoplay="1500">
              <a href="#"><img src="images/portfolio/68.jpg" alt=""></a>
              <a href="#"><img src="images/portfolio/71.jpg" alt=""></a>
            </div>
          </div>
          <div class="portfolio-description" data-lightbox="gallery">
            <a title="Mock-up" data-lightbox="gallery-image" href="images/portfolio/83l.jpg" class="hidden"></a>
            <a title="Mock-up" data-lightbox="gallery-image" href="images/portfolio/82l.jpg" class="hidden"></a>
            <a title="Photoshop Mock-up!" data-lightbox="gallery-image" href="images/portfolio/80l.jpg"><i class="icon-copy"></i></a>
            <a title="Paper Pouch!" data-lightbox="gallery-image" href="images/portfolio/81l.jpg" class="hidden"></a>
            <a href="portfolio-page-grid-gallery.html"><i class="icon-link"></i></a>
          </div>
         </div>
       </div> -->

       <?php foreach ($record as $key => $value): ?>
         <div class="portfolio-item img-zoom ct-photography ct-marketing ct-media">
           <div class="portfolio-item-wrap">
             <div class="portfolio-image">
               <a href="#"><img src="/uploads/MEMES/<?= $value['memes_image'] ?>" alt=""></a>
             </div>
             <div class="portfolio-description" data-lightbox="gallery">
               <a title="<?= $site_name ?> - <?= $mc['memes_category_name'] ?> Meme" data-lightbox="gallery-image" href="/uploads/MEMES/<?= $value['memes_image'] ?>"><i class="icon-copy"></i></a>
             </div>
           </div>
         </div>
       <?php endforeach; ?>



       <!-- <div class="portfolio-item img-zoom ct-photography ct-media ct-branding ct-Media">
         <div class="portfolio-item-wrap">
           <div class="portfolio-image">
             <a href="#"><img src="/asset/images/portfolio/61.jpg" alt=""></a>
           </div>
           <div class="portfolio-description" data-lightbox="gallery">
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/83l.jpg" class="hidden"></a>
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/82l.jpg" class="hidden"></a>
             <a title="Photoshop Mock-up!" data-lightbox="gallery-image" href="/asset/images/portfolio/80l.jpg"><i class="icon-copy"></i></a>
             <a title="Paper Pouch!" data-lightbox="gallery-image" href="/asset/images/portfolio/81l.jpg" class="hidden"></a>
             <a href="portfolio-page-grid-gallery.html"><i class="icon-link"></i></a>
           </div>
         </div>
       </div>


       <div class="portfolio-item img-zoom ct-photography ct-media ct-branding ct-marketing ct-webdesign">
         <div class="portfolio-item-wrap">
           <div class="portfolio-image">
             <a href="#"><img src="/asset/images/portfolio/65.jpg" alt=""></a>
           </div>
           <div class="portfolio-description" data-lightbox="gallery">
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/83l.jpg" class="hidden"></a>
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/82l.jpg" class="hidden"></a>
             <a title="Photoshop Mock-up!" data-lightbox="gallery-image" href="/asset/images/portfolio/80l.jpg"><i class="icon-copy"></i></a>
             <a title="Paper Pouch!" data-lightbox="gallery-image" href="/asset/images/portfolio/81l.jpg" class="hidden"></a>
             <a href="portfolio-page-grid-gallery.html"><i class="icon-link"></i></a>
           </div>
         </div>
       </div>


       <div class="portfolio-item img-zoom ct-marketing ct-media ct-branding ct-marketing ct-webdesign">
         <div class="portfolio-item-wrap">
           <div class="portfolio-image">
             <a href="#"><img src="/asset/images/portfolio/66.jpg" alt=""></a>
           </div>
           <div class="portfolio-description" data-lightbox="gallery">
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/83l.jpg" class="hidden"></a>
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/82l.jpg" class="hidden"></a>
             <a title="Photoshop Mock-up!" data-lightbox="gallery-image" href="/asset/images/portfolio/80l.jpg"><i class="icon-copy"></i></a>
             <a title="Paper Pouch!" data-lightbox="gallery-image" href="/asset/images/portfolio/81l.jpg" class="hidden"></a>
             <a href="portfolio-page-grid-gallery.html"><i class="icon-link"></i></a>
           </div>
         </div>
       </div>


       <div class="portfolio-item img-zoom ct-photography ct-media ct-branding ct-marketing ct-webdesign">
         <div class="portfolio-item-wrap">
           <div class="portfolio-image">
             <a href="#"><img src="/asset/images/portfolio/67.jpg" alt=""></a>
           </div>
           <div class="portfolio-description" data-lightbox="gallery">
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/83l.jpg" class="hidden"></a>
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/82l.jpg" class="hidden"></a>
             <a title="Photoshop Mock-up!" data-lightbox="gallery-image" href="/asset/images/portfolio/80l.jpg"><i class="icon-copy"></i></a>
             <a title="Paper Pouch!" data-lightbox="gallery-image" href="/asset/images/portfolio/81l.jpg" class="hidden"></a>
             <a href="portfolio-page-grid-gallery.html"><i class="icon-link"></i></a>
           </div>
         </div>
       </div>


       <div class="portfolio-item ct-photography ct-media ct-branding ct-Media ct-marketing ct-webdesign">
          <div class="portfolio-item-wrap">
             <div class="portfolio-slider">
               <div class="carousel" data-items="1" data-loop="true" data-autoplay="true" data-animate-in="fadeIn" data-animate-out="fadeOut" data-autoplay="1500">
                 <a href="#"><img src="/asset/images/portfolio/68.jpg" alt=""></a>
                 <a href="#"><img src="/asset/images/portfolio/71.jpg" alt=""></a>
               </div>
             </div>
             <div class="portfolio-description" data-lightbox="gallery">
               <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/83l.jpg" class="hidden"></a>
               <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/82l.jpg" class="hidden"></a>
               <a title="Photoshop Mock-up!" data-lightbox="gallery-image" href="/asset/images/portfolio/80l.jpg"><i class="icon-copy"></i></a>
               <a title="Paper Pouch!" data-lightbox="gallery-image" href="/asset/images/portfolio/81l.jpg" class="hidden"></a>
               <a href="portfolio-page-grid-gallery.html"><i class="icon-link"></i></a>
             </div>
          </div>
       </div>


       <div class="portfolio-item img-zoom ct-photography ct-marketing ct-media">
         <div class="portfolio-item-wrap">
           <div class="portfolio-image">
             <a href="#"><img src="/asset/images/portfolio/69.jpg" alt=""></a>
           </div>
           <div class="portfolio-description" data-lightbox="gallery">
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/83l.jpg" class="hidden"></a>
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/82l.jpg" class="hidden"></a>
             <a title="Photoshop Mock-up!" data-lightbox="gallery-image" href="/asset/images/portfolio/80l.jpg"><i class="icon-copy"></i></a>
             <a title="Paper Pouch!" data-lightbox="gallery-image" href="/asset/images/portfolio/81l.jpg" class="hidden"></a>
             <a href="portfolio-page-grid-gallery.html"><i class="icon-link"></i></a>
           </div>
         </div>
       </div>


       <div class="portfolio-item img-zoom ct-marketing ct-media ct-branding ct-marketing ct-webdesign">
         <div class="portfolio-item-wrap">
           <div class="portfolio-image">
             <a href="#"><img src="/asset/images/portfolio/70.jpg" alt=""></a>
           </div>
           <div class="portfolio-description" data-lightbox="gallery">
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/83l.jpg" class="hidden"></a>
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/82l.jpg" class="hidden"></a>
             <a title="Photoshop Mock-up!" data-lightbox="gallery-image" href="/asset/images/portfolio/80l.jpg"><i class="icon-copy"></i></a>
             <a title="Paper Pouch!" data-lightbox="gallery-image" href="/asset/images/portfolio/81l.jpg" class="hidden"></a>
             <a href="portfolio-page-grid-gallery.html"><i class="icon-link"></i></a>
           </div>
         </div>
       </div>


       <div class="portfolio-item img-zoom ct-photography ct-media ct-branding ct-Media">
         <div class="portfolio-item-wrap">
           <div class="portfolio-image">
             <a href="#"><img src="/asset/images/portfolio/71.jpg" alt=""></a>
           </div>
           <div class="portfolio-description" data-lightbox="gallery">
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/83l.jpg" class="hidden"></a>
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/82l.jpg" class="hidden"></a>
             <a title="Photoshop Mock-up!" data-lightbox="gallery-image" href="/asset/images/portfolio/80l.jpg"><i class="icon-copy"></i></a>
             <a title="Paper Pouch!" data-lightbox="gallery-image" href="/asset/images/portfolio/81l.jpg" class="hidden"></a>
             <a href="portfolio-page-grid-gallery.html"><i class="icon-link"></i></a>
           </div>
         </div>
       </div>


       <div class="portfolio-item img-zoom ct-photography ct-media ct-branding ct-marketing ct-webdesign">
         <div class="portfolio-item-wrap">
           <div class="portfolio-image">
             <a href="#"><img src="/asset/images/portfolio/72.jpg" alt=""></a>
           </div>
           <div class="portfolio-description" data-lightbox="gallery">
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/83l.jpg" class="hidden"></a>
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/82l.jpg" class="hidden"></a>
             <a title="Photoshop Mock-up!" data-lightbox="gallery-image" href="/asset/images/portfolio/80l.jpg"><i class="icon-copy"></i></a>
             <a title="Paper Pouch!" data-lightbox="gallery-image" href="/asset/images/portfolio/81l.jpg" class="hidden"></a>
             <a href="portfolio-page-grid-gallery.html"><i class="icon-link"></i></a>
           </div>
         </div>
       </div>


       <div class="portfolio-item img-zoom ct-photography ct-marketing ct-media">
         <div class="portfolio-item-wrap">
           <div class="portfolio-image">
             <a href="#"><img src="/asset/images/portfolio/73.jpg" alt=""></a>
           </div>
           <div class="portfolio-description" data-lightbox="gallery">
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/83l.jpg" class="hidden"></a>
             <a title="Mock-up" data-lightbox="gallery-image" href="/asset/images/portfolio/82l.jpg" class="hidden"></a>
             <a title="Photoshop Mock-up!" data-lightbox="gallery-image" href="/asset/images/portfolio/80l.jpg"><i class="icon-copy"></i></a>
             <a title="Paper Pouch!" data-lightbox="gallery-image" href="/asset/images/portfolio/81l.jpg" class="hidden"></a>
             <a href="portfolio-page-grid-gallery.html"><i class="icon-link"></i></a>
           </div>
         </div>
       </div> -->

     </div><br><br>
       <!-- <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item active"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">4</a></li>
        <li class="page-item"><a class="page-link" href="#">5</a></li>
        <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
       </ul> -->
       <?php
       $output = '<ul class="pagination">';
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
            <li class="page-item active"><a class="page-link" href="javascript:void(0)">'.$page_array[$count].'<span class="sr-only">(current)</span></a></li>
           ';

           $previous_id = $page_array[$count] - 1;
           if($previous_id > 0){
             $previous_link = '
              <li class="page-item"><a class="page-link" href="/memes/'.$uri[2].'/page='.$previous_id.'"><i class="fa fa-angle-left"></i></a></li>
             ';
           }else{
             $previous_link = '
              <li class="page-item disabled"><a class="page-link" href="javascript:void(0)"><i class="fa fa-angle-left"></i></a></li>
             ';
           }

           $next_id = $page_array[$count] + 1;
           if($next_id >= $total_links){
             $next_link = '
              <li class="page-item disabled"><a class="page-link" href="javascript:void(0)"><i class="fa fa-angle-right"></i></a></li>
             ';
           }else{
             $next_link = '
              <li class="page-item"><a class="page-link" href="/memes/'.$uri[2].'/page='.$next_id.'"><i class="fa fa-angle-right"></i></a></li>
             ';
           }

         }else{
           if($page_array[$count] == '...'){
             $page_link .= '
              <li class="page-item disabled"><a class="page-link" href="javascript:void(0)">...</a></li>
             ';
           }else{
             $page_link .= '
              <li class="page-item"><a class="page-link" href="/memes/'.$uri[2].'/page='.$page_array[$count].'">'.$page_array[$count].'</a></li>
             ';
           }
         }
       }

       $output .= $previous_link . $page_link . $next_link;
       $output.= '
         </ul>
       ';
       echo $output;

        ?>
   </div>
 </section>


 <?php include "includes/footer.php" ?>
