<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Accept");
    header("Access-Control-Allow-Headers: X-Requested-With");
    header("Access-Control-Allow-Methods: POST, GET");
    header("Access-Control-Max-Age: 3600");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin: http://localhost:3000, http://localhost:3000/acertos, http://localhost:3000/, http://localhost ");
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
                echo json_encode("Ação inválida");
                break;
        }
    }
    else
        echo json_encode("Problema request");

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
        $response = new stdClass();
        $novoAcerto = $data->acerto;
        $time = strtotime($novoAcerto->ace_data);
        $dataAcerto = date('Y-m-d',$time);
        $acerto = new Acerto(0, $novoAcerto->ace_valor, $dataAcerto, $novoAcerto->ace_tipo, $novoAcerto->ace_motivo);
        $validaAcerto = $acerto->validar();

        if($validaAcerto['success'])
        {
            $result = $acerto->cadastrar(Conexao::getConexao());
            if($result)
            {
                $response->success = true;
                $response->message = "Acerto cadastrado com sucesso!";

            }
            else
            {
                $response->success = false;
                $response->message = "Erro ao cadastrar acerto!";
            }
        }
        else
        {
            $response->success = false;
            $response->message = $validaAcerto['message'];
        }
        echo json_encode($response);
    }

    function alterar($data) {
        $response = new stdClass();

        $novoAcerto = $data->acerto;
        $time = strtotime($novoAcerto->ace_data);
        $dataAcerto = date('Y-m-d',$time);

        $acerto = new Acerto($novoAcerto->ace_id, $novoAcerto->ace_valor, $dataAcerto, $novoAcerto->ace_tipo, $novoAcerto->ace_motivo);
        
        $validaAcerto = $acerto->validar();
        
        if($validaAcerto['success'])
        {
            $result = $acerto->alterar(Conexao::getConexao());
            if($result)
            {
                $response->success = true;
                $response->message = "Acerto alterado com sucesso!";

            }
            else
            {
                $response->success = false;
                $response->message = "Erro ao alterar acerto!";
            }
        }
        else
        {
            $response->success = false;
            $response->message = $validaAcerto['message'];
        }
        echo json_encode($response);
    }
    
    function excluir($id) {
        $response = new stdClass();
        $acerto = new Acerto();
        $result = $acerto->excluir(Conexao::getConexao(), $id);

        if($result)
        {
            $response->success = true;
            $response->message = "Acerto excluído com sucesso!";
        }
        else
        {
            $response->success = false;
            $response->message = "Erro ao excluir acerto!";
        }

        echo json_encode($response);
    }


?>