document.addEventListener('DOMContentLoaded', (event) => {
    var clientSecret = vars_global.stripe_publish_key;
    var stripe = Stripe(clientSecret);
    var elements = stripe.elements();
// Custom styling can be passed to options when creating an Element.
    var style = {
        base: {
            // Add your base input styles here. For example:
            fontSize: '16px',
            color: "#32325d",
        }
    };

// Create an instance of the card Element.
    var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');


    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Create a token or display an error when the form is submitted.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        var payment_method = get_payment_method();

        if ( payment_method !== 'stripe' ) {

            form.submit();
            return false;
        }

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the customer that there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });

    var stripeTokenHandler = (token) => {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    };
});

var get_payment_method = () => {
    var radios = $('.container--custom input[type="radio"]'), value;
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].type === 'radio' && radios[i].checked) {
            return radios[i].value;
        }
    }
};

$(document).ready(function () {
    console.log('Rent is running...');
    $(document).on('click', '.js-change-payment-method span', function (e) {
        var $this = $(this);
        var payment_method = $this.parent().attr('data-type');

        $('.payment-method').hide();
        $('.payment-method#' + payment_method).show();

    });
});
