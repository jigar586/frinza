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
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">CRM</span> - All Customers</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
              <span class="breadcrumb-item">CRM</span>
              <span class="breadcrumb-item active">All Customers</span>
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
                <h6 class="card-title">Customers</h6>
              </div>

              <div class="card-body">
                <table class="table datatable-basic" id="productTable">
                  <thead>
                    <tr>
                      <th>Sr</th>
                      <th>Customer Name</th>
                      <th>Contact No.</th>
                      <th>Total Orders</th>
                      <th>Wallet Bal</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (@count($customers) != 0) {
                      $i = 0;
                      foreach ($customers as $nOrd) {
                       
                    ?>
                    <tr>
                      <td><?= ++$i ?></td>
                      <td><a href="javascript:void(0)" onclick="userInfo(<?= $nOrd->uid ?>)"><?= @$nOrd->first_name.' '.@$nOrd->last_name ?></a></td>
                      <td><?= @$nOrd->user_contact ?></td>
                      <td><?= @$nOrd->order_count ?></td>
                      <td>₹<?= @$nOrd->wallet_add - @$nOrd->wallet_deduct ?></td>
                      <td>
                      <a href="javascript:void(0)" onclick="viewCustomerOrders(<?= @$nOrd->uid ?>,'<?= @$nOrd->first_name.' '.@$nOrd->last_name ?>')"><span class="badge badge-info">Order History</span></a>
                    </td>
                      
                   </tr>
                   <?php }
                      }
                    ?>
                 </tbody>
                </table>
              </div>
            </div>
            <div class="card" id="CustomerData" style="display: none;">
              <div class="card-header header-elements-inline">
                <h6 class="card-title" id="customerName"></h6>
              </div>
              <div class="card-body" id="customerDetail">
                
              </div>
            </div>
          </div>
         </div>
       </div>
     </div>

   </div>
 </div>
 <!-- /content area -->
<!-- Modal Starts -->
<div id="myFormModal" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-md">
    <div class="modal-content" >
      <div class="modal-header">
        <h4 class="modal-title">Customer Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body  font-size-lg col-10" id='myForwardForm'>
        
      </div>
      <div class="modal-footer">
      	<div>
			<input type="number" id="refund_amount" value="0">
			<input type="hidden" id="user_id" value="0">
    		<button type="button" class="btn bg-success" onclick="addMoneyToWallet()">Add to Wallet</button>
      	</div>
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
  function viewCustomerOrders(arg,name)
  {
    $.ajax({
      url: '<?= base_url('admin/customerdetail') ?>',
      type:'post',
      data: {id:arg},
      success: function(a)
      {
        $('#customerDetail').html(a);
        $('#customerName').text(name);
        $('#CustomerData').show();
        $('html, body').animate({scrollTop: $("#CustomerData").offset().top}, 300);
      }
    })
  }
  function userInfo(arg)
  {
    $.ajax({
      url: '<?= base_url('admin/userinfo') ?>',
      type:'post',
      data: {id:arg},
      success: function(a)
      {
        $('#myForwardForm').html(a);
        $('#user_id').val(arg);
        $('#myFormModal').modal('show');
      }
    })
    
  }
  var ajax_status = 0;
  function addMoneyToWallet() 
  {
  	if (ajax_status) 
  	{
  		return false;
  	}
  	var amount = $('#refund_amount').val();
  	var id = $('#user_id').val();
  	$.ajax({
  		url: '<?= base_url('admin/userinfo') ?>',
  		type: 'POST',
  		data: {id: id, refund_amount: amount},
  		dataType: 'json'
  	})
  	.done(function(a) {
  		alert(a.msg);
  		window.location.reload();
  	});
  }
</script>
</body>
</html>
