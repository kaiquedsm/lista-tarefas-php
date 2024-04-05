<?php 

    require_once("templates/header.php");

?>
<div class="container">
        <aside>
            <h3 class="aside_title">INÍCIO</h3>
            <div class="item_aside">
                <span class="item" onclick="showItens(0)">Tarefas</span>
                <ul class="hidden_list_aside" id="task_list">
                    <li>A fazer</li>
                    <li>Fazendo</li>
                    <li>Feitas</li>
                </ul>
            </div>
            <div class="item_aside">
                <span class="item" onclick="showItens(1)">Período</span>
                <ul class="hidden_list_aside" id="period_list">
                    <li> Mês
                        <ul>
                            <li>Todos os meses</li>
                        </ul>
                    </li>
                    <li> Ano
                        <ul>
                            <li> Todos os anos</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
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