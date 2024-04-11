<article>
    <?= $task->getTitulo() ?>
    <p>Início: <?= $task->getDataInicio() ?></p>
    <p>Término: <?= $task->getDataTermino() ?></p>
    <div class="task-buttons">
        <div class="button-task">
            <button>
                <a href="task.php?id=<?= $task->getId() ?>">Editar</a>
            </button>
        </div>
        <form action="task-process.php" method="POST">
            <input type="hidden" name="type" value="delete">
            <input type="hidden" name="id" value="<?= $task->getId() ?>">
            <div class="button-task">
                <input type="submit" name="" value="Deletar">
            </div>
        </form>
    </div>
</article>       