<!DOCTYPE html>
<html lang="en">

<?php include_once('includes/headerlinks.php') ?>
<style>
    .mobileHide {
        display: block;
    }

    .mobileShow {
        display: none;
    }
</style>
<body class="category-page">
    <div id="page">
    
        <?php include_once('includes/header.php') ?>

        <?php include_once('includes/navigation.php') ?>
        <?php // echo "<pre>"; print_r($citiesList); ?>
        
        <section class="main-container col2-left-layout bounceInUp animated">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 noPadding">

                        <?php include_once('includes/category_slider.php') ?>

                        <article class="col-main">
                        
                            <h1 class="page-heading"><?= $categoryDetails[0]->subcategory_heading ?></h1>

                            <h5 for="" class="mobileHide"><?= $description ?></h5>
                        
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <?php foreach($citiesList as $cl){ ?>
                                            <div class="col-md-2 col-xs-6">
                                                <h5><a href="<?= base_url().url_title($cl->category_name,'-',TRUE).'/'.url_title($cl->child_name,'-',TRUE).'/cc'.$cl->child_id ?>"><?= $cl->child_name ?></a></h5>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
        
        <?php include_once('includes/brands.php') ?>
        
        <?php include_once('includes/footer.php') ?>

    </div>
    <?php include_once('includes/mobilemenu.php') ?>
</body>

</html>