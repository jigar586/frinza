
<table class="table datatable-basic" id="productTable">
	<thead>
		<tr>
			<th>Sr No</th>
			<th>Label</th>
			<th>Rate</th>
			<th class="text-center">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
			foreach ($taxes as $r) { ?>
				<tr>
					<td><?= $i++ ?></td>
					<td><?= $r->label ?></td>
					<td><?= $r->rate.'%' ?></td>
					<td class="text-center">
						<a href="javascript:void(0)" onclick="openFormModal(`<?= base_url('admin/formTax/'.$r->id) ?>`)"><span class="badge badge-info"><i class="icon-pencil3"></i> Edit</span></a>
						<a href="javascript:void(0)"  onclick="deleteTax(`<?= base_url('admin/removeTax/'.$r->id) ?>`)"><span class="badge badge-danger"><i class="icon-cancel-circle2"></i> Delete</span></a>
					</td>
				</tr>
		    <?php } ?>
	</tbody>
</table>
<script type="text/javascript">
	$('#productTable thead td').each( function () {
		var title = $(this).text();
		$(this).html( '<input type="text" class="form-control productTableData" placeholder="Search '+title+'" />' );
	} );
	
	var table = $('#productTable').DataTable({
		"pagingType": "full_numbers",
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	});


	table.columns().every( function () {
		var that = this;

		$( '.productTableData', this.footer() ).on( 'keyup change', function () {
			if ( that.search() !== this.value ) {
				that
				.column( $(this).parent().index()+':visible' )
				.search( this.value )
				.draw();
			}
		});
	});
</script>