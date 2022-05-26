<?php

 $uro = 'https://'.$_SERVER['HTTP_HOST']."/";
echo '<title>'.ucwords($site_name).' - Home</title>
<meta name="format-detection" content="telephone=no"/>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<link rel="icon" type="image/png" href="/'.$logo.'">
';

echo '<meta name="description" content="'.$site_description.'" />
<meta name="keywords" content="'.$metakeys.' blog">';
echo '<meta property="og:title" content="'.ucwords($site_name).'- Home" />
<meta property="og:type" content="article" />
<meta property="og:image" content="'.$uro.$logo.'" />
<meta property="og:image:width" content="450"/>
<meta property="og:image:height" content="298"/>
<meta property="og:description" content="'.$site_description.'" />';
echo '<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="'.ucwords($site_name).'- Home">
<meta name="twitter:description" content="'.$site_description.'">
<meta name="twitter:image" content="'.$uro.$logo.'">
<meta name="twitter:image:width" content="280">
<meta name="twitter:image:height" content="150">';
 ?>
