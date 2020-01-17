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
  <section class="main-container col1-layout">
    <div class="main container">
      <div class="account-login"> 
        
        <!-- For version 2 -->
        <div class="page-title">
          <h2>Guest Login</h2>
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
                      <input type="text" name="email" id="email_address" value="" title="Email Address" class="input-text validate-email required-entry" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                    </div>
                  </li>
                  <li>
                    <label for="contact_no">Contact No:<em class="required">*</em></label>
                    <div class="input-box">
                      <input type="number" name="contact" id="contact_no" value="" title="Contact Number" class="input-text validate-email required-entry" required>
                    </div>
                  </li>
                </ul>
              </div>
              <!--content-->
              
              <div class="buttons-set">
                
                <button type="submit" title="Submit" class="button submit"><span>Create</span></button>
                <div id='errMsg'>
                  
                </div>
                 </div><br>
                 <div class="tostore">
                                    <span>or</span>
                                    <a href="<?= base_url() ?>">Return to Store</a>
                                </div>
            </div>
            <div class="form-group text-center text-muted content-divider">
              <span class="px-2">or sign in with</span>
            </div>

            <div class="form-group text-center text-muted content-divider">
             <a href="#"><button type="button" class="btn btn-lg btn-fb" style="background: #4267B2; color:#fff;"><i class="fa fa-facebook pr-1"></i> Facebook</button></a>
             <a href="#"><button type="button" class="btn btn-lg btn-gplus" style="background: #DC4E41; color: #fff;"><i class="fa fa-google-plus pr-1"></i>Google</button></a>
           </div>
  
            
          </fieldset>
          <!--col2-set-->
        </form>
      </div>
      <br>
      <br>
      <br>
      <br>
      <br>
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
    $('#form-validate').on('submit',function(e){
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url: '<?= base_url('guest/login') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
          $('#errMsg').html(a);
          setTimeout(function(){
          	window.location.href = window.location.href;
          },3000)
        }
      })
    })
  })
</script>
</body>
</html>