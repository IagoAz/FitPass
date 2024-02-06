<body>
    <footer>
        <p>
            <a href="../index.php">Fitpass</a>
            <a href="../exercicio.php">Exercícios</a>
            <a href="../suplementos.php">Suplementos</a>
            <a href="../alimentos.php">Alimentos</a>
            <a href="<?php if (isset($_SESSION['id'])) {
                            echo '../../AAP_SITE/Controller/UsuarioController.php?id=' . $_SESSION['id'];
                        } else {
                            echo '../../AAP_SITE/login.php';
                        }
                        ?>">Login</a>
        </p>
        <p>Email para contato: FitPass.ajuda@email.com.br</p>
        <p>Telefone para contato: (11) 4002-8922</p>
        <p>Somos uma empresa dedicada a fornecer as melhores respostas aos nossos clientes.</p>
        <p>© 2023 FitPass. Todos os direitos reservados.</p>
    </footer>
</body>
</html>