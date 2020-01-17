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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Vendors</span> - View Vendors</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item">Vendors</span>
              <span class="breadcrumb-item active">View Vendors</span>
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
                <h6 class="card-title">Vendors</h6>
                <div class="myMsg pull-right" style="color: red;"></div>
              </div>
              <div class="card-body" id="myDataTable">


              </div>


            </div>
            <div class="card" id="CustomerData" style="display: none;">
              <div class="card-header header-elements-inline">
                <h6 class="card-title" id="customerName"></h6>
              </div>
              <div class="card-body" id="customerDetail">
                
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
  <div class="modal-dialog modal-md">
    <div class="modal-content" >
      <div class="modal-header">
        <h4 class="modal-title">Vendor Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body  font-size-lg col-10" id='myForwardForm'>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-secondary" data-dismiss="modal">Close</button>
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
  var caturl = '<?= base_url('admin/vendortable') ?>';
  $(document).ready(function(){
    // View Category Table on Load
    
    viewTable(caturl);
  });
// Edit & Delete Category
  function updateVendor($id,$e)
  {
    $.ajax({
      url:'<?= base_url('admin/changevendorstat') ?>',
      type: 'post',
      data: {vendor_id:$id,status:$e},
      success: function(a){
        $('.myMsg').html(a);
        viewTable(caturl);
      }
    });
  }
  function onVendor($id){
    updateVendor($id,1);
  }
  function offVendor($id){
    updateVendor($id,0);
  }
  function deleteVendor($id){
    if (confirm("Are you Sure You want to Delete this Vendor?")) {
      updateVendor($id,2);
    }
  }
  function vendorOrders(arg)
  {
    $.ajax({
      url: '<?= base_url('admin/vendorwiseorder') ?>',
      type:'post',
      data: {id:arg},
      success: function(a)
      {
        $('#customerDetail').html(a);
        $('#customerName').text(name);
        $('#CustomerData').show();
        $('html, body').animate({scrollTop: $("#CustomerData").offset().top}, 300);
      }
    })
  }
  function userInfo(arg)
  {
    $.ajax({
      url: '<?= base_url('admin/vendorinfo') ?>',
      type:'post',
      data: {id:arg},
      success: function(a)
      {
        $('#myForwardForm').html(a);
        $('#myFormModal').modal('show');
      }
    })
    
  }
</script>
</body>
</html>
