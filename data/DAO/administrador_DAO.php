<?php 
include_once "../Model/Administrador.php";
include_once "../Controller/AdministradorController.php";
include_once "../Conexao/Conexao.php";


class AdministradorDAO{
// Método para verificar login do administrador//
public function verificarLoginAdm(Administrador $administrador){
    try{
        $sql = "SELECT * FROM administrador WHERE ADM_STR_EMAIL = :email AND ADM_STR_SENHA = :senha";

        $stmt = Conexao::getConexao()->prepare($sql);

        $stmt->bindValue(":email", $administrador->getEmail());
        $stmt->bindValue(":senha", $administrador->getSenha());
        $stmt->execute();

        $resultado_query = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($resultado_query) == 1) {
            return true;
        }
    } catch(Exception $e){
        print "Erro ao procurar ADM<br>" . $e . '<br>';
    }

    // Login falhou ou erro na consulta SQL
    return false;
}
}
?>
