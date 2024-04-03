<?php 

    require_once("templates/header.php");
    require_once("templates/aside.php");

?>

        <section>
        <?php 
            $message->getMessage();
        ?>
        <?php if(!empty($flashMessage['msg'])): ?>
            <div class="msg-container">
                <p class="msg <?= $flashMessage['type'] ?>"><?= $flashMessage['msg'] ?></p>
            </div>
        <?php endif; ?>
        <div class="section-articles">
            <?php foreach((array)$findTasks as $task): ?>
                <a href="?rota=tarefa1">
                    <article><?= $task->getTitulo() ?></article>
                </a>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<?php 

    require_once("templates/footer.php");

?>