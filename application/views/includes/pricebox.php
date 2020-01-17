 <?php
	  if ($price != $sPrice) { ?>
	    <p class="special-price"> <span class="price-label"></span> <span id="product-price-48" class="price"> ₹<span id="currentPrice"><?= number_format($sPrice,2) ?></span></span> </p>
	    <p class="old-price"> <span class="price-label"></span> <span class="price"> ₹<span id="oldPrice"><?= number_format($price,2) ?></span> </span> </p>
	<?php  }else{ ?>
	  <p class="regular-price"> <span class="price-label"></span> <span id="product-price-48" class="price"> ₹<span id="currentPrice"><?= number_format($price,2) ?></span></span> </p>
	<?php }
	?>
	<p class="availability in-stock pull-right"><span>In Stock</span></p>