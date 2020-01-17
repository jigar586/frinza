<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/headerlinks.php') ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
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
        <section class="col-sm-9 noPadding">
        <div class="col-main">
          <div class="my-account">
            <div class="page-title">
              <h1>My Dashboard</h1>
            </div>
            <div class="dashboard">

              <div class="welcome-msg"> <strong>Hello, <?= @$user[0]->first_name.' '.@$user[0]->last_name ?></strong>
                <h4 class="text-success">My Frinza Wallet Balance:  ₹<?= UserWallet() ?></h4> 
                <p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information.</p>
              </div>
              <?php if (count($orders)) {
                 ?>
              <div class="recent-orders">
                <!-- <div class="title-buttons"><strong>Recent Orders</strong> <a href="#">View All </a> </div> -->
                <div class="">
                  <table  class="display responsive nowrap" width="100%" id="my-orders-table">
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
                  </table>
                </div>
              </div>
            <?php } ?>
              <div class="box-account">
                <div class="page-title">
                  <h2>Account Information</h2>
                </div>
                <div class="col2-set">
                  <div class="col-1">
                    <!-- <h5>Contact Information</h5> -->
                    <?php if (@$_SESSION['oauth'] != 'guest') {
                    echo '<a href="'.base_url('myprofile').'">Edit</a>';
                    }?>
                    <p><?= @$user[0]->first_name.' '.@$user[0]->last_name ?><br>
                      <?= @$user[0]->user_email ?><br>
                      <?= @$user[0]->user_contact ?><br>
                    </p>
                  </div>
                  <!-- <div class="col-2">
                    <h5>Newsletters</h5>
                    <a href="#">Edit</a>
                    <p> You are currently not subscribed to any newsletter. </p>
                  </div> -->
                </div>
                <div class="col2-set mobileHide">
                  <div class="col-1">
                    <?php 
                        $bil = [];
                        $bil['user_id'] = $_SESSION['loggedUser'];
                        $bil['is_billing >='] = 1;
                        $addr = $this->shop->getUserAddress($bil);
                        if (!empty($addr)) { ?>
                    <h5>Recent Billing Address</h5>
                    <address>
                      <?php 
                        echo $addr[0]->name.' '.$addr[0]->last_name.'<br>'.$addr[0]->address_1.'<br>'.$addr[0]->address_2.'<br>'.$addr[0]->city.', '.$addr[0]->pin_code.'<br>T:'.$addr[0]->contact.'<br>';
                      ?>
                      </address>
                    <?php  } ?>
                  </div>
                  <div class="col-2">
                    <?php 
                        $bil = [];
                        $bil['is_billing !='] = 1;
                        $bil['user_id'] = $_SESSION['loggedUser'];
                        $addr = $this->shop->getUserAddress($bil);
                        if (!empty($addr)) { ?>
                    <h5>Recent Shipping Address</h5>
                    <address>
                      <?php
                         
                        echo $addr[0]->name.' '.$addr[0]->last_name.'<br>'.$addr[0]->address_1.'<br>'.$addr[0]->address_2.'<br>'.$addr[0]->city.', '.$addr[0]->pin_code.'<br>T:'.$addr[0]->contact.'<br>';
                       ?>
                      </address>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div> </div>
        </section>
        <aside class="col-right sidebar col-sm-3 col-xs-12 noPadding">
          <div class="block block-account">
            <div class="block-title"><h3>My Account</h3></div>
            <div class="block-content">
              <ul>
                <li class="current"><a>My Dashboard</a></li>
                <?php if (@$_SESSION['oauth'] != 'guest') { ?>
                <li><a href="<?= base_url('myprofile') ?>">My Personal Details</a></li>
              <?php } ?>
                <li><a href="<?= base_url('wishlist') ?>">My Wishlist</a></li>
                <li><a href="<?= base_url('mycart') ?>">My Cart</a></li>
                <li><a href="<?= base_url('walletTransaction') ?>">My Frinza Wallet</a></li>
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
  <!-- Modal -->
  <?php if (@$_SESSION['oauth'] == null || @$_SESSION['oauth'] != 'guest') { ?>
    <div id="changeContact" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Contact No.</h4>
          </div>
          <div class="modal-body">
            <ul class="form-list">
              <li class="contactMsg" style="display: none;">
              </li>
              <li class="">
                <label>Contact No: <span class="required">*</span></label>
                <br>
                <input type="text" title="Enter Valid Contact No" class="input-text inpNumber required-entry" id="contactInput" maxlength="10" value="<?= @$user[0]->user_contact ?>" style="width:80%" name="contact">
              </li>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="updateContact()">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
  <?php } ?>

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
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
  $(function() {
      var table = $('#my-orders-table').DataTable({
        columnDefs: [
              { responsivePriority: 1, targets: 0 },
              { responsivePriority: 2, targets: -2 }
          ]
      });
    
  });
  <?php 
    if (@$_SESSION['oauth'] == null || @$_SESSION['oauth'] != 'guest') { ?>
      function updateContact() {
        // body...updateContact
        var contact = $('#contactInput').val();
        if (isNaN(contact) || contact.toString().length != 10) {
          $('#updateContact').val('').focus();
          $('.contactMsg').html('Invalid Contact Number!').removeClass('text-success text-danger').addClass('text-danger').show();
          return false;
        }
        $.ajax({
          url: '<?= base_url('update/changecontact') ?>',
          type: 'post',
          data: {contact : contact},
          dataType: 'json',
          success: function(a){
            $('.contactMsg').html(a['msg']).removeClass('text-success text-danger').addClass(a['class']).show();
            if (a['class'] == 'text-success') {
              setTimeout(function(){
                window.location.reload();
              },2000);
            }
            return false;
          }
        })
      }
  <?php  } ?>
</script>
</body>
</html>