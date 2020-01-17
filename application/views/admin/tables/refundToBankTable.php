<table class="table datatable-basic" id="productTable">
  <thead>
    <tr>
      <th>Sr</th>
      <th>Buyer's name</th>
      <th>Product Title</th>
      <th>Qty</th>
      <th>Order Price</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (count($cancelledOrders) != 0) {
      $i = 0;
      foreach ($cancelledOrders as $nOrd) {
       
    ?>
    <tr>
      <td><?= ++$i ?></td>
      <td><?= @$nOrd->first_name.' '.@$nOrd->last_name ?></td>
      <td><?= @$nOrd->product_title ?></td>
      <td><?= @$nOrd->qty ?></td>
      <td>₹<?= @$nOrd->price + @$nOrd->ship_rate ?></td>
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