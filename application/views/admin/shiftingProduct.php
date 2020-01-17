    <fieldset class="mb-3">
        <div class="form-group row">
            <div class="col-lg-8 col-md-8 col-xs-12">
                <input type="text" class="form-control" name="sku" id="sku_search" placeholder="Search Product with SKU or Name">
                <div class="alert alert-danger border-0 alert-dismissible" id="searchMsg" style="display: none">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                    <div></div>
                </div>
            </div>

            <!-- <div clas="col-md-2 col-xs-12">
                <button type="button" class="btn btn-success btn-icon"><i class="icon-plus3"></i></button>
            </div> -->
        </div>
        
        <form class="ajax-submit-form" action="javascript:;" method="post" data-action="<?= base_url('admin/shiftProduct/'.$priority.'/'.$rel_id) ?>">
            <div class="row">
                <div class="col-md-12">
                    <table class="table datatable-basic" id="productList">
                        <thead>
                            <tr>
                                <th>Product/SKU code</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>  
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 text-right mt-4">
                    <button type="submit" class="btn btn-primary" disabled>Submit <i class="icon-paperplane ml-2"></i></button>
                </div>
            </div>  
        </form>
        <div class="myMsg" style="position: absolute;left: 15px;"></div>
    </fieldset>
<script type="text/javascript">
var prodArr = 0;
$('#sku_search').autocomplete({
    minLength: 3,
    source: '<?= base_url('admin/searchproskuname') ?>',
    search: function() {
        $(this).parent().addClass('ui-autocomplete-processing');
    },
    open: function() {
        $(this).parent().removeClass('ui-autocomplete-processing');
    },
    select: function(event, ui) {
        $('#productList tbody').append(`<tr class="removeRelRow`+prodArr+`"><td><input type="hidden" name="prods[]" value="`+ui.item.id+`">`+ui.item.label+`</td><td><a href="javascript:removeRelRow('`+prodArr+`')" style="cursor:pointer;"><i class="icon-cross2"></i></a></td></tr>`);
        prodArr++;
        $('.ajax-submit-form button').attr('disabled', false);
        setTimeout(() => {
            $('#sku_search').val(''); 
        }, 500);
    }
});
function removeRelRow(index) {
    $('#productList tr.removeRelRow'+index).remove();
    if(!$('#productList tbody tr').length) {
        $('.ajax-submit-form button').attr('disabled', true);
    }
}
</script>