
<table class="table datatable-basic" id="productTable">
  <thead>
    <tr>
      <th>Sr</th>
      <th>Category Name</th>
      <th class="text-center">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 1;
      foreach ($categories as $r) { ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= $r->category_name ?></td>
          <td class="text-center">
            <a href="javascript:void(0)" onclick="editCategory(<?= $r->category_id ?>)"><span class="badge badge-info"><i class="icon-pencil3"></i> Edit</span></a>
            <a href="javascript:void(0)"  onclick="deleteCategory(<?= $r->category_id ?>)"><span class="badge badge-danger"><i class="icon-cancel-circle2"></i> Delete</span></a>
          </td>
        </tr>
    <?php  } ?>
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