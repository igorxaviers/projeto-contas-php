<?php
    include_once("./Controller.php");
    include_once("./../model/MovimentoCaixa.php");

    $data = json_decode(file_get_contents("php://input"));
    if($data)
    {
        $acao = $data->acao;
        
        switch($acao)
        {
            case 1:
                cadastrar($data);
                break;

            case 2:
                alterar($data);
                break;

            case 3:
                excluir($data->id);
                break;

            case 4:
                listar();
                break;

            case 5:
                buscar($data->id);
                break;

            default:
                echo "Ação inválida";
                break;
        }
    }

    function listar()
    {
        $movimento = new MovimentoCaixa(0,new Acerto(), new Caixa(), 0, 0);
        $listMovimentos = $movimento->getMovimentos(Conexao::getConexao());
        $jsonMovimentos = json_encode($listMovimentos);
        echo $jsonMovimentos;
        return $jsonMovimentos;
    }

    function buscar(int $id)
    {
        $movimento = new MovimentoCaixa(0,new Acerto(), new Caixa(), 0, 0);
        $listMovimentos = $movimento->getMovimento($id);
        $jsonMovimentos = json_encode($listMovimentos);
        echo $jsonMovimentos;
        return $jsonMovimentos;
    }

    function cadastrar($data) {
        $movimento = new MovimentoCaixa(0, $data->acerto->id, $data->caixa->id, $data->valor, $data->tipo);
        $movimento->cadastrar(Conexao::getConexao());
    }

    function alterar($data) {
        $novoMovimento = $data->movimento;
        $movimento = new MovimentoCaixa($novoMovimento->mov_id, $novoMovimento->acerto->id, $novoMovimento->caixa->id, $novoMovimento->mov_valor, $novoMovimento->mov_tipo);
        $validaMovimento = $movimento->validar();
        if($validaMovimento['ok'])
        {
            $result = $movimento->alterar(Conexao::getConexao());
            echo json_encode($result);
        }
        else
        {
            echo json_encode($validaMovimento);
        }
    }
    
    function excluir($id) {
        $movimentoCaixa = new MovimentoCaixa(0,new Acerto(), new Caixa(), 0, 0);
        $movimentoCaixa->excluir(Conexao::getConexao(), $id);
    }


?>