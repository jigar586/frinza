<!DOCTYPE html>
<html lang="en">
<style type="text/css">
	.required{
		color: red;
	}
</style>
<?php include_once('includes/headerlinks.php') ?>

<body>

	<!-- Page content -->
	<div class="page-content login-cover">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login form -->
				<form class="login-form wmin-sm-400" method="post" action="#">
					<div class="card mb-0">
						<ul class="nav nav-tabs nav-justified alpha-grey mb-0">
							<li class="nav-item"><a href="#login-tab1" class="nav-link border-y-0 border-left-0 active" data-toggle="tab"><h6 class="my-1">Sign in</h6></a></li>
						</ul>

						<div class="tab-content card-body">
							<div class="tab-pane fade show active" id="login-tab1">
								<div class="text-center mb-3">
									<i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
									<h5 class="mb-0">Login to your account</h5>
									<span class="d-block text-muted">Your credentials</span>
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
									<input type="text" name="name" class="form-control" placeholder="Username">
									<div class="form-control-feedback">
										<i class="icon-user text-muted"></i>
									</div>
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
									<input type="password" name="pwd" class="form-control" placeholder="Password">
									<div class="form-control-feedback">
										<i class="icon-lock2 text-muted"></i>
									</div>
								</div>

								<div class="form-group d-flex align-items-center">

									<a class="ml-auto" href="javascript:void(0)" data-toggle="modal" data-target="#forgotPassModal">Forgot password?</a>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">Sign in</button>
								</div>
								<div class="text-center myMsg"></div>
							</div>

							
						</div>
					</div>
				</form>
				<!-- /login form -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->
	<div id="forgotPassModal" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">&nbsp;Forgot Password?</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="forgotAlert">
						<div class="myForgotMsg"></div>
					</div>
					<div class="form-group row forgotEmail">
						<label class="col-lg-3 col-form-label">Email Address <span class="required">*</span></label>
						<div class="col-lg-9">
							<input type="text" class="form-control required-entry" title="Email Address" id="forgotEmail" style="width:80%" name="username" placeholder="Enter Your Email Address">
						</div>
					</div>
					<div class="form-group row forgotOTP" style="display: none">
						<label class="col-lg-3 col-form-label">Enter OTP:</label>
						<div class="col-lg-9">
							<input type="text" class="form-control required-entry" title="OTP" id="forgotOTP" style="width:80%" name="otp">
						</div>
					</div>
					<div class="form-group row forgotPass" style="display: none">
						<label class="col-lg-3 col-form-label">Enter New Password:</label>
						<div class="col-lg-9">
							<input type="password" class="form-control required-entry" title="New Password" id="forgotPass" style="width:80%" name="password">
						</div>
					</div>
					<div class="form-group row forgotPass" style="display: none">
						<label class="col-lg-3 col-form-label">Re Enter Password:</label>
						<div class="col-lg-9">
							<input type="password" class="form-control required-entry" title="New Password" id="forgotPass2" style="width:80%" name="password">
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> Close</button>
					<button class="btn bg-primary" type="button" id="forgotbtn" value="email" onclick="forgotPassword(this.value)"><i class="icon-checkmark3 font-size-base mr-1"></i> Save</button>
				</div>
			</div>
		</div>
	</div>
	 
<?php include('includes/footerlinks.php') ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.login-form').on('submit',function(e){
			e.preventDefault();
		var formData = new FormData(this);
		$.ajax({
			url: '<?= base_url('vendor/loginsubmit') ?>',
			type: 'post',
			processData: false,
			contentType: false,
			data: formData,
			success:function(a){
				a = JSON.parse(a);
				if (a['success']) {
					$('.myMsg').html(a['success']);
					setTimeout(window.location.href ='<?= base_url('vendor/orderrequests') ?>' ,3000);
				}else{
					$('.myMsg').html(a['err']);
				}
				}
			})
		})
	})
</script>
<script type="text/javascript">
  function forgotPassword(callType)
  {
    if (callType == 'email') {
      var email = $('#forgotEmail').val();
      if (email == '' || email == undefined || email == null) {
        $('.myForgotMsg').html('Please Enter Email!').removeClass('text-danger text-success').addClass('text-danger');
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
        $('.myForgotMsg').html('Please Enter OTP!').removeClass('text-danger text-success').addClass('text-danger');
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
        $('.myForgotMsg').html('Please Enter Password!').removeClass('text-danger text-success').addClass('text-danger');
        $('.forgotAlert').show();
        setTimeout(function(){
          $('.forgotAlert').hide();
        },2000);
        return false;
      }
      if (email != email2) {
        $('.myForgotMsg').html('Password doesn\'t match!').removeClass('text-danger text-success').addClass('text-danger');
        $('.forgotAlert').show();
        setTimeout(function(){
          $('.forgotAlert').hide();
        },2000);
        return false;
      }
    }
    $.ajax({
      url: '<?= base_url('vendor/forgotpass') ?>',
      type: 'post',
      data: {
        type: callType,
        email: email
      },
      dataType: 'json',
      success: function(a)
      {
        $('.myForgotMsg').html(a['msg']).removeClass('text-danger text-success').addClass(a['class']);
        $('#forgotPassModal div.modal-body div.form-group').hide();
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
