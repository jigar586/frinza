<head>

<meta http-equiv="x-ua-compatible" content="ie=edge">

<!--[if IE]>

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<![endif]-->

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="Description" content="Frinza provides best online cake, flowers and gifts delivery services across in India. Order now to get best discounts on fresh cake, gifts and flowers with Same day delivery, Midnight delivery, Fixed time delivery options">

<meta name="Keywords" content="1 Online Flower Delivery Portal In India, Send Flowers Online from Frinza - India's No. 1 Online Florist, Same Day Flower Delivery - in 2 Hours or even less!, Wide Variety of Fresh Cut Flowers For Every Occasion">

<!-- Favicons Icon -->

<link rel="icon" href="<?= FOLDER_ASSETS_TEMPLATEDATA ?>/favicon.png" type="image/x-icon" />

<?php if (!empty($product)) {

	echo "<title>".$product[0]->product_title."| Flower Delivery Online | India’s Leading Florist company – Frinza</title>";

	echo '<meta name="title" content="'.$product[0]->product_title.' | Flower Delivery Online | India’s Leading Florist company – Frinza">';

	echo '<meta name="abstract" content="'.$product[0]->product_title.' | Flower Delivery Online | India’s Leading Florist company – Frinza (Frinza.com)">';

	echo "<meta name='description' content='{$product[0]->meta_description}'>";

  	echo "<meta name='keywords' content='{$product[0]->meta_keyword}'>";

}elseif (!empty($blog)) {

	echo "<title>".$blog[0]->title."| Flower Delivery Online | India’s Leading Florist company – Frinza</title>";

	echo '<meta name="title" content="'.$blog[0]->title.' | Flower Delivery Online | India’s Leading Florist company – Frinza">';

	echo '<meta name="abstract" content="'.$blog[0]->title.' | Flower Delivery Online | India’s Leading Florist company – Frinza (Frinza.com)">';

}elseif (@$page_meta_title) {

	echo "<title>".$page_meta_title."</title>";

	echo "<meta name='title' content='".$page_meta_title."'>";

	echo "<meta name='description' content='{$meta_description}'>";

	echo "<meta name='keywords' content='{$meta_keywords}'>";
	  
	echo '<meta name="abstract" content="'.$page_meta_title.'">';

}

else{ ?>

<title>#1 Online Cakes, Flowers, Unique and Personalised Gifts Delivery in India | India's Leading Gifting Company | Frinza</title>

<meta name="title" content="#1 Online Cakes, Flowers, Unique and Personalised Gifts Delivery in India | India's Leading Gifting Company | Frinza">

<meta name="abstract" content="Flower Delivery Online | India’s Leading Florist company – Frinza (Frinza.com)">

<?php } ?>

<!-- Mobile Specific -->

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126647754-1"></script>

<script>

	window.dataLayer = window.dataLayer || [];

	function gtag(){dataLayer.push(arguments);}

	gtag('js', new Date());

	gtag('config', 'UA-126647754-1');

</script>
<!-- Facebook Pixel Code -->
	<noscript>
		<img height="1" width="1" 
		src="https://www.facebook.com/tr?id=247082639516869&ev=PageView
		&noscript=1"/>
	</noscript>
<!-- End Facebook Pixel Code -->

 <!-- Global site tag (gtag.js) - Google Ads: 771650075 --> 

 <script async src="https://www.googletagmanager.com/gtag/js?id=AW-771650075"></script> 

 <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-771650075'); </script>

 <?php

 if (!empty($orderdataList) && count($orderdataList)) {

 	echo "<!-- Event snippet for Purchase conversion page --> <script> gtag('event', 'conversion', { 'send_to': 'AW-771650075/aqpWCJuC5JQBEJvk-e8C', 'transaction_id': '' }); </script>";

 }

 ?>

<!-- CSS Style -->

<link rel="stylesheet" type="text/css" href="<?= FOLDER_ASSETS_TEMPLATEDATA ?>css/bootstrap.min.css">

<?php if (!empty($product)) { ?>

<link rel="stylesheet" type="text/css" href="<?= FOLDER_ASSETS_TEMPLATEDATA ?>css/bootstrap-datepicker3.css">

<?php } ?>

<link rel="stylesheet" type="text/css" href="<?= FOLDER_ASSETS_TEMPLATEDATA ?>css/font-awesome.css" media="all">

<link rel="stylesheet" type="text/css" href="<?= FOLDER_ASSETS_TEMPLATEDATA ?>css/owl.carousel.css">

<link rel="stylesheet" type="text/css" href="<?= FOLDER_ASSETS_TEMPLATEDATA ?>css/owl.theme.css">

<link rel="stylesheet" type="text/css" href="<?= FOLDER_ASSETS_TEMPLATEDATA ?>css/jquery.mobile-menu.css">

<link rel="stylesheet" type="text/css" href="<?= FOLDER_ASSETS_TEMPLATEDATA ?>css/style.css" media="all">

<link rel="stylesheet" type="text/css" href="<?= FOLDER_ASSETS_TEMPLATEDATA ?>css/revslider.css">

<link rel="stylesheet" type="text/css" href="<?= FOLDER_ASSETS_TEMPLATEDATA ?>css/blogmate.css">

<?php if (0) { ?>

<link rel="stylesheet" type="text/css" href="<?= FOLDER_ASSETS_TEMPLATEDATA ?>css/fancybox.css">

<link rel="stylesheet" type="text/css" href="<?= FOLDER_ASSETS_TEMPLATEDATA ?>css/loader.css">

<?php } ?>

<!-- Google Fonts -->

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<style>
.swal2-popup{
	font-size: 1.4rem !important;
	width: auto !important;
}

</style>
</head>

<!-- Google Tag Manager 
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NP65CB9');</script>
 End Google Tag Manager -->

<!-- Google Tag Manager (noscript) 
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NP65CB9"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
 End Google Tag Manager (noscript) -->