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
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Category Management</span> - Category</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item">Category Management</span>
							<span class="breadcrumb-item active">Category</span>
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
								<h6 class="card-title">Add Category</h6>
							</div>
							<div class="card-body">
								<form id="insertCategoryForm">
									<fieldset class="mb-3">
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Addon Category Name:</label>
											<div class="col-lg-8">
												<input type="text" name="txtcat" class="form-control catName" placeholder="Enter Name of Addon Category...">
												<input type="hidden" name="addoncategory_id" class="addoncategory_id">
											</div>
                                        </div>
                                        <div class="myMsg" style="position: absolute;left: 15px;"></div>
										<div class="row form-group">
											<div class="col-lg-8 offset-lg-2">
                                                
												<button type="submit" class="btn submitcat btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
											</div>
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
	var caturl = '<?= base_url('admin/addoncattable') ?>';
	$(document).ready(function(){
		// View Category Table on Load
		
		viewTable(caturl);

		$('.text-editor').summernote({ 
          fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Raleway'],
          fontNamesIgnoreCheck: ['Raleway'],
        });
      	$('.text-editor').summernote('fontName','Raleway');

		// Insert Category
		$('#insertCategoryForm').on('submit',function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: '<?= base_url('admin/insertaddoncat') ?>',
				type: 'post',
				processData: false,
				contentType: false,
				data: formData,
				success: function(a){
					$('.myMsg').html(a);
					$('#insertCategoryForm').trigger('reset');
					viewTable(caturl);
				}
			})
		});
	})
	// Edit & Delete Category
	function editCategory($cat)
	{
		var formData = new FormData();
		formData.set('category_id',$cat);
		$.ajax({
			url:'<?= base_url('admin/editcat') ?>',
			type: 'post',
			processData: false,
			contentType: false,
			data: formData,
			success: function(a){
				a= JSON.parse(a);
				$('.catName').val(a[0]['category_name']);
			}
		})
	};
	function deleteCategory($cat)
	{
		var formData = new FormData();
		formData.set('addoncategory_id',$cat);
		formData.set('delete_cat',1);
		
		if (confirm('Are you Sure that You want to delete this Category?')) {
			$.ajax({
				url:'<?= base_url('admin/deleteAddoncat') ?>',
				type: 'post',
				processData: false,
				contentType: false,
				data: formData,
				success: function(a){
					$('.myMsg').html(a);
					viewTable(caturl);
				}
			})
		} 
	};
	function updateCat(arg,arg2)
	{
		$.ajax({
			url:'<?= base_url('admin/deleteAddoncat') ?>',
			type: 'post',
			data: {id:arg,res:arg2},
			success: function(a){
				viewTable(caturl);
			}
		})
	}
	function onCat(arg)
	{
		updateCat(arg,1);
	}
	function offCat(arg)
	{
		updateCat(arg,0);
	}
</script>
</body>
</html>
