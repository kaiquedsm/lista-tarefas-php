<?php 

    require_once("templates/header.php");
    require_once("dao/TaskDAO.php");
    
    
    $id = filter_input(INPUT_GET, "id");
    $task = $taskDAO->findById($id);

?>

    <section>
        <form action="task-process.php" method="POST" class="form" id="form-task">
            <?php if(!$id): ?>
                <input type="hidden" name="type" id="" value="create">
                <div class="form-control">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="">
                </div>
                <div class="form-control">
                    <label for="data_inicio">Data de início</label>
                    <input type="date" name="data_inicio" id="">
                </div>
                <div class="form-control">
                    <label for="data_termino">Data de término</label>
                    <input type="date" name="data_termino" id="">
                </div>
                <div class="form-control">
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" id=""rows="5"></textarea>
                </div>
                <input type="submit" name="" value="Adicionar">
            <?php else: ?>
                <input type="hidden" name="type" id="" value="edit">
                <input type="hidden" name="id" id="" value="<?= $task->getId() ?>">
                <div class="form-control">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="" value="<?= $task->getTitulo() ?>"><br>
                </div>
                <div class="form-control">
                    <label for="data_inicio">Data de início</label>
                    <input type="date" name="data_inicio" id="" value="<?= $task->getDataInicio() ?>"><br>
                </div>
                <div class="form-control">
                    <label for="data_termino">Data de término</label>
                    <input type="date" name="data_termino" id="" value="<?= $task->getDataTermino() ?>"><br>
                </div>
                <div class="form-control">
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" id=""rows="5"><?= $task->getDescricao() ?></textarea>
                </div>
                <div class="form-control">
                    <input type="submit" name="" value="Editar">
                </div>
            <?php endif; ?>
        </form>
    </section>
</div>

<?php 

    require_once("templates/footer.php");

?>