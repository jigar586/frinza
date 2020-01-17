function getCompareBox() {
    $.ajax({
        url: myCompareBoxURL,
        type: "get",
        processData: !1,
        contentType: !1,
        success: function(e) {
            $("#compareBox").html(e)
        }
    })
}

function addToCompare(e) {
    var t = new FormData;
    t.set("product_id", e), $.ajax({
        url: compareURL,
        processData: !1,
        contentType: !1,
        type: "post",
        data: t,
        success: function(e) {
            alert(e), getCompareBox()
        }
    })
}

function addToWish(e) {
    var t = new FormData;
    t.set("product_id", e), $.ajax({
        url: wishURL,
        processData: !1,
        contentType: !1,
        type: "post",
        data: t,
        success: function(e) {
            alert(e)
        }
    })
}

function removeFromCart(e) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: removeFromCartURL,
                type: "post",
                data: {
                    product_id: e
                },
                success: function(e) {
                    Swal.fire(
                        'Deleted!',
                        e,
                        'success'
                    ).then(() => {
                        location.reload()
                    })
                }
            })
        }
    })
}

function addToCart(e, t) {
    var a = new FormData;
    a.set("product_id", e), a.set("quantity", t), $.ajax({
        url: cartURL,
        processData: !1,
        contentType: !1,
        type: "post",
        data: a,
        success: function(e) {
            alert(e)
        }
    })
}

function clearCart() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: clearCartURL,
                processData: !1,
                contentType: !1,
                type: "get",
                success: function(e) {
                    Swal.fire(
                        'Deleted!',
                        e,
                        'success'
                    ).then(() => {
                        location.reload()
                    })
                }
            })
        }
    })
    return false;
}

function quickView(e) {
    var t = new FormData;
    t.set("product_id", e), $.ajax({
        url: quickviewURL,
        processData: !1,
        contentType: !1,
        type: "post",
        data: t,
        success: function(e) {
            $("#quickView").html(e)
        }
    })
}

function loadProducts() {
    var e = new FormData;
    e.set("type", 1), $.ajax({
        url: productListURL,
        processData: !1,
        contentType: !1,
        type: "post",
        data: e,
        success: function(e) {
            $(".products-grid").html(e)
        }
    })
}

function SaveAddress() {
    var e = new FormData,
        t = $("#billing_postcode").val(),
        a = $("#billing_telephone").val();
    return isNaN(t) || 6 != t.toString().length ? (alert("Invalid postal code!"), $("#billing_postcode").val("").focus(), !1) : isNaN(a) || 10 != a.toString().length ? (alert("Invalid Contact No!"), $("#billing_telephone").val("").focus(), !1) : (e.set("first_name", $("#billing_firstname").val()), e.set("address_id", $("#billing_address_id").val()), e.set("last_name", $("#billing_lastname").val()), e.set("address_1", $("#billing").val()), e.set("address_2", $("#billing2").val()), e.set("city", $("#billing_city").val()), e.set("state", $("#billing_region_id").val()), e.set("pin_code", t), e.set("contact", a), e.set("email", $("#billing_email").val()), e.set("add_type", $('input[name="billing[use_for_shipping]"]:checked').val()), void $.ajax({
        url: saveBillURL,
        contentType: !1,
        processData: !1,
        data: e,
        type: "post",
        success: function(e) {
            if ((e = JSON.parse(e)).success) getSelectedAddress(e.address), getSelectedSAddress(e.address), $("#checkout-step-billing").hide(), $("#checkout-step-payment").show(), $("#opc-billing,#opc-payment").toggleClass("active");
            else if (e.success1) {
                $("#shipping-address-select").val();
                getSelectedAddress(e.address), $("#checkout-step-billing").hide(), $("#shipping-new-address-form").show(), $("#checkout-step-shipping").show(), $("#opc-billing,#opc-shipping").toggleClass("active")
            } else alert(e.err), location.reload()
        }
    }))
}

function confirmPayment() {
    var e = new FormData;
    e.set("billing_ad", $("#billing_address_id").val()), e.set("shipping_ad", $("#Shipping_address_id").val()), $.ajax({
        url: cnfmOrderURL,
        type: "post",
        contentType: !1,
        processData: !1,
        data: e,
        success: function(e) {
            alert(e), window.location.href = cnfmOrderPage
        }
    })
}

