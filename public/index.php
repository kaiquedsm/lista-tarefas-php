<?php 

    session_start();
    
    $rota = $_GET['rota'] ?? 'main';
    
    // if(!isset($_SESSION['usuario']) && !isset($_SESSION['senha'])) {
    //     $rota = 'login';
    // }
    
    
    
    $script = null;
    
    switch($rota) { 
        case 'main':
            $script = 'section.php';
            break;
        case 'tarefa1':
            $script = 'tarefa1.php';
            break;
        case 'login':
            $script = 'login.php';
            break;
    }
    
    if($rota != 'login') { 
        
        require_once('../data/tarefas.php');
        
        require_once __DIR__ . "/../inc/header.php";
        
        require_once __DIR__ . "/../inc/aside.php";
        
    }
    
    require_once __DIR__ . "/../scripts/$script";
    
    
    if($rota != 'login') { 
        
        require_once __DIR__ . "/../inc/footer.php";
        
    } 
    
?>

