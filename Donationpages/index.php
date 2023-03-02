<?php require_once('constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" href="../wp-content/plugins/Donations/Donationpages/build/css/intlTelInput.css">
<script src='https://cdn.checkout.com/js/framesv2.min.js?ver=6.1.1' id='custom-js-js'></script>
<link rel='stylesheet' id='style-css' href='../wp-content/plugins/Donations/Donationpages/style.css?ver=6.1.1' media='all' />

    <title>Checkout Frames v2: Single Frame</title>
    <style>
       .one-liner {
  flex-direction: row;
  display: flex;
  flex-wrap: nowrap;
  align-content: center;
  justify-content: space-between;
  align-items: baseline;
}
#footer-thankyou {
    display: none;
}
#payment-form {
    width: 55% !important;
    background:transparent !important;
}
#payment-form .group{
  margin: 0 10px;
  width: 100% !important;
}
#payment-form .group input,
#payment-form .group input:focus{
background:#f4f4f4 !important;
  width: 100% !important;
    margin-bottom: 25px !important;
    border: 1px solid #c4c4c4;
    height: 50px !important;
    font-size: 16px;
    margin: 0;
    padding: 12px;
    border-radius: 30px !important;
    color: black !important;

}

button#mas_showard {
    background: #333 !important;
    border: 0;
    color: #f7f7f7;
    transition: all .5s;
    height: 50px;
    font-size: 20px;
    margin: 0;
    padding: 12px;
    width: 100%;
    border-radius: 10px;
}
button#mas_showard:hover {
    cursor: pointer;
}
form#payment-form .checkout-form {
    display: none;
}
.iti.iti--allow-dropdown {
    width: 100%;
}

#payment-form .group input#phone {
    padding-left: 50px !important;
}
.iti.iti--allow-dropdown .iti__selected-flag {
    height: 50px;
}



.iti--allow-dropdown .iti__flag-container:hover .iti__selected-flag {
    background-color: transparent;
}


iframe#cardNumber,
#expiryDate,
#cvv{
  border:none !important;
  outline:none !important;
  background:#f4f4f4 !important;
}
input#amount:before {
     position: absolute;
     top: 0;
     content:"€";
 }
 input#amount{
  position:relative;
 }
#payment-form .group label{
  color: black;
}
.container{
  padding:40px;
  background:#E99C1B;
}
.form-title span.form-subtitle{
  font-size:16px;
  color:#fff;
}
.form-title h3.form-main-title{
  color:#fff;
  font-size:22px;
  text-transform:uppercase;
}
.button-submit,
#pay-button{
  background:#333 !important;

  border: 0;
    color: #f7f7f7;
    transition: all .5s;
    height: 50px;
    font-size: 20px;
    margin: 0;
    padding: 12px;
    width: 100%;
    border-radius: 10px;
}

#wpfooter{
  display: none !important;
}

    </style>
  </head>

  <body>
    <div class="container">
      <div class="form-title" style="text-align:center;">
      <span class="form-subtitle">Help us</span>
      <h3 class="form-main-title">
      Donate Now
    </h3>
      </div>
    <form
      id="payment-form"
      method="POST" action="#">
  <div class="one-liner">
      <div class="group">
				<label for="name" class="label">Donation amount</label>
				<input id="amount" name="amount" type="number" class="input" placeholder="e.g €1" required>
			</div>
			<div class="group">
			<label for="name" class="label">Name</label>
			<input id="name" type="text" name="name" class="input" required>
      </div>
</div>
<div class="one-liner">
    <div class="group">
			<label for="surname" class="label">Surname</label>
			<input id="surname" type="text" name="surname" class="input" required>
    </div>
    <div class="group">
			<label for="email" class="label">Email Address</label>
			<input id="email" type="email" name="email" class="input" required>
    </div>
</div>
    <div class="group" style="width: 97% !important;">
			<label for="phone" class="label">Phone Number</label>
      <input id="phone" type="tel" name="phone" class="input" placeholder="" required>
    </div>

    <div class="group" style="margin:0px !important;">
  <button class="mas_submit_button" id="mas_showard">Enter Card Details</button>
</div>

<div class="checkout-form">
    <div class="group">
    <div class="card-number-frame" id="accountNumber" >
</div>
</div>
  <div class="group" style="margin:0px !important;">
