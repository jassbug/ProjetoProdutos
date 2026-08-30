<?php
// Arquivo responsável por validar o login
require_once("../conexao.php");
require_once("../funcoes.php");


// Verifica se o formulário foi enviado
if(!isset($_POST["enviar"])){
    header("location:../index.php");
    exit;
}



// Recebe os dados digitados
$email = $_POST["email"];
$senha = $_POST["senha"];



// Verifica se os campos estão preenchidos
if(empty($email) || empty($senha)){
    echo "
    <script>
    alert('Preencha todos os campos!');
    window.location='../index.php';
    </script>
    ";
    exit;
}



// Verifica se o usuário existe no banco
$resultado = verificarUsuario($conn,$email,$senha);

if($resultado == true){

    // Inicia a sessão
    session_start();

    // Guarda o usuário logado
    $_SESSION["usuario"] = $email;

    // Vai para a página principal
    header("location:../principal.php");
    exit;

}else{
    echo "
    <script>
    alert('E-mail ou senha incorretos!');
    window.location='../index.php';
    </script>
    ";
}
?>