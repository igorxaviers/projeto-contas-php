<?php
    include_once("../bd/DAO/AcertoDAO.php");

    class Acerto {
        public $id;
        public $valor;
        public $data;
        public $tipo; //1 - entrada, 2 - saida
        public $motivo;

        public function __construct(int $id=0, float $valor=0, string $data="", int $tipo=0, string $motivo="") {
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
            $valida = array();
            $ok = true;
            if ($this->valor == 0) {
                $valida['erro'] = "Valor não pode ser vazio";
                $ok = false;
            }
            if ($this->data == null) {
                $valida['erro'] = "Data não pode ser vazia";
                $ok = false;
            }
            if (strlen($this->tipo) == 0) {
                $valida['erro'] = "Tipo não pode ser vazio";
                $ok = false;
            }
            if (strlen($this->motivo) == 0) {
                $valida['erro'] = "Motivo não pode ser vazio";
                $ok = false;
            }
            $valida['ok'] = $ok;
            return $valida;
        }

        public function cadastrar(mysqli $con) {
            $acertoDAO = new AcertoDAO();
            $certo = $acertoDAO->cadastrar($con, $this);
            echo $certo;
            return $certo;
        }

        public function excluir(mysqli $con, int $id) {
            $acertoDAO = new AcertoDAO();
            return $acertoDAO->excluir($con, $id);
        }

        public function alterar(mysqli $con) {
            $acertoDAO = new AcertoDAO();
            return $acertoDAO->alterar($con, $this);
        }

        public function getAcerto($id) {
            $acertoDAO = new AcertoDAO();
            return $acertoDAO->getAcerto(Conexao::getConexao(), $id);
        }

        public function getAcertos(mysqli $con) {
            $acertoDAO = new AcertoDAO();
            return $acertoDAO->getAcertos($con);
        }

    }
?>