<div class="expiry-date-frame">
</div>
</div>
<div class="group" style="margin:0px !important;">
<div class="cvv-frame">
</div>
<div class="group" style="margin:0px !important;">
  <button class="submit-button" id="pay-button">Donate Now</button>
</div>
</div>
</div>
    </div>
      </div>
      <p class="error-message"></p>
      <p class="success-payment-message"></p>
  </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Use as a Vanilla JS plugin -->
<script src="../wp-content/plugins/Donations/Donationpages/build/js/intlTelInput.min.js"></script> 
<!-- Use as a jQuery plugin -->
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="../wp-content/plugins/Donations/Donationpages/build/js/intlTelInput-jquery.min.js"></script> 

    <script>

      // validate all fields before showing checkout form
$(document).ready(function(){

var input = document.querySelector("#phone");
window.intlTelInput(input,({
}));

// jQuery 
$("#phone").intlTelInput({
});
      function checkInputs() {
        console.log('right');
  var isValid = true;
  $('form#payment-form input').filter('[required]').each(function() {
    if ($(this).val() === '') {
      $('.checkout-form .group button#pay-button').prop('disabled', true)
       $('form#payment-form .checkout-form').hide();
      $('button#mas_showard').removeClass('mas_showcarddetails');
      isValid = false;
      return false;
    }
  });
  if(isValid) {
    $('button#mas_showard').addClass('mas_showcarddetails');
    $('.checkout-form .group button#pay-button').prop('disabled', false)  
    $('.mas_showcarddetails').click(function() {
  console.log('in');
    $('form#payment-form .checkout-form').show();
    $('button#mas_showard.mas_showcarddetails').hide();
    });
  }
  return isValid;


}



$('.checkout-form .group button#pay-button').click(function() {
});

//Enable or disable button based on if inputs are filled or not
$('form#payment-form input').filter('[required]').on('keyup',function() {
checkInputs()
})

checkInputs()


});

let success_url = `<?= SUCCESS_URL; ?>`
var failure_url = `<?= FAILURE_URL; ?>`
var failurl;
var successurl;

if(success_url != ''){
  successurl = `<?= SUCCESS_URL; ?>`
    }else{
  successurl =  `<?= SITE_URL; ?>/wp-content/plugins/Donations/Donationpages/success.html`
}

if(failure_url != ''){
  failurl = `<?= FAILURE_URL; ?>`
    }else{
      failurl =  `<?= SITE_URL; ?>/wp-content/plugins/Donations/Donationpages/success.html`
}


        /* global Frames */
var payButton = document.getElementById("pay-button");
var form = document.getElementById("payment-form");
var errorStack = [];


Frames.init({
  
  publicKey: '<?= PUBLIC_KEY; ?>', 
  debug:true,
  modes: [ Frames.modes.RIGHT_TO_LEFT],
  modes: [ Frames.modes.CVV_OPTIONAL],
  modes: [ Frames.modes.DISABLE_COPY_PASTE ],
  style: {
    base: {
      color: 'black',
      fontSize: '18px',
    },
    autofill: {
      backgroundColor: 'yellow',
    },
    hover: {
      color: 'blue',
    },
    focus: {
      color: 'blue',
    },
    valid: {
      color: 'green',
    },
    invalid: {
      color: 'red',
    },
    placeholder: {
      base: {
        color: 'gray',
      },
      focus: {
        border: 'solid 1px blue',
      },
    },
  },
  localization: {
    cardNumberPlaceholder: 'Card number',
    expiryMonthPlaceholder: 'MM',
    expiryYearPlaceholder: 'YY',
    cvvPlaceholder: 'CVV',
  }
});

Frames.addEventHandler(
  Frames.Events.CARD_VALIDATION_CHANGED,
  onCardValidationChanged
);
function onCardValidationChanged(event) {
  console.log("CARD_VALIDATION_CHANGED: %o", event);
  payButton.disabled = !Frames.isCardValid();
}

