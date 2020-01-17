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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Discount</span> - Apply Offer</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item">Discount</span>
              <span class="breadcrumb-item active">Apply Offer</span>
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
                <h6 class="card-title">Apply Offer</h6>
              </div>
              <?php 
              //   echo "<pre>";
              //   print_r($categories);
              //   print_r($child_categories); die();
              ?>
              <p class="text-danger d-block ml-3"><b>Note:</b> Please Select Parents only if you want to apply offer to all Children!</p>
              <p class="d-block ml-3"> <b>For Ex.</b> Select Cake Category only and submit to apply offer to all products included under Cake Category.</p>
              <div class="card-body">
                <form id="offerSubmit">
                 <fieldset class="mb-3">
                  <div class="form-group row">
                    <label class="col-form-label col-lg-2">Offer:</label>
                    <div class="col-lg-8">
                      <select class="form-control form-control-uniform" name="offer" data-fouc>
                        <option value="">Select Offer</option>
                        <?php
                        foreach ($offers as $o) { ?>
                          <option value="<?= $o->offer_id ?>"><?= $o->offer_name ?></option>
                        <?php  }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-2">Select Category</label>
                    <div class="col-lg-8">
                      <select multiple="multiple" name="cat[]" class="form-control category">
                        <?php
                        foreach ($categories as $cat) { ?>
                         <option value="<?= $cat->category_id ?>"><?= $cat->category_name ?></option>
                       <?php  }
                       ?>
                     </select>
                   </div>
                   <div class="col-lg-2">
                      <button type="button" class="btn btn-outline-success selectAllBtn" onclick="selectAll(this,'select.category')">Select All</button>
                    </div>
                 </div>
                 <div class="form-group row">
                  <label class="col-form-label col-lg-2">Select Child-Category</label>
                  <div class="col-lg-8">
                    <select multiple="multiple" class="form-control childcategory" name="child[]">
                      <option value="">Select Child-category</option>
                    </select>
                  </div>
                  <div class="col-lg-2">
                    <button type="button" class="btn btn-outline-success selectAllBtn" onclick="selectAll(this,'select.childcategory')">Select All</button>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Select Products</label>
                  <div class="col-lg-8">
                    <select multiple="multiple" class="form-control product" name="product[]">
                      <option value="">Select Products</option>
                    </select>
                  </div>
                    <div class="col-lg-2">
                      <button type="button" class="btn btn-outline-success selectAllBtn" onclick="selectAll(this,'select.product')">Select All</button>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                 <button type="submit" class="btn btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
               </div>
               <div class="myMsg" style="position: absolute;left: 15px;"></div>
             </fieldset>
           </form>
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
<!-- Ajax calls -->
<script type="text/javascript">
  function selectAll(btn,select)
  {
    if ($(select).val().length == 0) {
      $(select).find('option').prop('selected', 'selected').change();
      $(btn).removeClass('btn-outline-success').addClass('btn-outline-danger').text("Deselect All");
    }else{
      $(select).find('option').prop('selected', false).change();
      $(btn).removeClass('btn-outline-danger').addClass('btn-outline-success').text("Select All");
    }
  }
  $(document).ready(function(){
    $('.category').on('change',function(){
      var ID = [];
      ID = $('.category').val();
      $('.childcategory').html('<option value="">Select Sub Category</option>');
        $.ajax({
          url: '<?= base_url('admin/getIndata/child') ?>',
          type: 'post',
          data: {cat: ID},
          success: function(a){
            a = JSON.parse(a);
            $.each(a,function(ind,value){
              var opt = $('<option/>');
              opt.val(value['child_id']);
              opt.text(value['child_name']);
              $('.childcategory').append(opt);
            })
          }
        });
        $.ajax({
          url: '<?= base_url('admin/getIndata/product') ?>',
          type: 'post',
          data: {cat: ID},
          success: function(a){
            a = JSON.parse(a);
            $.each(a,function(ind,value){
              var opt = $('<option/>');
              opt.val(value['product_id']);
              opt.text(value['product_title']);
              $('.product').append(opt);
            })
          }
        });
    });
    $('.childcategory').on('change',function(){
      var ID2 = [];
      ID2 = $('.childcategory').val();
      $('.product').html('<option id="allSelect" value="">Select All Products</option>');
        $.ajax({
          url: '<?= base_url('admin/getIndata/product') ?>',
          type: 'post',
          data: {child: ID2},
          success: function(a){
            a = JSON.parse(a);
            $.each(a,function(ind,value){
              var opt = $('<option/>');
              opt.val(value['product_id']);
              opt.text(value['product_title']);
              $('.product').append(opt);
            })
          }
        });
    });
    $('#offerSubmit').on('submit', function(e){
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url: '<?= base_url('admin/submitoffer') ?>',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(a){
          $('.myMsg').html(a);
          $('#offerSubmit').trigger('reset');
          $('.product').html('<option id="allSelect" value ="">Select All Products</option>');
        }
      })
    })
  })
</script>
</body>
</html>
