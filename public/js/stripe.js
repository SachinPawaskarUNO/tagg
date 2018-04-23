$(document).ready(function () {
    // Stripe.setPublishableKey('pk_test_VI93Q5aXznENjA73W8S5xY8Y');
    Stripe.setPublishableKey('pk_test_kx1WITwOGJFDq8Vi7zdRI7qQ');

    $("#buttonPay").click(function () {
        var plan_selected = $('input[name="plan"]:checked').val();
        if(typeof plan_selected === 'undefined'){
            $('.choose-plan-error').addClass('choose-plan-error-show');
        }
        else{
            var form = $('#subscription-form');
            var submit = form.find('#buttonPay');
            // var submit = form.find(':submit');
            //var submit = form.find('button');
            var submitInitialText = submit.text();
            submit.attr('disabled', 'disabled').text("Processing");
            getToken(form, submit, submitInitialText);
            /*Stripe.card.createToken(form, function (status, response) {
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
            })*/
        }
    });
    $("#update-default-card").click(function() {
        var form = $("#new-card-form");
        var submit = $(this);
        var submitInitialText = submit.text();
        submit.attr('disabled', 'disabled').text("Processing");
        getToken(form, submit, submitInitialText);
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
            total=total.replace(",","");
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

    var getToken = function(form, submit, submitInitialText) {
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
        });
    };


});









