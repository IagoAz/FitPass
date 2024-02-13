<?php

include_once "../DAO/UsuarioDAO.php";
include_once "../Model/Endereco.php";
include_once "../Model/Caracteristicas.php";
include_once "../Model/Usuario.php";



//Classes
$usuario = new Usuario();
$usuariodao = new UsuarioDAO();
$caracteristicas = new Caracteristicas();
$dados = filter_input_array(INPUT_POST);

if (isset($_POST['logarUSU'])) {

    $usuario->setEmail($dados['email']);
    $usuario->setSenha($dados['senha']);

    $resultado_login = $usuariodao->verificarLogin($usuario);

    if ($resultado_login != null) {

        // Login bem-sucedido
        // Abrir sessão para ficar logado
        session_start();
        $_SESSION['id'] = $resultado_login[0]['USU_INT_ID'];
        $_SESSION['email'] = $resultado_login[0]['USU_STR_EMAIL'];
        $_SESSION['cpf'] = $resultado_login[0]['USU_STR_CPF'];


        echo '<script>alert("Login realizado com sucesso!");</script>';
        echo '<script>window.location.href="../Controller/UsuarioController.php?id=' .  $_SESSION['id'] . '";</script>';
        exit(); // Certifique-se de sair após o redirecionamento para evitar a execução de código adicional

    } else {
        echo '<script>alert("Credenciais de login incorretas!");</script>';
        echo '<script>window.location.href="../login.php";</script>';
    }
}



