<?php


include("../conexao.php");


// recebendo dados do formulário
$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$categoria = $_POST["categoria"];
$preco = $_POST["preco"];
$disponibilidade = $_POST["disponibilidade"];

//a parte de separar a imagem eu pesquisei na internet pra organizar melhor as imagens
// recebendo imagem
$imagem = $_FILES["imagem"]["name"];
// escolhendo a pasta conforme categoria
if($categoria == 1){
    $pasta = "../Imagens/Carros/";
}elseif($categoria == 2){
    $pasta = "../Imagens/Acessórios/";
}elseif($categoria == 3){
    $pasta = "../Imagens/Roupas/";
}


// caminho completo da imagem
$caminho = $pasta . $imagem;


// salvar imagem na pasta
move_uploaded_file(
    $_FILES["imagem"]["tmp_name"],
    $caminho
);


// inserir produto no banco
$sql = "INSERT INTO Produtos
(nome, descricao, preco, disponibilidade, idCategoria, imagem)
VALUES
('$nome',
'$descricao',
'$preco',
'$disponibilidade',
'$categoria',
'$imagem')";

$resultado = mysqli_query($conn, $sql);

if($resultado){
    echo "<script> alert('Produto cadastrado com sucesso!'); window.location.href='../principal.php'; </script>";
}else{
    echo "<script> alert('Erro ao cadastrar produto!'); window.history.back(); </script>";
}
?>