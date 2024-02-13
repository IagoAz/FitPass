<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="View/css/index.css">
</head>
<body>
    <?php
    $pageTitle = "Login ADM";
    include('View/layout/header.php'); // Inclui o header
    ?>
    <br /><br />
    <br /><br />
    <br /><br />
    <br /><br /><br /><br />
    <div class="containerlogin">
        <h2>Login Administrativo</h2>
        <hr>
        <form method="post" action="Controller/AdministradorController.php">
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="submit" name="logarADM" value="Entrar">
            <br>
            <br>
        </form>
    </div>
    <br /><br />
    <br /><br /><br /><br />
    <br /><br /><br /><br />
    <?php
    include('View/layout/footer.php'); // Inclui o footer
    ?>
</body>

</html>