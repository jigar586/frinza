<!DOCTYPE html>

<html lang="en">

<?php include_once('includes/headerlinks.php') ?>

<body class="shopping-cart-page">

<div id="page"> 

<!-- Header -->

<?php include_once('includes/header.php') ?>  

<!-- end header --> 

  

  <!-- Navigation -->

  

  <?php include_once('includes/navigation.php') ?>

  <!-- end nav -->

  

  <!-- Breadcrumbs -->

  <!-- <div class="breadcrumbs">

    <div class="container">

      <div class="row">

        <div class="col-xs-12">

          <ul>

            <li class="home"> <a title="Go to Home Page" href="<?= base_url() ?>">Home</a> <span>/</span> </li>

            <li class="category1601"> <strong>About Us</strong> </li>

          </ul>

        </div>

      </div>

    </div>

  </div> -->

  

  

  <!-- main-container -->

  <div class="main-container col2-right-layout">

    <div class="main container noPadding">

      <div class="row">

        <section class="col-sm-9">

        <div class="col-main">

          <div class="page-title">

            <h1>Refund and Cancellation  Policy</h1>

          </div>

          <div class="">
            <?= $content[0]->page_data ?>
          </div>
        </div>

        </section>

        <aside class="col-right sidebar col-sm-3 col-xs-12">

          <div class="block block-company">

            <!-- <div class="block-title"><h3>Company</h3></div> -->

            <div class="block-content">

              <ol id="recently-viewed-items">

                <li class="item odd"><a href="<?= base_url('aboutus') ?>">About Us</a></li>

                <li class="item even"><a href="<?= base_url('sitemap') ?>">Sitemap</a></li>

                <li class="item  odd"><a href="<?= base_url('terms') ?>">Terms and Condition</a></li>

                <li class="item even"><a href="<?= base_url('contactus') ?>">Contact Us</a></li>
                <li class="item even"><a href="<?= base_url('career') ?>">Career</a></li>
                <li class="item odd"><strong>Refund and Cancellation Policy</strong></li>
                <li class="item last"><a href="<?= base_url('privacypolicy ') ?>">Privacy Policy</a></li>
              </ol>

            </div>

          </div>

        </aside>

      </div>

    </div>

  </div>

  <!--End main-container --> 

  





 <!-- Brands & Feature -->  

<?php include_once('includes/brands.php') ?>

  <!-- Footer -->

<?php include_once('includes/footer.php') ?>

</div>

<?php include_once('includes/mobilemenu.php') ?>



<!-- End Footer -->



<!-- JavaScript --> 

<?php include_once('includes/footerlinks.php') ?>

</body>

</html>