<?php
//Necessário testar em dominio com SSL
define("URL", "https://payment.agenciapublikando.com.br/");

$sandbox = true;

if ($sandbox) {

	//Credenciais do SandBox

	define("EMAIL_PAGSEGURO", "matheus.me.ngo@hotmail.com");

	define("TOKEN_PAGSEGURO", "E1F464F81D524DF88D07E00B37B7994F");

	define("URL_PAGSEGURO", "https://ws.sandbox.pagseguro.uol.com.br/v2/");

	define("SCRIPT_PAGSEGURO", "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");

	define("EMAIL_LOJA", "E-mail de suporte pós venda");

	define("MOEDA_PAGAMENTO", "BRL");

	define("URL_NOTIFICACAO", "https://sualoja.com.br/notifica.html");

} else {

	//Credenciais do PagSeguro

	define("EMAIL_PAGSEGURO", "e-mail do PagSeguro");

	define("TOKEN_PAGSEGURO", "token no PagSeguro");

	define("URL_PAGSEGURO", "https://ws.pagseguro.uol.com.br/v2/");

	define("SCRIPT_PAGSEGURO", "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");

	define("EMAIL_LOJA", "E-mail de suporte pós venda");

	define("MOEDA_PAGAMENTO", "BRL");

	define("URL_NOTIFICACAO", "https://sualoja.com.br/notifica.html");

}

// padrao
$conteudo = "none";
$modal = "block";

if(!empty($_GET["qq"])){
	// faz o acesso ao servidor e busca os dados do cliente
	$codLicense = htmlspecialchars($_GET["qq"]);

	// url
	$url = "https://central.agenciapublikando.com.br/licenses/getDataCliente/";
	// Iniciamos a função do CURL:
	$cUrl = curl_init($url . $codLicense); // passa a url e o código
	// parametros
	curl_setopt_array($cUrl, [
		// request custom do tipo get
		CURLOPT_CUSTOMREQUEST => 'GET',
		// Permite obter o resultado
		CURLOPT_RETURNTRANSFER => 1,
	]);
	// get cURL execute
	$result = curl_exec($cUrl);
	// close cUrl
	curl_close($cUrl);

	
	// result
	if ($result != "error") {
		// continua na página
		$resultado = json_decode($result, true);
		// exibe
		$conteudo = "block";
		$modal = "none";
	}else{
		//header("Location: ops.html");
		// se der erro, colocar para exibir um modal na tela, informando q nao achou os dados..
		echo "erro config";
		// nao exibe
		$conteudo = "none";
		$modal = "block";
	}
	
}