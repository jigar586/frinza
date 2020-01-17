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
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Category Management</span> - Sub Category</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
				
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Category Management</span>
							<span class="breadcrumb-item active">Sub Category</span>
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
								<h6 class="card-title">Add Sub Category</h6>
							</div>
							
							<div class="card-body">
								<form id="insertSubForm">
									<fieldset class="mb-3">
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Select Category:</label>
											<div class="col-lg-3">
												<select class="form-control form-control-uniform category" name="category_id" data-fouc>
													<option value="">Select Category</option>
													<?php
													foreach ($categories as $r) { ?>
														<option value="<?= $r->category_id ?>"><?= $r->category_name ?></option>
														<?php  }
														?>
													</select>
												</div>
												<label class="col-form-label col-lg-2">Sub Category Name:</label>
												<div class="col-lg-4">
													<input type="text" name="txtsub" class="form-control subCat" placeholder="Enter Name of Category...">
													<input type="hidden" name="subID" class="subID">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-form-label col-lg-2">Sub Category Heading:</label>
												<div class="col-lg-3">
													<input type="text" name="subheading" class="form-control sub_head" placeholder="Enter Heading of Category...">
												</div>
												<label class="col-form-label col-lg-2">Meta Title:</label>
												<div class="col-lg-4">
													<input type="text" name="metatitle" class="form-control meta_title" placeholder="Enter Meta Title...">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-form-label col-lg-2">Meta Keywords:</label>
												<div class="col-lg-3">
													<textarea name="metakeyword" class="form-control meta_keyword" placeholder="Enter Meta keywords..."></textarea>
												</div>
												<label class="col-form-label col-lg-2">Meta Description:</label>
												<div class="col-lg-4">
													<textarea name="metadescription" class="form-control meta_description" placeholder="Enter Meta description..."></textarea>
													<div class="myMsg" style="position: absolute;left: 15px;"></div>
												</div>
											</div>
											
											<div class="d-flex justify-content-end align-items-center">
												<button type="submit" class="btn submitsubcat btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
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
	var caturl = '<?= base_url('admin/subcattable') ?>';
	$(document).ready(function(){
		// View City Table on Load
		
		viewTable(caturl);
		
		// Insert SubCategory
		$('#insertSubForm').on('submit',function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: '<?= base_url('admin/insertsubcat') ?>',
				type: 'post',
				processData: false,
				contentType: false,
				data: formData,
				success: function(a){
					$('.myMsg').html(a);
					$('#insertSubForm').trigger('reset');
					viewTable(caturl);
				}
			})
		});
	})
	
	// Edit & Delete City
	function editSubcat($cat)
	{
		var formData = new FormData();
		formData.set('subcategory_id',$cat);
		$.ajax({
			url:'<?= base_url('admin/editsubcat') ?>',
			type: 'post',
			processData: false,
			contentType: false,
			data: formData,
			success: function(a){
				a= JSON.parse(a);
				$('.subCat').val(a[0]['subcategory_name']);
				$('.sub_head').val(a[0]['subcategory_heading']);
				$('.meta_title').val(a[0]['meta_title']);
				$('.meta_keyword').val(a[0]['meta_keyword']);
				$('.meta_description').val(a[0]['meta_description']);
				$('.category').val(a[0]['category_id']).click();
				$('.subID').val(a[0]["subcategory_id"]);
				$('.submitsubcat').html('Update  <i class="icon-paperplane ml-2"></i>');
				viewTable(caturl);
			}
		})
	};
	function deleteSubcat($cat)
	{
		var formData = new FormData();
		formData.set('subcategory_id',$cat);
		formData.set('delete_subcat',1);
		
		if (confirm('Are you Sure that You want to delete this Subcategory?')) {
			$.ajax({
				url:'<?= base_url('admin/deletesubcat') ?>',
				type: 'post',
				processData: false,
				contentType: false,
				data: formData,
				success: function(a){
					viewTable(caturl);
					$('#insertSubForm').trigger('reset');
				}
			})
		}
		
	};
	function updateSubCat(arg,arg2)
	{
		$.ajax({
			url:'<?= base_url('admin/deletesubcat') ?>',
			type: 'post',
			data: {id:arg,res:arg2},
			success: function(a){
				viewTable(caturl);
			}
		})
	}
	function onSubCat(arg)
	{
		updateSubCat(arg,1);
	}
	function offSubCat(arg)
	{
		updateSubCat(arg,0);
	}
</script>
</body>
</html>
