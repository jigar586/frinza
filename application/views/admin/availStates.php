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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">State & City</span> - Manage States</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item">State & City</span>
              <span class="breadcrumb-item active">Manage States</span>
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
                <h6 class="card-title">Add State</h6>
              </div>

              <div class="card-body">
                <form id="insertStateForm">
              	<fieldset class="mb-3">
                 <div class="form-group row">
                   <label class="col-form-label col-lg-2">State Name:</label>
                   <div class="col-lg-8">
                    <input type="text" name="txtstate" class="form-control stateName" placeholder="Enter Name of State...">
                    <input type="hidden" name="stateID" class="stateID">
                    <div class="myMsg" style="position: absolute;left: 15px;"></div>
                  </div>
                  <button type="submit" class="btn submitstate btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
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
    // View State Table on Load
    var caturl = '<?= base_url('admin/statetable') ?>';
    viewTable(caturl);

    // Insert Category
    $('#insertStateForm').on('submit',function(e){
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url: '<?= base_url('admin/insertstate') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
            $('.myMsg').html(a);
            $('#insertStateForm').trigger('reset');
            viewTable(caturl);
        }
      })
    });
})

// Edit & Delete Category
  function editState($cat)
    {
      var formData = new FormData();
      formData.set('state_id',$cat);
      $.ajax({
        url:'<?= base_url('admin/editstate') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
          a= JSON.parse(a);
          $('.stateName').val(a[0]['state_name']);
          $('.stateID').val(a[0]["category_id"]);
          $('.submitstate').html('Update  <i class="icon-paperplane ml-2"></i>');
        }
      })
    };
    function deleteState($cat)
    {
      var formData = new FormData();
      formData.set('state_id',$cat);
      formData.set('delete_state',1);
      
      if (confirm('Are you Sure that You want to delete this State?')) {
          $.ajax({
            url:'<?= base_url('admin/deletestate') ?>',
            type: 'post',
            processData: false,
            contentType: false,
            data: formData,
            success: function(a){
              viewTable('<?= base_url('admin/statetable') ?>');
            }
          })
      }
      
    };
</script>
</body>
</html>
