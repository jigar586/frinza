<h6>Product Details</h6>
<table class="table table-bordered table-responsive">
    <thead>
      <tr>
        <th></th>
        <th>Product Title</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Ship Time</th>
        <th>Order Date</th>
        <th>Message</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if (count($orderData)) {
          foreach ($orderData as $od) {
            $orderDate = date('M d,Y',strtotime($od->created_at));
            $shipTime = date('M d,y h:i a',strtotime($od->ship_from)).'-'.date('h:i a',strtotime($od->ship_till));
            $img = json_decode($od->product_img);
            $personalize_img = json_decode($od->personalize_img);
           ?>
            <tr>
              <td><img src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$img[0] ?>" height='120px'></td>
              <td><input type="hidden" name="HdnID[]" value="<?= $od->detail_id ?>"><b><?= $od->product_title ?></b><br><font size="1"><?= @getExtraTitle(@$od->extra,'- ','<br>') ?></font>
                <?php 
                  if(count($personalize_img)){
                    foreach ($personalize_img as $key => $value) { ?>
                       <a class="btn btn-primary" href="<?= @FOLDER_ASSETS_PERSONALIZE.$value ?>" style="margin-top: 10px;" download="<?= 'frinza-buyer-image-ord-no-'.$od->detail_id.'-'.($key+1) ?>">File <?= $key+1 ?></a>
                  <?php  }
                  } 
                ?>
              </td>
              <td><?= $od->qty ?></td>
              <td>₹<?= $od->price ?></td>
              <td><?= $shipTime ?></td>
              <td><?= $orderDate ?></td>
              <td><?= $od->msg_card ?></td>
            </tr>
        <?php  }
        }
       ?>
    </tbody>
</table>
 
