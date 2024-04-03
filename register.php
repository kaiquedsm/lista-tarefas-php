<?php 

    require_once("templates/header.php");
    require_once("templates/aside.php");

?>
    <form action="auth-process.php" method="POST">
        <div>
            <input type="hidden" value="register" name="type" id="register">
            <div>
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" placeholder="Digite seu nome">
            </div>
            <div>
                <label for="username">Usuário</label>
                <input type="text" name="username" id="username" placeholder="Digite seu nome de usuário">
            </div>
            <div>
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Digite seu e-mail">
            </div>
            <div>
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" placeholder="Digite sua senha">
            </div>
            <div>
                <label for="confirmPassword">Confirmar senha</label>
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirme sua senha">
            </div>
            <div>
                <input type="submit" name="submit" id="submit" placeholder="Enviar">
            </div>
            <div>
                <p>Já possui cadastro?</p>
                <a href="<?= $BASE_URL ?>/login.php">Fazer login</a>
            </div>
        </div>
    </form>
    <?php if(!empty($flashMessage['msg'])): ?>
        <div class="msg-container">
            <p class="msg <?= $flashMessage['type'] ?>"><?= $flashMessage['msg'] ?>TESTE</p>
        </div>
    <?php endif; ?>
    <?php $message->getMessage() ?>
</div>

<?php 

    require_once("templates/footer.php");

?>