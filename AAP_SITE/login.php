<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    header("Location: Controller/UsuarioController.php?id=$_SESSION[id]");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="View/css/index.css">
</head>
<body>
    <?php
    $pageTitle = "Login";
    include('View/layout/header.php'); // Inclui o header
    ?>
    <br /><br />
    <br /><br />
    <br /><br />
    <br /><br /><br /><br />
    <div class="containerlogin">
        <h2>Login</h2>
        <form method="post" action="Controller/UsuarioController.php">
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="submit" name="logarUSU" value="Entrar">
            <br>
            <br>
            <h8>Não possui cadastro? <a class="link_cadastro" href="cadastro.php">Cadastre-se</a></h8><br><br>
            <hr>
            <br><a class="link_adm" href="loginadm.php">Entrar como Administrador</a>
        </form>
    </div>
    <br /><br />
    <br /><br /><br /><br />
    <br /><br /><br /><br />
    <br /><br />
</body>
<?php
include('View/layout/footer.php'); // Inclui o footer
?>
</html>