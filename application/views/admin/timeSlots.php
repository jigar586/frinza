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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Charges</span> - Time Slots</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item">Charges</span>
              <span class="breadcrumb-item active">Time Slots</span>
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
                <h6 class="card-title">Set Time Slots</h6>
              </div>
              <div class="card-body">
                <div class="card-body">
                <form id="setTimeSlot" method="post">
                <fieldset class="mb-3">
                  <div class="form-group row">
                    <label class="col-form-label col-lg-2">Select Shipping Method:</label>
                    <div class="col-lg-4">
                      <select class="form-control form-control-uniform shippingtype" name="shippingtype" data-fouc>
                        <option value="3">Standard Delivery</option>
                        <option value="4">Early Morning Delivery</option>
                        <option value="1">Fixed Time Delivery</option>
                        <option value="2">Mid Night Delivery</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-2"> Shipping Time Slot:</label>
                    <div class="col-4">
                      <input type="text" class="form-control pickatime" name="fromTime" placeholder="Enter Start Time">
                    </div>
                    <div class="col-4">
                      <input type="text" class="form-control pickatime" name="toTime" placeholder="Enter End Time">
                    </div>
                  </div>
                    <div class="d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn submitsubcat btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
                  </div>
              </fieldset>
            </form>
          </div>
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
  var caturl = '<?= base_url('admin/timeslottable') ?>';
   
  $(document).ready(function(){
    // View City Table on Load
     viewTable(caturl);

    // Insert SubCategory
    $('#setTimeSlot').on('submit',function(e){
      e.preventDefault();

      var formData = new FormData(this);
      $.ajax({
        url: '<?= base_url('admin/settimeslot') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
            $('.myMsg').html(a);
            $('#setTimeSlot').trigger('reset');
            $('.shippingtype').click();
            viewTable(caturl);
        }
      })
    });
})

// Edit & Delete City
    function deleteSlot($cat)
    {
      var formData = new FormData();
      
      if (confirm('Are you Sure that You want to delete this TimeSlot?')) {
          $.ajax({
            url:'<?= base_url('admin/deleteslot') ?>',
            type: 'post',
            data: {slot_id:$cat},
            success: function(a){
              viewTable(caturl);
              $('#setShipRate').trigger('reset');
              $('.shippingtype').click();
              $('.myMsg').html(a);
            }
          })
      }
      
    };
</script>
</body>
</html>
