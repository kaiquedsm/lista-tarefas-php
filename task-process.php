<?php 

    require_once("helpers/base_url.php");
    require_once("db/db_config.php");
    require_once("models/Task.php");
    require_once("models/Message.php");
    require_once("dao/TaskDAO.php");

    $message = new Message($BASE_URL);
    $taskDAO = new TaskDAO($conn, $BASE_URL);    
    $type = filter_input(INPUT_POST, "type");
    
    if($type === "create") {
        
        $titulo = filter_input(INPUT_POST, "titulo");
        $data_inicio = filter_input(INPUT_POST, "data_inicio");  
        $data_termino = filter_input(INPUT_POST, "data_termino");  
        $descricao = filter_input(INPUT_POST, "descricao");
        
        $task = new Task();
        
        if(!empty($titulo) && !empty($data_inicio) && !empty($data_termino) && !empty($descricao)) {
            
            $task->setTitulo($titulo);
            $task->setDataInicio($data_inicio);
            $task->setDataTermino($data_termino);
            $task->setDescricao($descricao);
            
            $taskDAO->create($task);
            
        } else {
            
            $message->setMessage("Insira todos os dados", "success", "/task.php");
            
        }
        
    } elseif($type === "edit") {
        
        $titulo = filter_input(INPUT_POST, "titulo");
        $data_inicio = filter_input(INPUT_POST, "data_inicio");  
        $data_termino = filter_input(INPUT_POST, "data_termino");  
        $descricao = filter_input(INPUT_POST, "descricao");
        $id = filter_input(INPUT_POST, "id");
        
        $taskData = $taskDAO->findById($id);
        
        if($taskData) {
            
            $taskData->setTitulo($titulo);
            $taskData->setDataInicio($data_inicio);
            $taskData->setDataTermino($data_termino);
            $taskData->setDescricao($descricao);
            
            
            
            $taskDAO->update($taskData);
            
        } else {
            
            $message->setMessage("Insira todos os dados", "success", "/task.php");
            
        }
        
    }

?>