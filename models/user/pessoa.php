<?php 
//NO FUTURO PRECISAREMOS DISSO, POR ENQUANTO ESSE ARQUIIVO FAZ NADA
class Pessoa extends Endereco{

private $nome;
private $email;
private $senha;
private $cpf;

// Métodos getter e setter...
public function getNome() {
    return $this->nome;
}

public function setNome($nome) {
    $this->nome = $nome;
}

public function getEmail() {
    return $this->email;
}

public function setEmail($email) {
    $this->email = $email;
}

public function getSenha() {
    return $this->senha;
}

public function setSenha($senha) {
    $this->senha = $senha;
}

public function getCPF() {
    return $this->cpf;
}

public function setCPF($cpf) {
    $this->cpf = $cpf;
}
}

?>