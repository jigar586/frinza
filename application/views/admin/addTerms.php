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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Website</span> - Terms & Conditions</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item">Website</span>
              <span class="breadcrumb-item active">Terms & Conditions</span>
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
                <h6 class="card-title">Add Terms & Conditions</h6>
              </div>

              <div class="card-body">
                
            <div class="form-group">
              <button type="button" id="edit" class="btn btn-primary"><i class="icon-pencil3 mr-2"></i> Edit</button>
              <button type="button" id="save" class="btn btn-success"><i class="icon-checkmark3 mr-2"></i> Save</button>
              <div class="myMsg d-inline-block ml-2"></div>
            </div>
            <div id="myContent">
              <?= $content[0]->page_data ?>
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
    $(document).ready(function()
    {
      $('#edit').on('click', function() {
            $('#myContent').summernote({
              focus: true,
              fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Raleway'],
              fontNamesIgnoreCheck: ['Raleway'],}
            );
        })

        // Save
        $('#save').on('click', function() {
            var aHTML = $('#myContent').summernote('code');
            $('#myContent').summernote('destroy');
        });
      $('#save').on('click',function(e){
        var formData = new FormData();
        var content = $('#myContent').html();
        formData.set('txt',content);
        $.ajax({
          url: '<?= base_url('admin/site/termspage') ?>',
          processData: false,
          contentType: false,
          type: 'post',
          data: formData,
          success: function(a){
            $('.myMsg').html(a);
          }
        })
      });
    })
  </script>
</body>
</html>
