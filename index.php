<?php
/*
 
Plugin Name: Donations
 
Description: This plugin will help to donations.

*/
require __DIR__ . '/checkoutSdkPhpMaster/vendor/autoload.php';
// use Checkout\CheckoutSdk;
// use Checkout\Environment;
// use Checkout\OAuthScope;
use Checkout\CheckoutApiException;
use Checkout\CheckoutAuthorizationException;
use Checkout\CheckoutSdk;
use Checkout\Common\Address;
use Checkout\Common\Country;
use Checkout\Common\Currency;
use Checkout\Common\CustomerRequest;
use Checkout\Common\Phone;
use Checkout\Environment;
use Checkout\OAuthScope;
use Checkout\Payments\Request\PaymentRequest;
use Checkout\Payments\Request\Source\RequestCardSource;
use Checkout\Payments\Sender\Identification;
use Checkout\Payments\Sender\IdentificationType;
use Checkout\Payments\Sender\PaymentIndividualSender;

function donations_enqueue_scripts()
{
  $plugin_url = plugin_dir_url(__FILE__);
  wp_enqueue_style('style',  $plugin_url . "Donationpages/style.css");
  wp_enqueue_style('normalize',  $plugin_url . "Donationpages/normalize.css");
  // Card fields    
  wp_enqueue_script('custom-js', 'https://cdn.checkout.com/js/framesv2.min.js', array('jquery'));
}
add_action('admin_enqueue_scripts', 'donations_enqueue_scripts');


function donationFunction(){
    
  //   echo 'DonationPages/index.php';
    include 'Donationpages/index.php';
  }
  
  function donation_log(){
    include 'Donationpages/custom_field.php';
}
function DonationCustomMenu(){
  add_menu_page('Donations', 'Donate Now ', 'manage_options', 'donations-page', 'donationFunction', '', 6);
  // add_submenu_page('Custom Field', 'Enter Keys','manage_options', 'donations-page','donationFunction','',6);
//   }

    add_submenu_page(
        'donations-page',
        'Custom Field',//page title
        'Custom Field',//menu title
        'manage_options',//capability,
        'DonationsLog',//menu slug
        'donation_log'//callback function
    );
  }
add_action('admin_menu','DonationCustomMenu');

function testDonate()
{
  return '<h1>Test</h1>';
}
add_action('admin_menu', 'DonationCustomMenu');
add_shortcode('donation_form_short_code', 'donationFunction');

function check_session($ses_id)
{
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.sandbox.checkout.com/sessions/sid_a2ruuqdp2mcevlhlsr6xcxlxw4/issuer-fingerprint',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'PUT',
    CURLOPT_POSTFIELDS => '{
      "three_ds_method_completion": "Y"
    }',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Authorization: Bearer sk_sbox_dqmcmja373yetcnwkrwi6x6biyv'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  return $response;
}



add_action('wp_ajax_capture_payment', 'capture_payment');
add_action('wp_ajax_nopriv_capture_payment', 'capture_payment');
function capture_payment()
{
  $api = CheckoutSdk::builder()->staticKeys()
    ->environment(Environment::sandbox())
    ->secretKey("sk_sbox_p5gjax3rl5s42umc55tl6llvqaf")
    ->build();
  $phone = new Phone();
  $phone->country_code = "+1";
  $phone->number = "415 555 2671";

  $address = new Address();
  $address->address_line1 = "CheckoutSdk.com";
  $address->address_line2 = "90 Tottenham Court Road";
  $address->city = "London";
  $address->state = "London";
  $address->zip = "W1T 4TJ";
  $address->country = Country::$GB;

  $requestCardSource = new RequestCardSource();
  $requestCardSource->name = "Name";
  $requestCardSource->number = "4242424242424242";
  $requestCardSource->expiry_year = 2026;
  $requestCardSource->expiry_month = 10;
  $requestCardSource->cvv = "100";
  $requestCardSource->billing_address = $address;
  $requestCardSource->phone = $phone;

  $customerRequest = new CustomerRequest();
  $customerRequest->email = "email@docs.checkout.com";
  $customerRequest->name = "Customer";

  $identification = new Identification();
  $identification->issuing_country = Country::$GT;
  $identification->number = "1234";
  $identification->type = IdentificationType::$drivingLicence;

  $paymentIndividualSender = new PaymentIndividualSender();
  $paymentIndividualSender->fist_name = "FirstName";
  $paymentIndividualSender->last_name = "LastName";
  $paymentIndividualSender->address = $address;
  $paymentIndividualSender->identification = $identification;

  $request = new PaymentRequest();
  $request->source = $requestCardSource;
  $request->capture = true;
  $request->reference = "reference";
  $request->amount = 10;
  $request->currency = Currency::$USD;
  $request->customer = $customerRequest;
  $request->sender = $paymentIndividualSender;
  $request->processing_channel_id = 'pc_zwpifz3jm3lupcg4l6y7dbg5h4';

  try {
    $response = $api->getPaymentsClient()->requestPayment($request);
    if ($response["response_summary"] == "Approved") {
      $res = array("status" => "success", "link" => site_url() . "/success");
    }
  } catch (CheckoutApiException $e) {
    // API error
    $error_details = $e->error_details;
    $http_status_code = isset($e->http_metadata) ? $e->http_metadata->getStatusCode() : null;
    $res = array("status" => "failed", "description" => $error_details);
  } catch (CheckoutAuthorizationException $e) {
    // Bad Invalid authorization
    $error_details = $e->error_details;
    $res = array("status" => "failed", "description" => $error_details);
  }
  echo json_encode($res);

  exit();
}
