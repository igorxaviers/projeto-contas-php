<?php
    //include file Acerto.php
    include_once '../model/Acerto.php';

    class AcertoDAO{

        public function __construct(){}
        
        function cadastrar($con, Acerto $acerto){
            $sql = "INSERT INTO acertos (valor, data, tipo, motivo) VALUES (:valor, :data, :tipo, :motivo)";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':valor', $acerto->valor);
            $stmt->bindParam(':data', $acerto->data);
            $stmt->bindParam(':tipo', $acerto->tipo);
            $stmt->bindParam(':motivo', $acerto->motivo);
            return $stmt->execute();   
        }

        function alterar($con, Acerto $acerto){
            $sql = "UPDATE acertos SET valor = :valor, data = :data, tipo = :tipo, motivo = :motivo WHERE id = :id";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':valor', $acerto->valor);
            $stmt->bindParam(':data', $acerto->data);
            $stmt->bindParam(':tipo', $acerto->tipo);
            $stmt->bindParam(':motivo', $acerto->motivo);
            $stmt->bindParam(':id', $acerto->id);
            return $stmt->execute();
        }

        function excluir($con, int $id){
            $sql = "DELETE FROM acertos WHERE ace_id = :id";
            $stmt = $con::prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
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