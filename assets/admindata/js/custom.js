/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */
 function viewTable($url)
 {
 	$.ajax({
 		url: $url,
 		type: 'get',
 		processData: false,
 		contentType: false,
 		success: function(a){
 			$('#myDataTable').html(a);
 		}
 	});
 }
 function orderDetails($id)
 {
 	$.ajax({
 		url: orderDetailURL,
 		type: 'post',
 		data: {order_id: $id},
 		success: function(a){
 			$('#myDetailTable').html(a);
 			$('html, body').animate({scrollTop: $("#myDetailTable").offset().top}, 300);
 		}
 	})
 }
 function forwardDetailForm($id)
 {
 	$.ajax({
 		url:forwardFormURL,
 		data: {detail_id:$id},
 		type:'post',
 		success: function(a)
 		{
 			$('#myForwardForm').html(a);
 			$('#myFormModal').modal('show');
 		}
 	})
 }
 function lastBargainForm($id)
 {
    $.ajax({
        url:forwardFormURL,
        data: {detail_id:$id},
        type:'post',
        success: function(a)
        {
            $('#myBargainForm').html(a);
            $('#myBargainModal').modal('show');
        }
    })
 }
 function forwardOrderForm($id)
 {
 	var formData = new FormData();
 	formData.set('ord_id',$id);
 	$.ajax({
 		url: forwardFormURL,
 		processData: false,
 		contentType: false,
 		type: 'post',
 		data: formData,
 		success: function(a)
 		{
 			$('#myForwardForm').html(a);
 			$('#myFormModal').modal('show');
 		}
 	})

 }

jQuery(document).ready( function($) {
    $('#myFormModal').on('hidden.bs.modal',function(e){
        $('#myFormModal form').trigger('reset');
         $('#myFormModal select').val('').change();
    });
    // Disable scroll when focused on a number input.
    $('form').on('focus', 'input[type=number]', function(e) {
        $(this).on('wheel', function(e) {
            e.preventDefault();
        });
    });
 
    // Restore scroll on number inputs.
    $('form').on('blur', 'input[type=number]', function(e) {
        $(this).off('wheel');
    });
 
    // Disable up and down keys.
    $('form').on('keydown', 'input[type=number]', function(evt) {
        if ( evt.which != 8 && evt.which != 0 && evt.which != 9 && (evt.which < 48 || evt.which > 57) && (evt.which < 96 || evt.which > 105))
            evt.preventDefault();
    });  
      
});

function openModal(url, title, size = 'md') {
    $('#dynamicModal .modal-body').html('');
    $('#dynamicModal .modal-dialog').removeClass().addClass('modal-dialog modal-'+size);
    $('#dynamicModal .modal-title').text(title);
	$('#dynamicModal').modal('show');
    $.ajax({
        url: url,
        type: 'get'
    })
    .done(function(html) {
        $('#dynamicModal .modal-body').html(html);
    });
}