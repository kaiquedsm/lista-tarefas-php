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
            
            // retorna para quem chamar esse método
            return $task;
        }
        
        public function create(Task $task) {
            
            $query = "INSERT INTO tarefas (titulo, data_inicio, data_termino, descricao) VALUES (:titulo, :data_inicio, :data_termino, :descricao)";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":titulo", $task->getTitulo());
            $stmt->bindParam(":data_inicio", $task->getDataInicio());
            $stmt->bindParam(":data_termino", $task->getDataTermino());
            $stmt->bindParam(":descricao", $task->getDescricao());
            
            $stmt->execute();
            
            $this->message->setMessage("Tarefa adicionada com sucesso", "success", "/index.php");
            
        }
        
        public function update (Task $task) {
            
            $query = "UPDATE tarefas SET titulo = :titulo, data_inicio = :data_inicio, data_termino = :data_termino, descricao = :descricao WHERE id = :id";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":titulo", $task->getTitulo());
            $stmt->bindParam(":data_inicio", $task->getDataInicio());
            $stmt->bindParam(":data_termino", $task->getDataTermino());
            $stmt->bindParam(":descricao", $task->getDescricao());
            $stmt->bindParam(":id", $task->getId());
            
            $stmt->execute();
            
            $this->message->setMessage("Tarefa atualizada com sucesso", "success", "/index.php");
            
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
        
        public function delete (Task $task) {
            
            $query = "DELETE FROM projeto_tarefas WHERE id = :id";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":id", $task->getId());
            
            $stmt->execute();           
            
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
                
                $tasks[] = $task;
                
            }
            
            return $tasks;
            
        }
        
    } 

?>