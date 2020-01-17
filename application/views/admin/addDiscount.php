<!DOCTYPE html>
<html lang="en">
<!-- Headerlinks -->
<?php include('includes/headerlinks.php') ?>
<body>
  <!-- Main navbar -->
  <?php include('includes/header.php') ?>
  <!-- /main navbar -->
  <!-- Page content -->
  <div class="page-content">

	<?php include('includes/sidebar.php') ?>

	<div class="content-wrapper">
		<div class="page-header page-header-light">
			<div class="page-header-content header-elements-md-inline">
				<div class="page-title d-flex">
					<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Discount</span> - Create Offer</h4>
					<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
				</div>
			</div>

			<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
				<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item">Discount</span>
							<span class="breadcrumb-item active">Create Offer</span>
						</div>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
		</div>
		<!-- /page header -->


		<!-- Content area -->
		<div class="content">
			<div class="row">
				<div class="col-xl-12">
					<div class="card">
						<div class="card-header header-elements-inline">
							<h6 class="card-title">Create Offer</h6>
						</div>
						<?php 
						// echo "<pre>";
						// print_r($categories);
						// print_r($child_categories);
						// die;
							if (isset($offerData) && count($offerData) != 0) {
							$offerName = $offerData[0]->offer_name;
							$offerType = $offerData[0]->offer_type;
							$hdnID = '<input type="hidden" name="id" value="'.$offerData[0]->offer_id.'">';
							$amount = $offerData[0]->amount;
							$start = date('m/d/Y',strtotime($offerData[0]->start_date));
							$end = date('m/d/Y',strtotime($offerData[0]->end_date));
							$coupon = $offerData[0]->is_coupon;
							$img1 = json_decode($offerData[0]->banner);
							$img = '<div class="mt-2">';
							for ($i=0; $i < @count($img1); $i++) { 
								$img .= '<img class="mr-2" src="'.FOLDER_ASSETS_TEMPLATEBANNER.$img1[$i].'" height="150px">';
							}
							$img .= '</div>';
							$update = 1;
							}
						?>
						<div class="card-body">
							<form id="insertOffer">
								<fieldset class="mb-3">
									<div class="form-group row">
										<label class="col-form-label col-lg-2">Offer Name:</label>
										<div class="col-lg-3">
											<select class="form-control form-control-uniform" name="is_coupon" data-fouc>
												<option value="0">Discount Offer</option>
												<option value="1" <?= @$coupon == 1 ? "selected" : '' ?>>Coupon Offer</option>
											</select>
										</div>
										<div class="col-lg-5">
											<input type="text" class="form-control" name="offer_name" placeholder="Enter Name of Offer..." value="<?= @$offerName ?>">
										<?= @$hdnID ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-lg-2">Offer Period:</label>
										<div class="col-lg-4">
											<input type="text" class="form-control daterange-single" placeholder="Start Date" name="start_date" value="<?= @$start ?>"> 
										</div>
										<!-- <label class="col-form-label">To:</label> -->
										<div class="col-lg-4">
											<input type="text" class="form-control daterange-single" placeholder="End Date" name="end_date" value="<?= @$end ?>"> 
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-lg-2">Select Offer Type:</label>
										<div class="col-lg-8">
											<select class="form-control form-control-uniform" name="offer_type" data-fouc>
												<option value="1" <?= @$offerType == 1 ? 'selected' : '' ?>>Fixed Amount</option>
												<option value="2"<?= @$offerType == 1 ? '' :'selected' ?>>Pecentage Discount</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-lg-2">Discount Amount:</label>
										<div class="col-lg-8">
											<input type="text" class="form-control" name="amount" placeholder="Enter Amount ..." value="<?= @$amount ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-lg-2">Offer Banner:</label>
										<div class="col-lg-8">
											<input type="file" name="banner[]" class="form-control-uniform-custom" multiple="multiple" data-fouc>
											<?= @$img ?>
										</div>
									</div>
									<div class="myMsg" style="position: absolute;left: 18.5%;color: red;"></div>
									<div class="d-flex justify-content-end align-items-center">
										<button type="submit" class="btn btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
									</div>
								</fieldset>
							</form>
						</div>
						</div>
						<div class="card">
							<div class="card-body" id="myDataTable">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<div id="myFormModal" class="modal fade" role='dialog'>
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Apply Discount</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /content area -->


<!-- Footer -->
<?php include('includes/footer.php') ?>
<!-- /footer -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->
<?php include('includes/footerlinks.php') ?>
<!-- Ajax to submit offer -->
<script type="text/javascript">
	var caturl = '<?= base_url('admin/offertable') ?>';
	$(document).ready(function(){
		$('#insertOffer').on('submit',function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: '<?= @$update == 1 ? base_url('admin/updateoffer') : base_url('admin/insertoffer') ?>',
				type: 'post',
				processData: false,
				contentType: false,
				data: formData,
				success: function(a){
					$('.myMsg').html(a);
					$('#insertOffer').trigger('reset');
					<?php 
					if (@$update == 1) {
						echo 'setTimeout(function(){ window.location.href = window.location.href },1000);';
					}
					?>
					viewTable(caturl);
				}
			});
		});
		
		$('body').on('submit','#applyOffer',function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			let url = $(this).data('action');

			$.ajax({
				url: url,
				method: 'post',
				data: formData,
				processData: false,
				contentType: false,
				dataType: 'json'
			}).then(res => {
				if(res.status) {
					alert(res.msg);
					$('#myFormModal .modal-body').html('');
					$('#myFormModal').modal('hide');
				} else {
					alert(res.msg);
				}
			});
		});
		viewTable(caturl);
	});
	function deleteOffer(arg)
	{
		$.ajax({
			url: '<?= base_url('admin/updateoffer') ?>',
			type: 'post',
			data: {id: arg,request:2},
			success: function(a){
				$('.myMsg').html(a);
				$('#insertOffer').trigger('reset'); 
				viewTable(caturl);
			}
		})
	}
	function applyOffer(arg)
	{
		$('#myFormModal').modal('show');
		$('#myFormModal .modal-body').html('');

		$.ajax({
			url: '<?= base_url('admin/modalApplyoffer/') ?>'+arg,
			type: 'get',
			success: function(a){
				$('#myFormModal .modal-body').html(a);
				$('input[name=hdnId]').val(arg);
			}
		})

	}
</script>
</body>
</html>
