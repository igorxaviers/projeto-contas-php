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
            $query = "SELECT * FROM movimento_caixa as MC
                    INNER JOIN acertos as A ON MC.mov_acerto = A.ace_id
                    INNER JOIN caixa as C  ON MC.mov_caixa = C.cai_id";

            $result = $con->query($query); 
            $listMovimentos = array();
            foreach ($result as $row) {
                $listMovimentos[] = 
                    new MovimentoCaixa(
                        $row['mov_id'],
                        new Acerto($row['ace_id'], $row['ace_valor'], $row['ace_data'], $row['ace_tipo'], $row['ace_motivo']),
                        new Caixa($row['cai_id'], $row['cai_saldo_inicial'], $row['cai_saldo_final'], $row['cai_status']),
                        $row['mov_valor'],
                        $row['mov_tipo']
                    );
            }
            return $listMovimentos;
        }

    }


?>