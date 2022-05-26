<?php
 $uro = 'https://'.$_SERVER['HTTP_HOST']."/";
$bd = previewBody($post['hom_mav_content'], 22);
$rf = strip_tags($bd);
// $tn = $site_name." - ".ucwords($post['hom_mav_title']);
$tn = ucwords($post['hom_mav_title']);

echo '<title>'.$tn.'</title>
<meta name="format-detection" content="telephone=no"/>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<link rel="icon" type="image/png" href="/uploads/POSTS/'.$post['hom_mav_image'].'">
';
$cut = explode(' ',$post['hom_mav_title']);
$metakeys = implode(',',$cut).",";
echo '<meta name="description" content="'.$rf.'" />
<meta name="keywords" content="'.$metakeys.'blog">';
echo '<meta property="og:title" content="'.$site_name." - ".ucwords($post['hom_mav_title']).'" />
<meta property="og:type" content="article" />
<meta property="og:image" content="'.$uro.'uploads/POSTS/'.$post['hom_mav_image'].'" />
<meta property="og:image:width" content="450"/>
<meta property="og:image:height" content="298"/>
<meta property="og:description" content="'.$rf.'" />';
echo '<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="'.$site_name." - ".ucwords($post['hom_mav_title']).'">
<meta name="twitter:description" content="'.$rf.'">
<meta name="twitter:image" content="'.$uro.'uploads/POSTS/'.$post['hom_mav_image'].'">
<meta name="twitter:image:width" content="280">
<meta name="twitter:image:height" content="150">';
 ?>
