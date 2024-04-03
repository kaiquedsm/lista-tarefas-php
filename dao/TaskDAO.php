<?php 

    require_once('models/Task.php');
    
    class TaskDAO implements TaskDAOInterface {
        
        private $conn;
        
        public function __construct(PDO $conn) {
            $this->conn = $conn;
        }
        
        public function create(Task $task) {
            
            $query = "INSERT INTO projeto_tarefas (titulo, data_inicio, data_termino, descricao) VALUES (:titulo, :data_inicio, :data_termino, :descricao)";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":titulo", $task->getTitulo());
            $stmt->bindParam(":data_inicio", $task->getDataInicio());
            $stmt->bindParam(":data_termino", $task->getDataTermino());
            $stmt->bindParam(":descricao", $task->getDescricao());
            
            $stmt->execute();
            
        }
        
        public function edit (Task $task) {
            
            $query = "UPDATE projeto_tarefas SET (titulo = :titulo, data_inicio = :data_inicio, data_termino = :data_termino, descricao = :descricao) WHERE id = :id";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":titulo", $task->getTitulo());
            $stmt->bindParam(":data_inicio", $task->getDataInicio());
            $stmt->bindParam(":data_termino", $task->getDataTermino());
            $stmt->bindParam(":descricao", $task->getDescricao());
            $stmt->bindParam(":id", $task->getId());
            
            $stmt->execute();
            
        }
        
        public function find (Task $task) {
            
            $query = "SELECT * FROM projeto_tarefas WHERE id = :id";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":id", $task->getId());
            
            $stmt->execute();            
            
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