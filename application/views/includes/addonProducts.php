<style>
	.checkmark{
	    position: absolute;
		top: 0;
		left: 0;
		-moz-box-sizing: border-box;
		font-size: 20px;
		display: block;
		width: 30px;
		font-weight: bold;
		padding: 7px;
		font-size: 30px;
		height: 30px;
		color: #e62263;
		line-height: 16px;
		text-align: center;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		border:0px solid #000;
	}
	.chkCont .checkmark:after {
		-ms-transform: rotate(45deg);
		left: 9px;
		top: 5px;
		width: 9px;
		height: 14px;
		border: solid #fff;
		border-width: 0 3px 3px 0;
		-webkit-transform: rotate(45deg);
		-ms-transform: rotate(45deg);
		transform: rotate(45deg);
		background: #e62263;
	}
</style>
<ul id="product-detail-tab" class="nav nav-tabs product-tabs">
	<?php 
		for ($i=0; $i < count($categoryArr) ; $i++) { 
			//if(count($categoryArr[$i]->dataArray)){
	?>
		<li class="<?php if($i == 0){ echo "active"; } ?>"><a href="#addon_tab<?= $categoryArr[$i]->addoncategory_id ?>" data-toggle="tab"><?= $categoryArr[$i]->addoncategory_name ?></a></li>
	<?php //} 
	} ?>
</ul>
<form action="<?= base_url('cart/addtocart') ?>" method="post">
	<div id="productTabContent" class="tab-content">
		<?php 
			for ($i=0; $i < count($categoryArr) ; $i++) {
		?>
		<div class="tab-pane fade in <?php if($i == 0){ ?> active <?php } ?>" id="addon_tab<?= $categoryArr[$i]->addoncategory_id ?>">
			<div class="row">
				<div class="col-md-12">
					<?php
						if(count($categoryArr[$i]->dataArray)){
						foreach($categoryArr[$i]->dataArray as $catProd) {
							$img =json_decode($catProd->product_img); 
					?>
					<div class="col-md-3 col-xs-6">
						<div class="item">
							<div class="item-inner">
								<div class="item-img">
									<div class="item-img-info">
										<label class="chkCont" style="margin-bottom: 10px"><input type="checkbox" class="shipAdd" name="product_id[]" value="<?= $catProd->product_id ?>"><span class="checkmark">+</span></label>
										<img class="img-responsive imgClick" alt="Retis lapen casen" src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$img[0] ?>">
									</div>
								</div>
								<div class="item-info">
									<div class="info-inner">
										<div class="item-title"><h5 style="max-height: 30px; overflow: hidden;"><?= $catProd->product_title ?> </h5></div>
										<div class="item-content">
											<div class="item-price">
												<div class="price-box"> <span class="regular-price"> 
													<span class="price"><?= $catProd->price ?></span> </span>
												</div>
											</div>
											<div class="action">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } }else{
						echo "No add on available.";
					} ?>
				</div>
			</div>	
		</div>
		<?php } ?>
	</div>
	<button type="submit" class="button btn-continue pull-right addonaddToCart" name="cart_id" style="margin: 10px;padding: 12px;">Continue</button>
	<button type="button" class="button btn-continue pull-right " data-dismiss="modal" style="margin: 10px;padding: 12px;">Skip</button>
</form>
<script>
	$('document').ready(function(){
		$('.imgClick').click(function(){
			$(this).parent().find('.shipAdd').click();
		});
	})

</script>