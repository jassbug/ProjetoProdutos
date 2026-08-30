<?php

require_once("../conexao.php");
require_once("../funcoes.php");


verificarLogin();
$id = pegarIdProduto();
$produto = buscarProduto($conn,$id);

// Verifica se o produto existe
if(!$produto){
    echo "Produto não encontrado";
    exit;
}

$categorias = listarCategorias($conn);
if(isset($_POST["salvar"])){
    $imagem = "";
    // Verifica se foi selecionada uma nova imagem
    if($_FILES["imagem"]["name"] != ""){
        $imagem = salvarImagem(
            $_FILES["imagem"],
            $_POST["categoria"]
        );
    }

    // Atualiza o produto
    atualizarProduto(
        $conn,
        $id,
        $_POST["nome"],
        $_POST["descricao"],
        $_POST["categoria"],
        $_POST["preco"],
        $_POST["disponibilidade"],
        $imagem
    );

    header("location:../principal.php");
    exit;
}


// Verifica se o botão excluir foi enviado
if(isset($_POST["excluir"])){
    excluirProduto($conn,$id);
    header("location:../principal.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto - F1 Store</title>
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
        <a href="../principal.php" class="btn btn-light">
            Produtos
        </a>
    </div>
</nav>



<!-- EDITAR PRODUTO -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <!-- Título -->
                    <div class="text-center mb-4">
                        <h2 class="titulo">
                            ✏️ Editar Produto
                        </h2>
                        <p class="text-muted">
                            Altere os dados do produto
                        </p>
                    </div>



                    <form method="POST" enctype="multipart/form-data">
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
                                    value="<?php echo $produto["nome"]; ?>"
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
                                    required><?php echo $produto["descricao"]; ?></textarea>
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
                                        <option
                                            value="<?php echo $categoria["id"]; ?>"
                                            <?php
                                            if($produto["idCategoria"] == $categoria["id"]){
                                                echo "selected";
                                            }
                                            ?>>
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
                                    step="0.01"
                                    min="0"
                                    name="preco"
                                    class="form-control"
                                    value="<?php echo $produto["preco"]; ?>"
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
                                    class="form-control">
                                <small class="text-muted">
                                    Imagem atual:
                                    <?php echo $produto["imagem"]; ?>
                                </small>
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
                                        <?php
                                        if($produto["disponibilidade"] == "Disponível"){
                                            echo "checked";
                                        }
                                        ?>
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
                                        value="Indisponível"
                                        <?php
                                        if($produto["disponibilidade"] == "Indisponível"){
                                            echo "checked";
                                        }
                                        ?>>

                                    <label class="form-check-label">
                                        Indisponível
                                    </label>
                                </div>
                            </div>
                        </div>


                        <!-- Salvar -->
                        <button type="submit" name="salvar" class="btn btn-editar w-100">
                            Salvar Alterações
                        </button>
                        <br><br>

                        <!-- Excluir -->
                        <button type="submit" name="excluir" class="btn btn-danger w-100" onclick="return confirm('Deseja realmente excluir este produto?');">
                            🗑 Excluir Produto
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