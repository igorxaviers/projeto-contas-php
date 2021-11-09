<?php
    include_once("../bd/DAO/CaixaDAO.php");

    class Caixa {
        public $id;
        public $saldo_Inicial;
        public $saldo_Final;
        public $status;

        public function __construct(int $id=0, float $saldoI=0, float $saldoF=0,int $status = 0) {
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

        public function getCaixa($id) {
            $caixaDAO = new CaixaDAO();
            return $caixaDAO->getCaixa(Conexao::getConexao(), $id);
        }
    
    public function alterarStatus(mysqli $con)
    {
        if($this->status == 0)
            $this->abrirCaixa($con, $this->saldo_Inicial);
        else
            $this->fecharCaixa($con);
    }   

    public function abrirCaixa(mysqli $con, float $valorIni){
        $this->status = 1;
        $this->saldo_Inicial = $valorIni;
        $this->saldo_Final = $valorIni;
        return cadastrar($con);    
    }

    public function fecharCaixa(mysqli $con){
        $this->status = 0;
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

        public function excluir(mysqli $con, int $id) {
            $caixaDAO = new CaixaDAO();
            return $caixaDAO->excluir($con, $id);
        }

        public function validar() {
            $valida = array();
            $ok = true;
            if ($this->saldo_Inicial < 0) {
                $valida['erro'] = "Valor não pode ser menor que 0";
                $ok = false;
            }
            if ($this->saldo_Final < 0) {
                $valida['erro'] = "Valor não pode ser menor que 0";
                $ok = false;
            }
            if (strlen($this->status) == 0) {
                $valida['erro'] = "Status não pode ser vazio";
                $ok = false;
            }
            $valida['ok'] = $ok;
            return $valida;
        }
    }
?>