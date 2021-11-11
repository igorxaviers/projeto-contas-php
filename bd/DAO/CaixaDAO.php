<?php
    include_once '../model/Caixa.php';

    class CaixaDAO{

        public function __construct(){}
        
        function criarCaixa(mysqli $con, Caixa $c){
            var_dump($c);
            $sql = "INSERT INTO caixa (cai_saldo_inicial, cai_saldo_final, cai_status, cai_data) VALUES (".$c->saldo_Inicial.",".$c->saldo_Final.",".$c->status.",'".$c->data."')";
            $res = $con->query($sql);   
            return $res ? true : false;
        }

        function alterarStatus(mysqli $con, Caixa $c){
            $sql = "UPDATE caixa SET cai_status=".$c->status." WHERE cai_id=".$c->id."";
            $res = $con->query($sql);   
            return $res ? true : false;
        }

        function alterarSaldo(mysqli $con, Caixa $c){
            $sql = "UPDATE caixa SET cai_saldo_final=".$c->saldo_Final." WHERE cai_id=".$c->id."";
            $res = $con->query($sql);   
            return $res ? true : false;
        }

        function excluir(mysqli $con, int $id){
            $sql = "DELETE FROM caixa WHERE cai_id = ".$id."";
            $res = $con->query($sql); 
            return $res ? true : false;
        }
    
        function getCaixa(mysqli $con, int $cai_id) {
            $sql = $con->prepare("SELECT * FROM caixa WHERE cai_id = ".$cai_id."");
            $res = $con->query($sql);
            return $res ? true : false;
        }
    
        function getCaixas(mysqli $con) {
            $query = "SELECT * FROM caixa";
            $result = $con->query($query); 
            $listCaixas = array();
            foreach ($result as $row) {
                $listCaixas[] = $row;
            }
            return $listCaixas;
        }

    }


?>