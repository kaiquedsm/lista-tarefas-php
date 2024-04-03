<?php 

    require_once("templates/header.php");
    require_once("templates/aside.php");

?>

    <section>
        <form>
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="" value="<?= $tarefa1['titulo']?>" disabled><br>
            <label for="data_inicio">Data de início</label>
            <input type="text" name="data_inicio" id="" value="<?= $tarefa1['data_inicio']?>" disabled><br>
            <label for="data_termino">Data de término</label>
            <input type="text" name="data_termino" id="" value="<?= $tarefa1['data_termino']?>" disabled><br>
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="" value="<?= $tarefa1['descricao']?>" disabled>
        </form>
    </section>
</div>

<?php 

    require_once("templates/footer.php");

?>