function getSelectedAddress(e) {
    $("#billing_address_id").val(e), $.ajax({
        url: getBillAddress,
        data: {
            address_id: e
        },
        type: "post",
        success: function(e) {
            var t = "<address>" + (e = JSON.parse(e))[0].name + "<br>" + e[0].address_1 + "<br>" + e[0].address_2 + "<br>" + e[0].city + ", " + e[0].pin_code + "<br>T:" + e[0].contact + "</address>";
            $(".bil_side_add").html(t)
        }
    })
}

function getSelectedSAddress(e) {
    $.ajax({
        url: getShipAddress,
        data: {
            address_id: e
        },
        type: "post",
        success: function(e) {
            var t = "<address>" + (e = JSON.parse(e))[0].name + "<br>" + e[0].address_1 + "<br>" + e[0].address_2 + "<br>" + e[0].city + ", " + e[0].pin_code + "<br>T:" + e[0].contact + "</address>";
            $(".ship_side_add").html(t)
        }
    })
}

function addAddress(e) {
    var t = new FormData;
    t.set("address", e), $.ajax({
        url: addressFormURL,
        contentType: !1,
        processData: !1,
        data: t,
        type: "post",
        success: function(e) {
            $("#billing-new-address-form").html(e)
        }
    })
}

function addShipAddress(e) {
    var t = new FormData;
    t.set("address", e), $.ajax({
        url: addressShipFormURL,
        contentType: !1,
        processData: !1,
        data: t,
        type: "post",
        success: function(e) {
            $("#shipping-new-address-form").html(e)
        }
    })
}

function SaveShipAddress() {
    var e = new FormData,
        t = $("#Shipping_postcode").val(),
        a = $("#Shipping_telephone").val();
    return isNaN(t) || 6 != t.toString().length ? (alert("Invalid postal code!"), $("#Shipping_postcode").val("").focus(), !1) : isNaN(a) || 10 != a.toString().length ? (alert("Invalid Contact No!"), $("#Shipping_telephone").val("").focus(), !1) : (e.set("first_name", $("#Shipping_firstname").val()), e.set("address_id", $("#Shipping_address_id").val()), e.set("last_name", $("#Shipping_lastname").val()), e.set("address_1", $("#Shipping").val()), e.set("address_2", $("#Shipping2").val()), e.set("city", $("#Shipping_city").val()), e.set("state", $("#Shipping_region_id").val()), e.set("pin_code", $("#Shipping_postcode").val()), e.set("contact", $("#Shipping_telephone").val()), e.set("email", $("#Shipping_email").val()), void $.ajax({
        url: saveShipURL,
        contentType: !1,
        processData: !1,
        data: e,
        type: "post",
        success: function(e) {
            (e = JSON.parse(e)).success ? ($("#Shipping_address_id").val(e.address), getSelectedSAddress(e.address), $("#checkout-step-shipping").hide(), $("#checkout-step-payment").show(), $("#opc-shipping,#opc-payment").toggleClass("active")) : alert(e.err)
        }
    }))
}
$(document).ready(function() {
    $("body").addClass("loaded"), $(".loader").remove()
});
var cartToggle = 0;

function toggleCart() {
    0 == cartToggle ? (jQuery(".top-cart-contain").find(".top-cart-content").stop(!0, !0).slideDown(), cartToggle = 1) : (jQuery(".top-cart-contain").find(".top-cart-content").stop(!0, !0).slideUp(), cartToggle = 0)
}
jQuery(document).ready(function(e) {
    e("body").on("focus", ".inpNumber", function(t) {
        e(this).on("wheel", function(e) {
            e.preventDefault()
        })
    }), e("body").on("blur", ".inpNumber", function(t) {
        e(this).off("wheel")
    }), e("body").on("keydown input keyup keypress", ".inpNumber", function(e) {
        8 != e.which && 0 != e.which && 9 != e.which && (e.which < 48 || e.which > 57) && (e.which < 96 || e.which > 105) && e.preventDefault()
    })
});