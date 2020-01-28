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
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Products</span> - Create Product</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item">Products</span>
							<span class="breadcrumb-item active">Create Product</span>
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
								<h6 class="card-title">Add Product</h6>
							</div>
							<?php 
							if (isset($editProductData) && count($editProductData) != 0) {
								$personalized = $editProductData[0]->is_personalize ? 'checked' : '';
								$meta_title = $editProductData[0]->meta_title ? $editProductData[0]->meta_title : '';
								$meta_key = $editProductData[0]->meta_keyword ? $editProductData[0]->meta_keyword : '';
								$meta_dec = $editProductData[0]->meta_description ? $editProductData[0]->meta_description : '';
								$courier = $editProductData[0]->is_courier ? 'checked' : '';
								$productTitle = $editProductData[0]->product_title;
								$productID = '<input type="hidden" name="product_id" value="'.$editProductData[0]->product_id.'">';
								$sku = $editProductData[0]->sku_code;
								$avail_at = json_decode($editProductData[0]->avail_at);
								$price = $editProductData[0]->price;  
								$prodesc = $editProductData[0]->product_desc;
								$order_slot = $editProductData[0]->order_till;
								$order_slot = explode(' ', $order_slot);
								$selCat = '';
								$comma = '';
								$pincode_block = $editProductData[0]->pincode_block;
								$search_terms = $editProductData[0]->search_terms;
								foreach ($categoryArr as $v) {
									$selCat .= $comma;
									$selCat .= $v['key'];
									$comma = ',';
								}
								$selSubCat = '';
								$comma = '';
								foreach ($subcategoryArr as $v) {
									$selSubCat .= $comma;
									$selSubCat .= $v['key'];
									$comma = ',';
								}
								$selChild = '';
								$comma = '';
								foreach ($childcategoryArr as $v) {
									$selChild .= $comma;
									$selChild .= $v['key'];
									$comma = ',';
								}
								$img1 = json_decode($editProductData[0]->product_img);
								$img = '<div class="mt-2">';
									for ($i=0; $i < count($img1); $i++) { 
										$img .= '<img class="mr-2" src="'.FOLDER_ASSETS_TEMPLATEPRODUCT.$img1[$i].'" width="150px">';
									}
									$img .= '</div>';
								}
								?>
								<div class="card-body">
									<form id='insertProductForm'>
										<fieldset class="mb-3">
											<div class="form-group row">
												<label class="col-form-label col-lg-2">Category</label>
												<div class="col-lg-8">
													<select name="category_id[]" multiple="multiple" id="multiSelectCat" class="form-control select" data-fouc data-placeholder='Select Category'>
														<?php
														foreach ($categories as $r) { ?>
															<option value="<?= $r->category_id ?>"><?= $r->category_name ?></option>
														<?php  }
														?>
													</select>
													</div>
													<div class="col-lg-2">
														<button type="button" class="btn btn-outline-success selectAllBtn" onclick="selectAll(this,'select#multiSelectCat')">Select All</button>
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-form-label col-lg-2">Sub Category</label>
													<div class="col-lg-8">
														<select multiple="multiple" id="multiSelectSubCat" class="form-control select" data-placeholder='Select subcategory' name="subcategory_id[]" data-fouc>
														</select>
													</div>
													<div class="col-lg-2">
														<button type="button" class="btn btn-outline-success selectAllBtn" onclick="selectAll(this,'select#multiSelectSubCat')">Select All</button>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-lg-2">Child Category</label>
													<div class="col-lg-8">
														<select multiple="multiple" id="multiSelectChildCat" class="form-control select" data-placeholder='Select Childcategory' name="child_id[]" data-fouc>
															<option value="<?= @$child_id ?>"><?= @$child_id != '' ? getChildName($child_id) : 'Select Child Category' ?></option>
														</select>
													</div>
													<div class="col-lg-2">
														<button type="button" class="btn btn-outline-success selectAllBtn" onclick="selectAll(this,'select#multiSelectChildCat')">Select All</button>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-lg-2">Product Title:</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" name="product_title" placeholder="Enter Name of Product..." value="<?= @$productTitle ?>">
														<?= @$productID ?>
													</div>
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" class="form-check-input-styled-primary" value="1" name="is_personalize" <?= @$personalized ?> data-fouc>
															Is Personalized?
														</label>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-lg-2">SKU_Code:</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" name="sku_code" placeholder="Enter SKU..." value="<?= @$sku ?>">
													</div>
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" class="form-check-input-styled-primary" value="1" name="is_courier" <?= @$courier ?> data-fouc>
															Is Courier?
														</label>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-lg-2">Price:</label>
													<div class="col-lg-8">
														<input type="number" class="form-control" name="price" placeholder="Enter Price..." value="<?= @$price ?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-lg-2">Available in:</label>
													<div class="col-lg-8">
														<select class="form-control select citysel" data-placeholder="Select Cities..." name="avail_at[]" multiple="multiple" data-fouc id="availableAt">
															
															<?php
															foreach ($states as $r) { ?>
																<!-- <optgroup label="<?= $r->state_name ?>"> -->
																	<?php
																	$cond['state_id'] = $r->state_id;
																	$city = $this->cities->getCity($cond);
																	foreach ($city as $cc) { ?>
																		<option value="<?= $cc->city_id ?>" <?php echo @in_array($cc->city_id, $avail_at) ? 'selected' : '' ?>><?= $cc->city_name ?></option>
																		<?php  } ?>
																	<!-- </optgroup> -->
																	<?php  } ?>
																</select>
															</div>
															<div class="col-lg-2">
																<button type="button" class="btn btn-outline-success selectAllBtn" onclick="selectAll(this,'select.citysel')">Select All</button>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-form-label col-lg-2">Add Images:</label>
															<div class="col-lg-8">
																<input type="file" class="form-control-uniform-custom" name="product_img[]" multiple="multiple" data-fouc>
																<?= @$img ?>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-form-label col-lg-2">Product Description:</label>
															<div class="col-lg-8">
																<textarea rows="3" cols="3" maxlength="1000" class="form-control" name="product_desc" placeholder="Product Description"><?= @$prodesc ?></textarea>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-form-label col-lg-2">Order before:</label>
															<div class="col-lg-4">
																<input type="number" class="form-control" name="order_slot" placeholder="" value="<?= @$order_slot[0] ? @$order_slot[0] : 3 ?>">
															</div>
															<div class="col-lg-4">
																<select class="form-control" name="order_slot_type">
																	<option value="hours" <?=  @$order_slot[1] != 'days' ? 'selected' : '' ?>>Hours</option>
																	<option value="days" <?= @$order_slot[1] == 'days' ? 'selected' : '' ?>>Days</option>
																</select>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-form-label col-lg-2">Meta Title:</label>
															<div class="col-lg-8">
																<input type="text" name="metaTitle" class="form-control metaTitle" placeholder="Meta Title" value= "<?= @$meta_title ?>">
															</div>
														</div>
														<div class="form-group row">
															<label class="col-form-label col-lg-2">Meta keyword:</label>
															<div class="col-lg-8">
																<textarea name="metakey" class="form-control metakey" placeholder="Meta Keywords"><?= @$meta_key ?></textarea>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-form-label col-lg-2">Meta Description:</label>
															<div class="col-lg-8">
																<textarea name="metadec" class="form-control metadec" placeholder="Meta Description"><?= @$meta_dec ?></textarea>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-form-label col-lg-2">Search Trems:</label>
															<div class="col-lg-8">
															<input type="text" name="search_terms" class="form-control tokenfield" placeholder="Add Search Terms" value="<?= @$search_terms ?>" data-fouc>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-form-label col-lg-2">Blocked Pincode:</label>
															<div class="col-lg-8">
															<input type="text" name="pincode_block" class="form-control tokenfield" placeholder="Add Blocked Pincodes" value="<?= @$pincode_block ?>" data-fouc>
															</div>
														</div>
														<div class="form-group row"> 
															<label class="col-form-label col-lg-2">Addon Category</label>
															<div class="col-lg-8">
																<select name="addoncategory_id" class="form-control select" data-fouc data-placeholder='Select Addon Category'>
																	<option value="0">Not an Add-on</option>
																	<?php
																	foreach ($addoncategories as $r) { ?>
																		<option value="<?= $r['addoncategory_id'] ?>"><?= $r['addoncategory_name'] ?></option>
																		<?php  }
																		?>
																</select>
															</div>
														</div>
														<div class="form-group row"> 
															<label class="col-form-label col-lg-2">Tax</label>
															<div class="col-lg-8">
																<select name="tax_id" class="form-control select" data-fouc data-placeholder='Select tax'>
																	<option value="0">Select Tax</option>
																	<?php
																	foreach ($taxes as $r) { ?>
																		<option value="<?= $r->id ?>"><?= $r->label ?></option>
																		<?php  }
																		?>
																</select>
															</div>
														</div>
														<hr>
														<div class="form-group row tblVariation">
															<label class="col-form-label col-lg-12">Variations:</label>
															<div class="col-lg-10">
																<table class="table table-bordered">
																	<thead>
																		<tr>
																			<th>Title</th>
																			<th>Value</th>
																			<th>Type</th>
																			<th>is Size?</th>
																			<th></th>
																		</tr>
																	</thead>
																	<tbody id="VariationRows">
																		<?php ?>
																		<tr>
																			<td>
																				<input type="text" class="form-control charge_name" name="charge_name0" placeholder="Enter name of Charge" title="Name of Charge" value="<?= @$extraCharges[0]->charge_name ?>">
																				<input type="hidden" name="variations[]" value="0">
																			</td>
																			<td>
																				<input type="text" class="form-control charge_amount" name="charge_amount0" placeholder="Enter Amount to Charge" title="Amount to Charge" value="<?= @$extraCharges[0]->charge_amount ?>">
																			</td>
																			<td>
																				<select class="form-control form-control-uniform charge_type" name="charge_type0" data-fouc title="Type of Charge">
																					<option value="1" <?= @$extraCharges[0]->charge_type == 1 ? 'selected' : '' ?>>₹ Flat</option>
																					<option value="2" <?= @$extraCharges[0]->charge_type == 2 ? 'selected' : '' ?>>% Perc</option>
																				</select>
																			</td>
																			<td class="text-center">
																				<input type="checkbox" value='1' class="form-control-uniform mx-auto" name="random0" <?= @$extraCharges[0]->is_opt ? 'checked' : '' ?> data-fouc>
																			</td>
																			<td>
																				<div class="text-center d-block">
																					<a href="javascript:void(0)" onclick="insertRow()">
																						<span class="text-success"><i class="icon-plus-circle2"></i></span>
																					</a>
																				</div>
																				
																			</td>
																		</tr>
																		<?php
																		for ($i=1; $i < @count($extraCharges); $i++) { ?>
																			<tr class="variationRow<?= $i ?>">
																				<td>
																					<input type="text" class="form-control charge_name" name="charge_name<?= $i ?>" placeholder="Enter name of Charge" required title="Name of Charge" value='<?= @$extraCharges[$i]->charge_name ?>'>
																					<input type="hidden" name="variations[]" value="<?= $i ?>">
																				</td>
																				<td>
																					<input type="text" class="form-control charge_amount" name="charge_amount<?= $i ?>" placeholder="Enter Amount to Charge" required title="Amount to Charge" value='<?= @$extraCharges[$i]->charge_amount ?>'>
																				</td>
																				<td>
																					<select class="form-control form-control-uniform charge_type" name="charge_type<?= $i ?>" data-fouc required title="Type of Charge">
																						<option value="1" <?= @$extraCharges[$i]->charge_type == 1 ? 'selected' : '' ?>>₹ Flat</option>
																						<option value="2" <?= @$extraCharges[$i]->charge_type == 2 ? 'selected' : '' ?>>% Perc</option>
																					</select>
																				</td>
																				<td class="text-center">
																					<input type="checkbox" class="form-control-uniform mx-auto" name="random<?= $i ?>" <?= @$extraCharges[$i]->is_opt ? 'checked' : '' ?> value='1' data-fouc>
																				</td>
																				<td>
																					<div class="text-center d-block">
																						<a href="javascript:void(0)" onclick="insertRow()">
																							<span class="text-success"><i class="icon-plus-circle2"></i></span>
																						</a>
																						<a href="javascript:void(0)" onclick="removeRow(<?= @$i ?>)">
																							<span class="text-danger"><i class="icon-cancel-circle2"></i></span>
																						</a>
																					</div>
																				</td>
																			</tr>
																			<?php  }
																			?>
																		</tbody>
																	</table>
																</div>
															</div>
															
															<div class="d-flex justify-content-end align-items-center">
																<button type="submit" class="btn btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
															</div>
															<div class="myMsg" style="position: absolute;left: 15px;"></div>
														</fieldset>
													</form>
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
			
			<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/forms/tags/tokenfield.min.js"></script>
			<script type="text/javascript">
				$(document).ready(function(){

					var scrollTopA;
					var scrollTopB;
					var scrollTopC;
					var scrollTopD;
					$('#availableAt, #multiSelectChildCat, #multiSelectSubCat, #multiSelectCat').select2({closeOnSelect: false});
					// $('#availableAt').on("select2:open", function( event ){
					// 	console.log(event);
					// 	var $pr = $( '#'+event.params.args.data._resultId ).parent();
					// 	$pr.prop('scrollTop', $pr.prop('scrollTop') );
					// });
					$('#availableAt').on("select2:selecting", function( event ){


					    var $pr = $( '#'+event.params.args.data._resultId ).parent();
					    console.log($pr);
					    scrollTopA = $pr.prop('scrollTop');
					});
					$('#availableAt').on("select2:select", function( event ){
					    var $pr = $( '#'+event.params.data._resultId ).parent();
					    $pr.prop('scrollTop', scrollTopA );
					});
					$('#availableAt').on("select2:unselecting", function( event ){
					    var $pr = $( '#'+event.params.args.data._resultId ).parent();
					    scrollTopA = $pr.prop('scrollTop');
					});
					$('#availableAt').on("select2:unselect", function( event ){
					    var $pr = $( '#'+event.params.data._resultId ).parent();
					    $pr.prop('scrollTop', scrollTopA );
					});
					$('#multiSelectChildCat').on("select2:selecting", function( event ){
					    var $pr = $( '#'+event.params.args.data._resultId ).parent();
					    scrollTopB = $pr.prop('scrollTop');
					});
					$('#multiSelectChildCat').on("select2:select", function( event ){
					    var $pr = $( '#'+event.params.data._resultId ).parent();
					    $pr.prop('scrollTop', scrollTopB );
					});
					$('#multiSelectChildCat').on("select2:unselecting", function( event ){
					    var $pr = $( '#'+event.params.args.data._resultId ).parent();
					    scrollTopB = $pr.prop('scrollTop');
					});
					$('#multiSelectChildCat').on("select2:unselect", function( event ){
					    var $pr = $( '#'+event.params.data._resultId ).parent();
					    $pr.prop('scrollTop', scrollTopB );
					});
					$('#multiSelectSubCat').on("select2:selecting", function( event ){
					    var $pr = $( '#'+event.params.args.data._resultId ).parent();
					    scrollTopC = $pr.prop('scrollTop');
					});
					$('#multiSelectSubCat').on("select2:select", function( event ){
					    var $pr = $( '#'+event.params.data._resultId ).parent();
					    $pr.prop('scrollTop', scrollTopC );
					});
					$('#multiSelectSubCat').on("select2:unselecting", function( event ){
					    var $pr = $( '#'+event.params.args.data._resultId ).parent();
					    scrollTopC = $pr.prop('scrollTop');
					});
					$('#multiSelectSubCat').on("select2:unselect", function( event ){
					    var $pr = $( '#'+event.params.data._resultId ).parent();
					    $pr.prop('scrollTop', scrollTopC );
					});
					$('#multiSelectCat').on("select2:selecting", function( event ){
					    var $pr = $( '#'+event.params.args.data._resultId ).parent();
					    scrollTopD = $pr.prop('scrollTop');
					});
					$('#multiSelectCat').on("select2:select", function( event ){
					    var $pr = $( '#'+event.params.data._resultId ).parent();
					    $pr.prop('scrollTop', scrollTopD );
					});
					$('#multiSelectCat').on("select2:unselecting", function( event ){
					    var $pr = $( '#'+event.params.args.data._resultId ).parent();
					    scrollTopD = $pr.prop('scrollTop');
					});
					$('#multiSelectCat').on("select2:unselect", function( event ){
					    var $pr = $( '#'+event.params.data._resultId ).parent();
					    $pr.prop('scrollTop', scrollTopD );
					});

					// $(".select2-search, .select2-focusser").remove();
					// $('#availableAt, #multiSelectChildCat, #multiSelectSubCat, #multiSelectCat').on('select2:closing',function(event){
					// 	$(".select2-search, .select2-focusser").remove();
					// });

					$('select[name=addoncategory_id]').change(function(){
						if( $(this).val() != 0 ){
							$('.tblVariation').hide();
						}else{
							$('.tblVariation').show();
						}
					});

					$('.tokenfield').tokenfield();

					$('#insertProductForm').on('submit',function(e){
						e.preventDefault();
						var formValues = new FormData(this);
						// count = 0;
						// for ( var value of formValues.values())
						// {
						// 	count++;
						// }
						// console.log(count);
						$.ajax({
							url: '<?= base_url('admin/insertproduct') ?>',
							type: 'post',
							processData: false,
							contentType: false,
							data: formValues,
							success: function(a){
								$('.myMsg').html(a);
								
							}
						});
					});
					$('#multiSelectCat').on('change',function(){
						loadSubCat(function(){
							
						});
					});
					
					$('#multiSelectSubCat').on('change',function(){
						loadChildCat(function(){
						});
					});
				})
				function loadChildCat(callback)
				{
					var ID = $('#multiSelectSubCat').val();
					$('#multiSelectChildCat').html('');
					$.ajax({
						url: '<?= base_url('admin/childcatlistData') ?>',
						type: 'post',
						data: {subcategory_id:ID},
						success: function(a){
							a = JSON.parse(a);
							$('#multiSelectChildCat').select2({
								placeholder: 'Select Child Category',
								minimumResultsForSearch: Infinity,
								data: a,
								closeOnSelect: false
							});
							callback();
						}
					})
				}
				function loadSubCat(callback)
				{
					var ID = $('#multiSelectCat').val();
					$('#multiSelectChildCat').html('');
					$('#multiSelectSubCat').html('');
					$.ajax({
						url: '<?= base_url('admin/subcatlistData') ?>',
						type: 'post',
						data: {category_id:ID},
						success: function(a){
							a = JSON.parse(a);
							$('#multiSelectSubCat').select2({
								placeholder: 'Select Sub Category',
								minimumResultsForSearch: Infinity,
								data: a,
								closeOnSelect: false
							});
							callback();
						}
					})
				}
				function selectAll(btn,select)
				{
					if ($(select).val().length == 0) {
						$(select).select2('destroy').find('option').prop('selected', 'selected').end().select2().change();
						$(btn).removeClass('btn-outline-success').addClass('btn-outline-danger').text("Deselect All");
					}else{
						$(select).select2('destroy').find('option').prop('selected', false).end().select2().change();
						$(btn).removeClass('btn-outline-danger').addClass('btn-outline-success').text("Select All");
					}
					
				}
				var rowCount = 0;
				function insertRow()
				{
					rowCount++;
					$('#VariationRows').append(`<tr class="variationRow`+rowCount+`">
						<td>
							<input type="text" class="form-control charge_name" name="charge_name`+rowCount+`" placeholder="Enter name of Charge" required title="Name of Charge">
							<input type="hidden" name="variations[]" value="`+rowCount+`">
						</td>
						<td>
							<input type="text" class="form-control charge_amount" name="charge_amount`+rowCount+`" placeholder="Enter Amount to Charge" required title="Amount to Charge">
						</td>
						<td>
							<select class="form-control-uniform charge_type" name="charge_type`+rowCount+`" required title="Type of Charge">
								<option value="1">₹ Flat</option>
								<option value="2">% Perc</option>
							</select>
						</td>
						<td class="text-center">
							<input type="checkbox" class="form-control-uniform" name="random`+rowCount+`" >
						</td>
						<td>
							<div class="text-center d-block">
								<a href="javascript:void(0)" onclick="insertRow()">
									<span class="text-success"><i class="icon-plus-circle2"></i></span>
								</a>
								<a href="javascript:void(0)" onclick="removeRow(`+rowCount+`)">
									<span class="text-danger"><i class="icon-cancel-circle2"></i></span>
								</a>
							</div>
							
						</td>
					</tr>
					`);
					$('.form-control-uniform').uniform();
				}
				function removeRow(arg)
				{
					$('.variationRow'+arg).remove();
				}
			</script>
			<?php if (@$productID) { ?>
				<script type="text/javascript">
					$(document).ready(function(){
						$('#multiSelectCat').val([<?= $selCat ?>]).trigger('change');
						loadSubCat(
						function(){
							$('#multiSelectSubCat').val([<?= $selSubCat ?>]).trigger('change');
							loadChildCat(
							function(){
								$('#multiSelectChildCat').val([<?= $selChild ?>]).trigger('change');
							}
							);
						});
						
					});
				</script>
				<?php } ?>
			</body>
			</html>
			