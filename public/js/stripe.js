$(document).ready(function () {
    Stripe.setPublishableKey('pk_test_VI93Q5aXznENjA73W8S5xY8Y');

    $("#buttonPay").click(function () {
        var form = $('#subscription-form');
        var submit = form.find('button[type=submit]');
        // var submit = form.find(':submit');
        //var submit = form.find('button');
        var submitInitialText = submit.text();
        submit.attr('disabled', 'disabled').text("Processing");
        Stripe.card.createToken(form, function (status, response) {
            var token;
            if (response.error) {
                form.find('.stripe-errors').text(response.error.message).show();
                submit.removeAttr('disabled');
                submit.text(submitInitialText);
            } else {
                token = response.id;
                var input = $('<input type="hidden" name="token">');
                form.append(input.val(token));
                form.submit();
            }
        })

    });
    $('#coupon').keyup(function () {
        if (this.value.length > 0) {
            document.getElementById("apply").disabled = false;
        } else {
            document.getElementById("apply").disabled = true;
        }
    });
    $(document).on('click', '#apply', function () {
        coupon_code = $('#coupon').val();
        var request = $.ajax({
            url: 'applycoupon',
            type: 'GET',
            dataType: 'JSON',
            data: {coupon: coupon_code}
        });
        request.done(function (msg) {
            document.getElementById("coupon-message").style.color = "green";
            document.getElementById("coupon-message").innerHTML = "Your coupon has been applied successfully";
            var total = document.getElementById("cart_table").rows[1].cells.namedItem("total_price").innerHTML.slice(1);
            document.getElementById("cart_table").rows[2].cells.namedItem("discounted_price").innerHTML = "$"+((total * msg) / 100).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
            document.getElementById("cart_table").rows[3].cells.namedItem("balance_price").innerHTML = "$"+(total - (total * msg) / 100).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");

        });
        request.fail(function (jqXHR, textStatus) {
            document.getElementById("coupon-message").style.color = "red";
            document.getElementById("coupon-message").innerHTML = "The coupon entered is invalid.";
            var total = document.getElementById("cart_table").rows[1].cells.namedItem("total_price").innerHTML;
            var msg = 0;
            document.getElementById("cart_table").rows[2].cells.namedItem("discounted_price").innerHTML = "$"+((total * msg) / 100).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
            document.getElementById("cart_table").rows[3].cells.namedItem("balance_price").innerHTML = "$"+(total - (total * msg) / 100).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");

        });


    })


});




