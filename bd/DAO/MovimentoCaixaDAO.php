<?php
    //include file Acerto.php
    include_once '../model/MovimentoCaixa.php';

    class MovimentoCaixaDAO{

        public function __construct(){}
        
        function cadastrar(mysqli $con, MovimentoCaixa $movimento){
            var_dump($movimento);
            $sql = "INSERT INTO movimento_caixa (mov_acerto, mov_caixa, mov_valor, mov_tipo) VALUES (".$movimento->acerto->id.",".$movimento->caixa->id.",".$movimento->valor.",".$movimento->tipo.")";
            $res = $con->query($sql);   
            return $res ? true : $con->error;
        }

        function alterar(mysqli $con, MovimentoCaixa $movimento){
            $sql = "UPDATE movimento_caixa SET mov_acerto=".$movimento->acerto->id.", mov_caixa=".$movimento->caixa->id.", mov_valor=".$movimento->valor.", mov_tipo=".$movimento->tipo." WHERE mov_id=".$movimento->id."";
            $res = $con->query($sql);   
            echo $con->error;
            return $res ? true : $con->error;
        }

        function excluir(mysqli $con, int $id){
            $sql = "DELETE FROM movimento_caixa WHERE mov_id = ".$id."";
            $res = $con->query($sql); 
            var_dump($sql, $res);
            exit;
            echo $con->error;
            return $res ? true : $con->error;
        }
    
        function getMovimento(mysqli $con, int $mov_id) {
            $sql = $con->prepare("SELECT * FROM movimento_caixa WHERE mov_id = ?");
            $sql->bind_param("i", $mov_id);
            $sql->execute();
            $result = $sql->get_result();
            $sql->close();
            return $result;
        }
    
        function getMovimentos(mysqli $con) {
            $query = "SELECT * FROM movimento_caixa";
            $result = $con->query($query); 
            $listMovimentos = array();
            foreach ($result as $row) {
                $listMovimentos[] = $row;
            }
            return $listMovimentos;
        }

    }


?>