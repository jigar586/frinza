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
  <!-- main-container -->
  <div class="main-container col2-right-layout">
    <div class="main container noPadding">
      <div class="row">
        <section class="col-sm-9">
        <div class="account-login" style="margin-top: auto">
          <div class="page-title">
            <h1><?= $title ?></h1>
          </div>
          <div class="content">
            <?php
              if ($this->session->flashdata('errMsg')) { ?>
                <div class="alert alert-danger alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <?= $this->session->flashdata('errMsg') ?>
                </div>
            <?php
              }elseif ($this->session->flashdata('successMsg')) { ?>
                <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <?= $this->session->flashdata('successMsg') ?>
                </div>
            <?php  }
            ?>
            <form method="post" action="">
              <ul class="form-list">
                <li>
                    <label>First Name<em class="required">*</em></label>
                    <div class="input-box">
                      <input type="text" name="FirstName" value="<?= @$userdata->first_name ?>" title="First Name" class="input-text validate-email required-entry" required>
                    </div>
                  </li>
                  
                  <li>
                    <label>Last Name<em class="required">*</em></label>
                    <div class="input-box">
                      <input type="text" name="LastName" value="<?= @$userdata->last_name ?>" title="Last Name" class="input-text validate-email required-entry" required>
                    </div>
                  </li>
                  
                  <li>
                    <label for="email_address">Email Address<em class="required">*</em></label>
                    <div class="input-box">
                      <input type="text" name="email" id="email_address" value="<?= @$userdata->user_email ?>" title="Enter correct Email in lowercase letters." class="input-text validate-email required-entry" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" readonly>
                    </div>
                  </li>
                  <li>
                    <label for="contact_no">Contact No:<em class="required">*</em></label>
                    <div class="input-box">
                      <input type="number" name="contact" id="contact_no" value="<?= @$userdata->user_contact ?>" title="Contact Number" class="input-text validate-email required-entry" required>
                    </div>
                  </li>
                  <li class="fields">
                    <div class="field">
                      <label for="password">Current Password (Leave Empty if you don't want to change)</label>
                      <div class="input-box">
                        <input type="password" name="password" id="password" title="Invalid Password!" class="input-text required-entry validate-password">
                      </div>
                    </div>
                  </li>
                  <li class="fields">
                    <div class="field">
                      <label for="password">New Password</label>
                      <div class="input-box">
                        <input type="password" name="npassword" id="npassword" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters." class="input-text required-entry validate-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                      </div>
                    </div>
                  </li>
                  <li class="fields">
                    <div class="field">
                      <label for="password">Confirm Password</label>
                      <div class="input-box">
                        <input type="password" name="cpassword" id="cpassword" title="Password and Confirm Password doesn't Match." class="input-text required-entry validate-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                      </div>
                    </div>
                  </li>
                </ul>
                <div class="buttons-set">
                  <button type="submit" title="Submit" class="button submit"><span>Update</span></button>
                </div>
            </form>
          </div>
        </div>
        </section>
        <aside class="col-right sidebar col-sm-3 col-xs-12 noPadding">
          <div class="block block-account">
            <div class="block-title"><h3>My Account</h3></div>
            <div class="block-content">
              <ul>
                <li><a href="<?= base_url('dashboard') ?>">My Dashboard</a></li>
                <li class="current"><a>My Personal Details</a></li>
                <li><a href="<?= base_url('wishlist') ?>">My Wishlist</a></li>
                <li><a href="<?= base_url('mycart') ?>">My Cart</a></li>
                <li ><a href="<?= base_url('walletTransaction') ?>">My Frinza Wallet</a></li>
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
  
 <!-- Brands & Feature -->  
<?php include_once('includes/brands.php') ?>
  <!-- Footer -->
<?php include_once('includes/footer.php') ?>
</div>
<?php include_once('includes/mobilemenu.php') ?>
<!-- End Footer -->
<!-- JavaScript --> 
<?php include_once('includes/footerlinks.php') ?>
<script>
  $(function() {
    $('#npassword').on('keyup change',function() {
      var npas = $(this).val();
      $('#cpassword').attr('pattern',npas);
    })
  })
</script>
</body>
</html>