<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/headerlinks.php') ?>
<style type="text/css">
@media only screen and (max-width: 479px) and (min-width: 320px) {
    .blog-preview_desc {
        display: none;
    }
}
</style>

<body class="cms-index-index cms-home-page">
    <div id="page">
        
        <?php include_once('includes/header.php') ?>
        
        <?php include_once('includes/navigation.php') ?>
       
        <?php include_once('includes/slider.php') ?>
		<?php if($icons){ ?>
		<section class="noMargin">
			<div class="brand-logo" style="padding:0; margin:15px 0;">
				<div class="container">
					<div class="slider-items-products">
						<div id="icon-products-slider" class="product-flexslider hidden-buttons" style="margin-bottom: 0;">
							<div class="slider-items slider-width-col6"> 
							
							<?php foreach( $icons as $ar ){ ?>
								
								<div class="item"> <a href="<?= $ar->url ?>"><img src="<?= FOLDER_ASSETS_TEMPLATEBANNER.$ar->banner_img ?>" alt="<?= $ar->banner_name ?>" height="55"> </a> <h5 style="font-weight: bold;"> <?= $ar->banner_name ?> </h5> </div>
							
							<?php } ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
							
		<?php
		} 
		$mnbv = 0;
		for ($i=0; $i < $catCNT; $i++) { 
			$jklm = 'homeCatNameData'.$i;
			$jkdesc = 'homeCatDescData'.$i;
			$ijkl = 'homeCatProData'.$i;
			$klmn = 'homeCatIDData'.$i;
			
			if (@count($$ijkl) != 0) {
				if ($mnbv % 2 == 0) { ?>
            <section class="bestsell-pro noMargin">
                <div class="container noPadding">
                    <div class="related-pro">
                        <div class="slider-items-products">
                            <div class="related-block noMargin" style="margin:0;">
                                <div id="related-products-slider" class="product-flexslider hidden-buttons">
                                    <div class="home-block-inner">
                                        <div class="block-title">
                                            <h2>
                                                <?php
                                                    $asdkasdaosdk = explode(' ', $$jklm);
                                                    if (count($asdkasdaosdk) > 1) {
                                                        echo @$asdkasdaosdk[0];
                                                        unset($asdkasdaosdk[0]);
                                                        echo '<br><em>'.implode(' ',$asdkasdaosdk).'</em>';
                                                    } else {
                                                        echo $$jklm;
                                                    }
                                                ?>
                                            </h2>
                                        </div>
                                        <div class="pretext"><?= $$jkdesc ?></div>
                                        <?php $catPath = $i == 0 ? 'cc' : 'c'; ?>
                                        <a href="<?= base_url(url_title($$jklm,'-',TRUE).'/'.$catPath.$$klmn)?>"
                                            class="view_more_bnt">View All</a>
                                    </div>
                                    <div class="slider-items slider-width-col4 products-grid block-content">
                                        <?php foreach ($$ijkl as $rp) {
                                                $imgs = json_decode($rp->product_img);
                                        ?>
                                        <div class="item">
                                            <div class="item-inner">
                                                <div class="item-img">
                                                    <div class="item-img-info">
                                                        <a class="product-image" title="<?= $rp->product_title ?>"
                                                            href="<?= base_url('').url_title($rp->product_title,'-',TRUE).'/p'.$rp->product_id ?>">
                                                            <img alt="<?= $rp->product_title ?>" class="lazy"
                                                                src="<?= PLACEHOLDER_IMAGE ?>"
                                                                data-src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$imgs[0] ?>">
                                                        </a>
                                                        <?php
                                                            if (compareDate($rp->created_at,3)) { ?>
                                                        <div class="new-label new-top-left">new</div>
                                                        <?php  } ?>
                                                        <div class="box-hover">
                                                            <ul class="add-to-links">
                                                                <?php if(0){ ?>
                                                                <li><a class="link-quickview" data-toggle="modal"
                                                                        data-target="#quickView" href="javascript:void(0)"
                                                                        onclick="quickView(<?= $rp->product_id ?>)">Quick
                                                                        View</a>
                                                                </li>
                                                                <?php } ?>
                                                                <li><a class="link-wishlist" href="javascript:void(0)"
                                                                        onclick="addToWish(<?= $rp->product_id ?>)">Wishlist</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info">
                                                    <div class="info-inner">
                                                        <div class="item-title">
                                                            <h4>
                                                                <a title="<?= $rp->product_title ?>" href="<?= base_url('').url_title($rp->product_title,'-',TRUE).'/p'.$rp->product_id ?>"><?= $rp->product_title ?></a>
                                                            </h4>
                                                        </div>
                                                        <div class="rating">
                                                            <div class="ratings">
                                                                <div class="rating-box">
                                                                    <div class="rating" style="width: <?= getAvgRating($rp->product_id) ?>%">
                                                                    </div>
                                                                </div>
                                                                <p class="rating-links"> <a href="#"><?= getRatingCount($rp->product_id) ?> Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                            </div>
                                                        </div>
                                                        <div class="item-content">
                                                            <div class="item-price">
                                                                <div class="price-box">
                                                                    <?php
                                                                        $price = $rp->price;
                                                                        $sPrice = offeredPrice($price,$rp->product_id,$rp->child_id,$rp->category_id);
                                                                        if ($price > $sPrice) { ?>
                                                                    <p class="special-price">
                                                                        <span class="price-label">Special Price</span>
                                                                        <span class="price">₹<?= $sPrice ?></span>
                                                                    </p>
                                                                    <p class="old-price">
                                                                        <span class="price-label">Regular Price:</span>
                                                                        <span class="price">₹<?= $price ?></span>
                                                                    </p>
                                                                    <?php } elseif ($price < $sPrice) { ?>
                                                                    <span class="regular-price">
                                                                        <span class="price">₹<?= $sPrice ?></span>
                                                                    </span>
                                                                    <?php }else{ ?>
                                                                    <span class="regular-price">
                                                                        <span class="price">₹<?= $price ?></span>
                                                                    </span>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        <?php  }else{ ?>
            <section class="featured-pro noMargin">
                <div class="container noPadding">
                    <div class="slider-items-products">
                        <div class="featured-block">
                            <div id="related-products-slider" class="product-flexslider hidden-buttons">
                                <div class="home-block-inner">
                                    <div class="block-title">
                                        <h2>
                                            <?php
                                                $asdkasdaosdk = explode(' ', $$jklm);
                                                if (count($asdkasdaosdk) > 1) {
                                                    echo @$asdkasdaosdk[0];
                                                    unset($asdkasdaosdk[0]);
                                                    echo '<br><em>'.implode(' ',$asdkasdaosdk).'</em>';
                                                } else {
                                                    echo $$jklm;
                                                }
                                            ?>
                                        </h2>
                                    </div>
                                    <div class="pretext"><?= $$jkdesc ?></div>
                                    <a href="<?= base_url(url_title($$jklm,'-',TRUE).'/c'.$$klmn) ?>"
                                        class="view_more_bnt">View All</a>
                                </div>
                                <div class="slider-items slider-width-col4 products-grid block-content">
                                    <?php foreach ($$ijkl as $rp) {
                                        $imgs = json_decode($rp->product_img);
                                    ?>
                                    <div class="item">
                                        <div class="item-inner">
                                            <div class="item-img">
                                                <div class="item-img-info">
                                                    <a class="product-image" title="<?= $rp->product_title ?>" href="<?= base_url('').url_title($rp->product_title,'-',TRUE).'/p'.$rp->product_id ?>">
                                                        <img alt="<?= $rp->product_title ?>" class="lazy" src="<?= PLACEHOLDER_IMAGE ?>" data-src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$imgs[0] ?>">
                                                    </a>
                                                    <?php
                                                        if (compareDate($rp->created_at,3)) { ?>
                                                    <div class="new-label new-top-left">new</div>
                                                    <?php  } ?>
                                                    <div class="box-hover">
                                                        <ul class="add-to-links">
                                                            <?php if (0) { ?>
                                                            <li><a class="link-quickview" data-toggle="modal" data-target="#quickView" href="javascript:void(0)" onclick="quickView(<?= $rp->product_id ?>)">Quick
                                                                    View</a>
                                                            </li>
                                                            <?php } ?>
                                                            <li><a class="link-wishlist" href="javascript:void(0)" onclick="addToWish(<?= $rp->product_id ?>)">Wishlist</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info">
                                                <div class="info-inner">
                                                    <div class="item-title">
                                                        <h4>
                                                            <a title="<?= $rp->product_title ?>" href="<?= base_url('').url_title($rp->product_title,'-',TRUE).'/p'.$rp->product_id ?>"><?= $rp->product_title ?></a>
                                                        </h4>
                                                    </div>
                                                    <div class="rating">
                                                        <div class="ratings">
                                                            <div class="rating-box">
                                                                <div class="rating" style="width: <?= getAvgRating($rp->product_id) ?>%">
                                                                </div>
                                                            </div>
                                                            <p class="rating-links"> <a href="#"><?= getRatingCount($rp->product_id) ?> Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                        </div>
                                                    </div>
                                                    <div class="item-content">
                                                        <div class="item-price">
                                                            <div class="price-box">
                                                                <?php
                                                                    $price = $rp->price;
                                                                    $sPrice = offeredPrice($price,$rp->product_id,$rp->child_id,$rp->category_id);
                                                                    if ($price != $sPrice) { ?>
                                                                <p class="special-price">
                                                                    <span class="price-label">Special Price</span>
                                                                    <span class="price">₹<?= $sPrice ?></span>
                                                                </p>
                                                                <p class="old-price">
                                                                    <span class="price-label">Regular Price:</span>
                                                                    <span class="price">₹<?= $price ?></span>
                                                                </p>
                                                                <?php }else{ ?>
                                                                <span class="regular-price">
                                                                    <span class="price">₹<?= $price ?></span>
                                                                </span>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
		
        <?php  }
					$mnbv++;
				}
			}
		?>

        <div class="container noPadding">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-outer-container">
                        <div class="new_title">
                            <h2><strong>Latest</strong> Blog</h2>
                        </div>
                        <div class="blog-inner">
                            <?php foreach ($blogs as $r) {
								$id = $r->blog_id;
								$title = $r->title;
								$blogURL = base_url('blog/').$id.'/'.url_title($title);
								$catURL = base_url('blog/category/').$r->category.'/'.url_title($r->category_name);
								$date = date('Y-m-d H:i:s',strtotime($r->updated_at));
								$img = FOLDER_ASSETS_TEMPLATEBLOG.$r->blog_img;
								$comments = countBlogComment($id);
							?>
                            <div class="col-lg-6 col-md-6 col-sm-6 blog-preview_item">
                                <div class="entry-thumb image-hover2"> <a href="<?= $blogURL ?>"> <img alt="<?= word_limiter($title,5) ?>" src="<?= $img ?>"> </a> </div>
                                <div class="blog-preview_info">
                                    <ul class="post-meta">
                                        <li><i class="fa fa-comments"></i><a href="javascript:void(0)"><?= $comments ?> comments</a> </li>
                                        <li><i class="fa fa-calendar"></i><?= $date ?></li>
                                    </ul>
                                    <h4 class="blog-preview_title"><a href="<?= $blogURL ?>"><?= word_limiter($title,12) ?></a></h4>
                                    <div class="blog-preview_desc">
                                        <?= word_limiter(strip_tags($r->details,'<br>'),80) ?></div>
                                    <a class="blog-preview_btn" href="<?= $blogURL ?>">READ MORE</a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
			if (0) { ?>
        <div class="modal fade" id="quickView">
        </div>
        <?php } ?>
        <?php include_once('includes/brands.php') ?>

        <?php include_once('includes/footer.php') ?>
		
        <?php include_once( 'includes/mobilemenu.php') ?>
		
        <?php include_once('includes/footerlinks.php') ?>
        <script type="text/javascript">
        jQuery('#rev_slider_4').show().revolution({
            dottedOverlay: 'twoxtwo',
            navigationType: 'bullet',
        });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-beta.2/lazyload.js"></script>
        <script type="text/javascript">
        jQuery(function() {
            $("img.lazy").lazyload();
        })
        </script>
</body>

</html>