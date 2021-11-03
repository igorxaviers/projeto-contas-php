<?php
    include_once("../bd/DAO/AcertoDAO.php");

    class Acerto {
        private $id;
        private $valor;
        private $data;
        private $tipo; //1 - entrada, 2 - saida
        private $motivo;

        public function __construct(int $id=0, float $valor=0, DateTime $data=null, int $tipo=0, string $motivo="") {
            $this->id = $id;
            $this->valor = $valor;
            $this->data = $data;
            $this->tipo = $tipo;
            $this->motivo = $motivo;
        }

        public function getId() {
            return $this->id;
        }
        public function setId($id) {
            $this->id = $id;
        }

        public function getValor() {
            return $this->valor;
        }
        public function getData() {
            return $this->data;
        }
        public function getTipo() {
            return $this->tipo;
        }
        public function getMotivo() {
            return $this->motivo;
        }

        public function validar() {
            $erros = array();
            $ok = true;
            if (strlen($this->valor) == 0) {
                $erros[] = "Valor não pode ser vazio";
                $ok = false;
            }
            if ($this->data == null) {
                $erros[] = "Data não pode ser vazia";
                $ok = false;
            }
            if (strlen($this->tipo) == 0) {
                $erros[] = "Tipo não pode ser vazio";
                $ok = false;
            }
            if (strlen($this->motivo) == 0) {
                $erros[] = "Motivo não pode ser vazio";
                $ok = false;
            }
            array_push($erros, $ok);
            return $erros;
        }

        public function cadastrar() {
            $acertoDAO = new AcertoDAO();
            $acertoDAO->cadastrar(Conexao::getConexao(), $this);
        }

        public function excluir() {
            $acertoDAO = new AcertoDAO();
            $acertoDAO->excluir(Conexao::getConexao(), $this->id);
        }

        public function alterar() {
            $acertoDAO = new AcertoDAO();
            $acertoDAO->alterar(Conexao::getConexao(), $this);
            
        }

        public function getAcerto($id) {
            $acertoDAO = new AcertoDAO();
            return $acertoDAO->getAcerto(Conexao::getConexao(), $id);
        }

        public function getAcertos() {
            $acertoDAO = new AcertoDAO();
            return $acertoDAO->getAcertos(Conexao::getConexao());
        }

    }
?>