Frames.addEventHandler(
  Frames.Events.FRAME_VALIDATION_CHANGED,
  onValidationChanged
);
function onValidationChanged(event) {
  console.log("FRAME_VALIDATION_CHANGED: %o", event);

  var errorMessageElement = document.querySelector(".error-message");
  var hasError = !event.isValid && !event.isEmpty;

  if (hasError) {
    errorStack.push(event.element);
  } else {
    errorStack = errorStack.filter(function (element) {
      return element !== event.element;
    });
  }

  var errorMessage = errorStack.length
    ? getErrorMessage(errorStack[errorStack.length - 1])
    : "";
  errorMessageElement.textContent = errorMessage;
}

function getErrorMessage(element) {
  var errors = {
    "card-number": "Please enter a valid card number",
    "expiry-date": "Please enter a valid expiry date",
    cvv: "Please enter a valid cvv code",
  };

  return errors[element];
}

Frames.addEventHandler(
  Frames.Events.CARD_TOKENIZATION_FAILED,
  onCardTokenizationFailed
);
function onCardTokenizationFailed(error) {
  console.log("CARD_TOKENIZATION_FAILED: %o", error);
  Frames.enableSubmitForm();
}



Frames.addEventHandler(Frames.Events.cardTokenized, onCardTokenized);
function onCardTokenized(event) {
  console.log("hello is am tokenized");
  var el = document.querySelector(".success-payment-message");
  el.innerHTML =
    "Card tokenization completed<br>" +
    'Your card token is: <span class="token">' +
    event.token +
    "</span>";

    capture_payment_ajax(event.token)
  
}

form.addEventListener("submit", function (event) {

  event.preventDefault();
  let token;
  Frames.submitCard().then((res)=>{
    console.log("res," , res)
    token = res.token
    const customer_name = $("#name").val() + " " + $("#surname").val();
  console.log("name", customer_name);
  const email = $("#email").val();
  console.log("email", email);
  const phone = $("#phone").val();
console.log("phone", phone);
  const amount = $("#amount").val();
  const accountNumber = $("#accountNumber")
  console.log("accountNumber",accountNumber)
submit_payment(token,amount, email
, customer_name, phone, accountNumber)
  }).catch((err)=>{
    console.log("err //",err)
  })
 
});

function capture_payment_ajax(token){
  jQuery.ajax({
    url:"<?php echo admin_url('admin-ajax.php')?>",
    type:"post",
    data:{action:'capture_payment',token:token},
    success:function(res){
      res = JSON.parse(res);
      console.log(res.description);

    }
  })
}

function submit_payment(token,amount, email, customer_name, phone, country_code = "+92", accountNumber){

let environment = `<?= ENVIRONMENT; ?>`
var url;
if(environment == 'true'){
  url = 'https://api.sandbox.checkout.com/payments'
}
else{
  url = 'https://api.checkout.com/payments'
}

var settings = {
  "url": url,
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Authorization": 'Bearer <?= SECRET_KEY; ?>',
    "Content-Type": "application/json"
  },
  "data": JSON.stringify({
    "source": {
      "type": "token",
      "token": token
    },
    "amount": amount*100,
    "currency": "EUR",
    "reference": "donation-id-"+Math.round(Math.random()*1000),
    "capture": <?= CAPTURE_KEY; ?>,
    "customer": {
      "email": email,
      "name": customer_name,
      "phone": {
        "number": phone
      }
    },
    "success_url":successurl,
    "failure_url":failurl,
 
    "3ds": {
      "enabled": <?= THREEDS_KEY; ?>,
    }
  }),
};

$.ajax(settings).done(function (response) {
  console.log(response);
  if(response.status == "Pending"){
    window.location.href = response._links.redirect.href
    localStorage.setItem("amount", amount);
    localStorage.setItem("siteUrl",location.href)
  }else if(response.status == 'Authorized' && response.response_summary == 'Approved'){
    localStorage.setItem("amount", amount);
    localStorage.setItem("siteUrl",location.href)
    if(success_url != ''){
      window.location.href = `<?= SUCCESS_URL; ?>`
    }else{
      window.location.href =  `<?= SITE_URL; ?>/wp-content/plugins/Donations/Donationpages/success.html`
    }
  }else{
    localStorage.setItem("amount", amount);
    localStorage.setItem("siteUrl",location.href)
    if(failure_url != ''){
      window.location.href = `<?= FAILURE_URL; ?>`
    }else{
    window.location.href =  `<?= SITE_URL; ?>/wp-content/plugins/Donations/Donationpages/fail.html`
  }
  }
});



}
    </script>
  </body>
</html>
