<table class="table datatable-basic" id="productTable">
            <thead>
              <tr>
                <th>Sr No</th>
                <th>Vendor Name</th>
                <th>Contact No</th>
                <th>Vendor City</th>
                <th>Vendor State</th>
                <th>Unsettled Amount</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i = 1;
                foreach ($vendors as $r) { 
                  $city = $this->cities->getCityState($r->city_id);
              ?>
              <tr>
                <td><?= $i++ ?></td>
                <td><a href="javascript:void(0)" onclick="userInfo('<?= $r->vendor_id ?>')"><?= $r->vendor_name ?></a></td>
                <td><?= $r->vendor_contact ?></td>
                <td><?= $city[0]->city_name ?></td>
                <td><?= $city[0]->state_name ?></td>
                <td>₹<?= getVendorBalance($r->vendor_id) ?></td>
                <td>
                  <?php if ($r->is_available) { ?>
                    <button type="button" class="btn btn-outline-success" onclick="offVendor(<?= $r->vendor_id ?>)">Available</button>
                  <?php }else{ ?>
                    <button type="button" class="btn btn-outline-secondary" onclick="onVendor(<?= $r->vendor_id ?>)">Not Available</button>
                  <?php } ?>
                </td>
                <td class="text-center">
                  <a href="<?= base_url('admin/addVendor/'.$r->vendor_id) ?>" title='Edit Vendor'><span class="badge badge-info"><i class="icon-pencil3"></i></span></a>
                  <a href="javascript:void(0)"  onclick="deleteVendor(<?= $r->vendor_id ?>)"  title='Delete Vendor'><span class="badge badge-danger"><i class="icon-cancel-circle2"></i></span></a>
                  <a href="javascript:void(0)"  onclick="vendorOrders(<?= $r->vendor_id ?>)"  title='View Orders Processed by Vendor'><span class="badge badge-success"><i class="icon-cart"></i></span></a>
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