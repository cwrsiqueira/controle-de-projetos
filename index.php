<?php
session_start();

include_once "header.php";
include "conn.php";

$busca = " WHERE arquivado = 0";
$search = filter_input(INPUT_GET, 'search');
if (!empty($search)) {
    $busca = " WHERE arquivado = 1";
}

$projetos = [];
$sql = $pdo->query("SELECT * FROM projetos $busca");
if ($sql->rowCount() > 0) {
    $projetos = $sql->fetchAll();
}

$faturamento = 0;
foreach ($projetos as $projeto) {
    $faturamento += $projeto['faturamento'];
}

?>

<div class="container">
    <h1>Controle de Projetos</h1>
    <?php
    if (!empty($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <div class="row my-3 gap-3">
        <div class="col-sm">
            <a href="add-project.php" class="btn btn-success">Adicionar Projeto</a>
        </div>
        <div class="col-sm">
            Faturamento mensal: R$ <?= number_format($faturamento, 2, ',', '.'); ?>
        </div>
        <div class="col-sm">
            <form method="get" id="form-search">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="check" id="search" name="search" onchange="document.querySelector('#form-search').submit();" <?= $search ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="search">
                        Projetos arquivados
                    </label>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Início</th>
                    <th>Andamento</th>
                    <th>Obs.</th>
                    <th>Fim</th>
                    <th>Monetização</th>
                    <th>Faturamento</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projetos as $projeto) : ?>
                    <tr>
                        <td><?= $projeto['id']; ?></td>
                        <td><?= $projeto['nome']; ?></td>
                        <td><?= $projeto['descricao']; ?></td>
                        <td><?= date("d/m/Y", strtotime($projeto['inicio'])); ?></td>
                        <td><?= $projeto['andamento']; ?></td>
                        <td><?= $projeto['obs']; ?></td>
                        <td><?= $projeto['encerramento'] == "0000-00-00" ? "00/00/0000" : date("d/m/Y", strtotime($projeto['encerramento'])); ?></td>
                        <td><?= $projeto['monetizacao']; ?></td>
                        <td><?= number_format($projeto['faturamento'], 2, ",", "."); ?></td>
                        <?php if (empty($search)) : ?>
                            <td>
                                <a title="Editar" href="edit-project.php?id=<?= $projeto['id']; ?>"><i style="font-size:20px;" class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a title="Arquivar" href="archive-project.php?id=<?= $projeto['id']; ?>&arquivado=1"><i style="font-size:20px;" class="fa-solid fa-box-archive"></i></a>
                            </td>
                        <?php else : ?>
                            <td>
                                <a title="Arquivar" href="archive-project.php?id=<?= $projeto['id']; ?>&arquivado=0"><i style="font-size:20px;" class="fa-solid fa-rotate-left"></i></a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div><?php include_once "footer.php"; ?>