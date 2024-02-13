<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="../View/css/index.css">
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['id'])) {
        $id_usuario = $_SESSION['id'];
    }
    $pageTitle = "Perfil";
    include_once "View/layout/headerprofile.php";
    ?>
    <br>
    <div class="forms-containerBUTAO">

        <!-- BOTÔES -->
        <button onclick="logoutVBotao()">Logout</button>
        <button id="btnAlterarDados" onclick="alterarDadosVBotao()">Alterar Dados</button>
        <button id="btnExcluirConta" onclick="confirmarExclusaoConta()">Excluir Conta</button>

        <!-- FORMS PARA REALIZAÇÃO DE TAREFAS -->

        <!-- FORMS PARA DELETAR -->
        <form id="formularioexcluirConta" method="post" action="UsuarioController.php" style="display: none;">
            <button type="submit" name="excluirConta" method="post" style="background-color: black;" ; name="excluirConta">Excluir!</button>
        </form>

        <!-- FORMS PARA ALTERAR DADOS -->
        <form id="formularioAlterarDados" method="post" action="UsuarioController.php" style="display: none;" onsubmit="return validarFormulario()">


            <h3>Informações Pessoais</h3>
            <label for="novoNome">Novo Nome</label>
            <input type="text" name="novoNome" placeholder="Novo Nome" required>
            <label for="novoEmail">Novo Email</label>
            <input type="email" name="novoEmail" placeholder="Novo E-mail" required> <br /> <br />
            <label for="novaSenha">Nova Senha</label>
            <input type="password" maxlength="30" minlength="8" name="novaSenha" placeholder="Nova Senha" required> <br /> <br />

            <h3>Endereço</h3>
            <label for="novoCep">Novo CEP</label>
            <input type="text" maxlength="9" minlength="9" class="form-control" id="novoCep" autocomplete="off" class="form-control" name="novoCep" placeholder="Novo CEP" required>
            <script>
                const inputnovocep = document.querySelector('#novoCep');
                inputnovocep.addEventListener('keypress', () => {
                    let inputLength = inputnovocep.value.length;

                    if (inputLength === 5) {
                        inputnovocep.value += '-';
                    }
                });
            </script>

            <label for="novaRua">Nova Rua</label>
            <input type="text" name="novaRua" placeholder="Nova Rua" required>
            <label for="novoNumero">Novo Número</label>
            <input type="text" name="novoNumero" placeholder="Novo Número" required>
            <label for="novoBairro">Novo Bairro</label>
            <input type="text" name="novoBairro" placeholder="Novo Bairro" required>
            <label for="novoComplemento">Novo Complemento</label>
            <input type="text" name="novoComplemento" placeholder="Novo Complemento" required>
            <label for="novaCidade">Nova Cidade</label>
            <input type="text" name="novaCidade" placeholder="Nova Cidade" required>
            <label for="novoEstado">Novo Estado</label>
            <select id="estado" name="novoEstado" onchange="atualizarSigla()" required>

                <option value="" selected disabled>Atualize o seu estado</option>
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
            <input type="hidden" id="siglaInput" name="novaSigla" style="width: 7%; margin: 0px;" readonly>
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

            <h3>Características</h3>
            <label for="novoPeso">Novo Peso</label>
            <input type="text" name="novoPeso" placeholder="Novo Peso em Kg" required>
            <label for="novaAltura">Nova Altura</label>
            <input type="text" name="novaAltura" placeholder="Nova Altura em cm" required>
            <label for="novaIdade">Nova Idade</label>
            <input type="text" name="novaIdade" placeholder="Nova Idade" required>
            <input type="hidden" id="cpf" name="cpf" value="<?= $_SESSION['cpf'] ?>">


            <button type="submit" name="alterarDados">Salvar Alterações</button>
        </form>
    </div>
    <br>
    <div class="deixarLadoaLado">
        <div class="centralizarImg">
            <h3 class="fonte24">Seu Índice de Massa Corporal é: <?= $imc ?></h3>
            <?php echo '<div class="imgIMC">' .  $imagem . '</div>'; ?>
        </div>
        <div class="centralizarOLA">
            </br>
            <h3>Olá, <?= $nome ?>. <br>Essas são as suas características físicas:</h3>
            </br>
            <div class="caracs">
                <p><b>Peso:</b> <?= $peso ?> Kg.</p>
                <p><b>Idade:</b> <?= $idade ?> anos.</p>
                <p><b>Altura:</b> <?= $altura ?> cm.</p>
            </div>
            <center>
                <?php echo '<div class="teste"></br>' . $texto . '</div>'; ?>
            </center>
        </div>
    </div>
    </br></br> <br>

    <center>
        <div class="atencaorobocnaarea">
            <h3 style="color: red; text-align:center">ATENÇÂO</h3>
            <p>O índice não avalia se o peso está relacionado com o tecido muscular ou tecido adiposo. Isso significa que uma pessoa com grande quantidade de massa muscular pode ser considerada obesa quando analisamos apenas a proporção entre peso e altura.</p>
        </div>
    </center>
    </br></br></br></br>
    <div class="deixarLadoaLado2">
        <div class="centralizarDescricaoIMC">
            <p>O IMC é reconhecido como padrão internacional para avaliar o grau de sobrepeso e obesidade. É calculado dividindo o peso (em kg) pela altura ao quadrado (em metros).</p>
            <center>
                <img src="../imagens/imc/IMC.png" alt="IMC Image">
            </center>
        </div>
        <img class="tabelaimc" src="../imagens/tabelaimc.png" alt="Tabela IMC Image">
    </div>
    <?php
    include('View/layout/footerprofile.php'); // Inclui o footer
    ?>
    <script src="../View/js/app.js"></script>
</body>

</html>