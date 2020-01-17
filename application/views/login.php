<!DOCTYPE html>
<html lang="en">
<!-- Header Links starts here -->
<?php include_once('includes/headerlinks.php') ?>
<!-- Header Links ends -->
<body class="shopping-cart-page">
<div id="page"> 
<!-- Header -->
<?php include_once('includes/header.php') ?>
  <!-- end header --> 
  <!-- Navigation -->
<?php include_once('includes/navigation.php') ?>
  <!-- end nav --> 
  <style type="text/css"> 
    a.loginRegMenu > a.userBtn:last-child{
      border: 1px solid #fff;
      border-top: 0px;
    }
    .userBtn:hover{
      background: #fff;
    }
  </style>
  <section class="main-container col1-layout">
    <div class="main container noPadding">
      <div class="row loginRegMenu ">
        <a href="<?= base_url('login') ?>" class="py-4 col-xs-6 text-center userBtn" style="color:#fff;padding:10px;background: rgb(230,34,99);"><i class="fa fa-sign-in" style="font-size:18px; "></i>&nbsp;&nbsp;Login</a>
        <a href="<?= base_url('register') ?>" class="py-4 col-xs-6 text-center userBtn" style="padding:10px"><i class="fa fa-user-plus" style="font-size:18px; "></i>&nbsp;&nbsp;Register</a>
      </div>
      <div class="account-login noMargin" > 
        <div class="page-title mobileHide">
          <h1>Login or Create an Account</h1>
        </div>
        <fieldset class="col2-set">
          <div class="col-1 new-users mobileHide"><strong>New Customers</strong>
            <div class="content">
              <p>By creating an account with our store, you will be able to move through the checkout process fIberis, store multiple shipping addresses, view and track your orders in your account and more.</p>
              <div class="buttons-set">
                <button onclick="window.location='<?= base_url('register') ?>';" class="button create-account" type="button"><span>Create an Account</span></button>
              </div>
            </div>
            <br>
            <br>
            <strong>Guest Login</strong>
            <div class="content">
              <p>By Using our Guest Login features, you are able to order products without creating account on our website, but always prefer registering if not neccessary.</p>
              <div class="buttons-set">
                <button onclick="window.location='<?= base_url('guestlogin') ?>';" class="button create-account" type="button"><span>Guest Login</span></button>
              </div>
            </div>
          </div>
          <div class="col-2 registered-users"><strong>Login</strong>
            <div class="content">
              <p>If you have an account with us, please log in.</p>
              <form class="loginForm" method="post">
              <ul class="form-list">
                <li>
                  <label for="email">Email Address <span class="required">*</span></label>
                  <br>
                  <input type="text" title="Email Address" class="input-text required-entry" id="email" value="" name="login[username]">
                </li>
                <li>
                  <label for="pass">Password <span class="required">*</span></label>
                  <br>
                  <input type="password" title="Password" id="pass" class="input-text required-entry validate-password" name="login[password]">
                </li>
              </ul>
              <p class="required">* Required Fields</p>
              <div class="buttons-set">
                <button id="send2" name="send" type="submit" class="button login"><span>Login</span></button>
                
                <a class="forgot-word" href="javascript:void(0)" data-toggle="modal" data-target="#forgotPassModal">Forgot Your Password?</a> </div>
                <div class="incorrectLogin"></div>                
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
        </fieldset>
      </div>
    </div>
  </section>
  <div id="forgotPassModal" class="modal fade" role='dialog'>
    
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content"> 
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" style="color: black;    font-size: 30px;">×</button>
          <h4 class="modal-title1 text-center">Forgot Password?</h4>
        </div>
        <div class="modal-body">
          <ul class="form-list">
             <li class="forgotAlert" style="display: none;">
              <div class="myForgotMsg"></div>
            </li>
            <li class="forgotEmail">
              <label>Email Address <span class="required">*</span></label>
              <br>
              <input type="text" title="Email Address" class="input-text required-entry" id="forgotEmail" style="width:80%" name="username">
            </li>
            <li class="forgotOTP" style="display: none;">
              <label>Enter OTP:</label>
              <br>
              <input type="text" title="OTP" class="input-text required-entry" style="width:80%" id="forgotOTP" name="otp">
            </li>
            <li class="forgotPass" style="display: none;">
              <label>Enter New Password:</label>
              <br>
              <input type="password" title="New Password" class="input-text required-entry" id="forgotPass" style="width:80%" name="password">
            </li>
            <li class="forgotPass" style="display: none;">
              <label>Enter New Password:</label>
              <br>
              <input type="password" title="New Password" class="input-text required-entry" id="forgotPass2" style="width:80%" name="password">
            </li>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" id="forgotbtn" value="email" onclick="forgotPassword(this.value)" class="btn btn-success">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- Brand and features bar -->
