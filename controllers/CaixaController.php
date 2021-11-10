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
                criarCaixa($data);
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

    function criarCaixa($data) {
        $caixa = new Caixa(0, $data->saldo_Inicial, $data->saldo_Final, $data->status);
        $caixa->criarCaixa(Conexao::getConexao());
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