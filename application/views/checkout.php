<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/headerlinks.php') ?>
<style type="text/css">
.sidebar {
    position: sticky;
    top: 65px;
}
</style>

<body class="checkout-page">
    <div id="page">
        <!-- Header -->
        <?php include_once('includes/header.php') ?>
        <!-- end header -->

        <!-- Navigation -->

        <?php include_once('includes/navigation.php') ?>
        <!-- end nav -->
        <!-- main-container -->
        <div id="payment_form">
            <div class="main-container col2-right-layout">
                <div class="main container">
                    <div class="row">
                        <section class="col-sm-12 col-xs-12 noPadding">
                            <div class="col-main">
                                <div class="page-title">
                                    <h1>Checkout</h1>
                                </div>
                                <ol class="one-page-checkout" id="checkoutSteps">
                                    <li id="opc-billing" class="opc-billing section allow active">
                                        <div class="step-title"> <span class="number">1</span>
                                            <h3>Checkout Method</h3>
                                        </div>
                                        <div id="checkout-step-billing" class="step a-item">
                                            <form id="co-billing-form">
                                                <fieldset class="group-select">
                                                    <ul>
                                                        <li>
                                                            <label for="billing-address-select">Select a billing address
                                                                from your address book or enter a new address.</label>
                                                            <br>
                                                            <select name="billing_address_id"
                                                                id="billing-address-select" class="address-select"
                                                                title="">
																<?php 
																	if(count($BillAdd) != 0){
                              											foreach ($BillAdd as $bAd) { 
																?>
                                                                <option value="<?= $bAd->address_id ?>">
                                                                    <?= $bAd->name ?> <?= $bAd->last_name ?>,
                                                                    <?= $bAd->address_1 ?>, <?= $bAd->address_2 ?>,
                                                                    <?= $bAd->city ?> - <?= $bAd->pin_code ?></option>
                                                                <?php  }
																	} 
																?>
                                                                <option value="">New Address</option>
                                                            </select>
                                                        </li>
                                                        <li id="billing-new-address-form">
                                                        </li>
                                                        <li>
                                                            <input type="radio" name="billing[use_for_shipping]" id="billing_use_for_shipping_yes" value="1" onClick="SaveAddress()" class="radio">
                                                            <label for="billing_use_for_shipping_yes">Ship to this address</label>
                                                            <input type="radio" name="billing[use_for_shipping]" id="billing_use_for_shipping_no" value="0" checked="checked" onClick="SaveAddress()" class="radio">
                                                            <label for="billing_use_for_shipping_no">Ship to different address</label>
                                                        </li>
                                                        <li class="require"> <em class="required">* </em>Required Fields
                                                        </li>
                                                    </ul>
                                                    <button style="display: none;" type="button" class="button continue"
                                                        onclick="SaveAddress()"><span>Continue</span></button>
                                                </fieldset>
                                            </form>
                                        </div>
                                    <li id="opc-shipping" class="opc-shipping section">
                                        <div class="step-title"> <span class="number">2</span>
                                            <h3 class="one_page_heading"> Shipping Information</h3>
                                        </div>
                                        <div id="checkout-step-shipping" class="step a-item" style="display: none;">
                                            <form id="co-Shipping-form">
                                                <fieldset class="group-select">
                                                    <ul>
                                                        <li>
                                                            <label for="shipping-address-select">Select a Shipping
                                                                address from your address book or enter a new
                                                                address.</label>
                                                            <br>
                                                            <select name="shipping_address_id" id="shipping-address-select" class="address-select" title="">
                                                                <?php if(count($BillAdd) != 0){
																		foreach ($BillAdd as $bAd) { 
																?>
                                                                <option value="<?= $bAd->address_id ?>">
                                                                    <?= $bAd->name ?> <?= $bAd->last_name ?>,
                                                                    <?= $bAd->address_1 ?>, <?= $bAd->address_2 ?>,
                                                                    <?= $bAd->city ?> - <?= $bAd->pin_code ?></option>
                                                                <?php  }
																	} 
																?>
                                                                <option value="">New Address</option>
                                                            </select>
                                                        </li>
                                                        <li id="shipping-new-address-form">

                                                        </li>

                                                        <li class="require"> <em class="required">* </em>Required Fields
                                                        </li>
                                                    </ul>
                                                    <button type="button" class="button continue"
                                                        onclick="SaveShipAddress()"><span>Continue</span></button>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </li>

                                    <li id="opc-payment" class="section">
                                        <div class="step-title"> <span class="number">3</span>
                                            <h3 class="one_page_heading">Order Review</h3>
                                        </div>
                                        <div id="checkout-step-payment" style="display: none">
                                            <fieldset>
                                                <form action="<?= base_url('user/confirmorder') ?>" id="placeOrderForm"
                                                    method="post">
                                                    <table class="data-table cart-table" id="shopping-cart-table">
                                                        <colgroup>
                                                            <col width="1">
                                                            <col>
                                                            <col>
                                                            <col width="1">
                                                            <!-- <col width="1"> -->
                                                            <col width="1">
                                                            <col width="1">
                                                        </colgroup>
                                                        <thead>
                                                            <tr class="first last">
                                                                <th rowspan="1">&nbsp;</th>
                                                                <th rowspan="1"><span class="nobr">Product</span></th>
                                                                <th rowspan="2"><span class="nobr">Delivery Time</span>
                                                                </th>
                                                                <!-- <th colspan="1" class="a-center"><span class="nobr">Unit</span></th> -->
                                                                <th class="a-center" rowspan="1">Qty</th>
                                                                <th colspan="1" class="a-center">Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
																$cart = getCartData();
																$wallet = $payableWal;
																$payable = $payableAmount;
																$pname = $comma = "";
																foreach ($cart as $r) {
																	$pname .= $comma.$r['product_title'];
																	$comma = ', ';
															?>
                                                            <tr class="odd">
                                                                <td class="image">
																	<a class="product-image" title="<?= $r['product_title'] ?>" href="#">
																		<img width="75" alt="Sample Product" src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$r['product_img'] ?>">
																	</a>
                                                                </td>
                                                                <td>
                                                                    <h3 class="product-name"> 
																		<a href="#"><?= $r['product_title'] ?></a>
                                                                    </h3>
                                                                </td>
                                                                <td><?= $r['time'] ?></td>
                                                                <!-- <td class="a-right"><span class="cart-price"> <span class="price">₹<span class='sPrice'><?= $r['price'] ?></span></span> </span></td> -->
                                                                <td class="a-center movewishlist">
                                                                    <span class="qty input-text" title="Qty"><?= $r['qty'] ?></span>
                                                                </td>
                                                                <td class="a-right movewishlist">
																	<span class="cart-price">
																		<span class="price">₹
																			<span class='stPrice'><?= $r['price']*$r['qty'] ?></span>
																		</span>
                                                                    </span>
																</td>

                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="first">
                                                                <td colspan="6">
                                                                    <div class="col-md-12">
                                                                        <label class="col-md-2 col-xs-12"
                                                                            for="msg_card">Message on Card</label>
                                                                        <textarea class="col-md-8 col-xs-12"
                                                                            id="msg_card" name="msg_card"></textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="last">
                                                                <td class="a-right last" colspan="50">
                                                                    <input type="hidden" name="billing_ad"
                                                                        id="checkoutBill">
                                                                    <input type="hidden" name="shipping_ad"
                                                                        id="checkoutShip">
                                                                    <input type="hidden" name="walletpay"
                                                                        value="<?= @$payableWal ?>">
                                                                    <input type="submit" class="button coupon"
                                                                        value="Place Order" />

                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </form>
                                            </fieldset>
                                        </div>
                                    </li>
                                </ol>
                            </div>
                        </section>
                        <aside class="col-right sidebar col-sm-3 col-xs-12 hidden">
                            <div class="block block-progress">
                                <div class="block-title ">
                                    <h3>Your Checkout</h3>
                                </div>
                                <div class="block-content">
                                    <dl>
                                        <dt class="complete"> Billing Address <span class="separator">|</span> <a
                                                href="#billing" class="opc-billing">Change</a> </dt>
                                        <dd class="complete bil_side_add">

                                        </dd>
                                        <dt class="complete"> Shipping Address <span class="separator">|</span> <a
                                                href="#payment" class="opc-shipping">Change</a> </dt>
                                        <dd class="complete ship_side_add">

                                        </dd>
                                        <dt class="complete"> Payment Detail</dt>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>SubTotal :</td>
                                                    <td class="text-right"><span
                                                            class="price">₹<?= @$cartTotal ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping Charge :</td>
                                                    <td class="text-right"><span
                                                            class="price">₹<?= @$shipTotal ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td>Grand Total :</td>
                                                    <td class="text-right"><span
                                                            class="price">₹<?= @$cartTotal+@$shipTotal ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td>From Wallet :</td>
                                                    <td class="text-right"><span class="price" style="color:red">-
                                                            ₹<?= @$wallet ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Payable :</td>
                                                    <td class="text-right"><kbd class="price"
                                                            style="color:#fff;font-size: 15px">&nbsp; ₹<?= @$payable ?>
                                                            &nbsp;</kbd></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </dl>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once('includes/brands.php') ?>

        <?php include_once('includes/footer.php') ?>
    </div>
    <?php include_once('includes/mobilemenu.php') ?>

    <?php include_once('includes/footerlinks.php') ?>

    <script type="text/javascript">
    <?php
      if ($this->session->flashdata('txnError')) {
          echo 'alert("'.$this->session->flashdata('txnError').'");';
      }
    ?>
    $(document).ready(function() {
        console.log($('nav.sticky-header').height());
        var addID = $('#billing-address-select').val();
        addAddress(addID);
        $('#billing-address-select').on('change', function() {
            addAddress($(this).val());
            $('#checkoutBill').val($(this).val());
        });
        var shipID = $('#shipping-address-select').val();
        addShipAddress(shipID);
        $('#checkoutShip').val(shipID);
        $('#checkoutBill').val(addID);
        $('#shipping-address-select').on('change', function() {
            addShipAddress($(this).val());
            $('#checkoutShip').val($(this).val());
        });
    });
    </script>
    <script type="text/javascript">
    $('.opc-billing').click(function() {
        if ($('.opc-shipping').hasClass('active')) {
            if (SaveShipAddress() == false) {
                return false;
            }
        }
        $('#checkoutSteps li').removeClass('active');
        $(this).addClass('active');
        $('#checkout-step-billing').show();
        $('#checkout-step-shipping').hide();
    })
    $('.opc-shipping').click(function() {
        if ($('.opc-billing').hasClass('active')) {
            if (SaveAddress() == false) {
                return false;
            }
        }
        $('#checkoutSteps li').removeClass('active');
        $(this).addClass('active');
        $('#checkout-step-billing').hide();
        $('#checkout-step-shipping').show();
        $('#placeOrderForm').on('submit', function(e) {
            $('#checkoutBill').val($('#billing-address-select').val());
            $('#checkoutShip').val($('#shipping-address-select').val());
            if (!$('#checkoutShip').val() || !$('#checkoutBill').val()) {
                Toast.fire({
                    type: 'error',
                    title: 'Please Select Addresses!'
                });
                // alert('Please Select Addresses!');
                e.preventDefault();
            }
        })
    });
    </script>
</body>

</html>