<!DOCTYPE html>
<html lang="en">
<!-- Headerlinks -->
<?php include('includes/headerlinks.php') ?>
<body>
    <?php include('includes/header.php') ?>

    <div class="page-content">
        <?php include('includes/sidebar.php') ?>
    
        <div class="content-wrapper">
            <div class="page-header page-header-light">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Tax</span> - Manage Tax</h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>
                </div>
                <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                            <span class="breadcrumb-item active">Manage Tax</span>
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
                                <h6 class="card-title">Manage Tax</h6>
                                <button class="btn btn-primary text-right" name="btnAddTax" onClick="openFormModal(`<?= base_url('admin/formTax/0') ?>`)"><i class="mr-2 icon-plus3"></i>  Add Tax</button>
                            </div>
                            <div class="card-body" id="myDataTable">
                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php') ?>

</div>

<div id="myFormModal" class="modal fade" role='dialog'>
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Manage Tax</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body"></div>
			</div>
		</div>
	</div>
</div>

<?php include('includes/footerlinks.php') ?>

<script type="text/javascript">
var caturl = '<?= base_url('admin/taxtable') ?>';
    $(document).ready(function(){
        viewTable(caturl);

        // Insert Category
        $('body').on('submit', '#insertTaxForm',function(e){
        e.preventDefault();
        var formData = new FormData(this);
        let url = $(this).data('action');
        $.ajax({
            url: url,
            type: 'post',
            processData: false,
            contentType: false,
            data: formData,
            dataType: 'json',
            success: function(a){
                if(a.status) {
                    $('#myFormModal').modal('hide');
                }
                alert(a.message);
                viewTable(caturl);
            }
        })
        });
    })

    function deleteTax(url){
        if(confirm("Are you sure?")){
            $.ajax({
                url: url,
                type: 'post',
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(a){
                    alert(a.message);
                    viewTable(caturl);
                }
            })
        }
    }

function openFormModal(url){
    $('#myFormModal').modal('show');
    $.ajax({
        url: url,
        type: 'post',
        success: function(a){
            $('#myFormModal .modal-body').html(a);
        }
    })
}

</script>
</body>
</html>
