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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Charges</span> - Shipping Charges</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item">Charges</span>
              <span class="breadcrumb-item active">Shipping Charges</span>
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
                <h6 class="card-title">Set Shipping Charge</h6>
              </div>

              <div class="card-body">
                <form id="setShipRate" method="post">
                <fieldset class="mb-3">
                  <div class="form-group row">
                    <label class="col-form-label col-lg-2">Select Shipping Method:</label>
                    <div class="col-lg-6">
                      <select class="form-control form-control-uniform shippingtype" name="shippingtype" data-fouc>
                        <option value="1">Fixed Time Delivery</option>
                        <option value="2">Mid Night Delivery</option>
                        <option value="3">Regular Delivery</option>
                        <option value="4">Early Morning Delivery</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-2">Select Cities:</label>
                    <div class="col-lg-6">
                      <select class="form-control select citysel" data-placeholder="Select Cities..." name="avail_at[]" multiple="multiple" data-fouc required>
                          <?php
                          foreach ($states as $r) { ?>
                            <optgroup label="<?= $r->state_name ?>">
                              <?php
                              $cond['state_id'] = $r->state_id;
                              $city = $this->cities->getCity($cond);
                              foreach ($city as $cc) { ?>
                                <option value="<?= $cc->city_id ?>"><?= $cc->city_name ?></option>
                              <?php  } ?>
                            </optgroup>
                          <?php  } ?>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-outline-success selectAllBtn" onclick="selectAll()">Select All</button>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-2"> Charge:</label>
                    <div class="col-lg-6">
                      <input type="number" class="form-control shipcharge" name="shipcharge" placeholder="Enter Amount to Charge">
                    </div>
                  </div>
                  <div class="offset-2">
                    <button type="submit" class="btn submitsubcat btn-primary ml-1">Submit <i class="icon-paperplane ml-2"></i></button>
                    <div class="myMsg d-block ml-2 mt-1"></div>
                  </div>
                  
                
              </fieldset>
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-body" id="myDataTable">
            
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
<script type="text/javascript">
   var caturl = '<?= base_url('admin/shipratetable') ?>';
  $(document).ready(function(){
    // View City Table on Load
    viewTable(caturl);
    $('#setShipRate').on('submit',function(e){
      e.preventDefault();
      if(!$.isNumeric($('.shipcharge').val())) {
        alert('Enter Valid Amount!');
         return false;
      }
      var formData = new FormData(this);
      $.ajax({
        url: '<?= base_url('admin/setshiprate') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
            $('.myMsg').html(a);
            $('#setShipRate').trigger('reset');
            $('.shippingtype').click();
            viewTable(caturl);
        }
      })
    });
});

// Edit & Delete City
    function deleteCharge($cat)
    { 
      if (confirm('Are you Sure that You want to delete this Shipping Rate?')) {
          $.ajax({
            url:'<?= base_url('admin/deleteshiprate') ?>',
            type: 'post',
            data: {rate_id:$cat},
            success: function(a){
              viewTable(caturl);
              $('#setShipRate').trigger('reset');
              $('.shippingtype').click();
              $('.myMsg').html(a);
            }
          })
      }
    }
    function selectAll()
      {
        if ($('select.citysel').val().length == 0) {
          $('select.citysel').select2('destroy').find('option').prop('selected', 'selected').end().select2();
          $('.selectAllBtn').removeClass('btn-outline-success').addClass('btn-outline-danger').text("Deselect All");
        }else{
          $('select.citysel').select2('destroy').find('option').prop('selected', false).end().select2();
          $('.selectAllBtn').removeClass('btn-outline-danger').addClass('btn-outline-success').text("Select All");
        }
      }
</script>
</body>
</html>
