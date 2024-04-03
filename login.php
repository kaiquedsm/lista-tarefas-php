<?php 

    require_once("templates/header.php");
    require_once("templates/aside.php");

?>

<form action="auth-process.php" method="POST">
        <div>
            <input type="hidden" value="login" name="type" id="login">
            <div>
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Digite seu e-mail">
            </div>
            <div>
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" placeholder="Digite sua senha">
            </div>
            <div>
                <input type="submit" name="submit" id="submit" placeholder="Enviar">
            </div>
            <div>
                <p>Não possui cadastro?</p>
                <a href="<?= $BASE_URL ?>/register.php">Cadastrar</a>
            </div>
        </div>
    </form>
</div>

<?php 

    require_once("templates/footer.php");

?>