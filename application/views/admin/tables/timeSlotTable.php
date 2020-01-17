<table class="table datatable-basic" id="productTable">
            <thead>
              <tr>
                <th>Sr No</th>
                <th>Time Slot</th>
                <th>Shipping Type</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i = 1;
                foreach ($timeslots as $r) { 
                  
              ?>
              <tr>
                <td><?= $i++ ?></td>
                <td><?= $r->start_time.' To '.$r->end_time ?></td>
                <td><?php if ($r->ship_id == 2) {
                	echo 'Mid Night Delivery';
                }elseif ($r->ship_id == 1) {
                	echo "Fixed Time Delivery";
                }elseif($r->ship_id == 4){
                	echo "Early Morning Delivery";
                }else{
                  echo "Standard Delivery";
                } 
                 ?></td>
                <td class="text-center">
                  <a href="javascript:void(0)"  onclick="deleteSlot(<?= $r->timing_id ?>)"><span class="badge badge-danger"><i class="icon-cancel-circle2"></i> Delete</span></a>
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