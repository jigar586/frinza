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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Corporate Order</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item active">Corporate Order</span>
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
                <h6 class="card-title">Add Order</h6>
              </div>

              <div class="card-body">
                <form id='insertProductForm'>
                  <fieldset class="mb-3">
                    <div class="form-group row">
                      <label class="col-form-label col-lg-2">Enter SKU to Search:</label>
                      <div class="col-lg-8">
                        <input type="text" class="form-control" name="sku" id="sku_search" placeholder="Search Product with SKU">
                        <div class="alert alert-danger border-0 alert-dismissible" id="searchMsg" style="display: none">
                          <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                          <div></div>
                        </div>
                      </div>
                      
                    </div>
                    <div class="form-group row">
                      <label class="col-form-label col-lg-2">Product Title <span class="text-danger">*</span>:</label>
                      <div class="col-lg-8">
                        <select class="form-control select-search select product" data-placeholder="Select Product..." name="product" data-fouc>
                          <option value="">Select Product</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-form-label col-lg-2">Order Value <span class="text-danger">*</span>:</label>
                      <div class="col-lg-1">
                        <input type="number" class="form-control" name="qty" placeholder="Qty">
                      </div>
                      <div>
                        <label class="col-form-label">X</label>
                      </div>
                      <div class="col-lg-2">
                        <input type="number" name="price" class="form-control" placeholder="Enter Order Price">
                      </div>
                      <div>
                        <label class="col-form-label">=</label>
                      </div>
                      <div class="col-lg-2">
                        <input type="text" name="amount" class="form-control" value="₹0" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-form-label col-lg-2">Extra Charges:</label>
                      <div class="col-lg-8" id="extraCharge">
                        <input type="text" class="form-control" placeholder="Select Product to get Extra Charges" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-form-label col-lg-2">Delivery Details <span class="text-danger">*</span>:</label>
                      <div class="col-lg-8">
                        <div class="row">
                          <div class="col-3">
                            <input type="number" name="ship_price" class="form-control" placeholder="Shipping Charge" >
                          </div>
                          <div class="col-3">
                            <input type="text" class="form-control daterange-single" placeholder="Deliver On" name="date" >
                          </div>
                          <div class="col-3">
                            <input type="text" class="form-control pickatime" name="fromTime" placeholder="Deliver From" >
                          </div>
                          <div class="col-3">
                            <input type="text" class="form-control pickatime" name="toTime" placeholder="Deliver Till" >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-form-label col-lg-2">Billing Details <span class="text-danger">*</span>:</label>
                      <div class="col-lg-8">
                        <div class="mb-1 row">
                          <div class="col-6">
                            <input type="text" name="bill_fname" class="form-control" placeholder="First Name" >
                          </div>
                          <div class="col-6">
                            <input type="text" name="bill_lname" class="form-control" placeholder="Last Name" >
                          </div>
                        </div>
                        <div class="mb-1 row">
                          <div class="col-6">
                            <input type="email" name="bill_email" class="form-control" placeholder="Email" >
                          </div>
                          <div class="col-6">
                            <input type="number" name="bill_contact" class="form-control" placeholder="Contact" >
                          </div>
                        </div>
                        <div class="mb-1">
                          <input type="text" name="bill_address_1" class="form-control" placeholder="Address Line 1" >
                        </div>
                        <div class="mb-1">
                          <input type="text" name="bill_address_2" class="form-control" placeholder="Address Line 2" >
                        </div>
                        <div class="mb-1 row">
                          <div class="col-lg-4">
                            <input type="number" class="form-control" name="bill_pincode" placeholder="Enter Pin Code">
                          </div>
                          <div class="col-lg-4">
                            <input type="text" class="form-control" name="bill_city" placeholder="Enter City" >
                          </div>
                          <div class="col-lg-4">
                            <select class="form-control" name="bill_state" data-placeholder='Select State' >
                            <option value="">Select State</option>
                            <?php foreach ($states as $r) { ?>
                              <option value="<?= $r->state_id ?>"><?= $r->state_name ?></option>
                            <?php  } ?>
                          </select>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-form-label col-lg-2">Shipping Details <span class="text-danger">*</span>:</label>
                      <div class="col-lg-8">
                        <div class="mb-1 form-check">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input-styled-primary" name="sameAd">
                            Same As Billing Address
                          </label>
                        </div>
                        <div class="mb-1 row">
                          <div class="col-6">
                            <input type="text" name="ship_fname" class="form-control" placeholder="First Name">
                          </div>
                          <div class="col-6">
                            <input type="text" name="ship_lname" class="form-control" placeholder="Last Name">
                          </div>
                        </div>
                        <div class="mb-1 row">
                          <div class="col-6">
                            <input type="text" name="ship_email" class="form-control" placeholder="Email">
                          </div>
                          <div class="col-6">
                            <input type="number" name="ship_contact" class="form-control" placeholder="Contact">
                          </div>
                        </div>
                        <div class="mb-1">
                          <input type="text" name="ship_address_1" class="form-control" placeholder="Address Line 1">
                        </div>
                        <div class="mb-1">
                          <input type="text" name="ship_address_2" class="form-control" placeholder="Address Line 2">
                        </div>
                        <div class="mb-1 row">
                          <div class="col-lg-4">
                            <input type="number" class="form-control" name="ship_pincode" placeholder="Enter Pin Code">
                          </div>
                          <div class="col-lg-4">
                            <input type="text" class="form-control" name="ship_city" placeholder="Enter City">
                          </div>
                          <div class="col-lg-4">
                            <select class="form-control" name="ship_state" data-placeholder='Select State'>
                            <option value="">Select State</option>
                            <?php foreach ($states as $r) { ?>
                              <option value="<?= $r->state_id ?>"><?= $r->state_name ?></option>
                            <?php  } ?>
                          </select>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center">
                      <button type="submit" class="btn btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
                    </div>
                    <div class="myMsg" style="position: absolute;left: 15px;"></div>
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

  $('#sku_search').autocomplete({
      minLength: 2,
      source: '<?= base_url('admin/searchpro') ?>',
      search: function() {
          $(this).parent().addClass('ui-autocomplete-processing');
      },
      open: function() {
          $(this).parent().removeClass('ui-autocomplete-processing');
      },
    select: function( event, ui ) {
        $.ajax({
          url: '<?= base_url('admin/searchpro') ?>',
          type: 'post',
          data: {id:ui.item.id},
          success: function(a)
          {
            a = JSON.parse(a);
            if (a['success']) {
              $('select.product').html('<option value='+a.success.product_id+' selected>'+a.success.product_title+'</option>').trigger('change');
              $('#extraCharge').html(a.extraCharges);
            }else{
              $('#searchMsg').html(a['err']);
            }
          }
        })
            
      }
  });
  $(document).ready(function(){
    sameAdd();
    $('input[name=qty],input[name=price]').on('change').on('change',function(){
      var qty = $('input[name=qty]').val();
      var price = $('input[name=price]').val();
      $('input[name=amount]').val('₹'+qty*price);
    });
    $('input').on('change',function(){
      if ($(this).val() != null || $(this).value != "") {
      $(this).css('border-color','#ddd');
      }
    });

    $('input[name=sameAd],input[name*=bill_]').on('change',function(){
        sameAdd();
    });

    $('#insertProductForm').on('submit',function(e){
      e.preventDefault();
      if (validate() != 0) {
        return false;
      }
      var formData = new FormData(this);
      $.ajax({
        url: '<?= base_url('admin/insertorder') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
          $('.myMsg').html(a);
          setTimeout(function(){window.location.reload();}, 3000);
        }
      });
    });

  });
  function validate()
  {
    var inps = $('input:not(#sku_search)');
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
  function sameAdd()
  {
    if ($('input[name=sameAd]').is(':checked')) {
      $('input[name=ship_fname]').val($('input[name=bill_fname]').val());
      $('input[name=ship_lname]').val($('input[name=bill_lname]').val());
      $('input[name=ship_email]').val($('input[name=bill_email]').val());
      $('input[name=ship_contact]').val($('input[name=bill_contact]').val());
      $('input[name=ship_address_1]').val($('input[name=bill_address_1]').val());
      $('input[name=ship_address_2]').val($('input[name=bill_address_2]').val());
      $('input[name=ship_city]').val($('input[name=bill_city]').val());
      $('input[name=ship_pincode]').val($('input[name=bill_pincode]').val());
      $('select[name=ship_state]').val($('select[name=bill_state]').val()).click();
    }
  }
</script>
</body>
</html>
