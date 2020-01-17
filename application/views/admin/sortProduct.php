<!DOCTYPE html>
<html lang="en">

<?php include('includes/headerlinks.php') ?>

<body>
		<style>
			li.selected > div{ border: 1px solid red; }
		</style>
		<?php include('includes/header.php') ?>  

							<div class="page-content">

								<?php include('includes/sidebar.php') ?>
								
								<div class="content-wrapper">
									<div class="page-header page-header-light">
										<div class="page-header-content header-elements-md-inline">
										<div class="page-title d-flex">
											<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Products</span> - View Products</h4>
											<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
										</div>
									</div>
									<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
									<div class="d-flex">
										<div class="breadcrumb">
										<a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
										<span class="breadcrumb-item active">Products</span>
										<span class="breadcrumb-item active">Sorting Products</span>
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
										<h6 class="card-title">Product Sorting</h6>
									</div>
									<div class="card-body" id="myDataTable">
										<form action="" method="post" class="col-md-12">
											<div class="row">
												<div class="col-md-3">
													<label class="col-form-label col-md-12">Select Category:</label>
													<select name="category_id" id="multiSelectCat" class="form-control select" data-fouc data-placeholder='Select Category'>
														<option value="">Select Category</option>
														<?php
														foreach ($categories as $r) { ?>
															<option value="<?= $r->category_id ?>"><?= $r->category_name ?></option>
														<?php  }
														?>
													</select>
												</div>

												<div class="col-md-3">
													<label class="col-form-label col-md-12">Select Sub Category:</label>
													<select id="multiSelectSubCat" class="form-control select" data-placeholder='Select subcategory' name="subcategory_id" data-fouc>
														<option value="">Select Sub Category</option>
                       								</select>
												</div>

												<div class="col-md-3">
													<label class="col-form-label col-md-12">Select Chield Category:</label>
													<select id="multiSelectChildCat" class="form-control select" data-placeholder='Select Childcategory' name="child_id" data-fouc>
														<option value="">Select Child Category</option>
													</select>
												</div>

												<div class="col-md-3">
													<label class="col-form-label col-md-12">&nbsp;</label>
													<button type="button" class="btn btn-primary ml-3 legitRipple fetchproducts" name="">Submit</button>
												</div>

											</div>
										</form>
									</div>
								</div>
								<div class="card">
									<div class="card-header header-elements-inline">
										<h6 class="card-title">Product Listings</h6> <p class="msgDisp"></p>
										<button id="btnSubmitList" type="button text-right pull-right" class="btn btn-primary">Submit Listing</button>
									</div>
									<div class="card-body" id="myDataTable">
										<form action="" method="post" class="col-md-12">
											<div class="ProductGrid">
											</div>
											<ul class="row sorting-area list-inline">
											</ul>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		<?php include('includes/footer.php') ?>

	</div>

</div>

