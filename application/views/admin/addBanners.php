<!DOCTYPE html>
<html lang="en">
<!-- Headerlinks -->
<?php include('includes/headerlinks.php') ?>
<body>

  	<?php include('includes/header.php') ?>

	<div class="page-content">
		
		<?php include('includes/sidebar.php') ?>
		
		<div class="content-wrapper">
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Website</span> - Banners</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item">Website</span>
							<span class="breadcrumb-item active">Banners</span>
						</div>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
		
			<div class="content">
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header header-elements-inline">
								<h6 class="card-title">Add Banners</h6>
							</div>
							<div class="card-body">
								<form id="addBannerForm">
									<div class="form-group row">
										<div class="form-group col-md-4">
											<label class="col-form-label">Category:</label>
											<input type="hidden" name="bannerId">
											<select class="form-control category_id" name="category_id" data-fouc>
												<option value="0">Home Page Banner</option>
												<?php foreach ($categories as $r) { ?>
													<option value="<?= $r->category_id ?>"><?= $r->category_name ?></option>
												<?php  } ?>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label class="col-form-label">Child Category:</label>
											<select class="form-control child_id" name="child_id" data-fouc>
												<option value="0">Select Child Category</option>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label class="col-form-label">Banner Type:</label>
											<select class="form-control form-control-uniform " name="banner_type" data-fouc>
												<option value="full">Full</option>
												<option value="icon">Icon</option>
												<option value="text">Text</option>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label class="col-form-label">Image:</label>
											<input type="file" name="banner" class="form-control-uniform-custom" data-fouc>
											<img id='img-upload' style="width: 300px; padding: 20px 0;" />
										</div>
										
										<div class="form-group col-md-4">
											<label class="col-form-label">Banner URL:</label>
											<input type="text" name="url" class="form-control" placeholder="Banner Redirect Url">
										</div>
										
										<div class="form-group col-md-4">
											<label class="col-form-label">Banner Name:</label>
											<input type="text" name="banner_name" class="form-control" placeholder="Banner Name">
										</div>
									</div>
									<div class="d-flex justify-content-end align-items-center">
										<button type="submit" class="btn btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
										<div class="myMsg" style="position: absolute;left: 15px;color: red;"></div>
									</div>
								</form>
							</div>
						</div>

						<div class="card">
							<div class="card-header header-elements-inline">
								<h6 class="card-title">Banners</h6>
							</div>
							<div class="card-body"  id="myDataTable">

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('includes/footer.php') ?>

</div>


<?php include('includes/footerlinks.php') ?>

<script type="text/javascript">

	$('select.child_id').select2();
	$('select.category_id').select2();
	var cats = <?= json_encode($child_categories) ?>;
    var selected_childs = '';
    var firstFetch = true;
	$(document).ready(function(){
		
		$("input[name=banner]").change(function(){
			var file_size = $(this)[0].files[0].size;
			if(file_size>2097152) {
				$('#img-upload').attr('src','').css({'width':'0px','margin-bottom':'10px'});
				$("#file_error").html("File size is greater than 2MB");
				return false;
			}
			$("#file_error").html("");
			readURL(this);
		});

		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#img-upload').attr('src', e.target.result).css({'width':'120px','margin-bottom':'10px'});
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		var banurl = '<?= base_url('admin/bantable') ?>';
		viewTable(banurl);
		$('#addBannerForm').on('submit',function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: '<?= base_url('admin/insertbanner') ?>',
				type: 'post',
				processData: false,
				contentType: false,
				data: formData,
				success: function(a){
					$('.myMsg').html(a);
					$('#addBannerForm').trigger('reset');
					$('input[name=bannerId]').val('');
					$('button[type=submit]').html('Submit  <i class="icon-paperplane ml-2"></i>');
					viewTable(banurl);
				}
			})
		})
	});
	function updateBanner($id,$e)
	{
		var data = new FormData();
		data.append('banner_id',$id);
		data.append('status',$e);
		$.ajax({
			url:'<?= base_url('admin/updateban') ?>',
			type: 'post',
			processData: false,
			contentType: false,
			data: data,
			success: function(a){
				$('.myMsg').html(a);
				viewTable('<?= base_url('admin/bantable') ?>');
			}
		});
  	}

	function onBanner($id){
		updateBanner($id,1);
	}

	function offBanner($id){
		updateBanner($id,0);
	}
	
	function deleteBanner($id){
		if (confirm("Are you Sure You want to Delete this Banner?")) {
			updateBanner($id,2);
		}
	}
	
	function editBanner($id){
		var formData = new FormData();
		formData.set('banner_id',$id);
		$.ajax({
			url:'<?= base_url('admin/editbanner') ?>',
			type: 'post',
			processData: false,
			contentType: false,
			data: formData,
			success: function(a){
				a= JSON.parse(a);
				$('input[name=bannerId]').val(a[0]["banner_id"]);
				$('select[name=category_id]').val(a[0]["category_id"]).trigger('change');
				$('select[name=banner_type]').val(a[0]["banner_type"]);
				$('input[name=url]').val(a[0]["url"]);
				$('input[name=banner_name]').val(a[0]["banner_name"]);
				$('select[name=child_id]').val(a[0]["child_id"]);
				$('button[type=submit]').html('Update  <i class="icon-paperplane ml-2"></i>');
				$('#img-upload').attr('src','<?= FOLDER_ASSETS_TEMPLATEBANNER ?>'+a[0]['banner_img']);
				document.body.scrollTop = 0; // For Safari
  				document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
			}
		})
	}

	$('select.category_id').change(function(){
        var category_id = $(this).val();
		fetchChildCategories(category_id);
    });

    function fetchChildCategories(category_id) {
        $('select.child_id').html('');
		$('select.child_id').change();
		let childs = cats.filter(ar => {
			return category_id.indexOf(ar.category_id) > -1;
		});
		$('select.child_id').html('<option value="0" selected>Select Child Category</option>');
		for (let index = 0; index < childs.length; index++) {
			$('select.child_id').append(new Option( childs[index].child_name, childs[index].child_id ));
        }
        if(firstFetch) {
            $('select.child_id').val(selected_childs).trigger('change');
        }
        firstFetch = false;
    }
</script>
</body>
</html>
