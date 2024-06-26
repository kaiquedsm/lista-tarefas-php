<?php 

    require_once('models/Task.php');
    require_once("models/Message.php");
    
    class TaskDAO implements TaskDAOInterface {
        
        private $conn;
        private $url;
        private $message;
        
        public function __construct(PDO $conn, $url) {
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }
        
        public function buildTask($data) {
            $task = new Task();
            
            $task->setId($data['id']);
            $task->setTitulo($data['titulo']);
            $task->setDataInicio($data['data_inicio']);
            $task->setDataTermino($data['data_termino']);
            $task->setDescricao($data['descricao']);
            $task->setUserId($data['user_id']);
            $task->setStatusId($data['status_id']);
            
            // retorna para quem chamar esse método
            return $task;
        }
        
        public function create(Task $task) {
            
            $query = "INSERT INTO tarefas (titulo, data_inicio, data_termino, descricao, user_id, status_id) VALUES (:titulo, :data_inicio, :data_termino, :descricao, :user_id, :status_id)";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":titulo", $task->getTitulo());
            $stmt->bindParam(":data_inicio", $task->getDataInicio());
            $stmt->bindParam(":data_termino", $task->getDataTermino());
            $stmt->bindParam(":descricao", $task->getDescricao());
            $stmt->bindParam(":user_id", $task->getUserId());
            $stmt->bindParam(":status_id", $task->getStatusId());
            
            $stmt->execute();
            
            $this->message->setMessage("Tarefa adicionada com sucesso", "success", "/index.php");
            
        }
        
        public function update (Task $task) {
            
            $query = "UPDATE tarefas SET titulo = :titulo, data_inicio = :data_inicio, data_termino = :data_termino, descricao = :descricao, status_id = :status_id WHERE id = :id";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":titulo", $task->getTitulo());
            $stmt->bindParam(":data_inicio", $task->getDataInicio());
            $stmt->bindParam(":data_termino", $task->getDataTermino());
            $stmt->bindParam(":descricao", $task->getDescricao());
            $stmt->bindParam(":status_id", $task->getStatusId());
            $stmt->bindParam(":id", $task->getId());
            
            $stmt->execute();
            
            $this->message->setMessage("Tarefa atualizada com sucesso", "success", "/index.php");
            
        }
        
        public function getTasksByStatusId($id) {
            
            $query = "SELECT * FROM tarefas WHERE status_id = :status_id";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":status_id", $id);
            
            $stmt->execute();            
            
        }
        
        public function getTasksByUserId($id) {
            
            $tasks = [];
            
            $query = "SELECT * FROM tarefas WHERE user_id = :user_id";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":user_id", $id);
            
            $stmt->execute();
            
            if($stmt->rowCount() > 0) {
                
                $taskData = $stmt->fetchAll();
                
                foreach($taskData as $task) {
                    $tasks[] = $this->buildTask($task);
                }
                
            }
            
            return $tasks;
            
        }
        
        public function findById ($id) {
            
            $task = [];
            
            $query = "SELECT * FROM tarefas WHERE id = :id";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
            
            if($stmt->rowCount() > 0) {
                
                $taskData = $stmt->fetch();
                
                $task = $this->buildTask($taskData);
                
                return $task;
                
            }
            
            
        }
        
        public function delete ($id) {
            
            $query = "DELETE FROM tarefas WHERE id = :id";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();          
            
            $this->message->setMessage("Tarefa excluída com sucesso", "success", "/index.php");
            
        }
        
        public function findAll () {
            
            $tasks = [];
            
            $query = "SELECT * FROM tarefas";
            
            $stmt = $this->conn->query($query);
            
            $data = $stmt->fetchAll();
            
            foreach ($data as $item) {
                
                $task = new task();
                
                $task->setId($item['id']);
                $task->setTitulo($item['titulo']);
                $task->setDataInicio($item['data_inicio']);
                $task->setDataTermino($item['data_termino']);
                $task->setDescricao($item['descricao']);
                $task->setUserId($item['user_id']);
                $task->setStatusId($item['status_id']);
                
                $tasks[] = $task;
                
            }
            
            return $tasks;
            
        }
        
    } 

?>