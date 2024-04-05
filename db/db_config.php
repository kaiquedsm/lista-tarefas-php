<?php 

    // $tarefas = [
    //     [
    //         'titulo' => 'Terminar programação PHP',
    //         'data_inicio' => '13/02/2024',
    //         'data_termino' => '13/03/2024',
    //         'descricao' => 'Desenvolver site PHP'
    //     ]
    // ]
    
    $db_name = "projeto_tarefas";
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    
    $conn = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);
    
    // Habilitar erros PDO: quando fizer uma besteira no BD, irá aparecer uma mensagem na tela para fins de debug
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

?>