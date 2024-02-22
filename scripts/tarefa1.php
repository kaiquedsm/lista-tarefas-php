<?php 
    include_once('../data/tarefas.php')
?>    
    <section>
        <form>
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="" value="<?= $tarefas[0]['titulo']?>" disabled><br>
            <label for="data_inicio">Data de início</label>
            <input type="text" name="data_inicio" id="" value="<?= $tarefas[0]['data_inicio']?>" disabled><br>
            <label for="data_termino">Data de término</label>
            <input type="text" name="data_termino" id="" value="<?= $tarefas[0]['data_termino']?>" disabled><br>
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="" value="<?= $tarefas[0]['descricao']?>" disabled>
        </form>
    </section>
</div>