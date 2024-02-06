<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="View/css/index.css">
</head>
<body>
    <?php
    $pageTitle = "Perfil ADM";
    include('View/layout/header.php'); // Inclui o header

    $conn = mysqli_connect("localhost", "root", "", "aap_fitpass");
    ?>
    <h1>Olá Administrador</h1>
    <div class="forms-containerBUTAO">
        <form action="logout.php" method="post">
            <button type="submit">Logout</button>
        </form>
    </div>
    <br>
    <div class="alignformadm">
        <div class="formperfiladm">
            <form id="myForm" action="https://api.staticforms.xyz/submit" method="post" onsubmit="return validarFormulario()">
                <input type="hidden" name="accessKey" value="ba28c711-8160-4418-ad0a-7c5c38799dfd">
                <input type="hidden" name="redirectTo" value="http://localhost/AAP_SITE/perfiladm.php?id=">
                <h1>Enviar Conteúdo</h1>
                <hr>
                <h3>Dados Pessoais</h3>
                Nome: <br> <input type="text" name="name" placeholder="Insira seu nome" required><br>
                Email: <br> <input type="email" name="email" placeholder="Insira seu email" required><br>
                CPF: <br> <input type="text" id="CPF" name="cpf" maxlength="14" placeholder="Insira seu CPF" required><br>
                <h3>Dados de Envio</h3>
                <hr>
                Título: <br> <input type="text" name="subject" placeholder="Insira o Título" required><br>
                Mensagem: <br> <textarea id="caixadetextoadm" name="message" placeholder="Insira sua mensagem" required></textarea><br>

                <button type="submit" id="btnperfadm"> Enviar </button>
            </form>
            <script src="View/js/app.js"></script>
        </div>
    </div>
    <script>
        document.getElementById('myForm').addEventListener('submit', function(event) {
            alert('Enviado com sucesso');
        });
    </script>
    <br>
    <?php
    include('View/layout/footer.php'); // Inclui o footer
    ?>
</body>
</html>