//Classes
else if (isset($_POST['cadastrarUSU'])) {
    $usuario->setNome($dados['nome']);
    $usuario->setEmail($dados['email']);
    $usuario->setSenha($dados['senha']);
    $usuario->setCPF($dados['cpf']);
    $usuario->setRua($dados['rua']);
    $usuario->setBairro($dados['bairro']);
    $usuario->setNumero($dados['numero']);
    $usuario->setComplemento($dados['complemento']);
    $usuario->setCep($dados['cep']);
    $usuario->setCidade($dados['cidade']);
    $usuario->setEstado($dados['estado']);
    $usuario->setSigla($dados['sigla']);
    $caracteristicas->setPeso($dados['peso']);
    $caracteristicas->setAltura($dados['altura']);
    $caracteristicas->setIdade($dados['idade']);
    $caracteristicas->setGenero($dados['genero']);

    // Verifica dados repetidos antes de prosseguir
    if ($usuariodao->verificarDadosRepetidos($usuario)) {
        echo '<script>alert("Erro ao cadastrar. Email ou CPF já cadastrado.");</script>';
        echo '<script>window.location.href="../cadastro.php";</script>';
        exit();
    }

    $idcaracteristica = $usuariodao->insertCaracteristicas($caracteristicas);
    $usuario->setId($idcaracteristica[0]['CAR_INT_ID']);


    $cadastroSucesso = $usuariodao->inserirCadastro($usuario);

    echo '<script>alert("Cadastro Realizado com sucesso!");</script>';
    echo '<script>window.location.href="../login.php";</script>';
    exit(); // Certifique-se de sair após o redirecionamento para evitar a execução de código adicional

} else if (isset($_GET['id'])) {
    $usuario->setId($_GET['id']);

    $dadosDAO = $usuariodao->selecionarUsuario($usuario);

    $nome = $dadosDAO[0]['USU_STR_NOME'];
    $peso = $dadosDAO[0]['CAR_DOU_PESO'];
    $idade = $dadosDAO[0]['CAR_INT_IDADE'];
    $altura = $dadosDAO[0]['CAR_DOU_ALTURA'];
    $genero = $dadosDAO[0]['CAR_STR_GENERO'];
    //CALCULAR O IMC
    $alturametro = $altura / 100;
    $imc = $peso / ($alturametro * $alturametro);
    $verificarimc;
    $texto;
    $imagem;
    $imc = number_format($imc, 1);

    // CALCULO IMC FEMININO
    if ($genero === 'Feminino') {
        if ($imc <= 18.5) {
            $verificarimc = 'baixopeso';
        } elseif ($imc <= 23.9) {
            $verificarimc = 'pesoideal';
        } elseif ($imc <= 28.9) {
            $verificarimc = 'sobrepeso';
        } elseif ($imc <= 34.9) {
            $verificarimc = "obesidade1";
        } elseif ($imc <= 39.9) {
            $verificarimc = "obesidade2";
        } else {
            $verificarimc = "obesidade3";
        }
        switch ($verificarimc) {
            case "baixopeso":
                $texto = '<span class="titulo">Abaixo do Peso</span><br>Procure um médico. Algumas pessoas têm um baixo peso por características do seu organismo e tudo bem. Outras podem estar enfrentando problemas, como a desnutrição. É preciso saber qual é o caso.';
                $imagem = '<img src="../imagens/imc/mulherabaixo.jpeg" / class="imagempessoa">';
                break;
            case "pesoideal":
                $texto = '<span class="titulo">Peso Ideal</span><br>Que bom que você está com o peso normal! E o melhor jeito de continuar assim é mantendo um estilo de vida ativo e uma alimentação equilibrada.';
                $imagem = '<img src="../imagens/imc/mulherideal.jpeg" / class="imagempessoa">';
                break;
            case "sobrepeso":
                $texto = '<span class="titulo">Sobrepeso</span><br>Ele é, na verdade, uma pré-obesidade e muitas pessoas nessa faixa já apresentam doenças associadas, como diabetes e hipertensão. Importante rever hábitos e buscar ajuda antes de, por uma série de fatores, entrar na faixa da obesidade pra valer.';
                $imagem = '<img src="../imagens/imc/mulhersobrepeso.jpeg" / class="imagempessoa">';
                break;
            case "obesidade1":
                $texto = '<span class="titulo">Obesidade Grau 1</span><br>Sinal de alerta! Chegou na hora de se cuidar, mesmo que seus exames sejam normais. Vamos dar início a mudanças hoje! Cuide de sua alimentação. Você precisa iniciar um acompanhamento com nutricionista e/ou endocrinologista.';
                $imagem = '<img src="../imagens/imc/mulherob1.jpeg" / class="imagempessoa">';
                break;
            case "obesidade2":
                $texto = '<span class="titulo">Obesidade Grau 2</span><br>Mesmo que seus exames aparentem estar normais, é hora de se cuidar, iniciando mudanças no estilo de vida com o acompanhamento próximo de profissionais de saúde.';
                $imagem = '<img src="../imagens/imc/mulherob2.jpeg" / class="imagempessoa">';
                break;
            case "obesidade3":
                $texto = '<span class="titulo">Obesidade Grau 3</span><br>Aqui o sinal é vermelho, com forte probabilidade de já existirem doenças muito graves associadas. O tratamento deve ser ainda mais urgente.';
                $imagem = '<img src="../imagens/imc/mulherob3.jpeg" / class="imagempessoa">';
                break;
        }
    }
    //CALCULO IMC Masculino
    else {
        if ($imc <= 20) {
            $verificarimc = 'baixopeso';
        } elseif ($imc <= 24.9) {
            $verificarimc = 'pesoideal';
        } elseif ($imc <= 29.9) {
            $verificarimc = 'sobrepeso';
        } elseif ($imc <= 35.9) {
            $verificarimc = 'obesidade1';
        } elseif ($imc <= 42) {
            $verificarimc = 'obesidade2';
        } else {
            $verificarimc = 'obesidade3';
        }
        switch ($verificarimc) {
            case "baixopeso":
                $texto = '<span class="titulo">Abaixo do Peso</span><br>Procure um médico. Algumas pessoas têm um baixo peso por características do seu organismo e tudo bem. Outras podem estar enfrentando problemas, como a desnutrição. É preciso saber qual é o caso.';
                $imagem = '<img src="../imagens/imc/homemabaixo.png" / class="imagempessoa">';
                break;
            case "pesoideal":
                $texto = '<span class="titulo">Peso Ideal</span><br>Que bom que você está com o peso normal! E o melhor jeito de continuar assim é mantendo um estilo de vida ativo e uma alimentação equilibrada.';
                $imagem = '<img src="../imagens/imc/homem_ideal.png" / class="imagempessoa">';
                break;
            case "sobrepeso":
                $texto = '<span class="titulo">Sobrepeso</span><br>Ele é, na verdade, uma pré-obesidade e muitas pessoas nessa faixa já apresentam doenças associadas, como diabetes e hipertensão. Importante rever hábitos e buscar ajuda antes de, por uma série de fatores, entrar na faixa da obesidade pra valer.';
                $imagem = '<img src="../imagens/imc/homemsobrepeso.jpg" / class="imagempessoa">';
                break;
            case "obesidade1":
                $texto = '<span class="titulo">Obesidade Grau 1</span><br>Sinal de alerta! Chegou na hora de se cuidar, mesmo que seus exames sejam normais. Vamos dar início a mudanças hoje! Cuide de sua alimentação. Você precisa iniciar um acompanhamento com nutricionista e/ou endocrinologista.';
                $imagem = '<img src="../imagens/imc/homemob1.jpg" / class="imagempessoa">';
                break;
            case "obesidade2":
                $texto = '<span class="titulo">Obesidade Grau 2</span><br>Mesmo que seus exames aparentem estar normais, é hora de se cuidar, iniciando mudanças no estilo de vida com o acompanhamento próximo de profissionais de saúde.';
                $imagem = '<img src="../imagens/imc/homemob2.jpg" / class="imagempessoa">';
                break;
            case "obesidade3":
                $texto = '<span class="titulo">Obesidade Grau 3</span><br>Aqui o sinal é vermelho, com forte probabilidade de já existirem doenças muito graves associadas. O tratamento deve ser ainda mais urgente.';
                $imagem = '<img src="../imagens/imc/homemob3.jpg" / class="imagempessoa">';
                break;
        }
    }
    include '../perfil.php';
} else if (isset($_POST['logarUSU'])) {

    $usuario->setEmail($dados['email']);
    $usuario->setSenha($dados['senha']);

    $resultado_login = $usuariodao->verificarLogin($usuario);

    if ($resultado_login != null) {

        // Login bem-sucedido
        // Abrir sessão para ficar logado
        session_start();
        $_SESSION['id'] = $resultado_login[0]['USU_INT_ID'];
        $_SESSION['email'] = $resultado_login[0]['USU_STR_EMAIL'];
        $_SESSION['cpf'] = $resultado_login[0]['USU_STR_CPF'];

        echo '<script>alert("Login realizado com sucesso!");</script>';
        echo '<script>window.location.href="../Controller/UsuarioController.php?id=' .  $_SESSION['id'] . '";</script>';
        exit(); // Certifique-se de sair após o redirecionamento para evitar a execução de código adicional

    } else {
        echo '<script>alert("Credenciais de login incorretas!");</script>';
        echo '<script>window.location.href="../login.php";</script>';
    }
} else if (isset($_POST['excluirConta'])) {

    session_start();

    $usuario->setId($_SESSION['id']);

    $resultado_delete = $usuariodao->excluirDados($usuario);

    if ($resultado_delete) {
        echo '<script>alert("Conta deletada com sucesso!");</script>';
        echo '<script>window.location.href="../logout.php";</script>';
    } else {
        echo '<script>alert("Erro ao excluir conta.");</script>';
    }
}


