<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/headerlinks.php') ?>
<link rel="stylesheet" type="text/css" href="https://mdbootstrap.com/wp-includes/css/dist/block-library/style.min.css?ver=5.2.3"></style>
<link rel="stylesheet" type="text/css" href="<?= FOLDER_ASSETS_TEMPLATEDATA ?>packages/core/main.css"></style>
<link rel="stylesheet" type="text/css" href="<?= FOLDER_ASSETS_TEMPLATEDATA ?>packages/daygrid/main.css"></style>
<link rel="stylesheet" type="text/css" href="<?= FOLDER_ASSETS_TEMPLATEDATA ?>packages/list/main.css"></style>

<style>
    #loading {
        display: none;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }
	.checkmark{
	    position: absolute;
		top: 0;
		left: 0;
		-moz-box-sizing: border-box;
		font-size: 20px;
		display: block;
		width: 30px;
		font-weight: bold;
		padding: 7px;
		font-size: 30px;
		height: 30px;
		color: #e62263;
		line-height: 16px;
		text-align: center;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		border:0px solid #000;
	}
	.chkCont .checkmark:after {
		-ms-transform: rotate(45deg);
		left: 9px;
		top: 5px;
		width: 9px;
		height: 14px;
		border: solid #fff;
		border-width: 0 3px 3px 0;
		-webkit-transform: rotate(45deg);
		-ms-transform: rotate(45deg);
		transform: rotate(45deg);
		background: #e62263;
	}
