const input = document.querySelector('#CPF');
input.addEventListener('keypress', () => {
    let inputLength = input.value.length; // Corrigido aqui
    if (inputLength === 3 || inputLength === 7) {
        input.value += '.'
    } else if (inputLength === 11) {
        input.value += '-'
    }
});
const inputcep = document.querySelector('#CEP');
inputcep.addEventListener('keypress', () => {
    let inputLength = inputcep.value.length; // Corrigido aqui

    if (inputLength === 5) {
        inputcep.value += '-';
    }
});



//DESLOGAR
function logoutVBotao() {
    var resposta = confirm("Deseja sair de sua conta?");
    if (resposta) {
      window.location.href = '../logout.php';
    }
}
//EXCLUIR CONTA
function confirmarExclusaoConta() {
    var btn = document.getElementById('btnExcluirConta');
    var formulario = document.getElementById('formularioexcluirConta');
    var formularioA = document.getElementById('formularioAlterarDados');
    var btnA = document.getElementById('btnAlterarDados');
    if (formulario.style.display === 'none') {
        var resposta = confirm("Deseja excluir sua conta? Ela não poderá ser acessada novamente.");
        if (resposta) {
            formulario.style.display = 'block';
            btn.textContent = 'Manter Conta';
            formularioA.style.display = 'none';
            btnA.textContent = 'Alterar Dados';
        }
    } else {
        formulario.style.display = 'none';
        btn.textContent = 'Excluir Conta';
    }
}
// ALTERAR DADOS
function alterarDadosVBotao(){
    var btn = document.getElementById('btnAlterarDados');
    var btnE = document.getElementById('btnExcluirConta');
    var formulario = document.getElementById('formularioAlterarDados');
    var formularioE = document.getElementById('formularioexcluirConta');
    if (formulario.style.display === 'none') {
        formulario.style.display = 'block';
        formularioE.style.display = 'none';
        btn.textContent = 'Manter Dados';
        btnE.textContent = 'Excluir Conta';
    } else {
        formulario.style.display = 'none';
        btn.textContent = 'Alterar Dados';
    }
}
