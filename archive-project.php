<?php
session_start();

$dados = filter_input_array(INPUT_GET);
if (!$dados['id']) {
    $_SESSION['msg'] = "<p class='alert alert-danger'>Projeto não encontrado!</p>";
    header("Location: index.php");
    exit;
}
include "conn.php";

$sql = $pdo->prepare("UPDATE projetos SET arquivado = :arquivado WHERE id = :id");
$sql->bindValue(":id", $dados['id']);
$sql->bindValue(":arquivado", $dados['arquivado']);

if (!$sql->execute()) {
    $_SESSION['msg'] = "<p class='alert alert-danger'>Erro ao arquivar o projeto!</p>";
    header("Location: index.php");
    exit;
}

if ($dados['arquivado'] == 1) {
    $_SESSION['msg'] = "<p class='alert alert-success'>Projeto arquivado com sucesso!</p>";
    header("Location: index.php");
} else {
    $_SESSION['msg'] = "<p class='alert alert-success'>Projeto desarquivado com sucesso!</p>";
    header("Location: index.php?search=check");
}
