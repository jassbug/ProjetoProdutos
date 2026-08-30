<?php
session_start();

// remove todas as variáveis da sessão
session_destroy();

// redireciona para login
header("Location: ../index.php");
exit;
?>