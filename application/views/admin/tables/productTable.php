
<table class="table datatable-basic" id="productTable">
            <thead>
              <tr>
                <th>Sr No</th>
                <!-- <th>Category</th>
                <th>Sub Category</th> -->
                <th>Product Title</th>
                <!-- <th>SKU</th> -->
                <th>Price</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1; 
              foreach ($products as $p) {
              ?>
              <tr>
                <td><?= @$i++ ?></td>
                <!-- <td><?= @$p->category_name ?></td>
                <td><?= @$p->child_name ?></td> -->
                <td><?= @$p->product_title ?></td>
                <td>₹<?= @$p->price ?></td>
                <td>
                  <?php
                    if (@$p->status == 1) { ?>
                      <button type="button" class="btn btn-outline-success" onclick="offProduct(<?= @$p->product_id ?>)">Active</button>
                  <?php  }else { ?>
                    <button type="button" class="btn btn-outline-secondary" onclick="onProduct(<?= @$p->product_id ?>)">Inactive</button>
                  <?php }
                  ?>
                </td>
                <td class="text-center">
                        <a href="<?= base_url('admin/addProduct/'.$p->product_id) ?>"><span class="badge badge-info"><i class="icon-pencil3"></i> Edit</span></a>
                        <a href="javascript:void(0)"  onclick="deleteProduct(<?= @$p->product_id ?>)"><span class="badge badge-danger"><i class="icon-cancel-circle2"></i> Delete</span></a>
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