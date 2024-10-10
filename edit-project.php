<?php
session_start();
include_once "header.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id) {
    $_SESSION['msg'] = "<p class='alert alert-danger'>Projeto não encontrado!</p>";
    header("Location: index.php");
    exit;
}
include "conn.php";

$projeto = [];
$sql = $pdo->prepare("SELECT * FROM projetos WHERE id = :id");
$sql->bindValue(":id", $id);
$sql->execute();

if ($sql->rowCount() > 0) {
    $projeto = $sql->fetch();
}

?>

<div class="container">
    <h1>Adicionar Projeto</h1>
    <?php
    if (!empty($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <div class="form-group">
        <form action="edit-project-action.php" method="post">

            <input type="hidden" name="id" value="<?= $projeto['id']; ?>">

            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= $projeto['nome']; ?>">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" value="<?= $projeto['descricao']; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="inicio" class="form-label">Início</label>
                        <input type="date" class="form-control" id="inicio" name="inicio" value="<?= $projeto['inicio']; ?>">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="andamento" class="form-label">Andamento</label>
                        <input type="text" class="form-control" id="andamento" name="andamento" value="<?= $projeto['andamento']; ?>">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="encerramento" class="form-label">Encerramento</label>
                        <input type="date" class="form-control" id="encerramento" name="encerramento" value="<?= $projeto['encerramento']; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="monetizacao" class="form-label">Monetização</label>
                        <input type="text" class="form-control" id="monetizacao" name="monetizacao" value="<?= $projeto['monetizacao']; ?>">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="faturamento" class="form-label">Faturamento</label>
                        <input type="text" class="form-control" id="faturamento" name="faturamento" value="<?= $projeto['faturamento']; ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="obs" class="form-label">obs</label>
                <textarea name="obs" id="obs" class="form-control"><?= $projeto['obs']; ?></textarea>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <button class="btn btn-success" type="submit">Salvar</button>
                <a href="index.php" class="btn btn-info">Voltar</a>
            </div>
        </form>
    </div>
</div>
<?php include_once "footer.php"; ?>