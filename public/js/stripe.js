$(document).ready(function () {
    Stripe.setPublishableKey('pk_test_VI93Q5aXznENjA73W8S5xY8Y');
    $('button').click(function () {
        var form = $('#subscription-form');
        var submit = form.find('button');
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


    })

});
