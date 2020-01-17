
<table class="table datatable-basic" id="detailTable">
  <thead>
    <tr>
      <th>Sr</th>
      <th>Order No.</th>
      <th>Product Name</th>
      <th>Qty</th>
      <th>Order Value</th>
      <th>Order Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (count($customerData) != 0) {
      $i = 0;
      foreach ($customerData as $nOrd) {
        $orderDate = date('d M, Y',strtotime($nOrd->created_at));
    ?>
    <tr>
      <td><?= ++$i ?></td>
      <td><?= $nOrd->order_id ?></td>
      <td><?= $nOrd->product_title ?></td>
      <td><?= $nOrd->qty ?></td>
      <td>₹<?= $nOrd->amount ?></td>
      <td><?= $orderDate ?></td>
   </tr>
   <?php }
      }
    ?>
 </tbody>
</table>
<script type="text/javascript">
$('#detailTable thead td').each( function () {
  var title = $(this).text();
  $(this).html( '<input type="text" class="form-control detailTableData" placeholder="Search '+title+'" />' );
} );
// DataTable
var table = $('#detailTable').DataTable({
              "pagingType": "full_numbers",
              "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
             });

  // Apply the search
table.columns().every( function () {
  var that = this;

  $( '.detailTableData', this.footer() ).on( 'keyup change', function () {
    if ( that.search() !== this.value ) {
      that
      .column( $(this).parent().index()+':visible' )
      .search( this.value )
      .draw();
    }
  });
});
</script>