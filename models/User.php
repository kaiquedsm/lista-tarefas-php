<?php 

class User {
    
    private $id;
    private $name;
    private $username;
    private $email;
    private $password;
    private $token;
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    public function getUsername() {
        return $this->username;
    }
    
    public function setUserName($username) {
        $this->username = $username;
    }
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    public function getToken() {
        return $this->token;
    }
    
    public function setToken($token) {
        $this->token = $token;
    }
    
    // Funções que retornam algo, e que não faz interação com algo, são feitas fora da DAO, ou seja, direto na classe User
    public function generateToken() {
        return bin2hex(random_bytes(50));
    }
    
    public function generatePassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
}

interface UserDAOInterface {
    public function buildUser($data);
    public function create(User $user, $authUser = false);
    public function update(User $user);
    public function verifyToken($protected = false);
    public function setTokenToSession($token, $redirect = true);
    public function authenticateUser($email, $password);
    public function findByEmail($email);
    public function findById($id);
    public function findByToken($token);
    public function changePassword(User $user);
}

?>