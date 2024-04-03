<?php 

    Class Task {
        
        private $id;
        private $titulo;
        private $data_inicio;
        private $data_termino;
        private $descricao;
        
        
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
        
    }
    
    interface TaskDAOInterface {
        
        public function create (Task $task);
        public function edit (Task $task);
        public function find (Task $task);
        public function findAll();
        public function delete (Task $task);
        
    }

?>