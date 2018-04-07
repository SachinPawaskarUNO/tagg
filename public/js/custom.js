$("body").on('change', '#plan,#user_locations', function() {
    $("#cart").removeClass("hide");
    document.getElementById("cart_table").rows[2].cells.namedItem("discounted_price").innerHTML = 0;
    document.getElementById("coupon-message").innerHTML = '';
    document.getElementById("coupon").value = '';
    var plan = $('#plan').val();
    var user = $('#user_locations').val();
    // var location_selected = document.getElementById("user_locations").options[document.getElementById("user_locations").selectedIndex].text;
    // var plan_selected = document.getElementById("plan").options[document.getElementById("plan").selectedIndex].text;

    var location_selected = $('input[name="user_locations"]:checked').val();
    var plan_selected = $('input[name="plan"]:checked').val();

    $('#plan_selected').html(plan_selected);
    $('#location_selected').html(location_selected);


    var yearly_charge = '';
    var totalamount = '';
    var totalamountshow = '';
    if ((plan_selected != '') && (location_selected != '')) {
        if (plan_selected == 'Monthly') {
            if (location_selected == '5') {
                totalamount = 19;
            } else if (location_selected == '25') {
                totalamount = 49;
            } else if (location_selected == '100') {
                totalamount = 199;
            } else {
                totalamount = 249;
            }
        } else {
            if (location_selected == '5') {
                // yearly_charge = (19 * 12);
                yearly_charge = 180;
            } else if (location_selected == '25') {
                // yearly_charge = (49 * 12);
                yearly_charge = 470;
            } else if (location_selected == '100') {
                // yearly_charge = (99 * 12);
                yearly_charge = 1900;
            } else {
                // yearly_charge = (249 * 12);
                yearly_charge = 2390;
            }
            // var discount = (yearly_charge * 20) / 100;
            // totalamount = yearly_charge - discount;
            // var discount = (yearly_charge * 20) / 100;
            totalamount = yearly_charge;

        }
        totalamountshow = "$" + totalamount.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
        if (totalamount != '') {
            $('#total_price').html(totalamountshow);
            $('#balance_price').html(totalamountshow);

        }
    }
});


$("body").on('keyup', '#cardNumber', function() {
    var regexp1 = new RegExp("[^0-9]");
    if (regexp1.test(document.getElementById("cardNumber").value)) {
        $('#card_error').show();
        $('#card_error').html('Only Numbers Allowed');
        $('#cardNumber').focus();
        return false;
    } else {
        $('#card_error').hide();
    }

});

$("body").on('keyup', '#expiryMonth', function() {
    var regexp1 = new RegExp("[^0-9]");
    if (regexp1.test(document.getElementById("expiryMonth").value)) {
        $('#expiry_error').show();
        $('#expiry_error').html('Only Numbers Allowed');
        $('#expiryMonth').focus();
        return false;
    } else {
        $('#expiry_error').hide();
    }

});
$("body").on('keyup', '#expiryYear', function() {
    var regexp1 = new RegExp("[^0-9]");
    if (regexp1.test(document.getElementById("expiryYear").value)) {
        $('#expiry_error').show();
        $('#expiry_error').html('Only Numbers Allowed');
        $('#expiryYear').focus();
        return false;
    } else {
        $('#expiry_error').hide();
    }

});
$("body").on('keyup', '#cvCode', function() {
    var regexp1 = new RegExp("[^0-9]");
    if (regexp1.test(document.getElementById("cvCode").value)) {
        $('#expiry_error').show();
        $('#expiry_error').html('Only Numbers Allowed');
        $('#cvCode').focus();
        return false;
    } else {
        $('#expiry_error').hide();
    }

});
$("body").on('change', '#coupon', function() {
    var coupon = $('#coupon').val();
    if (coupon == '') {
        document.getElementById("cart_table").rows[2].cells.namedItem("discounted_price").innerHTML = 0;
        var total = document.getElementById("cart_table").rows[1].cells.namedItem("total_price").innerHTML;
        document.getElementById("cart_table").rows[3].cells.namedItem("balance_price").innerHTML = total.replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
    }

});
