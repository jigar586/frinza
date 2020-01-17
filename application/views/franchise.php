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

    <div class="main-container col2-right-layout">
      <div class="main container">
        <div class="row">
           <section class="col-sm-12">
          <div class="col-main">
            <div class="page-title">
              <h2>Franchise</h2>
            </div>
            <div class="static-contain">
              <form class="group-select" id="form-validate" action="#" method="post">
                <ul>
                  <li id="billing-new-address-form">
                    <fieldset>
                   
                      <input type="hidden" name="billing[address_id]" value="" id="billing:address_id">
                      <ul>
                        <li>
                          <div class="customer-name">
                            <div class="input-box name-firstname">
                              <label for="billing:firstname">Name<span class="required">*</span></label>
                              <br>
                              <input type="text" id="billing:firstname" name="name" value="" title="First Name" class="input-text " required>
                            </div>
                            <div class="input-box name-lastname">
                              <label for="billing:lastname"> Email Address <span class="required">*</span> </label>
                              <br>
                              <input type="email" id="billing:lastname" name="email" value="" title="Last Name" class="input-text" required>
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="input-box">
                            <label for="billing:company">Company</label>
                            <br>
                            <input type="text" id="billing:company" name="company" value="" title="Company" class="input-text" required>
                          </div>
                          <div class="input-box">
                            <label for="billing:email">Telephone <span class="required">*</span></label>
                            <br>
                            <input type="number" maxlength="10" name="contact" id="billing:email" value="" title="Email Address" class="input-text" required>
                          </div>
                        </li>
                        <li>
                          <label>Subject <span class="required">*</span></label>
                          <br>
                          <input type="text" title="Street Address" name="subject" id="billing" value="" class="input-text required-entry" required>
                        </li>
                        <li>
                          <label>Address <span class="required">*</span></label>
                          <br>
                          <input type="text" title="Street Address" name="address" id="billing2" value="" class="input-text required-entry" required>
                        </li>
                        <li class="">
                          <label for="comment">Comment<em class="required">*</em></label>
                          <br>
                          <div>
                            <textarea name="comment" id="comment" title="Comment" class="required-entry input-text" cols="5" rows="3" required></textarea>
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
            </div>
          </div>
        </section>
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
  <!-- Ajax For Validation & Registration -->
  <script type="text/javascript">
    $(document).ready(function(){
      $('#form-validate').on('submit',function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
          url: '<?= base_url('user/Franchise') ?>',
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