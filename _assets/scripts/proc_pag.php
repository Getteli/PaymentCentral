<?php

include 'configuracao.php';
header('Content-Type: application/json');

$datajson = file_get_contents("php://input");

$dataString = $datajson;

$Dados = array();

$asArr = explode( '&', $dataString );

foreach( $asArr as $val ){
  $tmp = explode( '=', $val );
  $Dados[ $tmp[0] ] = $tmp[1];
}

// echo json_encode($Dados);
// print_r($Dados);


$DadosArray["email"] = EMAIL_PAGSEGURO;

$DadosArray["token"] = TOKEN_PAGSEGURO;



if ($Dados['paymentMethod'] == "creditCard") {



    $DadosArray['creditCardToken'] = $Dados['tokenCartao'];

    $DadosArray['installmentQuantity'] = 2; //$Dados['qntParcelas'];

    $DadosArray['installmentValue'] = $Dados['itemAmount1'];//$Dados['valorParcelas'];

    $DadosArray['noInterestInstallmentQuantity'] = $Dados['itemAmount1'];//$Dados['noIntInstalQuantity'];

    $DadosArray['creditCardHolderName'] = urldecode($Dados['creditCardHolderName']);

    $DadosArray['creditCardHolderCPF'] = $Dados['creditCardHolderCPF'];

    $DadosArray['creditCardHolderBirthDate'] = urldecode($Dados['creditCardHolderBirthDate']);

    $DadosArray['creditCardHolderAreaCode'] = $Dados['senderAreaCode'];

    $DadosArray['creditCardHolderPhone'] = $Dados['senderPhone'];

    $DadosArray['billingAddressStreet'] = urldecode($Dados['billingAddressStreet']);

    $DadosArray['billingAddressNumber'] = $Dados['billingAddressNumber'];

    $DadosArray['billingAddressComplement'] = urldecode($Dados['billingAddressComplement']);

    $DadosArray['billingAddressDistrict'] = urldecode($Dados['billingAddressDistrict']);

    $DadosArray['billingAddressPostalCode'] = $Dados['billingAddressPostalCode'];

    $DadosArray['billingAddressCity'] = urldecode($Dados['billingAddressCity']);

    $DadosArray['billingAddressState'] = urldecode($Dados['billingAddressState']);

    $DadosArray['billingAddressCountry'] = urldecode($Dados['billingAddressCountry']);



} else if ($Dados['paymentMethod'] == "boleto") {

    

} else if ($Dados['paymentMethod'] == "eft") {

    $DadosArray['bankName'] = $Dados['bankName'];

}



$DadosArray['paymentMode'] = 'default';

$DadosArray['paymentMethod'] = $Dados['paymentMethod'];





$DadosArray['receiverEmail'] = EMAIL_LOJA;

$DadosArray['currency'] = $Dados['currency'];

// $DadosArray['extraAmount'] = $Dados['extraAmount'];





$DadosArray['itemId1'] = $Dados['itemId1'];

$DadosArray['itemDescription1'] = urldecode($Dados['itemDescription1']);

$DadosArray['itemAmount1'] = $Dados['itemAmount1'];

$DadosArray['itemQuantity1'] = $Dados['itemQuantity1'];





$DadosArray['notificationURL'] = URL_NOTIFICACAO;

$DadosArray['reference'] = $Dados['reference'];

$DadosArray['senderName'] = urldecode($Dados['senderName']);

$DadosArray['senderCPF'] = $Dados['senderCPF'];

$DadosArray['senderAreaCode'] = $Dados['senderAreaCode'];

$DadosArray['senderPhone'] = $Dados['senderPhone'];

$DadosArray['senderEmail'] = urldecode($Dados['senderEmail']);

$DadosArray['senderHash'] = $Dados['hashCartao'];

$DadosArray['shippingAddressRequired'] = $Dados['shippingAddressRequired'];



$buildQuery = http_build_query($DadosArray);

$url = URL_PAGSEGURO . "transactions";



$curl = curl_init($url);

curl_setopt($curl, CURLOPT_HTTPHEADER, Array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));

curl_setopt($curl, CURLOPT_POST, true);

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

curl_setopt($curl, CURLOPT_POSTFIELDS, $buildQuery);

$retorno = curl_exec($curl);

curl_close($curl);

$xml = simplexml_load_string($retorno);





$retorna = ['dados' => $xml, 'DadosArray' => $DadosArray];

// header('Content-Type: application/json');

echo json_encode($retorna);