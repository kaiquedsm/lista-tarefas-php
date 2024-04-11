<?php 

    Class Task {
        
        private $id;
        private $titulo;
        private $data_inicio;
        private $data_termino;
        private $descricao;
        private $user_id;
        private $status_id;
        
        
        public function getId() {
            return $this->id;
        }
        
        public function setId($id) {
            $this->id = $id;
        }
        
        public function getTitulo() {
            return $this->titulo;
        }
        
        public function setTitulo($titulo) {
            $this->titulo = $titulo;
        }
        
        public function getDataTermino() {
            return $this->data_termino;
        }
        
        public function setDataTermino($data_termino) {
            $this->data_termino = $data_termino;
        }
        
        public function getDataInicio() {
            return $this->data_inicio;
        }
        
        public function setDataInicio($data_inicio) {
            $this->data_inicio = $data_inicio;
        }
                
        public function getDescricao() {
            return $this->descricao;
        }
        
        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }
        public function getUserId() {
            return $this->user_id;
        }
        
        public function setUserId($user_id) {
            $this->user_id = $user_id;
        }
        public function getStatusId() {
            return $this->status_id;
        }
        
        public function setStatusId($status_id) {
            $this->status_id = $status_id;
        }
        
    }
    
    interface TaskDAOInterface {
        
        public function buildTask($data);
        public function create (Task $task);
        public function update (Task $task);
        public function getTasksByStatusId($id);
        public function findById ($id);
        public function findAll();
        public function delete ($id);
        
    }

?>