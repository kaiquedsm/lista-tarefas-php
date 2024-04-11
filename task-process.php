<?php 

    require_once("helpers/base_url.php");
    require_once("db/db_config.php");
    require_once("models/Task.php");
    require_once("models/Message.php");
    require_once("dao/TaskDAO.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);
    $taskDAO = new TaskDAO($conn, $BASE_URL);    
    $userDAO = new UserDAO($conn, $BASE_URL);    
    $type = filter_input(INPUT_POST, "type");
    
    $userData = $userDAO->verifyToken(false);
    
    if($userData !== null) {
        $userId = $userData->getId();
    } else {
        $message->setMessage("Faça o login para adicionar tarefas", "error", "/index.php");
    }
    
    
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
            $task->setUserId($userData->getId());
            $task->setStatusId(1);
            
            $taskDAO->create($task);
            
        } else {
            
            $message->setMessage("Insira todos os dados", "error", "back");
            
        }
        
        
    } elseif($type === "edit") {
        
        $titulo = filter_input(INPUT_POST, "titulo");
        $data_inicio = filter_input(INPUT_POST, "data_inicio");  
        $data_termino = filter_input(INPUT_POST, "data_termino");  
        $descricao = filter_input(INPUT_POST, "descricao");
        $status_id = filter_input(INPUT_POST, "status");
        $id = filter_input(INPUT_POST, "id");
        
        $taskData = $taskDAO->findById($id);
        
        if($taskData) {
            
            $taskData->setTitulo($titulo);
            $taskData->setDataInicio($data_inicio);
            $taskData->setDataTermino($data_termino);
            $taskData->setDescricao($descricao);            
            $taskData->setStatusId($status_id);            
            
            $taskDAO->update($taskData);
            
        } else {
            
            $message->setMessage("Insira todos os dados", "success", "/task.php");
            
        }
        
    } elseif($type === "delete") {
        
        $id = filter_input(INPUT_POST, "id");
        
        $taskDAO->delete($id);
        
    }

?>