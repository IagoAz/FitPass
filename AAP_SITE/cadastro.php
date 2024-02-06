<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="View/css/index.css">
</head>
<body>
	<?php
	$pageTitle = "Cadastro";
	include('View/layout/header.php'); // Inclui o header
	?>
	<br /><br />
	<br /><br />
	<form action="Controller/UsuarioController.php" method="post" onsubmit="return validarFormulario()">
		<div class="formulario">
			<h1>CADASTRO</h1>
			<hr>
			<section class="DadosPessoais">
				<h3>Dados Pessoais</h3>
				<p>
					<label for="inputName">Nome <b class="aster">*</b></label>
					<input type="text" id="inputName" name="nome" class="form-control" placeholder="Nome Completo" required>
				</p>
				<p>
					<label for="inputEmail">Email <b class="aster">*</b></label>
					<input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email" required>
				</p>
				<p>
					<label for="inputPassword">Senha <b class="aster">*</b></label>
					<input maxlength="30" minlength="8" type="password" class="form-control" name="senha" id="inputPassword" placeholder="Senha" required>
				</p>
				<p>
					<label for="inputZip">CPF <b class="aster">*</b></label>
					<input maxlength="14" minlength="14" type="text" autocomplete="off" class="form-control" id="CPF" name="cpf" placeholder="XXX.XXX.XXX-XX" required>
				</p>
			</section>
			<section class="Endereco">
				<h3>Endereço</h3>
				<hr>
				<p>
					<label for="inputAddress">Rua <b class="aster">*</b></label>
					<input type="text" class="form-control" name="rua" id="inputAddress" placeholder="Ex.: Av Vinicius de Morais, 25" required>
					<label for="inputAddress">Bairro <b class="aster">*</b></label>
					<input type="text" class="form-control" name="bairro" id="inputAddress" placeholder="Bairro" required>
				</p>
				<label for="inputAddress">Número <b class="aster">*</b></label>
				<input type="text" class="form-control" name="numero" id="inputAddress" placeholder="Nº" style="width: 7%; margin: 5px;" required>
				<label for="inputAddress">Comp. </label>
				<input type="text" class="form-control" name="complemento" id="inputAddress" placeholder="Apto." style="width: 19%; margin: 5px;">
				</p>
				
				<label for="inputAddress2">CEP <b class="aster">*</b></label>
				<input maxlength="9" minlength="9" type="text" autocomplete="off" class="form-control" name="cep" id="CEP" placeholder="12345-670">

				<label for="inputCity">Cidade <b class="aster">*</b></label>
				<input type="text" class="form-control" name="cidade" id="inputCity" placeholder="Ex.: Barueri" required>
				<p>
					<label for="estado">Estado <b class="aster">*</b></label>
					<select id="estado" name="estado" onchange="atualizarSigla()">
						<option value="" selected disabled>Selecione um estado</option>
						<option value="Acre">Acre</option>
						<option value="Alagoas">Alagoas</option>
						<option value="Amapá">Amapá</option>
						<option value="Amazonas">Amazonas</option>
						<option value="Bahia">Bahia</option>
						<option value="Ceará">Ceará</option>
						<option value="Distrito Federal">Distrito Federal</option>
						<option value="Espírito Santo">Espírito Santo</option>
						<option value="Goiás">Goiás</option>
						<option value="Maranhão">Maranhão</option>
						<option value="Mato Grosso">Mato Grosso</option>
						<option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
						<option value="Minas Gerais">Minas Gerais</option>
						<option value="Pará">Pará</option>
						<option value="Paraíba">Paraíba</option>
						<option value="Paraná">Paraná</option>
						<option value="Pernambuco">Pernambuco</option>
						<option value="Piauí">Piauí</option>
						<option value="Rio de Janeiro">Rio de Janeiro</option>
						<option value="Rio Grande do Norte">Rio Grande do Norte</option>
						<option value="Rio Grande do Sul">Rio Grande do Sul</option>
						<option value="Rondônia">Rondônia</option>
						<option value="Roraima">Roraima</option>
						<option value="Santa Catarina">Santa Catarina</option>
						<option value="São Paulo">São Paulo</option>
						<option value="Sergipe">Sergipe</option>
						<option value="Tocantins">Tocantins</option>
					</select>
					<input type="hidden" id="siglaInput" name="sigla" style="width: 7%; margin: 0px;" readonly>
					<script>
						function atualizarSigla() {
							// Obter o elemento select e a opção selecionada
							var estadoSelect = document.getElementById("estado");
							var siglaInput = document.getElementById("siglaInput");
							// Obter o valor da opção selecionada
							var estadoSelecionado = estadoSelect.options[estadoSelect.selectedIndex].value;
							// Mapear estados para suas respectivas siglas
							var sigla = {
								"Acre": "AC",
								"Alagoas": "AL",
								"Amapá": "AP",
								"Amazonas": "AM",
								"Bahia": "BA",
								"Ceará": "CE",
								"Distrito Federal": "DF",
								"Espírito Santo": "ES",
								"Goiás": "GO",
								"Maranhão": "MA",
								"Mato Grosso": "MT",
								"Mato Grosso do Sul": "MS",
								"Minas Gerais": "MG",
								"Pará": "PA",
								"Paraíba": "PB",
								"Paraná": "PR",
								"Pernambuco": "PE",
								"Piauí": "PI",
								"Rio de Janeiro": "RJ",
								"Rio Grande do Norte": "RN",
								"Rio Grande do Sul": "RS",
								"Rondônia": "RO",
								"Roraima": "RR",
								"Santa Catarina": "SC",
								"São Paulo": "SP",
								"Sergipe": "SE",
								"Tocantins": "TO"
							};
							// Atualizar o valor do input com a sigla correspondente
							siglaInput.value = sigla[estadoSelecionado] || "";
						}
					</script>
			</section>
			</p>
			<section class="Caracteristicas">
				<h3>Características</h3>
				<hr>
				<div class="grupo">
					<label for="inputWeight">
						<p>&nbsp;&nbsp;&nbsp;&nbsp; Peso <b class="aster">*</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							Altura <b class="aster">*</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Idade <b class="aster">*</b></p>
					</label>
					<input type="text" name="peso" id="inputWeight" style="width: 15%; margin: 15px; " placeholder="Em Kg" required>
					<label for="inputHeight"></label>
					<input type="text" id="inputHeight" name="altura" style="width: 15%; margin: 15px; padding-right:5px;" placeholder="Em Cm" required>
					<label for="inputAge"></label>
					<input type="text" id="inputAge" name="idade" style="width: 15%; margin: 15px;" placeholder="Ex.: 18" required>
				</div>
				<p>
					<label for="inputGender">Gênero <b class="aster">*</b></label>
					<select id="inputGender" name="genero" class="form-control" required>
						<option selected hidden>Escolha...</option>
						<option value="Masculino">Masculino</option>
						<option value="Feminino">Feminino</option>
					</select>
				</p>
				<input type="submit" name="cadastrarUSU" id="submitBtn"></input>
		</div>
		</section>
	</form>
	<script src="View/js/app.js"></script>
</body>
<br /><br />
<br /><br />
<?php
include('View/layout/footer.php'); // Inclui o footer
?>
</html>