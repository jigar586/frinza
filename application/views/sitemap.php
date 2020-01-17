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
  <section class="main-container col1-layout">
    <div class="main container">
      <div class="col-main">
        <div class="cart">
          <div class="page-title">
            <h1>Sitemap</h1>
          </div>
          <div class="row content-row">
            <section class="col-sm-9">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
              
              <!-- BEGIN BOX-CATEGORY -->
              <div class="box-content box-category">
                <ul>
                  <?php
                    foreach ($category as $cat) {
                      $catURL = base_url('category/').$cat->category_id.'/'.url_title($cat->category_name);
                    
                  ?>
                  <li> <a href = "<?= $catURL ?>"><?= $cat->category_name ?></a> <span class="subDropdown plus"></span>
                    <ul>
                      <?php
                        $tempSub = $this->shop->getSubCategory($cat->category_id);
                        foreach ($tempSub as $sub) {
                         
                        
                      ?>
                      <li> <a href = "#"> <?= $sub->subcategory_name ?> </a> <span class="subDropdown plus"></span>
                        <ul class="level1">
                        <?php
                          $tempChild = $this->shop->getChildCategory($sub->subcategory_id);
                          foreach ($tempChild as $cc) {
                            $childURL = base_url('childcategory/').$cc->child_id.'/'.url_title($cc->child_name);
                          
                        ?>
                          <li> <a href = "<?= $childURL ?>"><?= $cc->child_name ?></a> </li>
                          <?php } ?>
                          <!--end for-each -->
                        </ul>
                        <!--level1--> 
                      </li>
                    <?php } ?>
                    </ul> 
                  </li>
                <?php } ?>
                </ul>

              </div>
              <!--box-content box-category--> 
            </div>
            <!-- </div> -->
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
              <ul class="simple-list arrow-list bold-list">
                <li><a href="<?= base_url('mycart') ?>">Shopping Cart</a></li>
                <li> <a href="#">My Account</a>
                  <?php if (isset($_SESSION['loggedUser'])) {
                   ?>
                  <ul>
                    <li><a href="<?= base_url('dashboard') ?>">My Account</a></li>
                    <li><a href="<?= base_url('wishlist') ?>">My Wishlist</a></li>
                    <li><a href="<?= base_url('order') ?>">Track Order</a></li>
                    <!-- <li><a href="#">Order history</a></li> -->
                    <!-- <li><a href="#">Advanced search</a></li> -->
                    <!-- <li><a href="#">Reviews</a></li> -->
                  </ul>
              <?php }else{ ?>
                <ul>
                <li><a href="<?= base_url('login') ?>">Login</a></li>
                <li><a href="<?= base_url('register') ?>">Register</a></li>
              </ul>
              <?php } ?>

                </li>
                <li> <a href="#">Customer service</a>
                  <ul>
                    <li><a href="#">Online support</a></li>
                    <li><a href="#">Help & FAQs</a></li>
                    <li><a href="#">Call Center</a></li>
                  </ul>
                </li>
                <li> <a href="#">Information</a>
                  <ul>
                    <li><a href="<?= base_url('aboutus') ?>">About Us</a></li>
                    <li><a href="#">Shipping &amp; Returns</a></li>
                    <li><a href="#">Privacy Notice</a></li>
                    <li><a href="<?= base_url('terms') ?>">Conditions of Use</a></li>
                  </ul>
                </li>
              </ul>
            </div>
            </section>
          <aside class="col-right sidebar col-sm-3 col-xs-12">
          <div class="block block-company">
            <!-- <div class="block-title"><h3>Company</h3></div> -->
            <div class="block-content">
              <ol id="recently-viewed-items">
                <li class="item odd"><a href="<?= base_url('aboutus') ?>">About Us</a></li>
                <li class="item even"><strong>Sitemap</strong></li>
                <li class="item  odd"><a href="<?= base_url('terms') ?>">Terms and Condition</a></li>
                <li class="item even"><a href="<?= base_url('contactus') ?>">Contact Us</a></li>
                <li class="item odd"><a href="<?= base_url('career') ?>">Career</a></li>
                <li class="item even"><a href="<?= base_url('refundCancle') ?>">Refund and Cancellation Policy</a></li>
                <li class="item last"><a href="<?= base_url('privacypolicy ') ?>">Privacy Policy</a></li>
              </ol>
            </div>
          </div>
        </aside>
          </div>
        </div>
      </div>
    </div>
  </section>
  


 <!-- Brand Logo -->  
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