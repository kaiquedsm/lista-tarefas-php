<?php 

    require_once("models/Status.php");
    class StatusDAO implements StatusDAOInterface {
        
        private $conn;
        
        public function __construct(PDO $conn) {
            $this->conn = $conn;
        }
        
        public function findAll() {
            
            $status_array = [];
            
            $query = "SELECT * FROM status";
            
            $stmt = $this->conn->query($query);
            
            $data = $stmt->fetchAll();
            
            foreach ($data as $item) {
                
                $status = new Status();
                
                $status->setId($item['id']);
                $status->setNome($item['nome']);
                
                $status_array[] = $status;
                
            }
            
            return $status_array;
            
        }
            
        }


?>