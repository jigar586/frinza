<!DOCTYPE html>
<html lang="en">
<!-- Headerlinks -->
<?php include('includes/headerlinks.php') ?>
<body class="sidebar-xs">
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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Orders</span> - New Orders</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item">Orders</span>
              <span class="breadcrumb-item active">New Orders</span>
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
              <div class="card-body">
                <form method="post" action="#" id="orderFilter">
                  <div class="form-group row">
                    <label class="col-form-label col-lg-2">Delivery Time Range:</label>
                    <div class="col-lg-4 input-group">
                      <span class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-calendar22"></i></span>
                      </span>
                      <input type="text" class="form-control daterange-time" name="datetimerange">
                      <input type="hidden" name="filter" id="applyFilter" value="">
                    </div>
                    
                    <div class="col-lg-3">
                      <select class="form-control form-control-uniform shippingtype" name="shippingtype" data-fouc>
                        <option value="">Select Shipping Method</option>
                        <option value="1">Fixed Time Delivery</option>
                        <option value="2">Mid Night Delivery</option>
                        <option value="3">Regular Delivery</option>
                        <option value="4">Early Morning Delivery</option>
                      </select>
                    </div>
                    <button type="submit" class="btn submitcat btn-primary ml-3" onclick="$('#applyFilter').val(1)">Filter <i class="icon-paperplane ml-2"></i></button>
                  </div>
                </form>
              </div>
            </div>
            <div class="card">
              <div class="card-header header-elements-inline">
                <h6 class="card-title">New Orders</h6>
              </div>

              <div class="card-body" id="myDataTable">
                
              </div>


            </div>

            <div id="myFormModal" class="modal fade" role='dialog'>
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Forward Order to Vendor</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <form id="assignOrder" method="post" action="#">
                  <div class="modal-body">

                    <div id="myForwardForm" style="margin-bottom: 15px;">
                      
                    </div>
                    <h6>Assign to Vendor</h6>
                    <div class="form-group row">
                      <label class="col-form-label col-lg-3">Vendor:</label>
                      <div class="col-lg-8">
                        <select class="form-control vendor-search" name="vendor_id" data-fouc>
                          <option value="">Select Vendor</option>
                          <?php
                          if (count($vendors)) {
                            foreach ($vendors as $v) { ?>
                              <option value="<?= @$v->vendor_id ?>"><?= @getCityName(@$v->city_id).' - '. @$v->vendor_name ?></option>
                            <?php  }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-form-label col-lg-3">Vendor Price:</label>
                      <div class="col-lg-8">
                        <input type="text" class="form-control" name="vendor_price" placeholder="Price for Vendor...">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-form-label col-lg-3">Message:</label>
                      <div class="col-lg-8">
                        <textarea rows="3" cols="3" name="vendor_msg" class="form-control" placeholder="Additional Message..."></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-primary">Assign</button>
                  </div>
                </form>
                </div>
              </div>
            </div>
        <!-- /Modal -->
          </div>
         </div>
       </div>
     </div>

   </div>
 </div>
 <!-- /content area -->
<!-- Modal Starts -->
<div id="myUserModal" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-md">
    <div class="modal-content" >
      <div class="modal-header">
        <h4 class="modal-title">Customer Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body  font-size-lg col-10" id='userForm'>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</div>
<!-- /page content -->
<?php include('includes/footerlinks.php') ?>
<script type="text/javascript">
  var banurl = '<?= base_url('admin/orderlisttable') ?>';
  function filteredDataTable(){
    $('#orderFilter').trigger('submit');
  }
  $(document).ready(function(){
    $('.vendor-search').select2();
    $('#orderFilter').on('submit',function(e){
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url: '<?= base_url('admin/orderlisttable') ?>',
        processData: false,
        contentType: false,
        type: 'post',
        data: formData,
        success: function(a){
          $('#myDataTable').html(a);
        }
      })
    });

    viewTable(banurl);
    $('#assignOrder').on('submit',function(e){
      e.preventDefault();
      var formData = new FormData(this);
      if ($('select[name="vendor_id"]').val() && !isNaN($('input[name="vendor_price"]').val())) {
      $.ajax({
        url: '<?= base_url('admin/assignorder') ?>',
        processData: false,
        contentType: false,
        type: 'post',
        data: formData,
        success: function(a){
          alert(a);
          filteredDataTable();
          $('#myDetailTable').html('');
          $('#myFormModal').modal('hide');
        }
      })
    }else{
      alert('Enter Necessary Details!');
    }
    });
  });
  function userInfo(arg)
  {
    $.ajax({
      url: '<?= base_url('admin/userinfo') ?>',
      type:'post',
      data: {id:arg},
      success: function(a)
      {
        $('#userForm').html(a);
        $('#myUserModal').modal('show');
      }
    })
    
  }
</script>
</body>
</html>
