<script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>js/jquery-3.3.1.min.js"></script> 
<script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>js/bootstrap.min.js"></script> 
<script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>js/bootstrap-datepicker.js"></script> 
<script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>js/revslider.js"></script> 
<script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>js/common.js"></script> 
<script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>js/owl.carousel.min.js"></script> 
<script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>js/jquery.mobile-menu.min.js"></script> 
<script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>js/countdown.js"></script> 
<script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>js/cloud-zoom.js"></script>
<script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>js/jquery.touchSwipe.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css" id="theme-styles">

<script type="text/javascript">
	var compareURL = '<?= base_url('product/compare') ?>';
	var wishURL = '<?= base_url('product/wish') ?>';
	var cartURL = '<?= base_url('product/cart') ?>';
	var quickviewURL = '<?= base_url('product/quickview') ?>';
	var myCompareBoxURL = '<?= base_url('product/comparebox') ?>';
	var productListURL = '<?= base_url('product/loadlist') ?>';
	var clearCartURL = '<?= base_url('user/clearcart') ?>';
	var removeFromCartURL = '<?= base_url('user/removeitemcart') ?>';
	var saveBillURL = '<?= base_url('user/saveaddress') ?>';
	var saveShipURL = '<?= base_url('user/saveshipaddress') ?>';
	var makePaymentURL = '<?= base_url('order/payment') ?>';
	var addressFormURL = '<?= base_url('user/addressform') ?>';
	var addressShipFormURL = '<?= base_url('user/addressshipform') ?>';
	var getShipAddress = '<?= base_url('user/addressship') ?>';
	var getBillAddress = '<?= base_url('user/addressbill') ?>';
	var cnfmOrderURL = '<?= base_url('user/confirmorder') ?>';
	var cnfmOrderPage = '<?= base_url('user/orderpage') ?>';
</script>
<script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>js/custom.js"></script>
 <script type="text/javascript">
 	$( document ).ready(function() {
	    $('#mobWrapper').click(function(){
	      $('#mobile-menu').hide(500);
	      $('#mobWrapper').hide();
	    });
	    $('body').on('click','.mm-toggle-wrap',function(){
	      $('#mobile-menu').css('left','0px').show(500);
	      $('#mobWrapper').show();
		});
	});
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});
	
	function yourAddonsModal($id) {
		$('#yourAddonsModal').modal('show');
		if( $('#yourAddonsModal .modal-body').html() == '' ){
			var pincode = $('#pincode').val();
			var city_id = $('.citysel').val();
			$.ajax({
				url: '<?= base_url('cart/getAddonsProducts') ?>',
				type: 'post',
				data:{
					pincode : pincode,
					city_id : city_id
				},
				success: function (a) {
					console.log(a);
					$('#yourAddonsModal .modal-body').html(a);
					$('.addonaddToCart').val($id);
				}
			})
		}
	}
		
  </script>