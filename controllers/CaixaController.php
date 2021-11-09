<?php
    include_once("./Controller.php");
    include_once("./../model/Caixa.php");

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
                alterarStatus($data->id);
                break;

            case 5:
                atualizarSaldo($data);
                break;

            default:
                echo "Ação inválida";
                break;
        }
    }

    function cadastrar($data) {
        $caixa = new Caixa(0, $data->saldo_Inicial, $data->saldo_Final, $data->status);
        $caixa->cadastrar(Conexao::getConexao());
    }

    function alterar($data) {
        $novoCaixa = $data->caixa;
        $caixa = new Caixa($novoCaixa->cai_id, $novoCaixa->cai_saldo_inicial, $novoCaixa->cai_saldo_final, $novoCaixa->cai_status);
        $validaCaixa = $caixa->validar();
        if($validaCaixa['ok'])
        {
            $result = $caixa->alterar(Conexao::getConexao());
            echo json_encode($result);
        }
        else
        {
            echo json_encode($validaCaixa);
        }
    }
    
    function excluir($id) {
        $caixa = new Caixa();
        $caixa->excluir(Conexao::getConexao(), $id);
    }
    
    function alterarStatus($id)
    {
        $caixa = new Caixa();
        $caixa = $caixa->getCaixa($id);
        $caixa->alterarStatus(Conexao::getConexao());
    }

    function atualizarSaldo($data)
    {
        $caixa = new Caixa();
        $caixa = $caixa->getCaixa($data->id);
        $caixa->atualizarSaldo(Conexao::getConexao(), $data->valor);
    }


?>