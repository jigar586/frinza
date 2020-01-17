<table class="table  datatable-basic" id="childcatTable">
    <thead>
        <tr>
            <th>Sr</th>
            <th>Category</th>
            <th>Subcategory</th>
            <th>Childcategory</th>
            <th>Status</th>
            <th>Is Display</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
    $i = 1;
      foreach ($categories as $r) { ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $r->category_name ?></td>
            <td><?= $r->subcategory_name ?></td>
            <td><?= $r->child_name ?></td>
            <td>
                <?php if (@$r->is_active) { ?>
                	<button type="button" class="btn btn-outline-success" onclick="offChildCat(<?= @$r->child_id ?>)">Online</button>
                <?php }else{ ?>
                	<button type="button" class="btn btn-outline-secondary" onclick="onChildCat(<?= @$r->child_id ?>)">Offline</button>
                <?php } ?>
            </td>
            <td>
                <?php if (@$r->is_display) { ?>
                	<button type="button" class="btn btn-outline-success" onclick="isDisplay(<?= @$r->child_id ?>,<?= @$r->is_display ?>)">Active</button>
                <?php }else{ ?>
                	<button type="button" class="btn btn-outline-secondary" onclick="isDisplay(<?= @$r->child_id ?>,<?= @$r->is_display ?>)">Inactive</button>
                <?php } ?>
            </td>
            <td class="text-center">
                <a href="javascript:void(0)" onclick="editChildcat(<?= $r->child_id ?>)"><span class="badge badge-info"><i class="icon-pencil3"></i> Edit</span></a>
                <a href="javascript:void(0)" onclick="deleteChildcat(<?= $r->child_id ?>)"><span class="badge badge-danger"><i class="icon-cancel-circle2"></i> Delete</span></a>
				<a href="javascript:void(0)" onclick="openModal('<?= base_url('admin/shiftProductForm/3/'.$r->child_id)?>','Product Shifting','md')"><span class="badge badge-success"><i class="icon-paperplane"></i> Product Shift</span></a>
            </td>
        </tr>
        <?php  }
    ?>
    </tbody>
</table>
<script type="text/javascript">
$('#childcatTable thead td').each(function() {
    var title = $(this).text();
    $(this).html('<input type="text" class="form-control childcatTableData" placeholder="Search ' + title +
        '" />');
});
// DataTable
var table = $('#childcatTable').DataTable({
    "pagingType": "full_numbers",
    "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
    ],
});

// Apply the search
table.columns().every(function() {
    var that = this;

    $('.childcatTableData', this.footer()).on('keyup change', function() {
        if (that.search() !== this.value) {
            that
                .column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();
        }
    });
});
</script>