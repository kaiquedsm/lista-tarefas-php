<?php 

    require_once('./models/User.php');
    require_once('./models/Message.php');
    
    class UserDAO implements UserDAOInterface {
    
    private $conn;
    private $url;
    private $message;
    
    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }
        
    public function buildUser($data) {
            
        $user = new User();
        
        $user->setId($data['id']);
        $user->setname($data['name']);
        $user->setUsername($data['username']);
        $user->setemail($data['email']);
        $user->setpassword($data['password']);
        $user->settoken($data['token']);
        
        // retorna para quem chamar esse método
        return $user;
        
    }
    public function create(User $user, $authUser = false) {
        
        $stmt = $this->conn->prepare("INSERT INTO users (
            name, username, email, password, token
        ) VALUES (
            :name, :username, :email, :password, :token      
        )");
        
        
        $stmt->bindParam(":name", $user->getName());
        $stmt->bindParam(":username", $user->getUsername());
        $stmt->bindParam(":email", $user->getEmail());
        $stmt->bindParam(":password", $user->getPassword());
        $stmt->bindParam(":token", $user->getToken());
        
        $stmt->execute();
        
        // Autenticar usuário, caso auth seja true
        if($authUser) {
            $this->setTokenToSession($user->getToken());
        }
        
    }
    public function update(User $user, $redirect = true) {
        
        $stmt = $this->conn->prepare("UPDATE users SET 
            name = :name,
            username = :username,
            email = :email,
            token = :token
            WHERE id = :id;
        ");
        
        $stmt->bindParam(":name", $user->getName());
        $stmt->bindParam(":username", $user->getUsername());
        $stmt->bindParam(":email", $user->getEmail());
        $stmt->bindParam(":token", $user->getToken());
        $stmt->bindParam(":id", $user->getId());
        
        $stmt->execute();
        
        if($redirect) {
            
            // Redireciona para o perfil do usuário
            
            $this->message->setMessage("Dados atualizados com sucesso!", "success", "/editprofile.php");
            
        }
        
    }
    public function verifyToken($protected = false) {
        
        if(!empty($_SESSION['token'])) {
            
            // Pega o token da session
            
            $token = $_SESSION['token'];
            
            $user = $this->findByToken($token);
            
            if($user) {
                // Retorna usuário para o front
                return $user;
            } else if ($protected){
                
                echo "elseif1";
                // Redireciona usuário não autenticado
                $this->message->setMessage("Faça a autenticação para acessar a página!", "error", "/index.php");
                
            }
            
        } else if ($protected){
            
            
            echo "elseif2";
            // Redireciona usuário não autenticado
            $this->message->setMessage("Faça a autenticação para acessar a página!", "error", "/index.php");
            
        }
        
    }
    public function setTokenToSession($token, $redirect = true) {
        
        // Salvar token na sessão
        $_SESSION['token'] = $token;
        
        if($redirect) {
            
            // Redireciona para o perfil do usuário
            
            $this->message->setMessage("Seja bem vindo!", "success", "editprofile.php");
            
        }
        
    }
    public function authenticateUser($email, $password) {
        
        $user = $this->findByEmail($email);
        
        if($user) {
            
            // Checar se as senhas batem
            if(password_verify($password, $user->getPassword())) {
                
                // Gerar um token e inserir na session
                
                $token = $user->generateToken();
                
                $this->setTokenToSession($token, false);
                
                // Atualizar token no usuário
                $user->setToken($token);
                
                $this->update($user, false);
                
                return true;
                
            } else {
                return false;
            }
            
        } else {
            return false;
        }
        
    }
    public function findByEmail($email) {
        
        if($email != '') {
            
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            
            $stmt->bindParam(":email", $email);
            
            $stmt->execute();
            
            if($stmt->rowCount() > 0) {
                
                $data = $stmt->fetch();
                $user = $this->buildUser($data);
                
                return $user;
                
            } else {
                return false;
            }
            
        } else {
            return false;
        }
        
    }
    public function findById($id) {
        
    }
    public function findByToken($token) {
        
        if($token != '') {
            
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
            
            $stmt->bindParam(":token", $token);
            
            $stmt->execute();
            
            if($stmt->rowCount() > 0) {
                
                $data = $stmt->fetch();
                $user = $this->buildUser($data);
                
                return $user;
                
            } else {
                return false;
            }
            
        } else {
            return false;
        }
        
    }
    public function changePassword(User $user) {
        
    }
        
    }

?>