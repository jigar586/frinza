<table class="table datatable-basic" id="productTable">
            <thead>
              <tr>
                <th>Sr.</th>
                <th>Buyer's Name</th>
                <th>Product Title</th>
                <th>Shipping Period</th>
                <th>Amount</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (count($orders)) {
                $i = 0;
                foreach ($orders as $ord) {
                  $shipTime = date('M d,Y h:i a',strtotime($ord->ship_from)).'-'.date('h:i a',strtotime($ord->ship_till));
                 ?>
              <tr>
                <td><?= ++$i ?></td>
                <td><?= $ord->name.' '.$ord->last_name ?></td>
                <td><?= $ord->product_title ?></td>
                <td><?= $shipTime ?></td>
                <td>₹<?= $ord->vendor_price ?></td>
                <td>
                	<?php if ($ord->suborder_status == 2) { ?>
                		<span class="badge badge-info">Accepted</span>
                	<?php }elseif ($ord->suborder_status == 3) { ?>
                		<span class="badge badge-warning">Out for Delivery</span>
                	<?php }elseif($ord->suborder_status == 4){ ?>
                	<span class="badge badge-success">Delivered</span>
                	<?php } ?></td>
                <td class="text-center">
                  
                      <button type="button" onclick="getDetailForVendor(<?= $ord->assign_id ?>)" class="btn btn-outline-danger btn-sm rounded-round">Check Details</button>
                  
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