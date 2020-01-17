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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Accepted Orders</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item active">Orders</span>
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
                <h6 class="card-title">Orders</h6>
              </div>

              <div class="card-body" id="myDataTable">
                
              </div>


            </div>
            <!-- Modal Starts -->
            <div id="myDataModal" class="modal fade" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" >
              <div class="modal-header">
                <h4 class="modal-title">Order Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <div class="modal-body" id='myDetails'>
                
              </div>
              <div class="modal-footer">
                <select class="form-control col-3" name="orderStatus">
                  <option value="2">Select Status of Order</option>
                  <option value="3">Out for Delivery</option>
                  <option value="4">Delivered</option>
                </select>
                <button type="button" class="btn bg-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="updateOrderStatus()" class="btn bg-success">Update</button>
                <!-- <button type="button" onclick="submitRequest(3)" class="btn bg-danger">Reject</button> -->
              </div>
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
    viewTable('<?= base_url('vendor/acceptedtable') ?>');
  });
  function getDetailForVendor($id)
  {
    $.ajax({
      url: '<?= base_url('vendor/getorderdetails') ?>',
      data: {assign_id: $id},
      type: 'post',
      success: function(a)
      {
        $('#myDetails').html(a);
        $('#myDataModal').modal('show');
      }
    })
  }
function updateOrderStatus()
{
  var Hdn = $('input[name="HdnID[]"]').val();
  var status = $('select[name="orderStatus"]').val();
  if (confirm('Are You Sure you want to update this order`s status?')) {
    $.ajax({
      url: '<?= base_url('vendor/updateOrderStatus') ?>',
      data: {response:status,HdnID:Hdn},
      type: 'post',
      success: function(a)
      {
        alert(a);
        $('#myDataModal').modal('hide');
        viewTable('<?= base_url('vendor/acceptedtable') ?>');
      }
    })
  }
    
  
}
</script>
</body>
</html>
