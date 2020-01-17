<?php if(isset($banners) && count($banners) != 0){ ?>
  <div class="category-description std" style="margin-bottom: -28px">
    <div class="slider-items-products">
      <div id="category-desc-slider" class="product-flexslider hidden-buttons">
        <div class="slider-items slider-width-col1 owl-carousel owl-theme">
          <?php
            foreach ($banners as $r) { ?>

              <div class="item"> <a href="#"><img src='<?=FOLDER_ASSETS_TEMPLATEBANNER.$r->banner_img ?>' alt="slide-img"/></a></div>

          <?php } ?>
        </div>
      </div>
    </div>
  </div>
<?php } ?>