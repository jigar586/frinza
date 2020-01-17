
  <?php
  if (!isset($_SESSION['compareProduct'])) {
        exit();
      }
  ?>
  <div class="block-title "><h3>Compare Products (<?= count($_SESSION['compareProduct']) ?>)</h3></div>
  <div class="block-content">
    <ol id="compare-items">
      <?php
      
        foreach ($_SESSION['compareProduct'] as $cp) {
          $comP = $this->shop->checkProduct($cp);
        
      ?>
      <li class="item">
        <a class="btn-remove1" title="Remove This Item" href="javascript:void(0)" onclick="addToCompare(<?= $cp ?>)"></a>
        <a href="<?= base_url('gift/').$comP[0]->product_id.'/'.url_title(strtolower($comP[0]->product_title)) ?>" class="product-name"> <?= $comP[0]->product_title ?></a> 
      </li>
    <?php } ?>
    </ol>
    <div class="ajax-checkout">
      <button type="submit" title="Submit" class="button button-compare"><span>Compare</span></button>
      <button type="submit" title="Submit" class="button button-clear" onclick="addToCompare(0)"><span>Clear</span></button>
    </div>
  </div>