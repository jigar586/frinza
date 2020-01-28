<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/headerlinks.php') ?>

<style type="text/css">
    .pageData {
        display: none !important;
    }

    .page-active {
        display: block !important;
    }

    .pageLi {
        display: none;
    }

    #perPagePost {
        margin: 0;
        background: #f8f8f8;
        padding: 6px;
    }

    @media only screen and (min-width:320px) and (max-width:479px) {
        li.item.col-xs-6:nth-child(2n+1) {
            padding-right: 6px !important;
        }

        li.item.col-xs-6:nth-child(2n) {
            padding-left: 6px !important;
        }
    }

    .mobileHide {
        display: block;
    }

    .mobileShow {
        display: none;
    }

    .btn-gray {
        color: #fff !important;
        background: gray !important;
        border: 0 !important;
    }

    .myBtn.btn-continue{
        width: 100%;
    }
    .myBtn.btn-continue:hover{
        background: #e62263c2;
        border: 1px solid #000;
    }
</style>

<body class="category-page">
    <div id="page">
        
        <?php include_once('includes/header.php') ?>
 
        <?php include_once('includes/navigation.php') ?>
        
        <section class="main-container col2-left-layout bounceInUp animated">
            <div class="container">
                <div class="row">

                    <div class="col-sm-9 col-sm-push-3 noPadding">
                        <?php include_once('includes/category_slider.php') ?>

                        <?php if($icons[0]->banner_type == 'icon'){ ?>
                            <section class="noMargin">
                                <div class="brand-logo"> 
                                    <div class="container">
                                        <div class="slider-items-products">
                                            <div id="productList-products-slider" class="product-flexslider hidden-buttons" style="margin-bottom: 0;">
                                                <div class="slider-items slider-width-col6"> 
                                                
                                                <?php foreach( $icons as $ar ){ 
                                                        if($ar->banner_type == 'icon'){
                                                    ?>
                                                    <div class="item"> <a href="<?= $ar->url ?>"><img src="<?= FOLDER_ASSETS_TEMPLATEBANNER.$ar->banner_img ?>" alt="<?= $ar->banner_name ?>" height="90"> </a> <h5 style="font-weight: bold;"> <?= $ar->banner_name ?> </h5> </div>
                                                <?php } } ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>                  
                        <?php }  ?>

                        <?php if($icons){ ?>
                            <section class="noMargin">
                                <div class="">
                                    <div class="container">
                                        <div style="padding-top:5px;">
                                            <?php foreach( $icons as $ar ){ 
                                                if($ar->banner_type == 'text'){
                                            ?>
                                                <div class="col-md-2 col-xs-6" style="padding: 5px;">
                                                    <a target="_blank" href="<?= $ar->url ?>"><button type="button" class="button myBtn btn-continue btn"><span><?= $ar->banner_name ?></span></button></a>
                                                </div>
                                            <?php } } ?>
                                        </div>
                                    </div>
                                </div>
                            </section> 
                        <?php }  ?>

                        <article class="col-main" style="margin-top: 10px;">
                            <h1 class="page-heading"><?= $catName ?></h1>
                            <h5 for="" class="mobileHide"><?= $description ?></h5>
                            <div class="col-xs-12 mobileShow noPadding" style="display: none;">
                                <div class="col-xs-4 noPadding" style="padding: 2px;">
                                    <a class=" text-center" href="?filt="><button class="btn button btn-block <?php if($this->input->get('filt') == ''){ echo "active"; } ?>"><i class="fa fa-star"></i> Popularity</button></a>
                                </div>
                                <div class="col-xs-4 noPadding" style="padding: 2px;">
                                    <a class=" text-center" href="?filt=asc"><button class="btn button btn-block  <?php if($this->input->get('filt') == 'asc'){ echo "active"; } ?>"><i class="fa fa-arrow-down"></i> Low to High</button></a>
                                </div>
                                <div class="col-xs-4 noPadding" style="padding: 2px;">
                                    <a class=" text-center" href="?filt=desc"><button class="btn button btn-block text-center <?php if($this->input->get('filt') == 'desc'){ echo "active"; } ?>"><i class="fa fa-arrow-up"></i> High to Low</button></a>
                                </div>
                            </div>
                            <div class="category-products tab-content" id="productContent">
                            </div>
                            <div class="toolbar">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-md-12 pull-center text-center">
                                        <div class="pager">
                                            <div class="pages">
                                                <ul class="pagination">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="mobileHide">
                                    <?= $static_block ?>
                                </div>

                                <div class="accordion mobileShow" id="accordionExample" style="width:100%;">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button class="button btn-gray " type="button" data-toggle="collapse"
                                                    data-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne" style="width:100%;">
                                                    More Information
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                <?= $static_block ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </article>
                    </div>
                    <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9 noPadding mobileHide">
                        <aside class="col-left sidebar">
                            <div class="side-nav-categories">
                                <div class="block-title">
                                    <h3>Shop By Price</h3>
                                </div>
                                <div class="box-content box-category">
                                    <ul>
                                        <li><a href="?filt=asc">Low to High</a></li>
                                        <li><a href="?filt=desc">High to Low</a></li>
                                        <li><a href="?bl=200">below Rs. 200</a></li>
                                        <li><a href="?ab=200&bl=400">Rs. 200 - Rs. 400</a></li>
                                        <li><a href="?ab=400&bl=600">Rs. 400 - Rs. 600</a></li>
                                        <li><a href="?ab=600&bl=800">Rs. 600 - Rs. 800</a></li>
                                        <li><a href="?ab=800&bl=1000">Rs. 800 - Rs. 1000</a></li>
                                        <li><a href="?ab=1000">Rs. 1000 Above</a></li>
                                    </ul>

                                </div>
                                <!--box-content box-category-->
                            </div>
                        </aside>
                        <aside class="col-left sidebar">
                            <div class="side-nav-categories">
                                <div class="block-title">
                                    <h3>Categories</h3>
                                </div>
                                <div class="box-content box-category">
                                    <ul>
                                        <?php
										foreach ($category as $cat) {
											$catURL = base_url('').url_title($cat->category_heading,'-',TRUE).'/c'.$cat->category_id;
											?>
                                        <li> <a href="<?= $catURL ?>"><?= $cat->category_name ?></a> <span
                                                class="subDropdown plus"></span>
                                            <ul>
                                                <?php
														$tempSub = $this->shop->getSubCategory($cat->category_id);
														foreach ($tempSub as $sub) {
													?>
                                                <li> <a href="#"> <?= $sub->subcategory_name ?> </a> <span
                                                        class="subDropdown minus"></span>
                                                    <ul class="level1">
                                                        <?php
																	$tempChild = $this->shop->getChildCategory($sub->subcategory_id);
																	foreach ($tempChild as $cc) {
																		$childURL = base_url('').url_title($cc->child_heading,'-',TRUE).'/cc'.$cc->child_id;
																?>
                                                        <li> <a href="<?= $childURL ?>"><?= $cc->child_name ?></a> </li>
                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <?php } ?>
                                    </ul>

                                </div>
                                <!--box-content box-category-->
                            </div>
                            <?php if (count($OfferBan) != 0) { ?>
                            <div class="custom-slider">
                                <div>
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <?php 
                                                for ($j=0; $j < count($OfferBan) ; $j++) { 
                                            ?>
                                            <li class="<?php if($j == 0){echo 'active';} ?>"
                                                data-target="#carousel-example-generic" data-slide-to="<?= $j ?>"></li>
                                            <?php }
																?>
                                        </ol>
                                        <div class="carousel-inner">
                                            <?php
                                                $i = 0;
                                                foreach ($OfferBan as $ob) {
                                                    $offerImg = json_decode($ob->banner);
                                                    
                                            ?>
                                            <div class="item <?php if($i == 0){echo 'active'; $i++;} ?>"><img src="<?= FOLDER_ASSETS_TEMPLATEBANNER.$offerImg[0] ?>" alt="slide2">
                                                <div class="carousel-caption">
                                                    <h3><a title="<?= $ob->offer_name ?>" href="#">
                                                    <?php
                                                        if ($ob->offer_type == 1) {
                                                            echo "₹".$ob->amount;
                                                        }else{
                                                            echo $ob->amount."%";
                                                        }
                                                        if ($ob->is_coupon == 1) {
                                                            echo " Cashback";
                                                        }else{
                                                            echo " OFF";
                                                        }
                                                    ?>
                                                        </a></h3>
                                                    <p><?= $ob->offer_name ?></p>
                                                </div>
                                            </div>

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        
        <?php include_once('includes/brands.php') ?>
        
        <?php include_once('includes/footer.php') ?>
    </div>
    <?php include_once('includes/mobilemenu.php') ?>
    
    <?php include_once('includes/footerlinks.php') ?>
    <script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>js/jquery.twbsPagination.js"></script>
    <script>
    var pageSize = "12";
    var pageCount = "<?= $productCount[0]->count ?>";
    var perPageNo = Math.ceil(pageCount / pageSize);
    $('.pagination').twbsPagination({
        totalPages: perPageNo,
        startPage: 1,
        visiblePages: 6,
        initiateStartPageClick: true,
        href: false,
        hrefVariable: '{{number}}',

        // Text labels
        first: '«',
        prev: '',
        next: '',
        last: '»',

        // carousel-style pagination
        loop: false,

        // callback function
        onPageClick: function(event, page) {
            var formData = new FormData();

            var cond = '<?= json_encode($newProducts) ?>';
            formData.set('arr', cond);
            formData.set('pageNo', (page - 1) * 12);
            $('#productContent').html('');
            $.ajax({
                url: '<?= base_url('product/loadlist') ?>',
                type: 'post',
                contentType: false,
                processData: false,
                data: formData,
                success: function(a) {
                    $('#productContent').html(a);
                    var scrollpos = ($(".page-heading").offset().top - 50) > 50 ? ($(
                        ".page-heading").offset().top - 50) : 50;
                    $('html, body, #page').animate({
                        scrollTop: scrollpos
                    }, 200);
                }
            })
        },

        // pagination Classes
        paginationClass: 'pagination',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first',
        pageClass: 'pageLi',
        activeClass: 'active',
        disabledClass: 'disabled'

    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.button').click(function() {
            $('.button-active').removeClass('button-active');
            $(this).addClass('button-active');
        });
    })
    </script>
</body>

</html>