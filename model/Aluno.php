<?php
    class Aluno{
        private $nome;
        private $idade;
        private $cidade;

        public function __construct($nome, $idade, $cidade){
            $this->nome = $nome;
            $this->idade = $idade;
            $this->cidade = $cidade;
        }

        public function getNome(){
            return $this->nome;
        }
        public function getIdade(){
            return $this->idade;
        }
        public function getCidade(){
            return $this->cidade;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }
        public function setIdade($idade){
            $this->idade = $idade;
        }
        public function setCidade($cidade){
            $this->cidade = $cidade;
        }
    }
?> 