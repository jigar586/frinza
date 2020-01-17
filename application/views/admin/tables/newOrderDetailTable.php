<table class="table datatable-basic" id="productTable">
  <thead>
    <tr>
      <th>Sr</th>
      <th>Order No.</th>
      <th>Buyer's Name</th>
      <th>Product Title</th>
      <th>Qty</th>
      <th>Price</th>
      <th>Order Value</th>
      <th>Order Date</th>
      <th>Address</th>
      <th>Delivery Time</th>
      <th class="text-center">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (count($newOrders) != 0) {
      $i = 0;
      foreach ($newOrders as $nOrd) {
        $orderDate = date('d M, Y',strtotime($nOrd->created_at));
        $shipSlot = date('d M, Y h:i a',strtotime($nOrd->ship_from)).' - '.date('h:i a',strtotime($nOrd->ship_till));
    ?>
    <tr>
      <td><?= ++$i ?></td>
      <td><?= $nOrd->order_id ?></td>
       <td><a href="javascript:void(0)" onclick="userInfo(<?= $nOrd->user ?>)"><?= @$nOrd->first_name.' '.@$nOrd->last_name ?></td> 
      <td><?= $nOrd->product_title ?></td>
      <td><?= $nOrd->qty ?></td>
      <td>₹<?= $nOrd->price ?></td>
      <td>₹<?= $nOrd->amount ?></td>
      <td><?= $orderDate ?></td>
      <td><?= $nOrd->billFname.' '.$nOrd->billLname. "<br>".$nOrd->contact . "<br>".$nOrd->address_1 ?>, <?= $nOrd->address_2 ?>, <?= $nOrd->city ?>, <?= $nOrd->pin_code ?></td>
      <td><?= $shipSlot ?></td>
      <td class="text-center">
        <div class="list-icons">
          <a href="javascript:void(0)" onclick="forwardDetailForm(<?= $nOrd->detail_id ?>)"><span class="badge badge-info">Forward</span></a>
       </div>
     </td>
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