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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Orders</h4>
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
            <form>
            <div class="modal-content" >
              <div class="modal-header">
                <h4 class="modal-title">Order Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <div class="modal-body" id='myDetails'>
                
              </div>
              <div class="modal-footer">
                <input type="number" class="form-control col-2 bargain" name="bargain">
                <button type="button" onclick="submitRequest(2)" class="btn bg-warning bargain">Bargain Price</button>
                <button type="button" class="btn bg-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="submitRequest(1)" class="btn bg-success">Accept</button>
                <button type="button" onclick="submitRequest(3)" class="btn bg-danger">Reject</button>
              </div>
            </div>
          </form>
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
    viewTable('<?= base_url('vendor/requesttable') ?>');
  });
  function getDetailForVendor($id,$last)
  {
    $.ajax({
      url: '<?= base_url('vendor/getorderdetails') ?>',
      data: {assign_id: $id},
      type: 'post',
      success: function(a)
      {
        if ($last) {
          $('.bargain').hide();
        }else{
          $('.bargain').show();
        }
        $('#myDetails').html(a);
        $('#myDataModal').modal('show');
      }
    })
  }
function submitRequest($id)
{
  var Hdn = $('input[name="HdnID[]"]').val();
  if($id != 2)
  {
    $.ajax({
      url: '<?= base_url('vendor/updaterequest') ?>',
      data: {response:$id,HdnID:Hdn},
      type: 'post',
      success: function(a)
      {
        alert(a);
        $('#myDataModal').modal('hide');
        viewTable('<?= base_url('vendor/requesttable') ?>');
      }

    })
  }else{
    var newPrice = $('input[name="bargain"]').val();
    if (newPrice != '') {
      $.ajax({
        url: '<?= base_url('vendor/updaterequest') ?>',
        data: {response:$id,HdnID:Hdn,price: newPrice},
        type: 'post',
        success: function(a)
        {
          alert(a);
          $('#myDataModal').modal('hide');
          viewTable('<?= base_url('vendor/requesttable') ?>');
        }
      })
    }else{
      alert('Enter Bargain Price to Bargain!');
      $('input[name="bargain"]').focus();
    }
  }
}
</script>
</body>
</html>