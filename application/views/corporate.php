<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/headerlinks.php') ?>

<body class="shopping-cart-page">
  <div id="page"> 
    <?php include_once('includes/header.php') ?>
    <?php include_once('includes/navigation.php') ?>
    <div class="main-container col2-right-layout">
      <div class="main container">
        <div class="row">
          <section class="col-sm-12">
          <div class="col-main">
            <div class="page-title">
              <h2>Corporate</h2>
            </div>
            <div class="static-contain">
              <form id="form-validate" class="group-select">
                <ul>
                  <li id="billing-new-address-form">
                    <fieldset>
                      <ul>
                        <li>
                          <div class="customer-name">
                            <div class="input-box name-firstname">
                              <label for="billing:firstname"> Name<span class="required">*</span></label>
                              <br>
                              <input type="text" id="Name" name="name" value="" title="First Name" class="input-text " required>
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
                            <label for="billing:company">Company</label>
                            <br>
                            <input type="text" id="company" name="company" value="" title="Company" class="input-text" required>
                          </div>
                          <div class="input-box">
                            <label for="billing:email">Telephone <span class="required">*</span></label>
                            <br>
                            <input type="number" name="contact" id="contact" value="" title="Email Address" class="input-text" required>
                          </div>
                        </li>
                        <li>
                          <label>Subject <span class="required">*</span></label>
                          <br>
                          <input type="text" title="subject" name="subject" id="subject" value="" class="input-text required-entry" required>
                        </li>
                        <li>
                          <label>Address <span class="required">*</span></label>
                          <br>
                          <input type="text" title="address" name="address" id="address" value="" class="input-text required-entry" required>
                        </li>
                        <li class="">
                          <label for="comment">message<em class="required">*</em></label>
                          <br>
                          <div>
                            <textarea name="message" id="message" title="Comment" class="required-entry input-text" cols="5" rows="3"></textarea>
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
    <?php include_once('includes/brands.php') ?>
    <!-- Footer -->
    <?php include_once('includes/footer.php') ?>
  </div>
  <?php include_once('includes/mobilemenu.php') ?>
  <!-- JavaScript --> 
  <?php include_once('includes/footerlinks.php') ?>
  <!-- Ajax For Validation & Registration -->
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