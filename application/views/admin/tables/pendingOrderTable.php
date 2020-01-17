<table class="table datatable-basic" id="productTable">
  <thead>
    <tr>
      <th>Sr</th>
      <th>Buyer's Name</th>
      <th>Product Title</th>
      <th>Qty</th>
      <th>Last Checked</th>
      <th>Delivery Time</th>
      <th>Contact No.</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (count($pendingOrders) != 0) {
      $i = 0;
      foreach ($pendingOrders as $nOrd) {
        $orderDate = date('d M, Y',strtotime($nOrd->updated_at));
        $shipSlot = date('d M, Y h:i a',strtotime($nOrd->start_date)).' - '.date('h:i a',strtotime($nOrd->end_date));
    ?>
    <tr>
      <td><?= ++$i ?></td>
      <td><?= $nOrd->first_name.' '.$nOrd->last_name ?></td>
      <td><?= $nOrd->product_title ?></td>
      <td><?= $nOrd->qty ?></td>
      <td><?= $orderDate ?></td>
      <td><?= $shipSlot ?></td>
      <td><?= $nOrd->user_contact ?></td>
   </tr>
   <?php }
      }
    ?>
 </tbody>
</table>
<script type="text/javascript">
$('#productTable thead td').each( function () {
  var title = $(this).text();
  $(this).html( '<input type="text" class="form-control productTableData" placeholder="Search '+title+'" />' );
} );
// DataTable
var table = $('#productTable').DataTable({
              "pagingType": "full_numbers",
              "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
             });

  // Apply the search
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