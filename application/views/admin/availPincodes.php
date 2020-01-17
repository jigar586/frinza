<?php
$states = array_map('unserialize', array_unique(array_map( 'serialize',array_map(function($ar){
	$b = [];
	$b['state_name'] = $ar['state_name'];
	$b['state_id'] = $ar['state_id'];
	return $b;
}, $state_city_array))));
?>
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

	<!-- Main sidebar -->
	<?php include('includes/sidebar.php') ?>
	<!-- /main sidebar -->
	<!-- Main content -->
	<div class="content-wrapper">

	  <!-- Page header -->
		<div class="page-header page-header-light">
			<div class="page-header-content header-elements-md-inline">
				<div class="page-title d-flex">
					<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">State & City</span> - Manage Cities</h4>
					<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
				</div>
			</div>

			<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
				<div class="d-flex">
					<div class="breadcrumb">
					<a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
					<span class="breadcrumb-item">State & City</span>
					<span class="breadcrumb-item active">Manage Cities</span>
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
							<h6 class="card-title">Add City</h6>
						</div>

						<div class="card-body">
							<form id="insertPincodeForm">
								<fieldset class="mb-3">
									<div class="form-group row">
										<label class="col-form-label col-lg-1">Select State:</label>
										<div class="col-lg-2">
										<select class="form-control form-control-uniform state" name="state_id" data-fouc>
											<option value="opt1">Select State</option>
											<?php foreach ($states as $r) { ?>
											<option value="<?= $r['state_id'] ?>"><?= $r['state_name'] ?></option>
											<?php } ?>
										</select>
										</div>
										<label class="col-form-label col-lg-1">Select City:</label>
										<div class="col-lg-2">
										<select class="form-control form-control-uniform" name="city_id" data-fouc>
										</select>
										</div>
										<label class="col-form-label col-lg-1">Pincode Name:</label>
										<div class="col-lg-4">
										<input type="text" class="form-control pincodeName" name="txtpincode" placeholder="Enter Name of pincode...">
										<input type="hidden" name="pincode_id" class="pincode_id">
										<div class="myMsg" style="position: absolute;left: 15px;"></div>
										</div>
									</div>

									<div class="d-flex justify-content-end align-items-center">
										<button type="submit" class="btn submitcity btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
					<div class="card">
						<div class="card-header col-md-4">
							<select class="form-control form-control-uniform state" id="state_id" data-fouc>
								<option value="opt1">Select State</option>
								<?php foreach ($states as $r) { ?>
								<option value="<?= $r['state_id'] ?>"><?= $r['state_name'] ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="card-body" id="myDataTable">
						</div>
					</div>

				</div>
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
<script type="text/javascript">
var cities = <?= json_encode($state_city_array) ?>;
$('#state_id').change(function(){
	var caturl = '<?= base_url('admin/pincodetable/') ?>';
	viewTable(caturl+$(this).val());
})

var editModeCity = 0;
  $(document).ready(function(){
	// View City Table on Load

	$('select[name=state_id]').change(function(){
		var state_id = $(this).val();
		$('select[name=city_id]').html('');
		$('select[name=city_id]').change();
		let citydrop = cities.filter(ar => {
			return ar.state_id == state_id;
		});
		for (let index = 0; index < citydrop.length; index++) {
			$('select[name=city_id]').append(new Option( citydrop[index].city_name, citydrop[index].city_id ));
		}
		if(editModeCity) {
			$('select[name=city_id]').val(editModeCity).trigger('change');
		}
	});
	
	// Insert Pinciode

	$('#insertPincodeForm').on('submit',function(e){
	  e.preventDefault();
	  var formData = new FormData(this);
	  $.ajax({
		url: '<?= base_url('admin/insertpincode') ?>',
		type: 'post',
		processData: false,
		contentType: false,
		data: formData,
		success: function(a){
			$('.myMsg').html(a);
			editModeCity = 0;
			$('#insertPincodeForm').trigger('reset');
			viewTable(caturl);
		}
	  })
	});
})

// Edit & Delete City
  function editPincode($cat)
	{
		var formData = new FormData();
		formData.set('pincode_id',$cat);
	  	$.ajax({
			url:'<?= base_url('admin/editpincode') ?>',
			type: 'post',
			processData: false,
			contentType: false,
			data: formData,
			dataType: 'json',
			success: function(a){
				$('.pincodeName').val(a[0]['pincode']);
				let cityval = cities.find(ar => {
					return a[0]['city_id'] == ar.city_id;
				});
				editModeCity = cityval.city_id;
				$('select[name=state_id]').val(cityval.state_id).trigger('change');
				$('.pincode_id').val(a[0]["pincode_id"]);
				$('.submitPincode').html('Update  <i class="icon-paperplane ml-2"></i>');
			}
	  	})
	};
	function deletePincode($cat)
	{
		var formData = new FormData();
		formData.set('pincode_id',$cat);
		formData.set('delete_pincode',1);

		if (confirm('Are you Sure that You want to delete this Pincode?')) {
			$.ajax({
				url:'<?= base_url('admin/deletepincode') ?>',
				type: 'post',
				processData: false,
				contentType: false,
				data: formData,
				success: function(a){
				viewTable('<?= base_url('admin/pincodetable') ?>');
				}
			})
		}
	};
</script>
</body>
</html>
