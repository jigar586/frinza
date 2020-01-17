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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Charges</span> - Extra</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item active">Charges</span>
              <span class="breadcrumb-item active">Extra</span>
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
                <h6 class="card-title">Add Extra Charges</h6>
              </div>

              <div class="card-body">
                <form id="insertSubForm">
                <fieldset class="mb-3">
                  <div class="form-group row">
                    <label class="col-form-label col-lg-2">Select Category:</label>
                    <div class="col-lg-8">
                      <select class="form-control form-control-uniform category" name="category_id" data-fouc required title="Please Select Category to Add Charge">
                        <option value="">Select Category</option>
                        <?php
                          foreach ($categories as $r) { ?>
                            <option value="<?= $r->category_id ?>"><?= $r->category_name ?></option>
                        <?php  }
                        ?>
                      </select>
                    </div>
                  
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input-styled-primary" name="random" data-fouc>
                        Is Size?
                      </label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-4">
                      <label class="col-form-label">Name of Charge:</label>
                      <input type="text" class="form-control charge_name" name="charge_name" placeholder="Enter name of Charge" required title="Please Enter Name of Charge">
                    </div>
                    <div class="col-4">
                      <label class="col-form-label"> Charge:</label>
                      <input type="text" class="form-control charge_amount" name="charge_amount" placeholder="Enter Amount to Charge" required title="Please Enter Amount of Money to Charge">
                    </div>
                    <div class="col-2">
                      <label class="col-form-label"> Type:</label>
                      <select class="form-control form-control-uniform charge_type" name="charge_type" data-fouc required title="Please Select Type of Charge to Add Charge">
                        <option value="1">₹ Flat</option>
                        <option value="2">% Percentage</option>
                      </select>
                    </div>
                    <input type="hidden" name="chargeID" class="chargeID">
                    
                  </div>
                  <div class="myMsg"></div>
                  <div class="d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn submitsubcat btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
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
  $(document).ready(function(){
    // View City Table on Load
    var caturl = '<?= base_url('admin/chargestable') ?>';
    viewTable(caturl);

    // Insert SubCategory
    $('#insertSubForm').on('submit',function(e){
      e.preventDefault();
      if ($('select.category').val() == '') {
        $('select.category').addClass('is-invalid');
        return false;
      }else{
        $('select.category').removeClass('is-invalid');
      }
      var formData = new FormData(this);
      $.ajax({
        url: '<?= base_url('admin/insertcharges') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
            $('.myMsg').html(a);
            $('#insertSubForm').trigger('reset');
            $('.category').click();
            $('.charge_type').click();
            $('input[name=random]').parent('span.checked').removeClass('checked');
            viewTable(caturl);
        }
      })
    });
})

// Edit & Delete City
  function editCharge($cat)
    {
      var formData = new FormData();
      formData.set('charge_id',$cat);
      $.ajax({
        url:'<?= base_url('admin/editcharge') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
          a= JSON.parse(a);
          $('.category').val(a[0]['category_id']).click();
          $('.charge_type').val(a[0]["charge_type"]);
          $('.charge_amount').val(a[0]["charge_amount"]);
          $('.chargeID').val(a[0]["charge_id"]).click();
          $('.charge_name').val(a[0]["charge_name"]);
          $('.submitsubcat').html('Update  <i class="icon-paperplane ml-2"></i>');
        }
      })
    };
    function deleteCharge($cat)
    {
      var formData = new FormData();
      formData.set('charge_id',$cat);
      formData.set('delete_charge',1);
      
      if (confirm('Are you Sure that You want to delete this Charge?')) {
          $.ajax({
            url:'<?= base_url('admin/deletecharge') ?>',
            type: 'post',
            processData: false,
            contentType: false,
            data: formData,
            success: function(a){
              viewTable('<?= base_url('admin/chargestable') ?>');
              $('#insertSubForm').trigger('reset');
              $('.category').click();
              $('.charge_type').click();
              $('.myMsg').html(a);
            }
          })
      }
      
    };
</script>
</body>
</html>
