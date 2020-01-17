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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Blogs</span> - Add Blog</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item">Blogs</span>
              <span class="breadcrumb-item active">Add Blog</span>
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
              <div class="card-header">
                <h6 class="card-title">Add Blog</h6>
              </div>
              <?php
              $img = '';
              $title = '';
              $bcat = '';
              $detail = '';
                if (isset($editBlogData)) {
                  $title = $editBlogData[0]->title;
                  $bcat = $editBlogData[0]->category;
                  $detail = $editBlogData[0]->details;
                  $img = '<br><img src="'.FOLDER_ASSETS_TEMPLATEBLOG.$editBlogData[0]->blog_img.'" width="150px">';
                }
              ?>

          <!-- Blog editor -->
          <div class="card-body">
            <form id="submitBlog" action="#">
              <div class="form-group row">
                <label class="col-form-label col-2">Title of Blog:</label>
                <div class="col-10">
                  <input type="text" class="form-control form-control-lg font-weight-bold" name="title" placeholder="Enter Title of The Blog" value="<?= $title ?>" required>
                  <input type="hidden" name="editBlog" value="<?= @$editBlogData[0]->blog_id ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-2">Featured Image:</label>
                <div class="col-10">
                  <input type="file" name="banner" class="form-control-uniform-custom form-control-lg" data-fouc>
                  <?= $img ?>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-lg-2">Select Category:</label>
                <div class="col-lg-10">
                  <select  name="cat" class="form-control" required="required">
                    <?php
                    foreach ($categories as $cat) { 
                      if ($cat->catagory_id == $bcat) { ?>
                       <option value="<?= $cat->category_id ?>" selected><?= $cat->category_name ?></option>
                    <?php  }
                      ?>
                     <option value="<?= $cat->category_id ?>"><?= $cat->category_name ?></option>
                   <?php  }
                   ?>
                 </select>
               </div>
             </div>
              <div class="form-group">
              <textarea class="text-editor" name="desc" required="required"><?= $detail ?></textarea>
            </div>
            <div class="d-flex justify-content-end align-items-center">
              <button type="submit" class="btn btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
            </div>
            </form>
            
        </div>
        <!-- /Blog editor -->
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
      $('.text-editor').summernote({ 
          fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Raleway'],
          fontNamesIgnoreCheck: ['Raleway'],
        });
      $('.text-editor').summernote('fontName','Raleway');
      $('#submitBlog').on('submit',function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
          url: '<?= base_url('admin/insertblog') ?>',
          type: 'post',
          processData: false,
          contentType: false,
          data: formData,
          success: function(a){
              alert(a);
              setTimeout(window.location.href ='<?= base_url('admin/addBlog') ?>' ,3000);
          }
        })
      });
    })
  </script>
</body>
</html>
