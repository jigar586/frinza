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
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Category Management</span> - Child Category</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item">Category Management</span>
							<span class="breadcrumb-item active">Child Category</span>
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
								<h6 class="card-title">Add Child Category</h6>
							</div>
							<div class="card-body">
								<form id="insertSubForm">
									<fieldset class="mb-3">
										<div class="form-group row">
											<label class="col-form-label col-2">Select Category:</label>
											<div class="col-3">
												<select class="form-control form-control-uniform category" data-fouc>
													<option value="">Select Category</option>
													<?php foreach ($categories as $r) { ?>
														<option value="<?= $r->category_id ?>"><?= $r->category_name ?></option>
													<?php  } ?>
												</select>
											</div>
											<label class="col-form-label col-2">Sub Category:</label>
											<div class="col-3">
												<select class="form-control form-control-uniform subcategory" name="subcategory_id" data-fouc>
													<option value="">Select Sub Category</option>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Enter Child Category Name:</label>
											<div class="col-lg-8">
												<input type="text" name="txtchild" class="form-control childCat" placeholder="Enter Name of Child Category...">
												<input type="hidden" name="childID" class="childID">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2">H1 Child Category Heading:</label>
											<div class="col-lg-8">
												<input type="text" name="childheading" class="form-control childheading" placeholder="Enter Heading of Child Category...">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2">H1 Heading Description:</label>
											<div class="col-lg-8">
												<textarea name="headingDescription" maxlength="1000" class="form-control headingDescription" placeholder="Heading Description"></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Enter Meta Title:</label>
											<div class="col-lg-8">
												<input type="text" name="meta_title" class="form-control meta_title" placeholder="Enter Meta Title...">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Meta keyword:</label>
											<div class="col-lg-8">
												<textarea name="metakey" class="form-control metakey" placeholder="Meta Keywords"></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Meta Desc:</label>
											<div class="col-lg-8">
												<textarea name="metadec" class="form-control metaDesc" placeholder="Meta Description"></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Static Block:</label>
											<div class="col-lg-8">
												<textarea name="static_block" class="form-control static_block text-editor" placeholder="Static Block"></textarea>
												<div class="myMsg" style="position: absolute;left: 15px;"></div>
											</div>
										</div>	
										<div class="d-flex justify-content-end align-items-center">
											<button type="submit" class="btn submitsubcat btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
										</div>
									</fieldset>
								</form>
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
	var caturl = '<?= base_url('admin/childcattable') ?>';
	$(document).ready(function(){
		// View City Table on Load
		viewTable(caturl);
		$('.text-editor').summernote({ 
          fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Raleway'],
          fontNamesIgnoreCheck: ['Raleway'],
        });
      	$('.text-editor').summernote('fontName','Raleway');

		$('.category').on('change',function(){
			var ID = $('.category').val();
			$('.subcategory').html('<option value="">Select Sub Category</option>');
			$.ajax({
				url: '<?= base_url('admin/subcatlist') ?>',
				type: 'post',
				data: {category_id:ID},
				success: function(a){
					a = JSON.parse(a);
					$.each(a,function(ind,value){
						var opt = $('<option/>');
						opt.val(value['subcategory_id']);
						opt.text(value['subcategory_name']);
						$('.subcategory').append(opt);
					})
				}
			})
		});
		// Insert SubCategory
		$('#insertSubForm').on('submit',function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: '<?= base_url('admin/insertchildcat') ?>',
				type: 'post',
				processData: false,
				contentType: false,
				data: formData,
				success: function(a){
					$('.myMsg').html(a);
					$('#insertSubForm').trigger('reset');
					$('.static_block').summernote('code', '');
					viewTable(caturl);
				}
			})
		});
	})
	// Edit & Delete City
	function editChildcat($cat)
	{
		var formData = new FormData();
		formData.set('child_id',$cat);
		$.ajax({
			url:'<?= base_url('admin/editchildcat') ?>',
			type: 'post',
			processData: false,
			contentType: false,
			data: formData,
			success: function(a){
				a= JSON.parse(a);
				$('.childCat').val(a[0]['child_name']);
				$('.meta_title').val(a[0]['child_title']);
				$('.childheading').val(a[0]['child_heading']);
				$('.headingDescription').val(a[0]['heading_description']);
				$('.category').val(a[0]['category_id']).change();
				setTimeout(function(){$('.subcategory').val(a[0]['subcategory_id']).change();},500);
				$('.childID').val(a[0]["child_id"]);
				$('.metakey').val(a[0]["meta_keyword"]);
				$('.metaDesc').val(a[0]["meta_description"]);
				$('.static_block').summernote('code', a[0]["static_block"]);
				$('.submitsubcat').html('Update  <i class="icon-paperplane ml-2"></i>');
				viewTable(caturl);
			}
		})
	};
	function deleteChildcat($cat)
	{
		var formData = new FormData();
		formData.set('child_id',$cat);
		formData.set('delete_childcat',1);
		
		if (confirm('Are you Sure that You want to delete this Child Category?')) {
			$.ajax({
				url:'<?= base_url('admin/deletechildcat') ?>',
				type: 'post',
				processData: false,
				contentType: false,
				data: formData,
				success: function(a){
					viewTable('<?= base_url('admin/childcattable') ?>');
					$('#insertSubForm').trigger('reset');
				}
			})
		}
		
	};
	function updateChildCat(arg,arg2)
	{
		$.ajax({
			url:'<?= base_url('admin/deletechildcat') ?>',
			type: 'post',
			data: {id:arg,res:arg2},
			success: function(a){
				viewTable(caturl);
			}
		})
	}
	function isDisplayChildCat(arg,arg2)
	{
		$.ajax({
			url:'<?= base_url('admin/isdisplaychildcat') ?>',
			type: 'post',
			data: {id:arg,res:arg2},
			success: function(a){
				viewTable(caturl);
			}
		})
	}
	function onChildCat(arg)
	{
		updateChildCat(arg,1);
	}
	function offChildCat(arg)
	{
		updateChildCat(arg,0);
	}
	function isDisplay(arg,is_display)
	{
		if(is_display == 1){
			is_display = 0;
		}else{
			is_display = 1;
		}
		isDisplayChildCat(arg,is_display);
	}
</script>
</body>
</html>