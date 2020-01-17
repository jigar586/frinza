<?php if(isset($banners) && count($banners) != 0){ ?>
	<div id="magik-slideshow" class="noMargin magik-slideshow">
		<div class="container no-paddingrl">
			<div class="row">
				<div class="col-md-12">
					<div id='rev_slider_4_wrapper' class='rev_slider_wrapper fullwidthbanner-container'>
						<div id='rev_slider_4' class='rev_slider fullwidthabanner'>
							<ul>
								<?php
									foreach ($banners as $r) { 
								?>
									<li data-transition='random' data-slotamount='7' data-mIberisspeed='1000' data-thumb='<?=FOLDER_ASSETS_TEMPLATEBANNER.$r->banner_img ?>' onclick="window.location.href = '<?= @$r->url ?>'">
										<img src='<?=FOLDER_ASSETS_TEMPLATEBANNER.$r->banner_img ?>' alt="slide-img" data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat' />
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>