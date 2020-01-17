<table class="table datatable-basic" id="productTable">
    <thead>
        <tr>
            <th>Sr No</th>
            <th>Offer Name</th>
            <th>Offer Type</th>
            <th>Offer Period</th>
            <!-- <th>SKU</th> -->
            <th>Amount</th>
            <th>Status</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
			$i = 1; 
			foreach ($offers as $p) {
				$start = strtotime($p->start_date);
				$end = strtotime($p->end_date);
				$today = strtotime(date('Y-m-d'));
			?>

        <tr>
            <td><?= $i++ ?></td>
            <td><?= $p->offer_name ?></td>
            <td>
                <?php if ($p->is_coupon == 1) {
                    echo "Cashback Coupon";
                  }else{  
                    echo "Discount";
                  } ?>
            </td>
            <td><?= date('F d, Y',$start)?> - <?= date('F d, Y',$end)?></td>
            <td>
                <?php if ($p->offer_type == 1) {
                    echo '₹'.$p->amount;
                  }else{
                    echo $p->amount."%";
                  } 
                  ?>
            </td>
            <td>
                <?php
                    if ($p->status == 0) { ?>
                <span class="badge badge-secondary">Inactive</span>
                <?php  }elseif ($start < $today && $end < $today) { ?>
                <span class="badge badge-danger">Expired</span>
                <?php }elseif ($today < $start) { ?>
                <span class="badge badge-info">Pending</span>
                <?php }elseif ($start <= $today && $today <= $end) { ?>
                <span class="badge badge-success">Live</span>
                <?php }
                  ?>
            </td>
            <td class="text-center">
                <div class="list-icons">
                    <div class="dropdown">
                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                            <i class="icon-menu9"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?= base_url('admin/addDiscount/'.$p->offer_id) ?>" class="dropdown-item"><i   class="icon-pencil3"></i> Edit</a>
                            <a href="javascript:void(0)" onclick="deleteOffer(<?= $p->offer_id ?>)" class="dropdown-item"><i class="icon-cancel-circle2"></i> Delete</a>
                            <a href="javascript:void(0)" onclick="applyOffer(<?= $p->offer_id ?>)" class="dropdown-item"><i class="icon-paperplane"></i> Apply Discount</a>
                            <!-- <a href="#" class="dropdown-item"><i class="icon-file-word"></i> Export to .doc</a> -->
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <?php 
              } ?>

    </tbody>
</table>
<script type="text/javascript">
$('#productTable thead td').each(function() {
    var title = $(this).text();
    $(this).html('<input type="text" class="form-control productTableData" placeholder="Search ' + title +
        '" />');
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