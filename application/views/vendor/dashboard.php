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
						<h4>Available Bal: ₹ <?= $myBalance ?></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Wallet</span>
						</div>
					</div>
				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">
				<div class="row">
					<div class="card col-12">
						<div class="card-header header-elements-inline">
					        <h6 class="card-title">Statement</h6>
				      	</div>
				      	<div class="card-body" id="myDataTable">
				      		
				      	</div>
					</div>
				</div>
			</div>
				<!-- /content area -->
			<!-- Modal Starts -->
            <div id="myDataModal" class="modal fade" tabindex="-1">
	          <div class="modal-dialog modal-lg">
	            <div class="modal-content" >
	              <div class="modal-header">
	                <h4 class="modal-title">Order Details</h4>
	                <button type="button" class="close" data-dismiss="modal">&times;</button>
	              </div>

	              <div class="modal-body" id='myDetails'>
	                
	              </div>
	              <div class="modal-footer">
	                <button type="button" class="btn bg-secondary" data-dismiss="modal">Close</button>
	              </div>
	            </div>
	          </div>
	        </div>
	        <!-- /Modal -->

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
				viewTable('<?= base_url('vendor/statement') ?>');
			});
			 function getDetailForVendor($id)
			{
				$.ajax({
				  url: '<?= base_url('vendor/getorderdetails') ?>',
				  data: {detail_id: $id},
				  type: 'post',
				  success: function(a)
				  {
				    $('#myDetails').html(a);
				    $('#myDataModal').modal('show');
				  }
				})
			}
		</script>
	</body>
	</html>
