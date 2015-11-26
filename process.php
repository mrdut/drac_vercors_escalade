<?php
session_start();
require 'error-handler.php';
set_error_handler("handleError");


/*
Retrieve session info from database
*/

require 'database.php';
$db = new Database();

$db->query("SELECT prenom, nom, mail, categorie, sexe FROM bloc_participants WHERE token=:token LIMIT 1");
$db->bind(':token', $_GET['token']);
$result = $db->single();
$_SESSION['firstname'] = $result['prenom'];
$_SESSION['lastname']  = $result['nom'];
$_SESSION['mail']      = $result['mail'];
$_SESSION['category']  = $result['categorie'];
$_SESSION['sex']       = $result['sexe'];

if ($_SESSION['sex'] == 'M')
{
  $_SESSION['sex_str'] = 'garçon';
}
else
{
  $_SESSION['sex_str'] = 'fille';
}

/*
Process Paypal response
*/

require 'globals.php';
require 'paypal.php';

$product = array("name" => "Frais d'inscription",
"price"=> $GLOBALS['registration-fee'],
"count"=> 1);

$port = 0;
$totalttc = $product['price'];

$paypal = new Paypal();
$response = $paypal->request('GetExpressCheckoutDetails',
array('TOKEN' => $_GET['token']));

if ($response)
{
  if($response['CHECKOUTSTATUS'] == 'PaymentActionCompleted')
  {
    trigger_error("Ce paiement a déjà été validé. Vous n'avez pas été débité à nouveau.");
  }
}
else
{
  trigger_error("Erreur Paypal:" . $paypal->errors);
}

$params = array('TOKEN' => $_GET['token'],
'PAYERID'=> $_GET['PayerID'],
'PAYMENTACTION' => 'Sale',

'PAYMENTREQUEST_0_AMT' => $totalttc + $port,
'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR',
'PAYMENTREQUEST_0_SHIPPINGAMT' => $port,
'PAYMENTREQUEST_0_ITEMAMT' => $totalttc);

$params["L_PAYMENTREQUEST_0_NAME0"] = $product['name'];
$params["L_PAYMENTREQUEST_0_DESC0"] = 'Open de Bloc Grenoble 2015';
$params["L_PAYMENTREQUEST_0_AMT0"] = $product['price'];
$params["L_PAYMENTREQUEST_0_QTY0"] = $product['count'];

$response = $paypal->request('DoExpressCheckoutPayment', $params);

if (!$response)
{
  $url = 'cancel.php';
}
else
{
  $url = 'success.php';

  $response['PAYMENTINFO_0_TRANSACTIONID'];

  $db->beginTransaction();

  $db->query("UPDATE bloc_participants SET payer_id = :payer_id, transaction = :transaction WHERE token = :token");

  $db->bind('payer_id', $_GET['PayerID']);
  $db->bind('transaction' , $response['PAYMENTINFO_0_TRANSACTIONID']);
  $db->bind('token' , $_GET['token']);

  $db->execute();

  $db->endTransaction();
}

header("Location: $url");
exit();
?>
