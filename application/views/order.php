<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/headerlinks.php') ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
<body class="shopping-cart-page">
<div id="page"> 
<!-- Header -->
  <?php include_once('includes/header.php') ?>
  <!-- end header --> 
  
  <!-- Navigation -->
  
  <?php include_once('includes/navigation.php') ?>
  <!-- end nav -->
  
  <!-- breadcrumbs -->
  
    <!-- <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="Go to Home Page" href="index.html">Home</a> <span>/</span> </li>
            <li class="category1601"> <strong>Contact Us</strong> </li>
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
            <h2>Recent Orders</h2>
          </div>
          <div class="">
              <div class="recent-orders">
                <!-- <div class="title-buttons"><strong>Recent Orders</strong> <a href="#">View All </a> </div> -->
                <div class="table-responsive">
                  <table class="data-table" id="my-orders-table"> 
                    <?php
                      if(count($orders) != 0){
                    ?>
                    <thead>
                      <tr class="first last">
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Ship to</th>
                        <th><span class="nobr">Order Total</span></th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($orders as $ord) {
                       ?>
                      <tr class="first odd">
                        <td><?= @$ord->detail_id ?></td>
                        <td><?= date('d/m/y',strtotime($ord->created_at)) ?></td>
                        <td><?= @$ord->name.' '.@$ord->last_name ?></td>
                        <td><span class="price">₹<?= @$ord->amount ?></span></td>
                        <td><em>
                          <?php
                            if (@$ord->suborder_status == 4) {
                              echo "Delivered";
                            }elseif (@$ord->suborder_status == 3) {
                              echo "Out for Delivery";
                            }elseif (@$ord->suborder_status == 2) {
                              echo "Accepted";
                            }elseif (@$ord->suborder_status == 5) {
                              echo "Cancelled";
                            }elseif (@$ord->suborder_status == 6) {
                              echo "Refunded to Wallet";
                            }elseif (@$ord->suborder_status == 7) {
                              echo "Refunded to Bank";
                            }else{
                              echo "Pending";
                            }
                          ?>
                        </em></td>
                        <!-- <td class="a-center last"><span class="nobr"> <a href="#">View Order</a></td> -->
                      </tr>
                    <?php } ?>
                    </tbody>
                    <?php }else{
                      ?>
                      <style type="text/css">
                          .noitem:before{
                            font-size:50px;
                          }
                        </style>
                        <tbody class="noborcderClass">
                          <tr>
                            <td colspan="5" class="text-center">
                              <p class="a-center noitem noPadding"></p>
                              <h2>Your Order history is empty !</h2>
                              <h5 style="color: #008000;">But it doesn't have to be.</h5>
                            </td>
                          </tr>
                        </tbody>
                    <?php } ?>
                    <tfoot>
                      <tr class="first last">
                        <td class="a-right last text-right" colspan="50"><button onclick="window.location.href = '<?= base_url() ?>'" class="button btn-continue" title="Continue Shopping" type="button"><span>Continue Shopping</span></button>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
          </div></div>
        </section>
         <aside class="col-right sidebar col-sm-3 col-xs-12 noPadding">
          <div class="block block-account">
            <div class="block-title"><h3>My Account</h3></div>
            <div class="block-content">
              <ul>
                <li class=""><a href="<?= base_url('dashboard') ?>">My Dashboard</a></li>
                <li><a href="<?= base_url('myprofile') ?>">My Personal Details</a></li>
                <li><a href="<?= base_url('wishlist') ?>">My Wishlist</a></li>
                <li><a href="<?= base_url('mycart') ?>">My Cart</a></li>
                <li><a href="<?= base_url('walletTransaction') ?>">My Frinza Wallet</a></li>
                <li class="current last"><a>My Orders</a></li>
              </ul>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
  <!--End main-container --> 
  


 <!-- Brand Logo -->  
  <?php include_once('includes/brands.php') ?>
  <!-- Footer -->
  <?php include_once('includes/footer.php') ?>
</div>
<?php include_once('includes/mobilemenu.php') ?>

<!-- End Footer -->

<!-- JavaScript --> 
<?php include_once('includes/footerlinks.php') ?>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(function() {
    $('#my-orders-table').DataTable();
  });
</script>
</body>
</html>