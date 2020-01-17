<table class="table datatable-basic" id="vendorTable">
  <thead>
    <tr>
      <th>Sr</th>
      <th>Buyer's Name</th>
      <th>Product Title</th>
      <th>Qty</th>
      <th>Vendor Price</th>
      <th>Delivered On</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (count($vendorOrders) != 0) {
      $i = 0;
      foreach ($vendorOrders as $nOrd) {
       
    ?>
    <tr>
      <td><?= ++$i ?></td>
      <td><?= $nOrd->first_name.' '.$nOrd->last_name ?></td>
      <td><?= $nOrd->product_title ?></td>
      <td><?= $nOrd->qty ?></td>
      <td>₹<?= $nOrd->vendor_price ?></td>
      <td><?= @date('d M, Y h:i a',strtotime($nOrd->updated_at)) ?></td>
      <td>
    <?php if ($nOrd->suborder_status == 2) { ?>
      <span class="badge badge-info">Accepted</span>
      <a href="javascript:void(0)" onclick="forwardDetailForm(<?= $nOrd->detail_id ?>)"><span class="badge badge-danger">Action as Vendor</span></a>
    <?php }elseif ($nOrd->suborder_status == 3) { ?>
      <span class="badge badge-warning">Out for Delivery</span>
      <a href="javascript:void(0)" onclick="forwardDetailForm(<?= $nOrd->detail_id ?>)"><span class="badge badge-danger">Action as Vendor</span></a>
    <?php }elseif($nOrd->suborder_status == 4){ ?>
    <span class="badge badge-success">Delivered</span>
    <?php }else { ?>
      <span class="badge badge-danger">Cancelled</span>
    <?php } ?>

    </td>
      
   </tr>
   <?php }
      }
    ?>
 </tbody>
</table>

<script type="text/javascript">
$('#vendorTable thead td').each( function () {
  var title = $(this).text();
  $(this).html( '<input type="text" class="form-control vendorTableData" placeholder="Search '+title+'" />' );
} );
// DataTable
var table = $('#vendorTable').DataTable({
              "pagingType": "full_numbers",
              "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
             });

  // Apply the search
table.columns().every( function () {
  var that = this;

  $( '.vendorTableData', this.footer() ).on( 'keyup change', function () {
    if ( that.search() !== this.value ) {
      that
      .column( $(this).parent().index()+':visible' )
      .search( this.value )
      .draw();
    }
  });
});
</script>