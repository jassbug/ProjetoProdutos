<?php

require_once("../conexao.php");
require_once("../funcoes.php");


// Verifica se o usuário está logado
verificarLogin();


// Busca as categorias cadastradas no banco
$categorias = listarCategorias($conn);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto - F1 Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilo.css">
</head>


<body>
<!-- MENU -->
<nav class="navbar navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="../principal.php">
            🏎 F1 Store
        </a>
        <div>
            <a href="../principal.php" class="btn btn-light me-2">
                Produtos
            </a>
            <a href="../Login/logout.php" class="btn btn-dark">
                Sair
            </a>
        </div>
    </div>
</nav>


<!-- CADASTRO -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="titulo">
                            ➕ Cadastrar Produto
                        </h2>

                        <p class="text-muted">
                            Preencha os dados do produto
                        </p>
                    </div>

                    <form action="salvar.php" method="POST" enctype="multipart/form-data">
                        <!-- Nome -->
                        <div class="row mb-3 align-items-center">
                            <label class="col-md-3 col-form-label">
                                Nome do Produto
                            </label>
                            <div class="col-md-9">
                                <input
                                    type="text"
                                    name="nome"
                                    class="form-control"
                                    placeholder="Digite o nome do produto"
                                    required>
                            </div>
                        </div>



                        <!-- Descrição -->
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">
                                Descrição
                            </label>
                            <div class="col-md-9">
                                <textarea
                                    class="form-control"
                                    rows="3"
                                    name="descricao"
                                    placeholder="Digite a descrição"
                                    required></textarea>
                            </div>
                        </div>



                        <!-- Categoria -->
                        <div class="row mb-3 align-items-center">
                            <label class="col-md-3 col-form-label">
                                Categoria
                            </label>
                            <div class="col-md-9">
                                <select class="form-select" name="categoria" required>
                                    <option value="">
                                        Selecione uma categoria
                                    </option>

                                    <?php while($categoria = mysqli_fetch_assoc($categorias)){ ?>
                                        <option value="<?php echo $categoria["id"]; ?>">
                                            <?php echo $categoria["categoria"]; ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                            </div>
                        </div>


                        <!-- Preço -->
                        <div class="row mb-3 align-items-center">
                            <label class="col-md-3 col-form-label">
                                Preço
                            </label>
                            <div class="col-md-9">
                                <input
                                    type="number"
                                    name="preco"
                                    step="0.01"
                                    min="0"
                                    class="form-control"
                                    placeholder="R$ 0,00"
                                    required>
                            </div>
                        </div>


                        <!-- Imagem -->
                        <div class="row mb-3 align-items-center">
                            <label class="col-md-3 col-form-label">
                                Foto do Produto
                            </label>
                            <div class="col-md-9">
                                <input
                                    type="file"
                                    name="imagem"
                                    class="form-control"
                                    required>
                            </div>
                    </div>



                        <!-- Disponibilidade -->
                        <div class="row mb-4 align-items-center">
                            <label class="col-md-3 col-form-label">
                                Disponibilidade
                            </label>
                            <div class="col-md-9">
                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="disponibilidade"
                                        value="Disponível"
                                        required>
                                    <label class="form-check-label">
                                        Disponível
                                    </label>
                                </div>


                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="disponibilidade"
                                        value="Indisponível">
                                    <label class="form-check-label">
                                        Indisponível
                                    </label>
                                </div>
                            </div>
                        </div>


                        <!-- Cadastrar -->
                        <button
                            type="submit"
                            class="btn btn-cadastrar w-100">
                            Cadastrar Produto
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Rodapé -->
<p class="rodape-login">
    © 2026 • Sistema F1 Store
</p>
</body>
</html>