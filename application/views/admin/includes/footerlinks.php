	<!-- Core JS files -->
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/main/jquery.min.js"></script>
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/main/bootstrap.bundle.min.js"></script>
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/extensions/jquery_ui/widgets.min.js"></script>
	<!-- Theme JS files -->
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/visualization/d3/d3.min.js"></script>
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/ui/moment/moment.min.js"></script>
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/pickers/daterangepicker.js"></script>
	
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/forms/styling/switch.min.js"></script>
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/forms/styling/uniform.min.js"></script>

	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/app.js"></script>

	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/demo_pages/dashboard.js"></script>
	<!-- /theme JS files -->
	<!-- For Summernote Editor -->
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/editors/summernote/summernote.min.js"></script>
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/demo_pages/editor_summernote.js"></script>
	<!-- For Forms Input -->
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/pickers/pickadate/picker.js"></script>
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/pickers/pickadate/picker.time.js"></script>
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/demo_pages/form_inputs.js"></script>
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/pickers/daterangepicker.js"></script>
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/demo_pages/picker_date.js"></script>

	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/demo_pages/datatables_basic.js"></script>
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/tables/datatables/datatables.min.js"></script>
	
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/demo_pages/components_modals.js"></script>
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/custom.js"></script>

	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/forms/selects/select2.min.js"></script>
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/demo_pages/form_select2.js"></script>
	<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/demo_pages/form_checkboxes_radios.js"></script>
	<script type="text/javascript">
		var forwardFormURL = '<?= base_url('admin/forwardorderform') ?>';
		var orderDetailURL = '<?= base_url('admin/neworderstable') ?>';
		var acceptBargainURL = '<?= base_url('admin/acceptbargain') ?>';
    jQuery(document).ready(function(){
            var url = window.location.href.replace(/\/\d+$/, "");
            $('a[href$="'+url+'"]').addClass('active');
            $('a.nav-link.active').parents('.nav-item').addClass('nav-item-open');
            $('a.nav-link.active').parents('.nav-group-sub').show();
			$('body').on('submit', '.ajax-submit-form', function(e) {
				e.preventDefault();
				let formurl = $(this).data('action');
				let form = new FormData(this);
				$.ajax({
					url: formurl,
					data: form,
					method: 'post',
					contentType: false,
					processData: false,
					dataType: 'json'
				}).then(response => {
					if(response.status) {
						$('#dynamicModal').modal('hide');
					}
					alert(response.msg);
				});
			});
    })
</script>

<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/plugins/ui/ripple.min.js"></script>