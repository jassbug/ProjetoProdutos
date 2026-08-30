<?php
require_once("conexao.php");
require_once("funcoes.php"); 


verificarLogin(); //ver se ele esta logado, se não estiver, redireciona para a página de login

//guardar a categoria selecionada, se não tiver nenhuma selecionada, 
// ele vai mostrar todos os produtos
$categoria = "";
if(isset($_GET["categoria"])){

    $categoria = $_GET["categoria"];

}

//Busca no banco os itens que tem a categoria seelecionada
$resultado = listarProdutos($conn,$categoria);

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Store - Produtos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">

</head>



<body>

<!-- Menu principal do site -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
    <a class="navbar-brand fw-bold">
        🏎 F1 Store
    </a>

    <div>

    <a href="Produtos/cadastrar.php" class="btn btn-outline-light me-2">
        Cadastrar Produto
    </a>

    <a href="Login/logout.php" class="btn btn-dark">
        Sair
    </a>
    </div>

    </div>
</nav>


<section class="hero">

    <div class="container text-center">

        <h1 class="display-4 fw-bold">
            Produtos F1
        </h1>


        <p class="lead">
            Confira todos os produtos disponíveis
        </p>

    </div>

</section>


<!--Filtros -->
<div class="container my-5">
    <div class="text-center filtro mb-5">
        <h2 class="titulo mb-4">
        Categorias
        </h2>

        <a href="principal.php" class="btn btn-danger me-2"> <!--MOstra todos os produtos -->
        Todos
        </a>

        <a href="principal.php?categoria=1" class="btn btn-outline-danger me-2"> <!--MOstra todos os que tem categoria carros -->
        🏎 Carros F1
        </a>

        <a href="principal.php?categoria=2" class="btn btn-outline-danger me-2"> <!--MOstra todos os que tem categoria acessórios -->
        🧢 Acessórios
        </a>

        <a href="principal.php?categoria=3" class="btn btn-outline-danger"> <!--MOstra todos os produtos da categoria roupas -->
        👕 Roupas
        </a>

    </div>


<!-- Criação dos cards dos produtos -->
<div class="row g-4">
<?php while($produto = mysqli_fetch_assoc($resultado)){ ?>  <!-- Percorre os produtos encontrados no banco -->

<div class="col-md-4 d-flex">
    <a href="Produtos/detalhes.php?id=<?php echo $produto["idProdutos"]; ?>" 

        class="text-decoration-none text-dark w-100">
        <div class="card shadow w-100">




        <?php
            $pastaImagem = pastaImagem($produto["idCategoria"]); // Pega a pasta da imagem de acordo com a categoria do produto.
        ?>

        <!-- Carrega a imagem do produto -->
        <img src="Imagens/<?php echo $pastaImagem; ?>/<?php echo $produto["imagem"]; ?>"
        class="card-img-top"
        alt="Produto">



        <div class="card-body text-center">
            <h4 class="mb-3">
            <?php echo $produto["nome"]; ?>
            </h4>
            <p>

            <?php echo $produto["descricao"]; ?>
            </p>


            <h5 class="mb-3">
            R$ <?php echo number_format($produto["preco"], 2, ",", "."); ?>
            </h5>

            <span class="badge <?php echo statusProduto($produto["disponibilidade"]); ?>">

                <?php echo $produto["disponibilidade"]; ?>

            </span>

            </div>
        </div>
    </a>
</div>
<?php } ?>
</div>
<!-- Rodapé -->
<p class="rodape-login">
© 2026 • Sistema F1 Store </p>
</div>
</body>
</html>
