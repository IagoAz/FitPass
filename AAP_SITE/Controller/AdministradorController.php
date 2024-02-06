<?php

include_once "../DAO/AdministradorDAO.php";
include_once "../Model/Administrador.php";


//Classes
$administrador = new Administrador();
$administradordao = new AdministradorDAO();


$dados = filter_input_array(INPUT_POST);

if(isset($_POST['logarADM'])){

    $administrador->setEmail($dados['email']);
    $administrador->setSenha($dados['senha']);

    $loginSucesso = $administradordao->verificarLoginAdm($administrador);

    if ($loginSucesso) {
        echo '<script>alert("Login realizado com sucesso!");</script>';
        echo '<script>window.location.href="../perfiladm.php?id=' . $_SESSION['id'] . '";</script>';
        exit(); // Certifique-se de sair após o redirecionamento para evitar a execução de código adicional
    }else{
        echo '<script>alert("Credenciais incorretas!");</script>';
        echo '<script>window.location.href="../loginadm.php";</script>';
        exit(); // Certifique-se de sair após o redirecionamento para evitar a execução de código adicional
    }
    
}
?>