<!DOCTYPE html>
<html lang="en">
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
									<input type="text" class="form-control" placeholder="Username" name="user">
									<div class="form-control-feedback">
										<i class="icon-user text-muted"></i>
									</div>
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
									<input type="password" class="form-control" placeholder="Password" password="pass" name="pass">
									<div class="form-control-feedback">
										<i class="icon-lock2 text-muted"></i>
									</div>
								</div>

								<div class="form-group d-flex align-items-center">
									<div class="form-check mb-0">
										
									</div>

								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">Sign in</button>
								</div>
								<div class="text-center myMsg"></div>
								<span class="form-text text-center text-muted">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span>
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
<?php include('includes/footerlinks.php') ?>
<?php include('includes/footerlinks.php') ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.login-form').on('submit',function(e){
			e.preventDefault();
		var formData = new FormData(this);
		$.ajax({
			url: '<?= base_url('admin/loginsubmit') ?>',
			type: 'post',
			processData: false,
			contentType: false,
			data: formData,
			success:function(a){
				a = JSON.parse(a);
				if (a['success']) {
					$('.myMsg').html(a['success']);
					setTimeout(window.location.href ='<?= base_url('admin/dashboard') ?>' ,3000);
				}else{
					$('.myMsg').html(a['err']);
				}
				}
			})
		})
	})
</script>
</body>
</html>
