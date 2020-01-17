<table class="table datatable-basic" id="productTable">
    <thead>
        <tr>
            <th>Sr No</th>
            <th>Category</th>
            <th>Child Category</th>
            <th>Banner Name</th>
            <th>Banner Type</th>
            <th>Banner Img</th>
            <th>Banner url</th>
            <th>Status</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 1;
			foreach ($banners as $r) {
            ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $r['category_name'] ? $r['category_name'] : 'Home Page Banner' ?></td>
            <td><?= $r['child_name'] ?></td>
            <td><?= $r['banner_name'] ?></td>
            <td><?= $r['banner_type'] ?></td>
            <td>
                <img src="<?= FOLDER_ASSETS_TEMPLATEBANNER.$r['banner_img'] ?>" height='100px'>
            </td>
            <td><?= $r['url'] ?></td>
            <td>
                <?php if ($r['is_active']) { ?>

                <button type="button" class="btn btn-outline-success"
                    onclick="offBanner(<?= $r['banner_id'] ?>)">Online</button>
                <?php }else{ ?>
                <button type="button" class="btn btn-outline-secondary"
                    onclick="onBanner(<?= $r['banner_id'] ?>)">Offline</button>
                <?php } ?>
            </td>
            <td class="text-center">
                <a href="javascript:void(0)" onclick="editBanner(<?= $r['banner_id'] ?>)"><span class="badge badge-info"><i class="icon-pencil3"></i> Edit</span></a>
                <a href="javascript:void(0)" onclick="deleteBanner(<?= $r['banner_id'] ?>)"><span class="badge badge-danger"><i class="icon-cancel-circle2"></i> Delete</span></a>
            </td>
        </tr>
        <?php 
			}
		?>
    </tbody>
</table>
<script type="text/javascript">
$('#productTable thead td').each(function() {
    var title = $(this).text();
    $(this).html('<input type="text" class="form-control productTableData" placeholder="Search ' + title + '" />');
});
// DataTable
var table = $('#productTable').DataTable({
    "pagingType": "full_numbers",
    "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
    ],
});

// Apply the search
table.columns().every(function() {
    var that = this;

    $('.productTableData', this.footer()).on('keyup change', function() {
        if (that.search() !== this.value) {
            that
                .column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();
        }
    });
});
</script>