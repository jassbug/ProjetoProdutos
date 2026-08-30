<?php

// ===============================
// LOGIN
// ===============================
// Verifica se o usuário está logado antes de acessar as páginas
function verificarLogin(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(!isset($_SESSION["usuario"])){
        header("location:../index.php");
        exit;
    }
}




// ===============================
// PRODUTOS
// ===============================

// Busca os produtos no banco de dados podendo filtrar por categoria
function listarProdutos($conn,$categoria=""){
    if($categoria != ""){
        $sql = "SELECT * FROM Produtos WHERE idCategoria=$categoria";
    }else{
        $sql = "SELECT * FROM Produtos";
    }
    return mysqli_query($conn,$sql);
}


// Busca as categorias cadastradas no banco
function listarCategorias($conn){
    $sql = "SELECT idCategorias AS id, categoria FROM Categorias";
    return mysqli_query($conn,$sql);
}


// Busca um produto específico pelo seu ID
function buscarProduto($conn,$id){
    $sql = "SELECT * FROM Produtos WHERE idProdutos = $id";
    $resultado = mysqli_query($conn,$sql);
    return mysqli_fetch_assoc($resultado);
}


function pegarIdProduto(){
    if(!isset($_GET["id"])){
        echo "Produto não informado";
        exit;
    }
    return $_GET["id"];
}

function pastaImagem($categoria){
    if($categoria == 1){
        return "Carros";
    }elseif($categoria == 2){
        return "Acessórios";
    }elseif($categoria == 3){
        return "Roupas";
    }
}

// Define a classe CSS de acordo com a disponibilidade do produto
function statusProduto($status){
    if($status == "Disponível"){
        return "status-disponivel";
    }else{
        return "status-indisponivel";
    }
}


function atualizarProduto(
$conn,
$id,
$nome,
$descricao,
$categoria,
$preco,
$disponibilidade,
$imagem
){

    if($imagem != ""){
        $sql = "UPDATE Produtos SET
        nome='$nome',
        descricao='$descricao',
        preco='$preco',
        disponibilidade='$disponibilidade',
        idCategoria='$categoria',
        imagem='$imagem'
        WHERE idProdutos=$id";
    }else{
        $sql = "UPDATE Produtos SET
        nome='$nome',
        descricao='$descricao',
        preco='$preco',
        disponibilidade='$disponibilidade',
        idCategoria='$categoria'
        WHERE idProdutos=$id";
    }
    return mysqli_query($conn,$sql);
}

function excluirProduto($conn,$id){
    $sql = "DELETE FROM Produtos WHERE idProdutos=$id";
    return mysqli_query($conn,$sql);
}

function finalizarCompra($conn,$id){
    $sql = "UPDATE Produtos SET disponibilidade='Indisponível' WHERE idProdutos=$id";
    return mysqli_query($conn,$sql);
}

// Salva a imagem do produto na pasta correspondente à categoria
function salvarImagem($imagem,$categoria){
    $pasta = "../Imagens/";
    if($categoria == 1){
        $pasta = $pasta . "Carros/";
    }elseif($categoria == 2){
        $pasta = $pasta . "Acessórios/";
    }elseif($categoria == 3){
        $pasta = $pasta . "Roupas/";
    }
    $nomeImagem = $imagem["name"];
    move_uploaded_file(
        $imagem["tmp_name"],
        $pasta . $nomeImagem
    );
    return $nomeImagem;
}




// ===============================
// USUÁRIOS
// ===============================
// Cadastra um novo usuário
function cadastrarUsuario($conn,$email,$senha){
    // Verifica se o email já existe
    $verificar = "SELECT * FROM Usuario WHERE email='$email'";
    $resultado = mysqli_query($conn,$verificar);
    if(mysqli_num_rows($resultado) > 0){
        return "existe";
    }

    // Insere o usuário no banco
    $sql = "INSERT INTO Usuario(email,senha) 
            VALUES ('$email','$senha')";
    if(mysqli_query($conn,$sql)){
        return true;
    }
    else{
        return false;
    }
}

// Verifica se o usuário consegue fazer login
function verificarUsuario($conn,$email,$senha){
    $sql = "SELECT * FROM Usuario 
            WHERE email='$email'
            AND senha='$senha'";
    $resultado = mysqli_query($conn,$sql);

    if(mysqli_num_rows($resultado) > 0){
        return true;
    }else{
        return false;
    }
}
