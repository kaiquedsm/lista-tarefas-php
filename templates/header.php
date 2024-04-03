<?php 

    require_once("helpers/base_url.php");
    require_once('db/db_config.php');
    require_once('dao/TaskDAO.php');
    require_once('dao/UserDAO.php');
    require_once("models/Message.php");
    
    $task = new TaskDAO($conn);
    $userDAO = new UserDAO($conn, $BASE_URL);
    $message = new Message($BASE_URL);
    
    $userData = $userDAO->verifyToken(false);
    $findTasks = $task->findAll();    
    
    $flashMessage = $message->getMessage();
    
    if(!empty($flashMessage['msg'])) {
        // Limpar a mensagem
        $message->clearMessage();
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <header>
        <div class="logo">
            <span>LOGO</span>
        </div>
        <nav>
            <?php if($userData): ?>
                <span><?= $userData->getName() ?></span>
            <?php endif; ?>
            <span>Menu</span>
            <span>Sobre</span>
            <span>Contatos</span>  
        </nav>
    </header>