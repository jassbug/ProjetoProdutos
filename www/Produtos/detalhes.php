<?php
    require_once("../conexao.php");
    require_once("../funcoes.php");

    verificarLogin(); // Verifica se o usuário está logado


    $id = pegarIdProduto();
    $produto = buscarProduto($conn, $id);

    if(!$produto){
        echo "Produto não encontrado";
        exit;
    }

    $pastaImagem = pastaImagem($produto["idCategoria"]);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $produto["nome"]; ?>
    </title>

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
            Voltar
        </a>
    </div>
</nav>



<!-- DETALHES DO PRODUTO -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">

                <!-- Imagem do produto -->
                <img
                    src="../Imagens/<?php echo $pastaImagem; ?>/<?php echo $produto["imagem"]; ?>"
                    class="card-img-top"
                    height="450"
                    style="object-fit: contain;"
                    alt="Produto">
                <div class="card-body text-center p-5">

                    <!-- Nome do produto -->
                    <h2 class="titulo">
                        <?php echo $produto["nome"]; ?>
                    </h2>


                    <!-- Descrição -->
                    <p class="mt-4">
                        <?php echo $produto["descricao"]; ?>
                    </p>


                    <!-- Preço -->
                    <h3>
                        R$ <?php echo number_format($produto["preco"], 2, ",", "."); ?>
                    </h3>
                    <br>

                    <?php

                    // Verifica se o produto está disponível
                    if($produto["disponibilidade"] == "Disponível"){

                    ?>
                        <!-- Status -->
                        <span class="badge bg-success p-2 status-badge">
                            Disponível
                        </span>
                        <br><br>

            
                        <!-- BOTÕES -->
                        <div class="d-flex justify-content-center gap-3">
                            <!-- Comprar -->
                            <a
                                href="comprar.php?id=<?php echo $produto["idProdutos"]; ?>"
                                class="btn btn-comprar">
                                🛒 Comprar Produto
                            </a>


                            <!-- Editar -->
                            <a
                                href="editar.php?id=<?php echo $produto["idProdutos"]; ?>"
                                class="btn btn-editar">
                                ✏️ Editar Produto
                            </a>
                        </div>
                    <?php

                    }else{
                    ?>
                        <!-- Produto indisponível -->
                        <span class="badge bg-warning text-dark p-2 status-badge">
                            Indisponível
                        </span>
                        <br><br>

                        <!-- Botão editar -->
                        <div class="d-flex justify-content-center">
                            <a
                                href="editar.php?id=<?php echo $produto["idProdutos"]; ?>"
                                class="btn btn-editar">
                                ✏️ Editar Produto
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<!-- Rodapé -->
<p class="rodape-login"> © 2026 • Sistema F1 Store</p>
</div>
</body>
</html>