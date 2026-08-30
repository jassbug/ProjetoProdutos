<?php


include("../conexao.php");


$id = $_POST["id"];
$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$categoria = $_POST["categoria"];
$preco = $_POST["preco"];
$disponibilidade = $_POST["disponibilidade"];


// define a pasta da imagem
if($categoria == 1){
    $pastaImagem = "Carros";
}elseif($categoria == 2){
    $pastaImagem = "Acessórios";
}elseif($categoria == 3){
    $pastaImagem = "Roupas";
}



// verifica se escolheu uma nova imagem 
if($_FILES["imagem"]["name"] != ""){
    $imagem = $_FILES["imagem"]["name"];
    $temporario = $_FILES["imagem"]["tmp_name"];
    move_uploaded_file(
        $temporario,
        "../Imagens/".$pastaImagem."/".$imagem
    );


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

$resultado = mysqli_query($conn,$sql);
if($resultado){
    header("location:../principal.php");
}else{
    echo "Erro ao atualizar produto";
}
?>