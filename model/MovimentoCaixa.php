<?php
    include_once("../bd/DAO/MovimentoCaixaDAO.php");
    include_once("../model/Acerto.php");
    include_once("../model/Caixa.php");

    class MovimentoCaixa {
        public $id;
        public $acerto;
        public $caixa;
        public $valor;
        public $tipo;

        public function __construct(int $id=0, Acerto $acerto, Caixa $caixa, float $valor=0, int $tipo=0) {
            $this->id = $id;
            $this->acerto = $acerto;
            $this->caixa = $caixa;
            $this->valor = $valor;
            $this->tipo = $tipo;
        }

        public function getId() {
            return $this->id;
        }
        public function setId($id) {
            $this->id = $id;
        }

        public function getAcertoM() {
            return $this->acerto;
        }
        public function setAcertoM($id) {
            $aux_acerto = new Acerto();
            $this->acerto = $aux_acerto->getAcerto($id);
        }
        public function getCaixaM() {
            return $this->caixa;
        }
        public function setCaixaM($id) {
            $aux_caixa = new Caixa();
            $this->caixa = $aux_caixa->getCaixa($id);
        }
        public function getValor() {
            return $this->valor;
        }
        public function getTipo() {
            return $this->tipo;
        }

        public function validar() {
            $erros = array();
            $ok = true;
            if (strlen($this->valor) == 0) {
                $erros[] = "Valor não pode ser vazio";
                $ok = false;
            }
            if (strlen($this->tipo) == 0) {
                $erros[] = "Tipo não pode ser vazio";
                $ok = false;
            }
            array_push($erros, $ok);
            return $erros;
        }

        public function cadastrar(mysqli $con) {
            $movimentoDAO = new MovimentoCaixaDAO();
            $certo = $movimentoDAO->cadastrar($con, $this);
            echo $certo;
            return $certo;
        }

        public function excluir(mysqli $con, int $id) {
            $movimentoDAO = new MovimentoCaixaDAO();
            return $movimentoDAO->excluir($con, $id);
        }

        public function alterar(mysqli $con) {
            $movimentoDAO = new MovimentoCaixaDAO();
            return $movimentoDAO->alterar($con, $this);
        }

        public function getMovimento($id) {
            $movimentoDAO = new MovimentoCaixaDAO();
            return $movimentoDAO->getMovimento(Conexao::getConexao(), $id);
        }

        public function getMovimentos(mysqli $con) {
            $movimentoDAO = new MovimentoCaixaDAO();
            $listMovimentos = $movimentoDAO->getMovimentos($con);
            foreach($listMovimentos as $movimento )
            {
                $movimento->$this->setAcertoM($movimento->this->getId());
            }
        }

    }
?>
