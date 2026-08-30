<?php
$conn = mysqli_connect(
    "mysql",
    "root",
    "1234",
    "prog_internet"
);


if(!$conn){

    die("Erro de conexão com o banco");

}

?>