<script src="<?= FOLDER_ASSETS_ADMINDATA ?>js/demo_pages/datatables_extension_buttons_print.js"></script>
<table class="table datatable-button-print-columns" id="productTable">
  <thead>
    <tr>
      <th>Sr</th>
      <th>Transaction ID</th>
      <th>Transaction Date</th>
      <th>Amount</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($statements)) {
      $i = 0;
      foreach ($statements as $ord) {
       ?>
       <tr>
        <td><?= ++$i ?></td>
        <td><?= $ord->vtx_id ?></td>
        <td><?= date('d M, Y',strtotime($ord->created_at)) ?></td>
        <td>
          <?php
          if ($ord->payment_type) {
            echo "<span class='text-danger'>- ₹".$ord->amount."</span>";
          }else{
            echo "<span class='text-success'>+ ₹".$ord->amount."</span>";
          }
          ?>  
        </td>
        <td class="text-center">
          <a href="javascript:void(0)" class="badge badge-danger" onclick="getDetailForVendor(<?= $ord->detail_id ?>)">Check Details</a>
        </td>
      </tr>
    <?php }
  } ?>
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
        buttons: ['print',]
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