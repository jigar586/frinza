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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Orders</span> - Cart Orders</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item">Orders</span>
              <span class="breadcrumb-item active">Cart Orders</span>
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
                <h6 class="card-title">Pending Orders</h6>
              </div>

              <div class="card-body" id="myDataTable">
                
              </div>


            </div>
            <!-- Modal Starts -->
            
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
    var banurl = '<?= base_url('admin/pendingorderstable') ?>';
    viewTable(banurl);
  });
</script>
</body>
</html>
