<table class="table datatable-basic" id="productTable">
            <thead>
              <tr>
                <th>Sr No</th>
                <th>Shipping Type</th>
                <th>City</th>
                <th>Shipping Rate</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i = 1;
                foreach ($ships as $r) { 
                  
              ?>
              <tr>
                <td><?= $i++ ?></td>
                <td><?php if ($r->shipping_id == 2) {
                	echo 'Mid Night Delivery';
                }elseif ($r->shipping_id == 1) {
                	echo "Fixed Time Delivery";
                }elseif($r->shipping_id == 4){
                  echo "Early Morning Delivery";
                }else{
                	echo "Standard Delivery";
                }  ?></td>
                <td><?= $r->city_name ?></td>
                <td>₹<?= $r->shipping_rate ?></td>
                <td class="text-center">
                  <a href="javascript:void(0)"  onclick="deleteSlot(<?= $r->rate_id ?>)"><span class="badge badge-danger"><i class="icon-cancel-circle2"></i> Delete</span></a>
                </td>
              </tr>
              <?php  }
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