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
                    "sql10.freemysqlhosting.net",    // Host
                    "sql10448860",         // Usuario
                    "uBFFiiRRfP",             // Senha
                    "sql10448860"         // Banco de dados
                );
                
                
                if (self::$con->connect_error)
                    die("Erro ao conectar ao banco de dados: " . self::$con->connect_error);
            }
            return self::$con;
        }
    }
?>