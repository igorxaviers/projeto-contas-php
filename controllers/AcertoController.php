<?php
    include_once("./Controller.php");
    include_once("./../model/Acerto.php");

    $data = json_decode(file_get_contents("php://input"));
    if($data)
    {
        $acao = $data->acao;
        // echo "JSON STRING ".$acao;
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
                excluir($data->ace_id);
                break;

            case 4:
                listar();
                break;

            case 5:
                buscar($data->ace_id);
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
    }

    function buscar(int $id)
    {
        $acerto = new Acerto();
        $listAcertos = $acerto->getAcerto(Conexao::getConexao(), $id);
        $jsonAcertos = json_encode($listAcertos);
        echo $jsonAcertos;
    }

    function cadastrar($data) {
        $time = strtotime($data->data);
        $dataAcerto = date('Y-m-d',$time);
        $acerto = new Acerto(0, $data->valor, $dataAcerto, $data->tipo, $data->motivo);
        $acerto->cadastrar(Conexao::getConexao());
    }

    function alterar($data) {
        var_dump($data);
        $novoAcerto = $data->acerto;
        $time = strtotime($novoAcerto->ace_data);
        $dataAcerto = date('Y-m-d',$time);
        $acerto = new Acerto($novoAcerto->ace_id, $novoAcerto->ace_valor, $dataAcerto, $novoAcerto->ace_tipo, $novoAcerto->ace_motivo);
        $validaAcerto = $acerto->validar();
        
        if($validaAcerto['ok'])
        {
            $result = $acerto->alterar(Conexao::getConexao());
            $result = json_encode($result);
            echo $result;
        }
        else
        {
            echo json_encode($validaAcerto);
            $validaAcerto = json_encode($validaAcerto);
            echo $validaAcerto;
        }
    }
    
    function excluir($id) {
        $acerto = new Acerto();
        $acerto->excluir(Conexao::getConexao(), $id);
    }


?>