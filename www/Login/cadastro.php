<?php

include("../conexao.php"); // Conexão com o banco
include("../funcoes.php"); // Funções do sistema


// Verifica se o formulário foi enviado
if(isset($_POST["cadastrar"])){

    // Pega os dados digitados
    $email = $_POST["email"];
    $senha = $_POST["senha"];


    // Chama a função de cadastra o usuário
    $resultado = cadastrarUsuario($conn,$email,$senha);

    // Cadastro realizado com sucesso
    if($resultado === true){
        echo "<script>
        alert('Usuário cadastrado com sucesso!');
        window.location='/index.php';
        </script>";
    }


    // Usuário já existe
    elseif($resultado == "existe"){
        echo "<script>
        alert('Esse email já está cadastrado!');
        history.back();
        </script>";
    }

    // Erro no cadastro
    else{
        echo "<script>
        alert('Erro ao cadastrar usuário!');
        history.back();
        </script>";


    }

}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro - F1 Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/estilo.css">

</head>


<body class="login-body">
<div class="login-container"> <!-- Área de cadastro -->
<div class="login-card">

<div class="text-center mb-4"><!-- Logo e título -->
    <div class="logo">
        🏎️
    </div>

    <h1 class="titulo-login">
        F1 Store
    </h1>

    <p class="descricao-login">
        Crie sua conta no sistema
    </p>
</div>


<form method="POST"><!-- Formulário -->
    <div class="mb-3"> <!-- Email -->
        <label class="form-label">
            E-mail
        </label>

        <input 
        type="email" 
        name="email"
        class="form-control"
        placeholder="Digite seu email"
        required>
    </div>


    <div class="mb-3"><!-- senha -->
        <label class="form-label">
            Senha
        </label>

        <input
        type="password"
        name="senha"
        class="form-control"
        placeholder="Digite sua senha"
        required>
    </div>

    <!-- cadastrar -->
    <button type="submit" name="cadastrar" class="btn btn-login w-100">
        Criar Conta
    </button>


    <!-- Voltar para login -->
    <a href="../index.php" class="btn btn-cadastro w-100 mt-3">
        Voltar para Login
    </a>

</form>
</div>

<!-- Rodapé -->
<p class="rodape-login">
© 2026 • Sistema F1 Store
</p>
</div>
</body>
</html>