<?php include_once('includes/brands.php') ?>
  <!-- Footer -->
  <?php include_once('includes/footer.php') ?>
</div>
<?php include_once('includes/mobilemenu.php') ?>
<!-- End Footer -->
<!-- JavaScript --> 
<?php include_once('includes/footerlinks.php') ?>
<!-- Ajax to Login -->
<script type="text/javascript">
  $(document).ready(function(){
    $('.loginForm').on('submit',function(e){
      e.preventDefault();
      $('#send2').trigger('click');
    });
    $('#forgotPass').on('keyup,keydown,change',function(){
      $('#forgotPass2').attr('pattern',$('#forgotPass').val());
    });
    $('#send2').on('click',function(e){
      e.preventDefault();
      var formData = new FormData();
      formData.append('email',$('#email').val());
      formData.append('pass',$('#pass').val());
      $.ajax({
        url: '<?= base_url('user/login') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
          if (a == '0') {
            $('.incorrectLogin').html('<p style="color:red">Enter Valid Username and Password!!</p>');
          }else{
            $('.incorrectLogin').html(a);
            // setTimeout(6000);
            window.location.href=window.location.href;
          }
        }
      })
    })
  });
  function forgotPassword(callType)
  {
    if (callType == 'email') {
      var email = $('#forgotEmail').val();
      if (email == '' || email == undefined || email == null) {
        $('.myForgotMsg').html('Please Enter Email!').removeClass('text-danger, text-success').addClass('text-danger');
        $('.forgotAlert').show();
        setTimeout(function(){
          $('.forgotAlert').hide();
        },2000);
        return false;
      }
    }
    if (callType == 'otp') {
      var email = $('#forgotOTP').val();
      if (email == '' || email == undefined || email == null) {
        $('.myForgotMsg').html('Please Enter OTP!').removeClass('text-danger, text-success').addClass('text-danger');
        $('.forgotAlert').show();
        setTimeout(function(){
          $('.forgotAlert').hide();
        },2000);
        return false;
      }
    }
    if (callType == 'pass') {
      var email = $('#forgotPass').val();
      var email2 = $('#forgotPass2').val();
      if (email == '' || email == undefined || email == null || email2 == '' || email2 == undefined || email2 == null) {
        $('.myForgotMsg').html('Please Enter Password!').removeClass('text-danger, text-success').addClass('text-danger');
        $('.forgotAlert').show();
        setTimeout(function(){
          $('.forgotAlert').hide();
        },2000);
        return false;
      }
      if (email != email2) {
        $('.myForgotMsg').html('Password doesn\'t match!').removeClass('text-danger, text-success').addClass('text-danger');
        $('.forgotAlert').show();
        setTimeout(function(){
          $('.forgotAlert').hide();
        },2000);
        return false;
      }
    }
    $.ajax({
      url: '<?= base_url('user/forgotpass') ?>',
      type: 'post',
      data: {
        type: callType,
        email: email
      },
      dataType: 'json',
      success: function(a)
      {
        $('.myForgotMsg').html(a['msg']).removeClass('text-danger, text-success').addClass(a['class']);
        $('#forgotPassModal ul.form-list li').hide();
        $('.'+a['stepClass']).show();
        $('#forgotbtn').val(a['step']);
        $('.forgotAlert').show();
        setTimeout(function(){
          $('.forgotAlert').hide();
        },2000);
        if (a['step'] == 'finish') {
          setTimeout(function(){
          window.location.reload();
        },2000);
          return false;
        }
      }
    });
    
  }
</script>
</body>
</html>