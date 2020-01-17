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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">State & City</span> - Manage Cities</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item">State & City</span>
              <span class="breadcrumb-item active">Manage Cities</span>
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
                <h6 class="card-title">Add City</h6>
              </div>

              <div class="card-body">
                <form id="insertCityForm">
                <fieldset class="mb-3">
                  <div class="form-group row">
                    <label class="col-form-label col-lg-2">Select State:</label>
                    <div class="col-lg-3">
                      <select class="form-control form-control-uniform state" name="state_id" data-fouc>
                        <option value="opt1">Select State</option>
                        <?php foreach ($states as $r) { ?>
                          <option value="<?= $r->state_id ?>"><?= $r->state_name ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <label class="col-form-label col-lg-2">City Name:</label>
                    <div class="col-lg-4">
                      <input type="text" class="form-control cityName" name="txtcity" placeholder="Enter Name of City...">
                      <input type="hidden" name="cityID" class="cityID">
                      <div class="myMsg" style="position: absolute;left: 15px;"></div>
                    </div>
                  </div>

                  <div class="d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn submitcity btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
                  </div>
                </fieldset>
              </form>
              </div>
            </div>
            <div class="card">
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
    // View City Table on Load
    var caturl = '<?= base_url('admin/citytable') ?>';
    viewTable(caturl);

    // Insert Category
    $('#insertCityForm').on('submit',function(e){
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url: '<?= base_url('admin/insertcity') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
            $('.myMsg').html(a);
            $('#insertCityForm').trigger('reset');
            viewTable(caturl);
        }
      })
    });
})

// Edit & Delete City
  function editCity($cat)
    {
      var formData = new FormData();
      formData.set('city_id',$cat);
      $.ajax({
        url:'<?= base_url('admin/editcity') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
          a= JSON.parse(a);
          $('.cityName').val(a[0]['city_name']);
          $('.state').val(a[0]['state_id']).click();
          $('.cityID').val(a[0]["city_id"]);
          $('.submitcity').html('Update  <i class="icon-paperplane ml-2"></i>');
        }
      })
    };
    function deleteCity($cat)
    {
      var formData = new FormData();
      formData.set('city_id',$cat);
      formData.set('delete_city',1);
      
      if (confirm('Are you Sure that You want to delete this City?')) {
          $.ajax({
            url:'<?= base_url('admin/deletecity') ?>',
            type: 'post',
            processData: false,
            contentType: false,
            data: formData,
            success: function(a){
              viewTable('<?= base_url('admin/citytable') ?>');
            }
          })
      }
      
    };
</script>
</body>
</html>
