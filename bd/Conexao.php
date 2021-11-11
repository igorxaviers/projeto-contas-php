<?php
    class Conexao {
        private static $con;

        public function __construct(){ }

        public static function getConexao() {
            if(self::$con == null) {

                // self::$con = new mysqli(
                //     "localhost",    // Host
                //     "root",         // Usuario
                //     "",             // Senha
                //     "teste"         // Banco de dados
                // );
                
                self::$con = new mysqli(
                    "us-cdbr-east-04.cleardb.com",    // Host
                    "b5ed7a8828e2bd",         // Usuario
                    "ab82cb38",             // Senha
                    "heroku_5ac1a6cc288143a"         // Banco de dados
                );
                
                
                if (self::$con->connect_error)
                    die("Erro ao conectar ao banco de dados: " . self::$con->connect_error);
            }
            return self::$con;
        }
    }
?>