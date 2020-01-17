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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Vendors</span> - Add Vendor</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item">Vendors</span>
              <span class="breadcrumb-item active">Add Vendor</span>
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
                <h6 class="card-title">Add Vendor</h6>
              </div>
              <?php 
                if (isset($editVendorData) && count($editVendorData) != 0) {
                  $vendorname = $editVendorData[0]->vendor_name;
                  $vendorID= $editVendorData[0]->vendor_id ;
                  $email = $editVendorData[0]->vendor_email;
                  $Address = $editVendorData[0]->vendor_address;
                  $vendorCity = $editVendorData[0]->city_id;
                  $GetState = $this->cities->getCityState($vendorCity);
                  $state = $GetState[0]->state_id;
                  $pin = $editVendorData[0]->pin_code;
                  $vendorContact = $editVendorData[0]->vendor_contact;

                }
              ?>
              <div class="card-body">
                <form id="vendorSubmit">
                <fieldset class="mb-3">
                 <input type="hidden" name="vendor_id" value="<?= $vendorID ?>">
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Vendor Name:</label>
                  <div class="col-lg-8">
                    <input type="text" name="vendor_name" class="form-control" placeholder="Enter Name of Vendor..." value="<?= @$vendorname ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Vendor's Email:</label>
                  <div class="col-lg-8">
                    <input type="text" name="vendor_email" class="form-control" placeholder="Enter Email ID of Vendor..." value="<?= @$email ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Vendor's Password:</label>
                  <div class="col-lg-8">
                    <input type="password" name="vendor_pwd" class="form-control" placeholder="Enter Password for Vendor...">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Vendor's Address:</label>
                  <div class="col-lg-8">
                    <textarea rows="3" cols="3" name="vendor_address" class="form-control" placeholder="Enter Vendor's Address"><?= @$Address ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Pin Code:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" name="pin_code" placeholder="Enter Pin Code of Vendor..." maxlength="6" value="<?= @$pin ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Select State:</label>
                  <div class="col-lg-8">
                      <select class="form-control form-control-uniform states" name="state" data-fouc required>
                          <option value="">Select State</option>
                          <?php
                            foreach ($states as $r) { ?>
                              <option value="<?= $r->state_id ?>" <?= $r->state_id == $state ? 'selected' : '' ?>><?= $r->state_name ?></option>
                          <?php  }
                          ?>
                      </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Select City:</label>
                  <div class="col-lg-8">
                    <select class="form-control form-control-uniform city_field"  name="city_id" data-fouc required>
                          <option value="<?= @$vendorCity ?>"><?= @$vendorCity != '' ? @getCityName($vendorCity) : 'Select City' ?></option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Contact No:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" name="vendor_contact" placeholder="Enter Mobile No. of Vendor..." value="<?= @$vendorContact ?>">
                  </div>
                </div>
                <div class="myMsg" style="position: absolute;left: 18.5%;"></div>
                <div class="d-flex justify-content-end align-items-center">
                  <button type="submit" class="btn btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
                </div>
                </fieldset>
                </form>
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
   
    $('input,textarea').on('change',function(){
      if ($(this).val() != null || $(this).value != "") {
      $(this).css('border-color','#ddd');
      }
    });
    $('.states').on('change',function(){
      var stateID = $('.states').val();
      $('.city_field').html('<option value="">Select City</option>');
      var formData = new FormData();
      formData.set('state_id',stateID);
      $.ajax({
        url: '<?= base_url('admin/citylist') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
          a = JSON.parse(a);
          $.each(a,function(ind,value){
            var opt = $('<option/>');
            opt.val(value['city_id']);
            opt.text(value['city_name']);
            $('.city_field').append(opt);
          })
        }
      })
    });
    $('#vendorSubmit').on('submit',function(e){
      e.preventDefault();
      if (validate() != 0) {
        return false;
      }
      var formData = new FormData(this);
      $.ajax({
        url: '<?= base_url('admin/addvendor') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
          $('.myMsg').html(a);
          $('#vendorSubmit').trigger('reset');
        }
      })
    })
  });
  function validate()
  {
    var inps = $('input:not([type=hidden]),select,textarea');
    var count = 0;
    $.each(inps,function(ind,inp){
      if (inp.value == null || inp.value == "") {
      $(this).css('border-color','red');
      count++;
      }else{
        $(this).css('border-color','#ddd');
      }
    });
    return count;  
  }
</script>
</body>
</html>
