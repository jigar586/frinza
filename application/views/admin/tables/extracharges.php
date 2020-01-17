
<table class="table datatable-basic" id="productTable">
            <thead>
              <tr>
                <th>Sr No</th>
                <th>Extra Charge</th>
                <th>Category</th>
                <th>Charge Type</th>
                <th>Amount</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1; 
              foreach ($charges as $p) {
              ?>
              <tr>
                <td><?= $i++ ?></td>
                <td><?= @$p->charge_name ?></td>
                <td><?= @getCategoryName($p->category_id) ?></td>
                <td>
                  <?php if (@$p->charge_type == 1) {
                    echo "Fixed";
                  }else{
                    echo "Percentage";
                  } ?>
                </td>
                <td>
                  <?php if (@$p->charge_type == 1) {
                    echo '₹'.$p->charge_amount;
                  }else{
                    echo $p->charge_amount."%";
                  } 
                  ?>  
                </td>
                <td class="text-center">
                  <div class="list-icons">
                    <div class="dropdown">
                      <a href="#" class="list-icons-item" data-toggle="dropdown">
                        <i class="icon-menu9"></i>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0)" onclick="editCharge(<?= $p->charge_id ?>)" class="dropdown-item"><i class="icon-pencil3"></i> Edit</a>
                        <a href="javascript:void(0)"  onclick="deleteCharge(<?= $p->charge_id ?>)" class="dropdown-item"><i class="icon-cancel-circle2"></i> Delete</a>
                        <!-- <a href="#" class="dropdown-item"><i class="icon-file-word"></i> Export to .doc</a> -->
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <?php 
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