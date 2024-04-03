<?php 

    require_once("helpers/base_url.php");
    require_once("db/db_config.php");
    require_once('models/User.php');
    require_once('models/Message.php');
    require_once('dao/UserDAO.php');
    
    $message = new Message($BASE_URL); 
       
    $userDAO = new UserDAO($conn, $BASE_URL);
    
    echo "or<br>";
    
    $type = filter_input(INPUT_POST, "type");
    
    if($type === "register") {
        
        $name = filter_input(INPUT_POST, "name");
        $username = filter_input(INPUT_POST, "username");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirmPassword = filter_input(INPUT_POST, "confirmPassword");
        
        if($name && $username && $email && $password) {
            
            if($password === $confirmPassword) {
                
                $findEmail = $userDAO->findByEmail($email);
                
                if($findEmail === false) {
                    
                    $user = new User();
                    
                    $userToken = $user->generateToken();
                    $finalPassword = $user->generatePassword($password);
                    
                    $user->setName($name);
                    $user->setUsername($username);
                    $user->setEmail($email);
                    $user->setPassword($finalPassword);
                    $user->setToken($userToken);
                    
                    $auth = true;
                    
                    $stmt = $userDAO->create($user, $auth);
                    
                    $message->setMessage("Seja bem vindo!", "success", "/register.php");
                    
                    
                } else {
                    // Enviar mensagem de erro de usuário já existe
                    $message->setMessage("Email já cadastrado", "error", "back");
                }
                
            }
            else {
                // Enviar mensagem de erro de senhas não batem
                $message->setMessage("Senhas não se coincidem!", "error", "/?rota=register");
            }
            
        } else {
            // Enviar mensagem de erro de dados faltantes
            $message->setMessage("Por favor, preencha todos os campos.", "error", "back");
        }
        
        
    } else if ($type === "login") {
        
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        
        if(!empty($email) && !empty($password)) {
            
            $emailUser = $userDAO->authenticateUser($email, $password);
            
            if($emailUser) {
                
                $message->setMessage("Login efetuado com sucesso.", "success", "/index.php");
                
            } else {
                
                $message->setMessage("Email ou senhas incorretos!", "error", "back");
                
            }
            
        } else {
            
            $message->setMessage("Por favor, preencha todos os campos.", "error", "back");
            
        }
        
    }
    
    
    

?>