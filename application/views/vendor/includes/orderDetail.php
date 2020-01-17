
  <h6>Product Details</h6>
  <table class="table table-bordered table-responsive">
    <thead>
      <tr>
        <th></th>
        <th>Product Title</th>
        <th>Qty</th>
        <th>Ship Time</th>
        <th>Ship To:</th>
        <th>Contact:</th>
        <th>Message</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if (count($Orders)) {
          foreach ($Orders as $od) {
            $orderDate = date('M d,Y',strtotime($od->created_at));
            $shipTime = date('M d,y h:i a',strtotime($od->ship_from)).'-'.date('h:i a',strtotime($od->ship_till));
            $img = json_decode($od->product_img);
            $personalize_img = json_decode($od->personalize_img);
           ?>
            <tr>
              <td><a href="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$img[0] ?>" download><img src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$img[0] ?>" height='120px'></a></td>
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
              <td><?= $shipTime ?></td>
              <td><?= $od->name.' '.$od->last_name.'<br>'.$od->address_1.'<br>'.$od->address_2.'<br>'.$od->city.', '.$od->pin_code.'<br>' ?></td>
              <td><?= $od->contact ?></td>
              <td><?= $od->msg_card ?></td>
            </tr>
        <?php  }
        }
       ?>
    </tbody>
  </table>
 
