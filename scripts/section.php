<section>
            <div class="section-articles">
                <?php foreach($tarefas as $tarefa): ?>
                    <a href="?rota=tarefa1">
                        <article><?= $tarefa['titulo'] ?></article>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>
    </div>