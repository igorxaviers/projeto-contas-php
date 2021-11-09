<?php
    include_once '../model/Caixa.php';

    class CaixaDAO{

        public function __construct(){}
        
        function cadastrar(mysqli $con, Caixa $c){
            var_dump($c);
            $sql = "INSERT INTO caixa (cai_saldo_inicial, cai_saldo_final, cai_status) VALUES (".$c->saldo_Inicial.",".$c->saldo_Final.",".$c->status.")";
            $res = $con->query($sql);   
            return $res ? true : $con->error;
        }

        function alterar(mysqli $con, Caixa $c){
            $sql = "UPDATE caixa SET cai_saldo_inicial=".$c->saldo_Inicial.", cai_saldo_final=".$c->saldo_Final.", cai_status=".$c->status."' WHERE cai_id=".$c->id."";
            $res = $con->query($sql);   
            echo $con->error;
            return $res ? true : $con->error;
        }

        function excluir(mysqli $con, int $id){
            $sql = "DELETE FROM caixa WHERE cai_id = ".$id."";
            $res = $con->query($sql); 
            var_dump($sql, $res);
            exit;
            echo $con->error;
            return $res ? true : $con->error;
        }
    
        function getCaixa(mysqli $con, int $cai_id) {
            $sql = $con->prepare("SELECT * FROM caixa WHERE cai_id = ?");
            $sql->bind_param("i", $cai_id);
            $sql->execute();
            $result = $sql->get_result();
            $sql->close();
            return $result;
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