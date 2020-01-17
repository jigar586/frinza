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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Blogs</span> - Add Blog Category</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <a href="#" class="breadcrumb-item">Blogs</a>
              <span class="breadcrumb-item active">Add Blog Category</span>
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
                <h6 class="card-title">Add Category for Blogs</h6>
              </div>

              <div class="card-body">
                <form id="insertCategoryForm">
              	<fieldset class="mb-3">
                 <div class="form-group row">
                   <label class="col-form-label col-lg-2">Category Name:</label>
                   <div class="col-lg-8">
                    <input type="text" name="txtcat" class="form-control catName" placeholder="Enter Name of Category...">
                    <input type="hidden" name="catID" class="catID">
                    <div class="myMsg" style="position: absolute;left: 15px;"></div>
                  </div>
                  
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Category Description:</label>
                   <div class="col-lg-8">
                    <textarea rows="3" cols="3" class="form-control desc" name="desc" placeholder="Category Description"></textarea>
                  </div>

                </div>
                <div class="d-flex justify-content-end align-items-center">
                  <button type="submit" class="btn btn-primary ml-3 submitcat">Submit <i class="icon-paperplane ml-2"></i></button>
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
    // View Category Table on Load
    var caturl = '<?= base_url('admin/blog/cattable') ?>';
    viewTable(caturl);

    // Insert Category
    $('#insertCategoryForm').on('submit',function(e){
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url: '<?= base_url('admin/blog/insertcat') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
            $('.myMsg').html(a);
            $('#insertCategoryForm').trigger('reset');
            viewTable(caturl);
        }
      })
    });
})

// Edit & Delete Category
  function editCategory($cat)
    {
      var formData = new FormData();
      formData.set('category_id',$cat);
      $.ajax({
        url:'<?= base_url('admin/blog/editcat') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
          a= JSON.parse(a);
          $('.catName').val(a[0]['category_name']);
          $('.catID').val(a[0]["category_id"]);
          $('.desc').val(a[0]["category_desc"]);
          $('.submitcat').html('Update  <i class="icon-paperplane ml-2"></i>');
        }
      })
    };
    function deleteCategory($cat)
    {
      var formData = new FormData();
      formData.set('category_id',$cat);
      formData.set('delete_cat',1);
      
      if (confirm('Are you Sure that You want to delete this Category?')) {
          $.ajax({
            url:'<?= base_url('admin/blog/deletecat') ?>',
            type: 'post',
            processData: false,
            contentType: false,
            data: formData,
            success: function(a){
              viewTable('<?= base_url('admin/blog/cattable') ?>');
            }
          })
      }
      
    };
</script>
</body>
</html>