</style>
<body class="category-page">
    <div id="page">
        
        <?php include_once('includes/header.php') ?>
 
        <?php include_once('includes/navigation.php') ?>
        
        <section class="main-container col2-left-layout bounceInUp animated">
            <div class="container">
                <div class="row">

                    <div class="col-sm-9 col-sm-push-3 noPadding">
                        <?php include_once('includes/category_slider.php') ?>

                        <article class="col-main" style="margin-top: 10px;">
                            <h1 class="page-heading"><?= @$catName ?></h1>
                            <h5 for="" class="mobileHide"><?= @$description ?></h5>
                            <div class="col-xs-12 mobileShow noPadding" style="display: none;">
                                <div class="col-xs-4 noPadding" style="padding: 2px;">
                                    <a class=" text-center" href="?filt="><button class="btn button btn-block <?php if($this->input->get('filt') == ''){ echo "active"; } ?>"><i class="fa fa-star"></i> Popularity</button></a>
                                </div>
                                <div class="col-xs-4 noPadding" style="padding: 2px;">
                                    <a class=" text-center" href="?filt=asc"><button class="btn button btn-block  <?php if($this->input->get('filt') == 'asc'){ echo "active"; } ?>"><i class="fa fa-arrow-down"></i> Low to High</button></a>
                                </div>
                                <div class="col-xs-4 noPadding" style="padding: 2px;">
                                    <a class=" text-center" href="?filt=desc"><button class="btn button btn-block text-center <?php if($this->input->get('filt') == 'desc'){ echo "active"; } ?>"><i class="fa fa-arrow-up"></i> High to Low</button></a>
                                </div>
                            </div>

                            <div class="category-products tab-content" id="productContent">
								<div id="calendar"></div>
                            </div>
							
                            <div>
                                <div class="accordion mobileShow" id="accordionExample" style="width:100%;">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </article>
                    </div>
                    <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9 noPadding mobileHide">
                        <aside class="col-left sidebar">
                            <div class="side-nav-categories">
                                <div class="block-title">
                                    <h3>Shop By Price</h3>
                                </div>
                                <div class="box-content box-category">
                                    <ul>
                                        <li><a href="?filt=asc">Low to High</a></li>
                                        <li><a href="?filt=desc">High to Low</a></li>
                                        <li><a href="?bl=200">below Rs. 200</a></li>
                                        <li><a href="?ab=200&bl=400">Rs. 200 - Rs. 400</a></li>
                                        <li><a href="?ab=400&bl=600">Rs. 400 - Rs. 600</a></li>
                                        <li><a href="?ab=600&bl=800">Rs. 600 - Rs. 800</a></li>
                                        <li><a href="?ab=800&bl=1000">Rs. 800 - Rs. 1000</a></li>
                                        <li><a href="?ab=1000">Rs. 1000 Above</a></li>
                                    </ul>

                                </div>
                                <!--box-content box-category-->
                            </div>
                        </aside>
                        <aside class="col-left sidebar">
                            <div class="side-nav-categories">
                                <div class="block-title">
                                    <h3>Categories</h3>
                                </div>
                                <div class="box-content box-category">
                                    <ul>
                                        <?php
										foreach ($category as $cat) {
											$catURL = base_url('').url_title($cat->category_heading,'-',TRUE).'/c'.$cat->category_id;
											?>
                                        <li> <a href="<?= $catURL ?>"><?= $cat->category_name ?></a> <span
                                                class="subDropdown plus"></span>
                                            <ul>
                                                <?php
														$tempSub = $this->shop->getSubCategory($cat->category_id);
														foreach ($tempSub as $sub) {
													?>
                                                <li> <a href="#"> <?= $sub->subcategory_name ?> </a> <span
                                                        class="subDropdown minus"></span>
                                                    <ul class="level1">
                                                        <?php
																	$tempChild = $this->shop->getChildCategory($sub->subcategory_id);
																	foreach ($tempChild as $cc) {
																		$childURL = base_url('').url_title($cc->child_heading,'-',TRUE).'/cc'.$cc->child_id;
																?>
                                                        <li> <a href="<?= $childURL ?>"><?= $cc->child_name ?></a> </li>
                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <?php } ?>
                                    </ul>

                                </div>
                                <!--box-content box-category-->
                            </div>
                            
                        </aside>
                    </div>
                </div>
            </div>
        </section>

        <div id="budgetModal" class="modal fade " role="dialog"  tab-index="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Annual Budget</h4>
                    </div>
                    <div class="modal-body" style="padding:auto 0;">
                        <div class="row">
                            <label class="control-label col-md-3" > Budget: </label>
                            <input tye="number" class="col-md-8 new-input"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="budgetClick" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="addressModal" class="modal fade " role="dialog"  tab-index="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Address</h4>
                    </div>
                    <div class="modal-body" style="padding:0;">
                        <div class="row">
                            <section class="col-sm-12 col-xs-12 customPad">
                                <div class="col-main">
                                    <div class="row clearfix row-eq-height">
                                        <div class="col-md-12 col-sm-12 col-xs-12 bb-1-d">
                                            <fieldset>
                                                <legend>Personal Details: </legend>
                                                <div class="">
                                                    <div class="form-group clearfix">
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">Age:<span class="required">*</span></label>
                                                            <br>
                                                            <input type="text" name="age" class="new-input bill-require" placeholder="Age">
                                                        </div>
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">Gender:<span class="required">*</span></label>
                                                            <br>
                                                            <select class="new-input bill-require" name="billing[state]">
                                                                <option value="">Select State</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">Relation:<span class="required">*</span></label>
                                                            <br>
                                                            <select class="new-input bill-require" name="billing[state]">
                                                                <option value="">Select State</option>
                                                                <option value="">Relation 1</option>
                                                                <option value="">Relation 2</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">Personality:<span class="required">*</span></label>
                                                            <br>
                                                            <select class="new-input bill-require" name="billing[state]">
                                                                <option value="">Select State</option>
                                                                <option value="">Personality 1</option>
                                                                <option value="">Personality 2</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">Profession:<span class="required">*</span></label>
                                                            <br>
                                                            <select class="new-input bill-require" name="billing[state]">
                                                                <option value="">Select State</option>
                                                                <option value="">Profession 1</option>
                                                                <option value="">Profession 2</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">Occassion:<span class="required">*</span></label>
                                                            <br>
                                                            <select class="new-input bill-require" name="billing[state]">
                                                                <option value="">Select State</option>
                                                                <option value="">Occassion 1</option>
                                                                <option value="">Occassion 2</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                    <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">Closeness:<span class="required">*</span></label>
                                                            <br>
                                                            <select class="new-input bill-require" name="billing[state]">
                                                                <option value="">Select State</option>
                                                                <option value="">1</option>
                                                                <option value="">2</option>
                                                                <option value="">3</option>
                                                                <option value="">4</option>
                                                                <option value="">5</option>
                                                                <option value="">6</option>
                                                                <option value="">7</option>
                                                                <option value="">8</option>
                                                                <option value="">9</option>
                                                                <option value="">10</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 bb-1-d">
                                            <fieldset>
                                                <legend>Billing Details: <button type="button" class="new-btn pull-right" onclick="clearForm('billing')">New*</button></legend>
                                                <div class="">
                                                    <div class="form-group clearfix">
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">First Name:<span class="required">*</span></label>
                                                            <br>
                                                            <input type="text" name="billing[name]" class="new-input bill-require" placeholder="First Name" value="<?= @$billing->name ?>">
                                                            <input type="hidden" name="billing[hdnID]" value="<?= @$billing->address_id ?>">
                                                        </div>
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">Last Name:<span class="required">*</span></label>
                                                            <br>
                                                            <input type="text" name="billing[last_name]" class="new-input bill-require" placeholder="Last Name" value="<?= @$billing->last_name ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <div class="col-md-12">
                                                            <label class="control-label">Email:<span class="required">*</span></label>
                                                            <br>
                                                            <input type="text" name="billing[email]" class="new-input bill-require" placeholder="Email Address" value="<?= @$billing->email ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <div class="col-md-12">
                                                            <label class="control-label">Address:<span class="required">*</span></label>
                                                            <br>
                                                            <input type="text" name="billing[address_1]" class="new-input bill-require" placeholder="Enter your Address" value="<?= @$billing->address_1 ?>">
                                                            <br><br>
                                                            <input type="text" name="billing[address_2]" class="new-input" value="<?= @$billing->address_2 ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">City:<span class="required">*</span></label>
                                                            <br>
                                                            <input type="text" name="billing[city]" class="new-input bill-require" placeholder="City" value="<?= @$billing->city ?>">
                                                        </div>
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">State:<span class="required">*</span></label>
                                                            <br>
                                                            <select class="new-input bill-require" name="billing[state]">
                                                                <option value="">Select State</option>
                                                                <?php
                                                                    for ($st=0; $st < count($states); $st++) { 
                                                                        $stateselection = $states[$st]->state_id == @$billing->state ? 'selected' : '';
                                                                        echo "<option value='".$states[$st]->state_id."' ".$stateselection.">".$states[$st]->state_name."</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">Pincode:<span class="required">*</span></label>
                                                            <br>
                                                            <input type="number" maxlength="6" name="billing[pin_code]" class="new-input bill-require" placeholder="Pin Code" value="<?= @$billing->pin_code ?>">
                                                        </div>
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">Telephone:<span class="required">*</span></label>
                                                            <br>
                                                            <input type="number" maxlength="10" name="billing[contact]" class="new-input bill-require" placeholder="Telephone No." value="<?= @$billing->contact ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 mt-xs bb-1-d">
                                            <fieldset>
                                                <legend>
                                                    <button type="button" class="new-btn pull-right" style="display: none;" id="shipAddNewBtn" onclick="clearForm('shipping')">New*</button>
                                                    <label class="chkCont" style="margin-bottom: 10px">Deliver to a different address?<input type="checkbox" id="shipAdd" name="sameAdd" value="1"><span class="checkmark"></span></label>
                                                </legend>
                                                <div id="shipAddContainer" style="display: none;">
                                                    <div class="form-group clearfix">
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">First Name:<span class="required">*</span></label>
                                                            <br>
                                                            <input type="text" name="shipping[name]" class="new-input ship-require" placeholder="First Name" value="<?= @$shipping->name ?>">
                                                            <input type="hidden" name="shipping[hdnID]" value="<?= @$shipping->address_id ?>">
                                                        </div>
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">Last Name:<span class="required">*</span></label>
                                                            <br>
                                                            <input type="text" name="shipping[last_name]" class="new-input ship-require" placeholder="Last Name" value="<?= @$shipping->last_name ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <div class="col-md-12">
                                                            <label class="control-label">Email:<span class="required">*</span></label>
                                                            <br>
                                                            <input type="email" name="shipping[email]" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" title="Please Enter Valid Email" class="new-input ship-require" placeholder="Email Address" value="<?= @$shipping->email ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <div class="col-md-12">
                                                            <label class="control-label">Address:<span class="required">*</span></label>
                                                            <br>
                                                            <input type="text" name="shipping[address_1]" class="new-input ship-require" placeholder="Enter your Address" value="<?= @$shipping->address_1 ?>">
                                                            <br><br>
                                                            <input type="text" name="shipping[address_2]" class="new-input" value="<?= @$shipping->address_2 ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">City:<span class="required">*</span></label>
                                                            <br>
                                                            <input type="text" name="shipping[city]" class="new-input ship-require" placeholder="City" value="<?= @$shipping->city ?>">
                                                        </div>
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">State:<span class="required">*</span></label>
                                                            <br>
                                                            <select class="new-input ship-require" name="shipping[state]">
                                                                <option value="">Select State</option>
                                                                <?php
                                                                    for ($st=0; $st < count($states); $st++) { 
                                                                        $stateselection = $states[$st]->state_id ==  @$shipping->state ? 'selected' : '';
                                                                        echo "<option value='".$states[$st]->state_id."'>".$states[$st]->state_name."</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">Pincode:<span class="required">*</span></label>
                                                            <br>
                                                            <input type="number" maxlength="6" name="shipping[pin_code]" class="new-input ship-require" placeholder="Pin Code" value="<?= @$shipping->pin_code ?>">
                                                        </div>
                                                        <div class="col-md-6 col-xs-6">
                                                            <label class="control-label">Telephone:<span class="required">*</span></label>
                                                            <br>
                                                            <input type="number" maxlength="10" name="shipping[contact]" class="new-input ship-require" placeholder="Telephone No." value="<?= @$shipping->contact ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="addressClick" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="productModal" class="modal fade " role="dialog"  tab-index="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Products</h4>
                    </div>
                    <div class="modal-body" style="padding:0;">
                        <div class="row">
                            <section class="col-sm-12 col-xs-12 customPad">
                                <div class="col-main">
                                    <div class="row clearfix row-eq-height">
                                        <div class="col-md-12 col-sm-12 col-xs-12 bb-1-d">
                                            <div class="col-md-3 col-xs-6">
                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info">
                                                                <label class="chkCont" style="margin-bottom: 10px"><input type="checkbox" class="shipAdd" name="product_id[]" value="309"><span class="checkmark">+</span></label>
                                                                <img class="img-responsive imgClick" alt="Retis lapen casen" src="http://localhost/frinza/assets/templatedata/images/products/a5b45aa67cb25b8d781cbee42938e965.jpg">
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"><h5 style="max-height: 30px; overflow: hidden;">Customized Heart Shape Keychain </h5></div>
                                                                <div class="item-content">
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> 
                                                                            <span class="price">249.00</span> </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="action">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-xs-6">
                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info">
                                                                <label class="chkCont" style="margin-bottom: 10px"><input type="checkbox" class="shipAdd" name="product_id[]" value="346"><span class="checkmark">+</span></label>
                                                                <img class="img-responsive imgClick" alt="Retis lapen casen" src="http://localhost/frinza/assets/templatedata/images/products/8d1a2cb9a38f0646c4b81eaea627176f.jpg">
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"><h5 style="max-height: 30px; overflow: hidden;">Keychain Of Fondness </h5></div>
                                                                <div class="item-content">
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> 
                                                                            <span class="price">249.00</span> </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="action">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-xs-6">
                                                <div class="item">
                                                    <div class="item-inner">
                                                        <div class="item-img">
                                                            <div class="item-img-info">
                                                                <label class="chkCont" style="margin-bottom: 10px"><input type="checkbox" class="shipAdd" name="product_id[]" value="539"><span class="checkmark">+</span></label>
                                                                <img class="img-responsive imgClick" alt="Retis lapen casen" src="http://localhost/frinza/assets/templatedata/images/products/465e4580944bb673df0a7dd8ea5b8ee3.png">
                                                            </div>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"><h5 style="max-height: 30px; overflow: hidden;">Personalised Photo Key chain </h5></div>
                                                                <div class="item-content">
                                                                    <div class="item-price">
                                                                        <div class="price-box"> <span class="regular-price"> 
                                                                            <span class="price">245.00</span> </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="action">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once('includes/brands.php') ?>
        
        <?php include_once('includes/footer.php') ?>
    </div>
    <?php include_once('includes/mobilemenu.php') ?>
    
    <?php include_once('includes/footerlinks.php') ?>
    <script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>packages/core/main.js"></script>
    <script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>packages/interaction/main.js"></script>
    <script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>packages/daygrid/main.js"></script>
    <script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>packages/list/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            defaultDate: new Date(),
            // navLinks: true,
            selectable: true,
            selectMirror: true,
            select: function(arg, start, end, allDay) {
                console.log(arg);
                console.log(arg.endStr);
                console.log(arg.startStr);
                // if(arg.endStr != arg.startStr){
                //     return false;
                // }
                $('#budgetModal').modal('show');
                // console.log(arg);
                // var title = prompt('Event Title:');
                // if (title) {
                // calendar.addEvent({
                //     title: "title",
                //     start: arg.start,
                //     end: arg.end,
                //     allDay: arg.allDay
                // })
                // }
                calendar.unselect()
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            eventRender: function (arg) {
                console.log(arg.event);
                // {description: "Lecture", department: "BioChemistry"}
            }
        });

        calendar.render();
        // calendar.addEvent({
        //     title: "title",
        //     start: "2019-09-24",
        //     end: "2019-09-28",
        //     allDay: false
        // });
    });
    </script>
    <script>
        $(function() {
            $('body').on('change','#shipAdd', function() {
                if ($(this).is(":checked")) {
                    $('#shipAddContainer').slideDown(500);
                    $('#shipAddNewBtn').fadeIn(500);
                }else{
                    $('#shipAddContainer').slideUp(500);
                    $('#shipAddNewBtn').fadeOut(500);
                }
            });
            $('body').on('click','#addressClick',function(){
                $('#budgetModal .modal-body').html($('#productModal .modal-body').html());
                $('#budgetModal .modal-footer').html($('#productModal .modal-footer').html());
            });
            $('body').on('click','#budgetClick',function(){
                $('#budgetModal .modal-body').html($('#addressModal .modal-body').html());
                $('#budgetModal .modal-footer').html($('#addressModal .modal-footer').html());
            });
        });
    </script>
</body>
</html>