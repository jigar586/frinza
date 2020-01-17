<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/headerlinks.php') ?>
<body class="create-ac-page">
<div id="page"> 
<!-- Header -->
  <?php include_once('includes/header.php') ?>
  <!-- end header --> 
  
  <!-- Navigation -->
  
  <?php include_once('includes/navigation.php') ?>
  <!-- end nav -->
  <style type="text/css"> 
    a.loginRegMenu > a.userBtn:first-child{
      border: 1px solid #fff;
      border-top: 0px;
    }
    a.userBtn:hover{
      background: #fff;
    }
  </style>
  <section class="main-container col1-layout">
    <div class="main container noPadding">
      <div class="row loginRegMenu ">
        <a href="<?= base_url('login') ?>" class="py-4 col-xs-6 text-center userBtn" style="padding: 10px;"><i class="fa fa-sign-in" style="font-size:18px; "></i>&nbsp;&nbsp;Login</a>
        <a href="<?= base_url('register') ?>" class="py-4 col-xs-6 text-center userBtn" style="color:#fff;padding:10px;background: rgb(230,34,99);"><i class="fa fa-user-plus" style="font-size:18px; "></i>&nbsp;&nbsp;Register</a>
      </div>
      <div class="account-login noMargin"> 
        
        <!-- For version 2 -->
        <div class="page-title mobileHide">
          <h2>Register</h2>
        </div>
        <!--page-title-->
        
        <form action="#" method="post" id="form-validate">
          <fieldset class="col2-set">
          <div class="col-11 new-users"> 
              <div class="content">
                <ul class="form-list">
                <li>
                    <label>First Name<em class="required">*</em></label>
                    <div class="input-box">
                      <input type="text" name="FirstName" value="" title="First Name" class="input-text validate-email required-entry" required>
                    </div>
                  </li>
                  
                  <li>
                    <label>Last Name<em class="required">*</em></label>
                    <div class="input-box">
                      <input type="text" name="LastName" value="" title="Last Name" class="input-text validate-email required-entry" required>
                    </div>
                  </li>
                  
                  <li>
                    <label for="email_address">Email Address<em class="required">*</em></label>
                    <div class="input-box">
                      <input type="text" name="email" id="email_address" value="" title="Enter correct Email in lowercase letters." class="input-text validate-email required-entry" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" required>
                    </div>
                  </li>
                  <li>
                    <label for="contact_no">Contact No:<em class="required">*</em></label>
                    <div class="input-box">
                      <input type="number" name="contact" id="contact_no" value="" title="Contact Number" class="input-text validate-email required-entry" required>
                    </div>
                  </li>
                  <li class="fields">
                    <div class="field">
                      <label for="password">Password<em class="required">*</em></label>
                      <div class="input-box">
                        <input type="password" name="password" id="password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters." class="input-text required-entry validate-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                      </div>
                    </div>
                  </li>
                  <li class="fields">
                    <div class="field">
                      <label for="password">Confirm Password<em class="required">*</em></label>
                      <div class="input-box">
                        <input type="password" name="cpassword" id="cpassword" title="Password and Confirm Password doesn't Match." class="input-text required-entry validate-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              <!--content-->
              
              <div class="buttons-set">
                
                <button type="submit" title="Submit" class="button submit"><span>Create Account</span></button>
                <div id='errMsg'>
                  
                </div>
                 </div><br>
                 <div class="tostore">
                    <span>or</span>
                    <a href="<?= base_url() ?>">Return to Store</a>
                 </div>
            </div>
  
            
          </fieldset>
          <!--col2-set-->
        </form>
        
              <div class="form-group text-center text-muted content-divider">
                  <span class="px-2">or sign in with</span>
                </div>
              <div class="form-group text-center product-shop">
                <div class="social">
                        <ul class="link">
                          <?php
                          if (isset($fbAuthURL)) {
                            ?>
                             <li><a href="<?= $fbAuthURL ?>"><button type="button" class="btn btn-lg btn-fb" style="background: #4267B2; color:#fff;"><i class="fa fa-facebook pr-1"></i> Facebook</button></a></li>
                             <li><a href="<?= $gpAuthURL ?>"><button type="button" class="btn btn-lg btn-gplus" style="background: #DC4E41; color: #fff;"><i class="fa fa-google-plus pr-1"></i> Google</button></a></li>
                          <!-- <li class="fb"><a href="<?= $fbAuthURL ?>"></a></li> -->
                          <?php  }
                          if (isset($gpAuthURL)) {
                         ?>
                          <!-- <li class="googleplus"><a href="<?= $gpAuthURL ?>"></a></li> -->
                        <?php } ?>
                        </ul>
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
<!-- Ajax For Validation & Registration -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#password').on('keyup change',function()
    {
      $('#cpassword').attr('pattern',$(this).val());
    });
    $('#form-validate').on('submit',function(e){
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url: '<?= base_url('user/Create') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
          $('#errMsg').html(a);
          $('#form-validate').trigger('reset');
        }
      })
    })
  })
</script>
</body>
</html>