<?php include('includes/footerlinks.php') ?>
<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/extensions/jquery_ui/interactions.min.js"></script>
<script src="https://rawgithub.com/shvetsgroup/jquery.multisortable/master/src/jquery.multisortable.js"></script>
<script type="text/javascript">
	var page_no = 0;
	var cat_id= '';
	var sub_cat_id= '';
	var child_cat_id= '';
	var finished = false;
	$(document).ready(function(){
		$('#btnSubmitList').hide();
		$('#multiSelectSubCat').on('change',function(){
			var ID = $(this).val();
			$('#multiSelectChildCat').html('');
			$.ajax({
				url: '<?= base_url('admin/selectedChildcatlistData') ?>',
				type: 'post',
				dataType: 'json',
				data: {subcategory_id:ID},
				success: function(a){
					$('#multiSelectChildCat').append("<option value=''>Select Child Category</option>");
					$.each(a, function (){
						$('#multiSelectChildCat').append($("<option     />").val(this.id).text(this.text));
					});
				}
			})
		});
		
		$('#multiSelectCat').on('change',function(){
			var ID = $(this).val();
			$('#multiSelectChildCat').html('');
			$('#multiSelectSubCat').html('');
			$.ajax({
			url: '<?= base_url('admin/selectedSubcatlist') ?>',
			type: 'post',
			data: {category_id:ID},
			dataType: 'json',
			success: function(a){
				$('#multiSelectSubCat').append("<option value=''>Select Sub Category</option>");
				$.each(a, function (){
					$('#multiSelectSubCat').append($("<option     />").val(this.id).text(this.text));
				});
			}
			})
		});
		
		$('.fetchproducts').on('click',function(){
			cat_id = $('select[name=category_id]').val();
			sub_cat_id = $('select[name=subcategory_id]').val();
			if(!sub_cat_id)
				sub_cat_id = '';
				
			child_cat_id = $('select[name=child_id]').val();
			if(!child_cat_id)
				child_cat_id = '';
			$('.ProductGrid').html('<input type="hidden" name="hdn_cat_id" value="'+cat_id+'"><input type="hidden" name="hdn_sub_cat_id" value="'+sub_cat_id+'"><input type="hidden" name="hdn_child_id" value="'+child_cat_id+'">');
			$('.sorting-area').html('');
			page_no = 0;
			finished=false;
			getProducts(child_cat_id, sub_cat_id, cat_id);
		});
		$('#btnSubmitList').click(function(){
			var cat_id = rel_id = $('input[name=hdn_cat_id]').val();
			var priority = 1;
			var sub_cat_id = $('input[name=hdn_sub_cat_id]').val();
			if( sub_cat_id){
				priority = 2;
				rel_id = sub_cat_id;
			}
			var child_cat_id = $('input[name=hdn_child_id]').val();
			if( child_cat_id){
				priority = 3;
				rel_id = child_cat_id;
			}

			var element = [];
			$('.sorting-area > li').each((index, ele) => {
				element.push({
					product_id : $(ele).attr('data-product'),
					order_no : index,
					priority : priority,
					rel_id : rel_id
				});
			});

			var elm = JSON.stringify(element);
			$.ajax({
				url: '<?= base_url('admin/sortProduct') ?>',
				type: 'post',
				data: {array:elm},
				dataType: 'json',
				success: function(a){
					if(a.status == 'success'){
						$('p.msgDisp').addClass('text-success');
					}else{
						$('p.msgDisp').addClass('text-danger');
					}
					$('p.msgDisp').html(a.message)
				}
			})
		});
	});
	$(window).scroll(function() {
		if(($(window).scrollTop() + $(window).height() + 50) >= $(document).height()) {
			getProducts(child_cat_id, sub_cat_id, cat_id);
		}
	});
	function getProducts(child, sub, cat)
	{
		if(finished)
			return;
		finished = true;
		$.ajax({
			url: '<?= base_url('admin/productlist') ?>',
			type: 'post',
			data: {
					category_id : cat, 
					sub_cat_id : sub, 
					child_cat_id : child, 
					page: page_no
				},
			dataType: 'json',
			success: function(res){
				page_no = res.page;
				var a = res.data;
				finished = !res.data.length;
				for( i=0; i<a.length; i++ ){
					img = JSON.parse(a[i]['product_img']);
					$('.sorting-area').append('<li class="col-xl-2 col-sm-4" data-position="'+(i+((page_no-1)*24))+'" data-product="'+a[i]['product_id']+'"><div class="card"><div class="card-body"><div class="card-img-actions"><a><img src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT ?>'+img[0]+'" class="card-img" width="96" alt=""></a></div></div><div class="card-body bg-light text-center"><div class="mb-2"><h6 class="font-weight-semibold mb-0">'+a[i]['product_title']+'</h6><h7 class="font-weight-semibold mb-0">₹ &nbsp;'+a[i]['price']+'</h7></div></div></div></li>');
				}
				$('.sorting-area').multisortable();
				// $('.sorting-area').sortable({
				// 	stop: function(event, ui) {
				// 		newval = ui.item.index();
				// 		oldval = ui.item.attr('data-position');
				// 		if( oldval >  newval ){
				// 			for (let index = 0 + newval; index < oldval; index++) {
				// 				$('.sorting-area').find('div[data-position="'+(index)+'"]').last().attr('data-position', index+1);
				// 			}
				// 			$('.sorting-area').find('div[data-position="'+oldval+'"]').first().attr('data-position', newval);
				// 			$( ".sorting-area" ).sortable( "refreshPositions" );
							
				// 		}else if(oldval < newval){
				// 			for (let index = 0 + newval; index > oldval; index--) {
				// 				$('.sorting-area').find('div[data-position="'+index+'"]').first().attr('data-position', index-1);
				// 			}
				// 			$('.sorting-area').find('div[data-position="'+oldval+'"]').last().attr('data-position', newval);
				// 			$( ".sorting-area" ).sortable( "refreshPositions" );
				// 		}
				// 	}
				// });
				$('#btnSubmitList').show();
				$('.sorting-area').disableSelection();
			}
		})
	}
</script>

</body>
</html>
