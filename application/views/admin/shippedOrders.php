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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Orders</span> - Shipped Orders</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item">Orders</span>
              <span class="breadcrumb-item active">Shipped Orders</span>
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
                <h6 class="card-title">Shipped Orders</h6>
              </div>

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
<!-- Modal Starts -->
            <div id="myFormModal" class="modal fade" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" >
              <div class="modal-header">
                <h4 class="modal-title">Order Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <div class="modal-body" id='myForwardForm'>
                
              </div>
              <div class="modal-footer">
                <select class="form-control col-3" name="orderStatus">
                  <option value="2">Select Status of Order</option>
                  <option value="4">Delivered</option>
                  <option value="5">Cancelled</option>
                </select>
                <button type="button" class="btn bg-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="updateOrderStatus()" class="btn bg-success">Update</button>
                <!-- <button type="button" onclick="submitRequest(3)" class="btn bg-danger">Reject</button> -->
              </div>
            </div>
          </div>
        </div>
        <!-- /Modal -->


 <!-- Footer -->
 <?php include('includes/footer.php') ?>
 <!-- /footer -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->
<?php include('includes/footerlinks.php') ?>
<script type="text/javascript">
  var banurl = '<?= base_url('admin/shippedorderstable') ?>';
  $(document).ready(function(){
    
    viewTable(banurl);
  });
  function filteredDataTable(){
    $('#orderFilter').trigger('submit');
  }
  $(document).ready(function(){
    $('#orderFilter').on('submit',function(e){
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url: '<?= base_url('admin/shippedorderstable') ?>',
        processData: false,
        contentType: false,
        type: 'post',
        data: formData,
        success: function(a){
          $('#myDataTable').html(a);
        }
      })
    });
  });
function updateOrderStatus()
{
  var Hdn = $('input[name="HdnID[]"]').val();
  var status = $('select[name="orderStatus"]').val();
  if (confirm('Are You Sure you want to update this order`s status?')) {
    $.ajax({
      url: '<?= base_url('admin/updateOrderStatus') ?>',
      data: {response:status,HdnID:Hdn},
      type: 'post',
      success: function(a)
      {
        alert(a);
        $('#myFormModal').modal('hide');
        filteredDataTable();
      }
    })
  } 
}
</script>
</body>
</html>
