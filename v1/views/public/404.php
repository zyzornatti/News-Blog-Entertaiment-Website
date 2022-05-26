<?php
$page_name = "Page not found";
include "includes/header.php";
 ?>

 <section class="p-b-150 p-t-150" data-bg-parallax="/images/parallax/6.jpg">
   <div class="container">
     <div class="row">
       <div class="col-lg-6">
         <div class="page-error-404">404</div>
       </div>
       <div class="col-lg-6">
        <div class="text-left">
           <h1 class="text-medium text-light">Ooops, This Page Could Not Be Found!</h1>
           <p class="lead text-light">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
           <div class="seperator m-t-20 m-b-20"></div>
           <div class="search-form">
             <p class="text-light">What are you looking for?</p>
             <form id="widget-search-form-sidebar" action="/search" method="get">
               <div class="input-group">
                 <input type="text" aria-required="true" name="q" class="form-control widget-search-form" placeholder="Search...">
                 <div class="input-group-append">
                   <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                 </div>
               </div>
             </form>
           </div>
        </div>
       </div>
     </div>
   </div>
 </section>

 <?php include "includes/footer.php" ?>
