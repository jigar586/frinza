<?php 
$i = 0;
foreach ($timeSlots as $ts) {

    $cDate = $date.' '.$ts->end_time;
    if ($ts->end_time == '12:00 AM') {
        $cDate = $date.' '.'24:00';
    }
   $ctdate = strtotime($cDate);
    if ($ctdate > strtotime(date('Y-m-d H:i:s',strtotime('+'.$time_gap)))) {
        $i++;
         ?>
        <div class="form-group clearfix text-center">
            <input type="radio" name="timing" value="<?= $ts->timing_id ?>" id="timeslot<?= $ts->timing_id ?>" autocomplete="off" style="display: none;"/>
            <div class="btn-group timelabels">
                <label for="timeslot<?= $ts->timing_id ?>" class="btn btn-info timRad" >
                    <span class="glyphicon glyphicon-ok"></span>
                    <span> </span>
                </label>
                <label for="timeslot<?= $ts->timing_id ?>" class="btn btn-info timRad" style="width: 200px;">
                   <?= $ts->start_time ?> - <?= $ts->end_time ?>
                </label>
            </div>
        </div>
<?php    }}
if ($i == 0) { ?>
<div>
    <p>Sorry No Time Slots are available for Your Selected Date in This type of Shipping!!</p>
    <p>Select Another Shipping Type!!</p>
</div>
<?php }else{ ?>
    
    <?php } ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('input[name="timing"]').on('change',function(){
                $('input[name="timing"]').next('.timelabels').children('label').removeClass('btn-success active').addClass('btn-info');
                $('input[name="timing"]:checked').next('.timelabels').children('label').toggleClass('btn-success btn-info active');
                $('#addCart').trigger('submit');
            });
        })
    </script>