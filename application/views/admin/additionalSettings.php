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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Website</span> - Additional Settings</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item">settings</span>
              <span class="breadcrumb-item active">Additional</span>
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
                <h6 class="card-title">Set Redeem Rate</h6>
              </div>
              <div class="card-body">
                <form method="post" action="">
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Enter Rate:</label>
                  <div class="col-lg-6">
                    <input type="number" class="form-control" placeholder="Enter Redeem Rate" value="<?= json_decode($record->page_data)->redeem_rate ?>" name="redeem_rate">
                  </div>
                  <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
                  </div>
                  <?php if(!empty($successMsg)){ ?>
                  <div class="col-lg-12 offset-lg-2 mt-2 text-success"><?= $successMsg ?></div>
                  <?php } ?>
                </div>
              </form>
              </div>
            </div>
             <!-- /content area -->
            <div class="card">
              <div class="card-header header-elements-inline">
                <h6 class="card-title">Set Occassion</h6>
              </div>
              <div class="card-body">
                <form method="post" action="">
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Select Occassion:</label>
                  <div class="col-lg-6">
                    <select class="form-control-uniform form-control" name="occ">
                      <option value="0">None</option>
                      <?php
                        foreach ($occassions as $occ) {
                          $sel = $occ->child_id == $selectedOccassion->page_data ? 'selected' : '';
                          echo '<option value="'.$occ->child_id.'" '.$sel.'>'.$occ->child_name.'</option>';
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
                  </div>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>


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
