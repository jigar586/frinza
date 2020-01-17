<?php
$selected_childs = array_values(array_column(array_filter($applied_data, function($ar) {
        return $ar['priority'] == 2;
    }), 'applied_on'));
if(count($selected_childs)) {
    $selected_cats = array_values(array_unique(array_column(array_filter($child_categories, function($ar) use ($selected_childs){
        return in_array($ar['child_id'], $selected_childs);
    }), 'category_id')));
} else {
    $selected_cats = array_values(array_column(array_filter($applied_data, function($ar) {
            return $ar['priority'] == 1;
        }), 'applied_on'));
}


?>
<form id="applyOffer" method="post" action="#" data-action="<?= base_url('admin/modalApplyoffer/'.$offer_id) ?>">		
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>category</label>
                <select multiple="multiple" data-placeholder="Please select category" name="category_id[]" class="form-control select2 category_id" >
                    <?php foreach($categories as $cat){ ?>
                        <option value="<?= $cat['category_id'] ?>" <?= in_array($cat['category_id'], $selected_cats) ? 'selected' : '' ?>><?= $cat['category_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Child Category</label>
                <select multiple="multiple" data-placeholder="Please select child category" name="child_id[]" class="form-control select2 child_id">
                    
                </select>
            </div>
            <div class="form-group text-right"> 
                <input class="btn btn-primary" type="submit" name="submitDiscount" value="Apply Discount">
            </div>
        </div>
    </div>
</form>
<script>
    var cats = <?= json_encode($child_categories) ?>;
    var selected_childs = <?= json_encode($selected_childs) ?>;
    var firstFetch = true;
    $('document').ready(function(){
        $('select.category_id').select2();
        $('select.child_id').select2();
        let selected_cat = $('select.category_id').val();
        fetchChildCategories(selected_cat);
    });
    $('select.category_id').change(function(){
        var category_id = $(this).val();
		fetchChildCategories(category_id);
    });

    function fetchChildCategories(category_id) {
        $('select.child_id').html('');
		$('select.child_id').change();
		let childs = cats.filter(ar => {
			return category_id.indexOf(ar.category_id) > -1;
		});
		for (let index = 0; index < childs.length; index++) {
			$('select.child_id').append(new Option( childs[index].child_name, childs[index].child_id ));
        }
        if(firstFetch) {
            $('select.child_id').val(selected_childs).trigger('change');
        }
        firstFetch = false;
    }
</script>