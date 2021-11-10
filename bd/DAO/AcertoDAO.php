<?php
    //include file Acerto.php
    include_once '../model/Acerto.php';

    class AcertoDAO{

        public function __construct(){}
        
        function cadastrar(mysqli $con, Acerto $acerto){
            $sql = "INSERT INTO acertos (ace_valor, ace_data, ace_tipo, ace_motivo) VALUES (".$acerto->valor.",'".$acerto->data."',".$acerto->tipo.",'".$acerto->motivo."')";
            $res = $con->query($sql);   
            return $res ? true : false;
        }

        function alterar(mysqli $con, Acerto $acerto){
            $sql = "UPDATE acertos SET ace_valor=".$acerto->valor.", ace_data='".$acerto->data."', ace_tipo=".$acerto->tipo.", ace_motivo='".$acerto->motivo."' WHERE ace_id=".$acerto->id."";
            $res = $con->query($sql);   
            return $res ? true : false;
        }

        function excluir(mysqli $con, int $id){
            $sql = "DELETE FROM acertos WHERE ace_id = ".$id."";
            $res = $con->query($sql); 
            return $res ? true : false;
        }
    
        function getAcerto(mysqli $con, int $ace_id) {
            $sql = $con->prepare("SELECT * FROM acertos WHERE ace_id = ?");
            $sql->bind_param("i", $ace_id);
            $sql->execute();
            $result = $sql->get_result();
            $sql->close();
            return $result;
        }
    
        function getAcertos(mysqli $con) {
            $query = "SELECT * FROM acertos";
            $result = $con->query($query); 
            $listAcertos = array();
            foreach ($result as $row) {
                $listAcertos[] = $row;
            }
            return $listAcertos;
        }

    }


?>