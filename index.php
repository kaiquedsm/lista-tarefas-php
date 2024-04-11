<?php 

    require_once("templates/header.php");
    
    if($userData !== null) {
        $userTasks = $taskDAO->getTasksByUserId($userData->getId());
    } else {
        $userTasks = [];
    }

?>
<div class="container">
        <aside>
            <h3 class="aside_title">INÍCIO</h3>
            <div class="items_aside">
                <div class="item_aside">
                    <a href="task.php" class="item">Adicionar tarefa</a>
                </div>
                <div class="item_aside">
                    <span class="item" onclick="showItens(1)">Tarefas</span>
                    <ul class="hidden_list_aside" id="task_list">
                        <li>A fazer</li>
                        <li>Fazendo</li>
                        <li>Feitas</li>
                    </ul>
                </div>
                <div class="item_aside">
                    <span class="item" onclick="showItens(2)">Período</span>
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
            </div>
        </aside>
        <section>
            <?php 
                // $message->getMessage();
            ?>
            <?php if(!empty($flashMessage['msg'])): ?>
                <div class="msg-container">
                    <p class="msg <?= $flashMessage['type'] ?>"><?= $flashMessage['msg'] ?></p>
                </div>
            <?php endif; ?>
            <div class="section-articles">
                <?php if(!empty($userData) && !empty($userTasks)): ?>
                    <div class="to-do">
                        <h3>A fazer</h3>
                    </div>
                    <div class="doing">
                        <h3>Em andamento</h3>
                    </div>
                    <div class="done">
                        <h3>Concluído</h3>
                    </div>
                    <?php foreach($userTasks as $task): ?>
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
                    <?php endforeach; ?>
                <?php elseif(!empty($userData) && empty($userTasks)): ?>
                    <h2>Sem tarefas no momento</h2>
                <?php else: ?>
                    <h2>Faça o login para exibir as tarefas</h2>
                    <?php endif; ?>
                </div>
        </section>
</div>

<?php 

    require_once("templates/footer.php");

?>