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
            $valida['message'] = "";
            $valida['success'] = true;
            if (empty($this->valor)) {
                $valida['message'] = "Valor não pode ser vazio";
                $valida['success'] = false;
            }
            if (empty($this->data)) {
                $valida['message'] = "Data não pode ser vazia";
                $valida['success'] = false;
            }
            if (empty($this->tipo)) {
                $valida['message'] = "Tipo não pode ser vazio";
                $valida['success'] = false;
            }
            if (empty($this->motivo)) {
                $valida['message'] = "Motivo não pode ser vazio";
                $valida['success'] = false;
            }
            return $valida;
        }

        public function cadastrar(mysqli $con) {
            $acertoDAO = new AcertoDAO();
            return $acertoDAO->cadastrar($con, $this);
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