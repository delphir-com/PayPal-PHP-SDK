<?php

// # Create Billing Agreement with PayPal as Payment Source
//
// This sample code demonstrate how you can create a billing agreement, as documented here at:
// https://developer.paypal.com/docs/api/payments.billing-agreements/v1/#billing-agreements_post
// API used: POST /v1/payments/billing-agreements

// Retrieving the Plan from the Create Update Sample. This would be used to
// define Plan information to create an agreement. Make sure the plan you are using is in active state.
/** @var Plan $createdPlan */
$createdPlan = require 'UpdatePlan.php';

use PayPal\Api\ApplicationContext;
use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\Plan;
use PayPal\Api\ShippingAddress;

/* Create a new instance of Agreement object
{
    "name": "Base Agreement",
    "description": "Basic agreement",
    "start_date": "2015-06-17T9:45:04Z",
    //"plan": {
    //  "id": "P-1WJ68935LL406420PUTENA2I"
    //},
    "plan_id" : "P-1WJ68935LL406420PUTENA2I",
    "payer": {
      "payment_method": "paypal"
    },
    "shipping_address": {
        "line1": "111 First Street",
        "city": "Saratoga",
        "state": "CA",
        "postal_code": "95070",
        "country_code": "US"
    },
    "application_context": {
        //"brand_name": "example",
        //"locale": "en-US",
        //"shipping_preference": "SET_PROVIDED_ADDRESS",
        //"user_action": "SUBSCRIBE_NOW",
        //"payment_method": {
        //  "payer_selected": "PAYPAL",
        //  "payee_preferred": "IMMEDIATE_PAYMENT_REQUIRED"
        //},
        "return_url": "https://example.com/returnUrl",
        "cancel_url": "https://example.com/cancelUrl"
    }
}*/
$agreement = new Agreement();

$agreement->setName('Base Agreement')
    ->setDescription('Basic Agreement')
    ->setStartDate('2019-06-17T9:45:04Z');

// Add Plan ID
// Please note that the plan Id should be only set in this case.
$plan = new Plan();
$plan->setId($createdPlan->getId());
$agreement->setPlan($plan);

// Add Payer
$payer = new Payer();
$payer->setPaymentMethod('paypal');
$agreement->setPayer($payer);

// Add Shipping Address
$shippingAddress = new ShippingAddress();
$shippingAddress->setLine1('111 First Street')
    ->setCity('Saratoga')
    ->setState('CA')
    ->setPostalCode('95070')
    ->setCountryCode('US');
$agreement->setShippingAddress($shippingAddress);

$appContext = new ApplicationContext();
$appContext
    ->setReturnUrl("$baseUrl/ExecuteAgreement.php?success=true")
    ->setCancelUrl("$baseUrl/ExecuteAgreement.php?success=false");
$agreement->setApplicationContext($appContext);

// For Sample Purposes Only.
$request = clone $agreement;

// ### Create Agreement
try {
    // Please note that as the agreement has not yet activated, we wont be receiving the ID just yet.
    $agreement = $agreement->create($apiContext);

    // ### Get redirect url
    // The API response provides the url that you must redirect
    // the buyer to. Retrieve the url from the $agreement->getApprovalLink()
    // method
    $approvalUrl = $agreement->getApprovalLink();
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Created Billing Agreement.", "Agreement", null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
 ResultPrinter::printResult("Created Billing Agreement. Please visit the URL to Approve.", "Agreement", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $agreement);

return $agreement;
