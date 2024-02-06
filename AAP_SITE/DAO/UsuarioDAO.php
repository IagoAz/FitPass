<?php
include_once "../Conexao/Conexao.php";
include_once "../Controller/UsuarioController.php";
include_once "../Model/Endereco.php";
include_once "../Model/Caracteristicas.php";
include_once "../Model/Usuario.php";
include_once "../Controller/AdministradorController.php";
include_once "../Conexao/Conexao.php";
class UsuarioDAO
{
    public function insertCaracteristicas(Caracteristicas $caracteristicas)
    {
        try {
            $sql = "INSERT INTO caracteristicas (CAR_DOU_PESO, CAR_DOU_ALTURA,
            CAR_INT_IDADE, CAR_STR_GENERO) VALUES (:peso, :altura, :idade, :genero)";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(':peso', $caracteristicas->getPeso());
            $stmt->bindValue(':altura', $caracteristicas->getAltura());
            $stmt->bindValue(':idade', $caracteristicas->getIdade());
            $stmt->bindValue(':genero', $caracteristicas->getGenero());
            $stmt->execute();
            $sql = "SELECT CAR_INT_ID FROM caracteristicas WHERE CAR_DOU_PESO = :peso AND
         CAR_DOU_ALTURA = :altura AND CAR_INT_IDADE = :idade AND CAR_STR_GENERO = :genero";
            $stmt1 = Conexao::getConexao()->prepare($sql);
            $stmt1->bindValue(':peso', $caracteristicas->getPeso());
            $stmt1->bindValue(':altura', $caracteristicas->getAltura());
            $stmt1->bindValue(':idade', $caracteristicas->getIdade());
            $stmt1->bindValue(':genero', $caracteristicas->getGenero());
            $stmt1->execute();
            $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            print "Erro ao cadastrar.<br>" . $e . '<br>';
        }
    }
    // Método para verificar login do usuario//
    public function verificarLogin(Usuario $usuario)
    {
        try {
            $sql = "SELECT * FROM usuario WHERE USU_STR_EMAIL = :email AND USU_STR_SENHA = :senha";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":email", $usuario->getEmail());
            $stmt->bindValue(":senha", $usuario->getSenha());
            $stmt->execute();
            $resultado_query = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($resultado_query) == 1) {
                return $resultado_query;
            }
        } catch (Exception $e) {
            print "Erro ao procurar ADM<br>" . $e . '<br>';
        }
    }
    // Método para verificar login do administrador//
    public function inserirCadastro(Usuario $usuario)
    {
        try {
            $sql = "CALL SP_USUARIO_INSERT (
                    :estado,
                    :sigla,
                    :cidade,
                    :rua,
                    :numero,
                    :bairro,
                    :complemento,
                    :cep,
                    :id,
                    :nome,
                    :senha,
                    :email,
                    :cpf
                )";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":estado", $usuario->getEstado());
            $stmt->bindValue(":sigla", $usuario->getSigla());
            $stmt->bindValue(":cidade", $usuario->getCidade());
            $stmt->bindValue(":rua", $usuario->getRua());
            $stmt->bindValue(":numero", $usuario->getNumero());
            $stmt->bindValue(":bairro", $usuario->getBairro());
            $stmt->bindValue(":complemento", $usuario->getComplemento());
            $stmt->bindValue(":cep", $usuario->getCep());
            $stmt->bindValue(":id", $usuario->getId());
            $stmt->bindValue(":nome", $usuario->getNome());
            $stmt->bindValue(":senha", $usuario->getSenha());
            $stmt->bindValue(":email", $usuario->getEmail());
            $stmt->bindValue(":cpf", $usuario->getcpf());
            $stmt->execute();
            $resultado_query = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($resultado_query) == 1) {
                return true;
            }
        } catch (Exception $e) {
            print "Erro ao cadastrar.<br>" . $e . '<br>';
        }
        // Login falhou ou erro na consulta SQL
        return false;
    }
    public function selecionarUsuario(Usuario $usuario)
    {
        try {
            $sql = "CALL SP_CARACTERISTICAS_SELECTbyid (:id)";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $usuario->getId());
            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($dados) == 1) {
                return $dados;
            }
        } catch (Exception $e) {
            print "Erro ao cadastrar.<br>" . $e . '<br>';
        }
    }
    public function verificarDadosRepetidos(Usuario $usuario)
    {
        try {
            $sql = "SELECT COUNT(*) AS total FROM usuario WHERE USU_STR_EMAIL = :email OR USU_STR_CPF = :cpf";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':cpf', $usuario->getCPF());
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['total'] > 0;
        } catch (Exception $e) {
            return false;
        }
    }
    //PARA EXCLUIR OS DADOS
    public function excluirDados(Usuario $usuario)
    {
        try {
            $sql = "CALL SP_USUARIO_DEL (:id)";

            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $usuario->getId());
            $stmt->execute();

            $rowCount = $stmt->rowCount();
            if ($rowCount > 0) {
                return true;
            }
        } catch (Exception $e) {
            echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
            return false;
        }
    }
    //PARA ALTERAR OS DADOS
    public function alterarDadosUSU(Usuario $usuario)
    {
        try {
            $sql = "CALL SP_USUARIO_UPDATE (
                :novoEstado,
                :novaSigla,
                :novaCidade,
                :novaRua,
                :novoNumero,
                :novoBairro,
                :novoComplemento,
                :novoCep,
                :id,
                :novoNome,
                :novaSenha,
                :novoEmail
            )";


            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":novoEstado", $usuario->getEstado());
            $stmt->bindValue(":novaSigla", $usuario->getSigla());
            $stmt->bindValue(":novaCidade", $usuario->getCidade());
            $stmt->bindValue(":novaRua", $usuario->getRua());
            $stmt->bindValue(":novoNumero", $usuario->getNumero());
            $stmt->bindValue(":novoBairro", $usuario->getBairro());
            $stmt->bindValue(":novoComplemento", $usuario->getComplemento());
            $stmt->bindValue(":novoCep", $usuario->getCep());
            $stmt->bindValue(":id", $usuario->getId());
            $stmt->bindValue(":novoNome", $usuario->getNome());
            $stmt->bindValue(":novaSenha", $usuario->getSenha());
            $stmt->bindValue(":novoEmail", $usuario->getEmail());

            $stmt->execute();
            $resultado_query = $stmt->rowCount();

            // Se pelo menos uma linha foi afetada, significa que a atualização foi bem-sucedida
            if ($resultado_query > 0) {
                return true;
            } else {
                // Nenhuma linha foi afetada, portanto, a atualização não foi bem-sucedida
                return false;
            }
        } catch (Exception) {
            return false;
        }
    }


    public function alterarDadosCAR(Caracteristicas $caracteristicas)
    {
        try {
            $sql = "UPDATE caracteristicas SET CAR_DOU_PESO = :novoPeso, CAR_DOU_ALTURA = :novaAltura, CAR_INT_IDADE = :novaIdade WHERE CAR_INT_ID = :id";
            $stmt1 = Conexao::getConexao()->prepare($sql);
            $stmt1->bindValue(':novoPeso', $caracteristicas->getPeso());
            $stmt1->bindValue(':novaAltura', $caracteristicas->getAltura());
            $stmt1->bindValue(':novaIdade', $caracteristicas->getIdade());
            $stmt1->bindValue(':id', $_SESSION['id']);

            $stmt1->execute();

            $rowCount = $stmt1->rowCount();
            if ($rowCount > 0) {
                return true;
            }
        } catch (Exception $e) {
            print "Erro ao atualizar as caracteristicas.<br>" . $e . '<br>';
            return false;
        }
    }

    public function pegarCPF(Usuario $usuario)
    {

        try {
            $sql = "CALL SP_USUARIO_SELECTbyid(:id)";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(':id', $_SESSION['id']);
            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $e) {
            print "Erro ao atualizar as caracteristicas.<br>" . $e . '<br>';
            return false;
        }
    }
}
