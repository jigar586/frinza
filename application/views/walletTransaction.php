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
  
  <!-- main-container --> 
  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9">
        <div class="col-main">
          <div class="my-account">
            <div class="page-title">
              <h1>My Frinza wallet</h1>
            </div>
            <div class="dashboard">

              <div class="welcome-msg">
                <h4 class="text-success">My Frinza Wallet Balance:  ₹<?= UserWallet() ?></h4> 
              </div>
            
            <?php if (count($walletTxn)) {
                 ?>
              <div class="recent-orders">
                <!-- <div class="title-buttons"><strong>Recent Transaction</strong> <a href="#">View All </a> </div> -->
                <div class="table-responsive">
                  <table class="data-table" id="my-wallet-table">
                    <col>
                    <col>
                    <col>
                    <col width="1">
                    <col width="1">
                    <col width="1">
                    <thead>
                      <tr class="first last">
                        <th>Order #</th>
                        <th>Withdrawal</th>
                        <th>Deposite</th>
                        <th>Txn id</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($walletTxn as $wltxn) { ?>
                        <tr>
                          <td>
                            <?= @$wltxn->order_id ?>
                          </td>
                          <td>
                            <?=  @$wltxn->payment_type == 1 ? '₹'.@$wltxn->amount : '' ?>
                          </td>
                          <td>
                            <?= @$wltxn->payment_type == 0 ? '₹'.@$wltxn->amount : '' ?>
                          </td>
                          <td>
                            <?= @$wltxn->txn_id ?>
                          </td>
                        </tr>
                      <?php }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
           <?php } ?>
            </div>
          </div> </div>
        </section>
        <aside class="col-right sidebar col-sm-3 col-xs-12">
          <div class="block block-account">
            <div class="block-title"><h3>My Account</h3></div>
            <div class="block-content">
              <ul>
                <li class=""><a href="<?= base_url('dashboard') ?>">My Dashboard</a></li>
                <li><a href="<?= base_url('myprofile') ?>">My Personal Details</a></li>
                <li><a href="<?= base_url('wishlist') ?>">My Wishlist</a></li>
                <li class=""><a href="<?= base_url('mycart') ?>">My Cart</a></li>
                <li class="current"><a>My Frinza Wallet</a></li>
                <li class="last"><a href="<?= base_url('order') ?>">My Orders</a></li>
              </ul>
            </div>
          </div>
          <?php if (isset($_SESSION['compareProduct'])) { ?>
            <div class="block block-compare" id="compareBox">
            <?php include_once('includes/comparebox.php') ?>
            </div>
          <?php } ?>
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
      $('#my-wallet-table').DataTable();
    });
    </script>
</body>
</html>