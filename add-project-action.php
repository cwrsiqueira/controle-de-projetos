<?php
session_start();
include "conn.php";

$dados = filter_input_array(INPUT_POST);

if (empty($dados['nome'])) {
    $_SESSION['msg'] = "<p class='alert alert-danger'>O campo nome é obrigatório!</p>";
    header("Location: add-project.php");
    exit;
}

$dados['faturamento'] = str_replace(",", ".", str_replace(".", "", $dados['faturamento']));

$sql = $pdo->prepare("INSERT INTO projetos SET nome = :nome, descricao = :descricao, inicio = :inicio, andamento = :andamento, encerramento = :encerramento, monetizacao = :monetizacao, faturamento = :faturamento, obs = :obs");
$sql->bindValue(":nome", $dados['nome']);
$sql->bindValue(":descricao", $dados['descricao']);
$sql->bindValue(":inicio", $dados['inicio']);
$sql->bindValue(":andamento", $dados['andamento']);
$sql->bindValue(":encerramento", $dados['encerramento']);
$sql->bindValue(":monetizacao", $dados['monetizacao']);
$sql->bindValue(":faturamento", $dados['faturamento']);
$sql->bindValue(":obs", $dados['obs']);

if (!$sql->execute()) {
    $_SESSION['msg'] = "<p class='alert alert-danger'>Ocorreu um erro ao salvar o projeto!</p>";
    header("Location: add-project.php");
    exit;
}

$_SESSION['msg'] = "<p class='alert alert-success'>Projeto adicionado com sucesso!</p>";
header("Location: index.php");
