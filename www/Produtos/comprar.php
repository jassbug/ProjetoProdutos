<?php
    require_once("../conexao.php");
    require_once("../funcoes.php");

    verificarLogin();
    $id = pegarIdProduto();
    $produto = buscarProduto($conn, $id);
    

    // Verifica se o produto existe
    if(!$produto){
        echo "Produto não encontrado";
        exit;
    }

    $pastaImagem = pastaImagem($produto["idCategoria"]);

    // Verifica se o botão comprar foi enviado
    if(isset($_POST["comprar"])){
        finalizarCompra($conn, $id);
        header("location:../principal.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar Produto - F1 Store</title>

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



<!-- COMPRA -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-lg">

                <!-- Imagem do produto -->
                <img
                    src="../Imagens/<?php echo $pastaImagem; ?>/<?php echo $produto["imagem"]; ?>"
                    class="card-img-top"
                    height="400"
                    style="object-fit: contain;"
                    alt="Produto">
                <div class="card-body text-center p-5">

                    <!-- Título -->
                    <h2 class="titulo">
                        Confirmar Compra
                    </h2>
                    <hr>

                    <!-- Nome -->
                    <h3>
                        <?php echo $produto["nome"]; ?>
                    </h3>

                    <!-- Descrição -->
                    <p class="mt-3">
                        <?php echo $produto["descricao"]; ?>
                    </p>

                    <!-- Preço -->
                    <h2>
                        R$ <?php echo number_format($produto["preco"], 2, ",", "."); ?>
                    </h2>

                    <?php
                        if($produto["disponibilidade"] == "Disponível"){
                    ?>

                    <!-- Status -->
                    <span class="badge bg-success p-2 status-badge">
                         Produto disponível
                    </span>

                    <br><br>

                    <!-- Formulário da compra -->
                    <form method="POST">
                        <button
                            type="submit"
                            name="comprar"
                            class="btn btn-comprar"
                            onclick="return confirm('Confirmar compra deste produto?');">
                            🛒 Finalizar Compra
                        </button>
                    </form>
                    <?php
                    }else{

                    ?>
                    <!-- Produto indisponível -->
                    <span class="badge bg-warning text-dark p-2 status-badge">
                        Produto indisponível
                    </span>
                    <?php
                    }
                    ?>
                    <br><br>

                    <!-- Voltar -->
                    <a
                        href="detalhes.php?id=<?php echo $produto["idProdutos"]; ?>"
                        class="btn btn-secondary">
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Rodapé -->
<p class="rodape-login">
© 2026 • Sistema F1 Store </p>
</div>
</body>
</html>