<form action="#" id="insertTaxForm" data-action="<?= base_url('admin/insertTax/'.$tax_id) ?>" method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Label</label>
                <input type="text" class="form-control" name="label" value="<?= @$singleTax[0]['label']; ?>" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>rate</label>
                <input type="number" class="form-control" name="rate" value="<?= @$singleTax[0]['rate']; ?>" required>
            </div>
            </div>
        <div class="col-md-12">
            <div class="form-group">    
                <input type="submit" class="btn btn-primary insertTax" value="Add Tax">
            </div>
        </div>
    </div>
</form>