<?php
session_start();
include_once "header.php";
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
        <form action="add-project-action.php" method="post">

            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="inicio" class="form-label">Início</label>
                        <input type="date" class="form-control" id="inicio" name="inicio" value="<?= date("Y-m-d") ?>">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="andamento" class="form-label">Andamento</label>
                        <input type="text" class="form-control" id="andamento" name="andamento">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="encerramento" class="form-label">Encerramento</label>
                        <input type="date" class="form-control" id="encerramento" name="encerramento">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="monetizacao" class="form-label">Monetização</label>
                        <input type="text" class="form-control" id="monetizacao" name="monetizacao">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="faturamento" class="form-label">Faturamento</label>
                        <input type="text" class="form-control" id="faturamento" name="faturamento">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="obs" class="form-label">obs</label>
                <textarea name="obs" id="obs" class="form-control"></textarea>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <button class="btn btn-success" type="submit">Salvar</button>
                <button class="btn btn-warning" type="reset">Limpar</button>
                <a href="index.php" class="btn btn-info">Voltar</a>
            </div>
        </form>
    </div>
</div>
<?php include_once "footer.php"; ?>