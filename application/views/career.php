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
            <h2>Career</h2>
          </div>
          <div class="static-contain">
            <form id="form-validate" class="group-select">
              <ul>
                <li id="billing-new-address-form">
                  <fieldset>
                 
                    <input type="hidden" name="billing[address_id]" value="" id="billing:address_id">
                    <ul>
                      <li>
                        <div class="customer-name">
                          <div class="input-box name-firstname">
                            <label for="billing:firstname"> Name<span class="required">*</span></label>
                            <br>
                            <input type="text" id="billing:firstname" name="name" value="" title="First Name" class="input-text " required>
                          </div>
                          <div class="input-box name-lastname">
                            <label for="billing:lastname"> Email Address <span class="required">*</span> </label>
                            <br>
                            <input type="email" id="email" name="email" value="" title="Last Name" class="input-text" required>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="input-box">
                          <label for="billing:email">Company</label>
                          <br>
                          <input type="text" name="company" id="billing:email" value="" title="Email Address" class="input-text validate-email" required>
                        </div>
                        <div class="input-box">
                          <label for="billing:email">Telephone <span class="required">*</span></label>
                          <br>
                          <input type="text" name="contact" id="billing:email" value="" title="Email Address" class="input-text validate-email" required>
                        </div>
                      </li>
                      <li>
                          <label for="billing:email">Subject</label>
                          <br>
                          <input type="text" name="subject" id="billing:email" value="" title="Email Address" class="input-text validate-email" required>
                      </li>
                      <li>
                          <label for="billing:email">Address</label>
                          <br>
                          <input type="text" name="address" id="billing:email" value="" title="Email Address" class="input-text validate-email" required>
                      </li>
                      <li class="">
                        <label for="comment">Comment<em class="required">*</em></label>
                        <br>
                        <div>
                          <input type="hidden" name="mailtype" value="career">
                          <textarea name="message" id="comment" title="Comment" class="required-entry input-text" cols="5" rows="3" required></textarea>
                        </div>
                      </li>
                    </ul>
                  </fieldset>
                </li>
                <li class="require"><em class="required">* </em>Required Fields</li>
                
                <li class="buttons-set">
                  <button type="submit" title="Submit" class="button submit"> <span> Submit </span> </button>
                </li>
              </ul>
            </form>
          </div></div>
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
                <li class="item even"><strong>Career</strong></li>
                <li class="item odd"><a href="<?= base_url('refundCancle') ?>">Refund and Cancellation Policy</a></li>
                <li class="item last"><a href="<?= base_url('privacypolicy ') ?>">Privacy Policy</a></li>
              </ol>
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
 <script type="text/javascript">
    $(document).ready(function(){
      $('#form-validate').on('submit',function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
          url: '<?= base_url('user/Corporate') ?>',
          type: 'post',
          processData: false,
          contentType: false,
          data: formData,
          success: function(a){
            alert(a);
            $('#form-validate').trigger('reset');
          }
        })
      })
    })
  </script>
</body>
</html>