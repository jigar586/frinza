<?php
if (count($shiprates) == 0) {
    echo "<p style='color:red'>Shipping is not Available for Selected City!!</p>";
    exit();
}
$ships = array('','Fixed Time Delivery','Mid Night Delivery','Standard Delivery','Early Morning Delivery');
foreach ($shiprates as $r) {
    
?>
<style type="text/css">
  input[type=checkbox], input[type=radio]{
    margin: 0px;
  }
</style>
<div class="form-group clearfix">
    
    <div class="btn-group shiplabels">
        <!-- <label for="ship_<?= $r->rate_id ?>" class="btn btn-info">
            <span class="glyphicon glyphicon-ok"></span>
            <span> </span>
        </label> -->
        <label for="ship_<?= $r->rate_id ?>" class="btn btn-default" style="width: 200px;"><input type="radio" name="shipping" value='<?= $r->rate_id ?>' id="ship_<?= $r->rate_id ?>" autocomplete="off" style="display: none;"/>
            <?= $ships[$r->shipping_id] ?>
        </label>
        <label for="ship_<?= $r->rate_id ?>" class="btn btn-info" >
            <span>
                <?php
                    if ($r->shipping_rate == 0) {
                        echo " Free";
                    }else{
                        echo "₹".$r->shipping_rate;
                    }
                ?>
            </span>
        </label>
    </div>
</div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('input[name="shipping"]').on('click',function(){
          $('input[name="shipping"]').next('.shiplabels').children('label').removeClass('btn-success active');
          $('input[name="shipping"]:checked').next('.shiplabels').children('label').toggleClass('btn-success active');
          $('#shippingType').hide();
          var formData = new FormData();
          formData.set('date', $('#dDate').val());
          formData.set('shiptype',$('input[name="shipping"]:checked').val());
          formData.set('productSpe',productSpecial);
          $.ajax({
            url: '<?= base_url('product/timeslotpick') ?>',
            contentType: false,
            processData: false,
            type: 'post',
            data: formData,
            success: function(a){
              $('#timeSlotPick').html(a);
              $('#timeSlotPick').show();
               $('#shippingType').hide();
               $('#datetimepicker12').hide();
            }
          })  
        });
    })
</script>