//PARA ALTERAR OS DADOS
else if (isset($_POST['alterarDados'])) {
    session_start();

    $usuario->setNome($dados['novoNome']);
    $usuario->setEmail($dados['novoEmail']);
    $usuario->setSenha($dados['novaSenha']);
    $usuario->setRua($dados['novaRua']);
    $usuario->setBairro($dados['novoBairro']);
    $usuario->setNumero($dados['novoNumero']);
    $usuario->setComplemento($dados['novoComplemento']);
    $usuario->setCep($dados['novoCep']);
    $usuario->setId($_SESSION['id']);
    $usuario->setCidade($dados['novaCidade']);
    $usuario->setEstado($dados['novoEstado']);
    $usuario->setSigla($dados['novaSigla']);

    $caracteristicas->setPeso($dados['novoPeso']);
    $caracteristicas->setAltura($dados['novaAltura']);
    $caracteristicas->setIdade($dados['novaIdade']);

    $atualizacao_sucesso = $usuariodao->alterarDadosUSU($usuario);
    
    if ($atualizacao_sucesso !== false) {
        $idcaracteristica = $usuariodao->alterarDadosCAR($caracteristicas);
        echo '<script>alert("Dados alterados com sucesso!");</script>';
        echo '<script>window.location.href="../Controller/UsuarioController.php?id=' . $_SESSION['id'] . '";</script>';
    } else {
        echo '<script>alert("Erro ao alterar dados. Email já utilizado. Por favor, tente novamente.");</script>';
        echo '<script>window.location.href="../Controller/UsuarioController.php?id=' . $_SESSION['id'] . '";</script>';
        // Pode adicionar mais detalhes de erro se necessário
    }
}
