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
  <style type="text/css">
  .myBorderBox{
      border: 1px solid #d8d8d8;
      padding: 15px;
      box-shadow: 0px 0px 7px 0px #dedede;
  }
  </style>
  <!-- main-container -->
  <div class="main-container col2-right-layout">
    <div class="main container noPadding">
      <div class="row">
        <section class="col-sm-12">
        <div class="col-main">
          <div class="text-center">
            
              <img class="img-responsive" src="<?= base_url().'assets/templatedata/images/thank-you.png' ?>" style="margin-bottom: 10px;">
          </div>

          <?php foreach($orderdataList as $orderdata){ 
            $img = json_decode($orderdata->product_img)[0];
            ?>
            <div class="row" style="margin-bottom: 20px;">
              <div class="col-sm-2">
              </div>
              <div class="col-sm-8">
                <div class="myBorderBox">
                  <div class="row">
                    <div class="col-sm-3">
                      <img class="img img-responsive" src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.@$img ?>">
                    </div>
                    <div class="col-sm-9">
                      <label><b><?= @$orderdata->product_title ?></b></label>
                      <br>
                      <label><b>Qty:</b> <?= @$orderdata->qty ?></label>
                      <br>
                      <label><b>price:</b> ₹<?= @$orderdata->price ?></label>
                      <br>
                      <label><b>Delivery Date:</b>&nbsp; <?= @date('d M,y',strtotime($orderdata->ship_from)) ?></label>
                      <br>
                      <label><b>Time Slot:</b>&nbsp;<?= @date('h:i A',strtotime($orderdata->ship_from)).' - '.@date('h:i A',strtotime($orderdata->ship_till)) ?></label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
          <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8 text-center">
              <button onclick="window.location.href = '<?= base_url() ?>" class="btn btn-share btn-lg btn-continue" title="Continue Shopping" type="button" style="margin-right: 20px; "><span>Go Home</span></button>
              <button onclick="window.location.href = '<?= base_url('dashboard') ?>'" class="btn btn-lg btn-continue" title="Continue Shopping" type="button"><span>My Account</span></button>
            </div>
          </div>
        </div>
        </section>
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