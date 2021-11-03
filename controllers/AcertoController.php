<?php
    include_once("./Controller.php");
    include_once("./../model/Acerto.php");

    $data = json_decode(file_get_contents("php://input"));
    if($data)
    {
        $acao = $data->acao;
        echo "JSON STRING ".$acao;
        /*
            TIPOS AÇÕES
            * 1 - CADASTRAR
            * 2 - ALTERAR
            * 3 - EXCLUIR
            * 4 - LISTAR
        */
        switch($acao)
        {
            case 1:
                cadastrar($data);
                break;

            case 2:
                alterar($data);
                break;

            case 3:
                excluir($data);
                break;

            case 4:
                listar();
                break;

            default:
                echo "Ação inválida";
                break;
        }
    }

    function listar()
    {
        $acerto = new Acerto();
        $listAcertos = $acerto->getAcertos(Conexao::getConexao());
        $jsonAcertos = json_encode($listAcertos);
        echo $jsonAcertos;
        return $jsonAcertos;
    }

    function cadastrar($data) {
        $acerto = new Acerto($data);
        $acerto->cadastrar(Conexao::getConexao(), $acerto);
    }

    function alterar($data) {
        $acerto = new Acerto($data);
        $acerto->alterar(Conexao::getConexao(), $acerto);
    }
    
    function excluir($data) {
        $acerto = new Acerto();
        $acerto->excluir(Conexao::getConexao(), $data->id);
    }


?>