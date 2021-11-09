<?php
    include_once("../bd/DAO/CaixaDAO.php");

    class Caixa {
        public $id;
        public $saldo_Inicial;
        public $saldo_Final;
        public $status;

        public function __construct(int $id=0, float $saldoI=0, float $saldoF=0,bool $status = false) {
            $this->id = $id;
            $this->saldo_Inicial = $saldoI;
            $this->saldo_Final = $saldoF;
            $this->status = $status;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getSaldo_Inicial() {
            return $this->saldo_Inicial;
        }

        public function getSaldo_Final() {
            return $this->saldo_Final;
        }

        public function getStatus() {
            return $this->status;
        }
    
    public function abrirCaixa(mysqli $con, float $valorIni){
        $this->status = true;
        $this->saldo_Inicial = $valorIni;
        $this->saldo_Final = $valorIni;
        return cadastrar($con);    
    }

    public function fecharCaixa(mysqli $con){
        $this->status = false;
        return alterar($con);
    }

    public function atualizarSaldo(mysqli $con, float $valor){
        $this->saldo_Final = $this->saldo_Final + $valor;
        return alterar($con);
    }


        public function cadastrar(mysqli $con) {
            $CaixaDAO = new CaixaDAO();
            $certo = $CaixaDAO->cadastrar($con, $this);
            echo $certo;
            return $certo;
        }

        public function alterar(mysqli $con) {
            $caixaDAO = new CaixaDAO();
            return $caixaDAO->alterar($con, $this);
        }

        public function getCaixa($id) {
            $caixaDAO = new CaixaDAO();
            return $caixaDAO->getCaixa(Conexao::getConexao(), $id);
        }
    }
?>