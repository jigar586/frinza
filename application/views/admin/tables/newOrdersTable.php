
<table class="table datatable-basic" id="detailTable">
  <thead>
    <tr>
      <th>Sr</th>
      <th>Order No.</th>
      <th>Buyer's Name</th>
      <th>No. of Products</th>
      <th>Order Value</th>
      <th>Order Date</th>
      <th class="text-center">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (count($newOrders) != 0) {
      $i = 0;
      foreach ($newOrders as $nOrd) {
        $orderDate = date('d M, Y',strtotime($nOrd->created_at));
    ?>
    <tr>
      <td><?= ++$i ?></td>
      <td><?= $nOrd->order_id ?></td>
      <td><?= $nOrd->first_name.' '.$nOrd->last_name ?></td>
      <td><?php $r = $this->vendor->getSubOrderCount($nOrd->order_id); echo $r[0]->pcount; ?></td>
      <td>₹<?= $nOrd->amount ?></td>
      <td><?= $orderDate ?></td>
      <td class="text-center">
        <div class="list-icons">
			<a href="javascript:void(0)" onclick="orderDetails(<?= $nOrd->order_id ?>)"><span class="badge badge-warning">Details</span></a>
      		<a href="javascript:void(0)" onclick="forwardOrderForm(<?= $nOrd->order_id ?>)"><span class="badge badge-info">Forward</span></a>
       </div>
     </td>
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