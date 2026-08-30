<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - F1 Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body class="login-body">


<!-- Área principa -->
<div class="login-container">


<div class="login-card">

<div class="text-center mb-4"><!--informações do sistema -->
    <div class="logo">
        🏎️
    </div>

    <h1 class="titulo-login">
        F1 Store
    </h1>

    <p class="descricao-login fw-bold">
        Sistema de Gerenciamento de Produtos
    </p>

</div>


<form action="Login/processa.php" method="POST"><!-- Formulário de login -->

    <!-- email -->
    <div class="mb-3">
    <label class="form-label">
        E-mail
    </label>

    <input
    type="email"
    name="email"
    class="form-control"
    placeholder="Digite seu e-mail"
    required>
    </div>



    <!-- senha -->
    <div class="mb-3">
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


    <!-- entrar -->
    <button type="submit" name="enviar"class="btn btn-login w-100">
        Entrar
    </button>


    <!-- cadastro de novo usuário -->
    <a href="Login/cadastro.php" class="btn btn-cadastro w-100 mt-3">
        Criar cadastro
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