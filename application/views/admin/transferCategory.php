<!DOCTYPE html>
<html lang="en">

<?php include('includes/headerlinks.php') ?>

<body>
    <style>
        li.selected > div{ border: 1px solid red; }
    </style>
    <?php include('includes/header.php') ?>  

        <div class="page-content">

            <?php include('includes/sidebar.php') ?>
            
            <div class="content-wrapper">
                <div class="page-header page-header-light">
                    <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Category Management</span> - Transfer Category</h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>
                </div>
                <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                    <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Category Management</span>
                    <span class="breadcrumb-item active">Transfer Category</span>
                </div>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">Transfer Categroy</h6>
                    </div>
                    <div class="card-body" id="myDataTable">
                        <form data-action="<?= base_url('admin/catTransferApply') ?>" id="transferForm" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12 pt-3">
                                        <h3>Transfer From</h3>
                                    </div>
                                    <div class="col-md-12 row">
                                        <label class="col-form-label col-md-12">Select Category:</label>
                                        <div class="col-md-9">
                                            <select name="category_id[]" multiple="multiple" id="multiSelectCat" class="form-control select" data-fouc data-placeholder='Select Category'>
                                                <?php
                                                foreach ($categories as $r) { ?>
                                                    <option value="<?= $r->category_id ?>"><?= $r->category_name ?></option>
                                                <?php  }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-success selectAllBtn legitRipple" onclick="selectAll(this,'select#multiSelectCat')">Select All</button>
                                        </div>
                                    </div>

                                    <div class="col-md-12 row">
                                        <label class="col-form-label col-md-12">Select Sub Category:</label>
                                        <div class=" col-md-9">
                                            <select multiple="multiple" id="multiSelectSubCat" class="form-control select" data-placeholder='Select subcategory' name="subcategory_id[]" data-fouc>
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-success selectAllBtn legitRipple" onclick="selectAll(this,'select#multiSelectSubCat')">Select All</button>
                                        </div>
                                    </div>

                                    <div class="col-md-12 row">
                                        <label class="col-form-label col-md-12">Select Chield Category:</label>
                                        <div class=" col-md-9">
                                            <select multiple="multiple" id="multiSelectChildCat" class="form-control select" data-placeholder='Select Childcategory' name="child_id[]" data-fouc>
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-success selectAllBtn legitRipple" onclick="selectAll(this,'select#multiSelectChildCat')">Select All</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="col-md-12 pt-3">
                                        <h3>Transfer To</h3>
                                    </div>
                                    <div class="col-md-12 row">
                                        <label class="col-form-label col-md-12">Select Category:</label>
                                        <div class=" col-md-9">
                                            <select multiple="multiple" name="tran_category_id[]" class="form-control select" id="selectCat" data-fouc data-placeholder='Select Category'>
                                                <?php
                                                foreach ($categories as $r) { ?>
                                                    <option value="<?= $r->category_id ?>"><?= $r->category_name ?></option>
                                                <?php  }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-success selectAllBtn legitRipple" onclick="selectAll(this,'select#selectCat')">Select All</button>
                                        </div>
                                    </div>

                                    <div class="col-md-12 row">
                                        <label class="col-form-label col-md-12">Select Sub Category:</label>
                                        <div class=" col-md-9">
                                            <select multiple="multiple" class="form-control select" id="selectSubcat" data-placeholder='Select subcategory' name="tran_subcategory_id[]" data-fouc>
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-success selectAllBtn legitRipple" onclick="selectAll(this,'select#selectSubcat')">Select All</button>
                                        </div>
                                    </div>

                                    <div class="col-md-12 row">
                                        <label class="col-form-label col-md-12">Select Chield Category:</label>
                                        <div class=" col-md-9">
                                            <select multiple="multiple" class="form-control select" id="selectChildCat" data-placeholder='Select Childcategory' name="tran_child_id[]" data-fouc>
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-success selectAllBtn legitRipple" onclick="selectAll(this,'select#selectChildCat')">Select All</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 text-right pull-right">
                                    <label class="col-form-label col-md-12">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary ml-3 legitRipple transferCategory" name="">Submit</button>
                                    <div class="myMsg text-left pull-left"></div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php') ?>
    <?php include('includes/footerlinks.php') ?>
    <script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/extensions/jquery_ui/interactions.min.js"></script>
    <script type="text/javascript">
        function loadChildCat(callback)
        {
            var ID = $('#multiSelectSubCat').val();
            $('#multiSelectChildCat').html('');
            $.ajax({
                url: '<?= base_url('admin/childcatlistData') ?>',
                type: 'post',
                data: {subcategory_id:ID},
                success: function(a){
                    a = JSON.parse(a);
                    $('#multiSelectChildCat').select2({
                        placeholder: 'Select Child Category',
                        minimumResultsForSearch: Infinity,
                        data: a
                    });
                    callback();
                }
            })
        }
        
        function loadSubCat(callback)
        {
            var ID = $('#multiSelectCat').val();
            $('#multiSelectChildCat').html('');
            $('#multiSelectSubCat').html('');
            $.ajax({
                url: '<?= base_url('admin/subcatlistData') ?>',
                type: 'post',
                data: {category_id:ID},
                success: function(a){
                    a = JSON.parse(a);
                    $('#multiSelectSubCat').select2({
                        placeholder: 'Select Sub Category',
                        minimumResultsForSearch: Infinity,
                        data: a
                    });
                    callback();
                }
            })
        }
        
        function loadSubCatTo(callback)
        {
            var ID = $('#selectCat').val();
            console.log(ID);
            $('#selectChildCat').html('');
            $('#selectSubcat').html('');
            $.ajax({
                url: '<?= base_url('admin/subcatlistData') ?>',
                type: 'post',
                data: {category_id:ID},
                success: function(a){
                    a = JSON.parse(a);
                    $('#selectSubcat').select2({
                        placeholder: 'Select Sub Category',
                        minimumResultsForSearch: Infinity,
                        data: a
                    });
                    callback();
                }
            })
        }

        function loadChildCatTo(callback)
        {
            var ID = $('#selectSubcat').val();
            $('#selectChildCat').html('');
            $.ajax({
                url: '<?= base_url('admin/childcatlistData') ?>',
                type: 'post',
                data: {subcategory_id:ID},
                success: function(a){
                    a = JSON.parse(a);
                    $('#selectChildCat').select2({
                        placeholder: 'Select Child Category',
                        minimumResultsForSearch: Infinity,
                        data: a
                    });
                    callback();
                }
            })
        }

        $(document).ready(function(){
            $('#multiSelectCat').on('change',function(){
                loadSubCat(function(){
                });
            });
            
            $('#multiSelectSubCat').on('change',function(){
                loadChildCat(function(){
                });
            });
            $('#selectCat').on('change',function(){
                loadSubCatTo(function(){
                });
            });
            
            $('#selectSubcat').on('change',function(){
                loadChildCatTo(function(){
                });
            });

            $('#transferForm').on('submit',function(e){
                e.preventDefault();
			    var formData = new FormData(this);
			    var dataurl = $(this).attr('data-action');
                $.ajax({
                    url: dataurl,
                    type: 'post',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(a){
                        $('.myMsg').html(a);
                        $('#transferForm').trigger('reset');
                        $('#multiSelectCat').select2('');
                        $('#multiSelectCat').select2('').trigger('change');
                        $('#selectCat').select2('');
                        $('#selectCat').select2('').trigger('change');
                        console.log('data'); die;
                    }
                })
            })
        });
        function selectAll(btn,select)
        {
            if ($(select).val().length == 0) {
                $(select).select2('destroy').find('option').prop('selected', 'selected').end().select2().change();
                $(btn).removeClass('btn-outline-success').addClass('btn-outline-danger').text("Deselect All");
            }else{
                $(select).select2('destroy').find('option').prop('selected', false).end().select2().change();
                $(btn).removeClass('btn-outline-danger').addClass('btn-outline-success').text("Select All");
            }
            
        }
        
    </script>

</body>
</html>
