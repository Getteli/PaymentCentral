<?php
	include '_assets/scripts/configuracao.php';
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<!-- metas -->
		<meta charset="utf-8">
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="theme-color" content="#fb8c00">

		<!-- favicon -->
		<link rel="shortcut icon" href="_assets/images/favicon.ico" />

		<!-- titulo -->
		<title>Agência Publikando | Pagamento</title>

		<!-- Icones materilalize -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		<!-- Styles -->
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="_assets/css/index.min.css">
		<style type="text/css">
			#myVideo {
			  position: fixed;
			  right: 0;
			  bottom: 0;
			  min-width: 100%; 
			  min-height: 100%;
			  pointer-events: none;
			  opacity: 0.5;
			}
			main{
				z-index: 11;
			}
			body{
				background-color: rgba(251, 140, 1, 1);
			    display: flex;
			    min-height: 100vh;
			    flex-direction: column;
			    background-repeat: no-repeat;
			    background-position: center;
			    background-size: cover;
			    overflow-x: hidden;
			    z-index: 100;
			}
		</style>
	</head>
	<body>
		<video autoplay muted loop id="myVideo">
		<source src="_assets/images/background.mp4" type="video/mp4">
		Your browser does not support HTML5 video.
		</video>

		<main>
			<!-- logo -->
			<div class="row">
				<div class="col s5 l2 left divLogo">
					<a href="https://agenciapublikando.com.br" class="brand-logo">
						<img src="_assets/images/logo.png" alt="Agência Publikando">
					</a>
				</div>
				<div class="col s2 l1 center">
					<hr class="vertical" width="1">
				</div>
				<div class="col s5 l2 left divLogo">
					<a href="#" class="brand-logo">
						<img src="_assets/images/pagseguropng.png" alt="Agência Publikando">
					</a>
				</div>
			</div>

			<div id="meu-modal" class="modal" style="display:<?php echo $modal; ?>"> <!-- bottom-sheet -->
				<div class="modal-content">
					<h4>Desculpe, mas houve um problema :(</h4>
					<p>Infelizmente houve um problema. Não conseguimos recuperar suas informações em nossa base
						de dados.
					</p>
					<p>Por favor, tente acessar novamente o link que lhe foi enviado. Caso o erro persista, entre
						em contato com nosso suporte pelo e-mail: <b>contato@agenciapublikando.com.br</b>, <br/>
						pelo nosso site oficial: <a href="https://agenciapublikando.com.br">Agência Publikando</a> <br/> 
						ou pelas nossas redes sociais.
					</p>
				</div>
			</div>

			<!-- conteudo -->
			<div class="container" style="display:<?php echo $conteudo; ?>">
				<!-- campos obrigatorios e et-->
				<span class="endereco" data-endereco="<?php echo URL; ?>"></span>
				<span id="msg"></span>

				<form name="formPagamento" action="" id="formPagamento">
					<input type="hidden" name="paymentMethod" id="paymentMethod" value="creditCard">
					<input type="hidden" name="receiverEmail" id="receiverEmail" value="<?php echo EMAIL_LOJA; ?>">
					<input type="hidden" name="currency" id="currency" value="<?php echo MOEDA_PAGAMENTO; ?>">
					<!--<input type="hidden" name="extraAmount" id="extraAmount" value="">-->
					<input type="hidden" name="itemId1" id="itemId1" value="0001">
					<input type="hidden" name="itemDescription1" id="itemDescription1" value="Curso de PHP Orientado a Objetos">
					<input type="hidden" name="itemAmount1" id="itemAmount1" value="600.00">
					<input type="hidden" name="itemQuantity1" id="itemQuantity1" value="1">
					<input type="hidden" name="notificationURL" id="notificationURL" value="<?php echo URL_NOTIFICACAO; ?>">
					<input type="hidden" name="reference" id="reference" value="1001">
					<input type="hidden" name="amount" id="amount" value="600.00">
					<input type="hidden" name="noIntInstalQuantity" id="noIntInstalQuantity" value="2">

					<div class="row white round">
						<div class="col l12">
							<h4>Dados do Cartão</h4>
						</div>

						<div class="input-field col s6 l4">
								<input type="text" name="numCartao" class="validate" placeholder="" id="numCartao" required>
								<span class="bandeira-cartao"></span>
								<label for="numCartao">Número do cartão</label>
						</div>

						<div class="input-field col s6 l2">
							<input type="text" name="cvvCartao" id="cvvCartao" maxlength="3" value="123" required>
							<label for="cvvCartao">CVV do cartão</label>
							<input type="hidden" name="bandeiraCartao" id="bandeiraCartao">
						</div>
						
						<div class="input-field col s6 l2">
							<input type="text" name="mesValidade" id="mesValidade" maxlength="2" value="12" required>
							<label for="mesValidade">Mês de Validade</label>
						</div>

						<div class="input-field col s6 l2">
							<input type="text" name="anoValidade" id="anoValidade" maxlength="4" value="2030" required>
							<label for="anoValidade">Ano de Validade</label>
						</div>

						<div class="input-field col s6 l3 select-qnt-parcelas">
							<select name="qntParcelas" id="qntParcelas" class="select-qnt-parcelas">
								<option value="">Selecione</option>
							</select>
							<label for="qntParcelas">Quantidades de Parcelas</label>

							<input type="hidden" name="valorParcelas" id="valorParcelas" placeholder="R$" />
						</div>

						<div class="input-field col s6 l3">
							<input type="text" name="creditCardHolderCPF" id="creditCardHolderCPF" placeholder="CPF sem traço" value="22111944785" required>
							<label for="creditCardHolderCPF">CPF do dono do Cartão</label>
						</div>

						<div class="input-field col s6 l6">
							<input type="text" name="creditCardHolderName" id="creditCardHolderName" placeholder="Nome igual ao escrito no cartão" value="<? echo $resultado['nomeCliente'] ?>" required>
							<label for="creditCardHolderName">Nome no Cartão</label>

							<input type="hidden" name="tokenCartao" id="tokenCartao">
							<input type="hidden" name="hashCartao" id="hashCartao">
						</div>

					</div>

					<div class="row white round">
						<div class="col l12">
							<h4>Endereço do dono do cartão</h4>
						</div>

						<div class="input-field col s6 l6">
							<input type="text" name="billingAddressStreet" id="billingAddressStreet" placeholder="Av. Rua" value="<? echo $resultado['enderecoCliente']['logradouro'] ?>" required>
							<label for="billingAddressStreet">Logradouro</label>
						</div>

						<div class="input-field col s6 l2">
							<input type="text" name="billingAddressNumber" id="billingAddressNumber" placeholder="Número" value="<? echo $resultado['enderecoCliente']['numero'] ?>" required>
							<label for="billingAddressNumber">Número</label>
						</div>

						<div class="input-field col s6 l4">
							<input type="text" name="billingAddressComplement" id="billingAddressComplement" placeholder="Complemento" value="<? echo $resultado['enderecoCliente']['complemento'] ?>">
							<label for="billingAddressComplement">Complemento</label>
						</div>

						<div class="input-field col s6 l3">
							<input type="text" name="billingAddressDistrict" id="billingAddressDistrict" placeholder="Bairro" value="<? echo $resultado['enderecoCliente']['bairro'] ?>">
							<label for="billingAddressDistrict">Bairro</label>
						</div>

						<div class="input-field col s6 l2">
							<input type="text" name="billingAddressPostalCode" id="billingAddressPostalCode" placeholder="CEP sem traço" value="<? echo $resultado['enderecoCliente']['cep'] ?>" required>
							<label for="billingAddressPostalCode">CEP</label>
						</div>

						<div class="input-field col s6 l3">
							<input type="text" name="billingAddressCity" id="billingAddressCity" placeholder="Cidade" value="<? echo $resultado['enderecoCliente']['cidade'] ?>" required>
							<label for="billingAddressCity">Cidade</label>
						</div>

						<div class="input-field col s6 l2">
							<input type="text" name="billingAddressState" id="billingAddressState" placeholder="Sigla do Estado" value="<? echo $resultado['enderecoCliente']['estado'] ?>" required>
							<label for="billingAddressState">Estado</label>

							<input type="hidden" name="billingAddressCountry" id="billingAddressCountry" value="BRL">							
						</div>

					</div>

					<div class="row white round">
						<div class="col l12">
							<h4>Dados do Comprador</h4>
						</div>

						<div class="input-field col s6 l6">
							<input type="text" name="senderName" id="senderName" placeholder="Nome completo" value="<? echo $resultado['nomeCliente'] ?>" required>
							<label for="senderName">Nome</label>
						</div>

						<div class="input-field col s6 l3">
							<input type="text" name="creditCardHolderBirthDate" id="creditCardHolderBirthDate" placeholder="Data de Nascimento. Ex: 12/12/1912" value="<? echo $resultado['dataNascimentoCliente'] ?>" required>
							<label for="creditCardHolderBirthDate">Data de Nascimento</label>
						</div>

						<div class="input-field col s6 l3">
							<input type="text" name="senderCPF" id="senderCPF" placeholder="CPF sem traço" value="22111944785" required>
							<label for="senderCPF">CPF</label>
						</div>

						<div class="input-field col s6 l2">
							<input type="text" name="senderAreaCode" id="senderAreaCode" placeholder="DDD" value="<? echo $resultado['dddCliente'] ?>" required>
							<label for="senderAreaCode">Telefone</label>
						</div>

						<div class="input-field col s6 l1">
							<input type="text" name="senderPhone" id="senderPhone" placeholder="Somente número" value="<? echo $resultado['numeroCliente'] ?>" required>
							<label for="senderPhone">DDD</label>
						</div>

						<div class="input-field col s6 l5">
							<input type="email" name="senderEmail" id="senderEmail" placeholder="E-mail do comprador" value="<? echo $resultado['emailCliente'] ?>" required>
							<label for="senderEmail">E-mail</label>
						</div>
					</div>

					<div class="row white round">
						<div class="col l12">
							<h4>Endereço de Entrega</h4>
						</div>

						<div class="input-field col s6 l4">
							<input type="hidden" name="shippingAddressRequired" id="shippingAddressRequired" value="true">

							<input type="text" name="shippingAddressStreet" id="shippingAddressStreet" placeholder="Av. Rua" value="<? echo $resultado['enderecoCliente']['logradouro'] ?>">
							<label for="shippingAddressStreet">Logradouro</label>
						</div>

						<div class="input-field col s6 l2">
							<input type="text" name="shippingAddressNumber" id="shippingAddressNumber" placeholder="Número" value="<? echo $resultado['enderecoCliente']['numero'] ?>">
							<label for="shippingAddressNumber">Número</label>
						</div>

						<div class="input-field col s6 l3">
							<input type="text" name="shippingAddressComplement" id="shippingAddressComplement" placeholder="Complemento" value="<? echo $resultado['enderecoCliente']['complemento'] ?>">
							<label for="shippingAddressComplement">Complemento</label>
						</div>

						<div class="input-field col s6 l3">
							<input type="text" name="shippingAddressDistrict" id="shippingAddressDistrict" placeholder="Bairro" value="<? echo $resultado['enderecoCliente']['bairro'] ?>">
							<label for="shippingAddressDistrict">Bairro</label>
						</div>

						<div class="input-field col s6 l1">
							<input type="text" name="shippingAddressPostalCode" id="shippingAddressPostalCode" placeholder="CEP sem traço" value="<? echo $resultado['enderecoCliente']['cep'] ?>">
							<label for="shippingAddressPostalCode">CEP</label>
						</div>

						<div class="input-field col s6 l2">
							<input type="text" name="shippingAddressCity" id="shippingAddressCity" placeholder="Cidade" value="<? echo $resultado['enderecoCliente']['cidade'] ?>">
							<label for="shippingAddressCity">Cidade</label>
						</div>

						<div class="input-field col s6 l1">
							<input type="text" name="shippingAddressState" id="shippingAddressState" placeholder="Sigla do Estado" value="<? echo $resultado['enderecoCliente']['estado'] ?>">
							<label for="shippingAddressState">Estado</label>

							<input type="hidden" name="shippingAddressCountry" id="shippingAddressCountry" value="BRL">
						</div>

						<div class="col s12 l12 divBtn">
							<footer class="right">
								<button type="submit" name="btnComprar" id="btnComprar" class="btn-large waves-effect waves-light orange accent-4 round">
									<i class="material-icons left">shopping_cart</i> Comprar
								</button>
							</footer>
						</div>
					</div>

				</form>
			</div>

		</main>
		<!-- scripts -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
		<script type="text/javascript" src="_assets/scripts/index.min.js"></script>
		<script type="text/javascript" src="<?php echo SCRIPT_PAGSEGURO; ?>"></script>