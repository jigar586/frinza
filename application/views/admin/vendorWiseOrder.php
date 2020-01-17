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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Vendors</span> - Vendorwise Orders</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item">Vendors</span>
              <span class="breadcrumb-item active">Vendorwise Orders</span>
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
                <h6 class="card-title">Vendorwise Orders</h6>
              </div>

              <div class="card-body">
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Select Vendor:</label>
                  <div class="col-lg-6">
                  <select class="form-control select-search" data-fouc>
                          <option value="opt1">Select Vendor</option>
                          <option value="opt2">Flower Vendor</option>
                          <option value="opt3">Chocolate Vendor</option>
                      </select>
                  </div>
                </div>
                <table class="table datatable-basic">
            <thead>
              <tr>
                <th>Sr No</th>
                <th>Order No.</th>
                <th>Buyer's Name</th>
                <th>Product Title</th>
                <th>Amount</th>
                <!-- <th>Status</th> -->
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>12501</td>
                <td>Suresh Varma</td>
                <td>Black Forest Cake</td>
                <!-- <td>BLKFrst</td> -->
                <td>₹520</td>
                <!-- <td><span class="badge badge-danger">Rejected</span></td> -->
                <td class="text-center">
                  <a href="#"><span class="badge badge-success">Delivered</span></a>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>12221</td>
                <td>Naresh Patel</td>
                <td>Rose Flower with Vase</td>
                <!-- <td>BLKFrst</td> -->
                <td>₹100</td>
                <!-- <td><span class="badge badge-danger">Rejected</span></td> -->
                <td class="text-center">
                  <a href="#"><span class="badge badge-info">In Transit</span></a>
                </td>
              </tr>
            </tbody>
          </table>
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
</body>
</html>
