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
                alterarStatus($data);
                break;

            case 2:
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
    
    function alterarStatus($data)
    {
        $caixaNovo = $data->caixa;
        $caixa = new Caixa();
        $caixa->saldo_Inicial = $caixaNovo->saldo_inicial;
        $caixa->atualizarStatus(Conexao::getConexao());
    }

    function atualizarSaldo($data)
    {
        $response = new stdClass();
        $caixa = new Caixa($data->id, $data->saldo_Inicial, $data->saldo_Final, $data->status, $data->data);
        if($data->valor - $caixa->saldo_Final >= 0)
        {
            $result = $caixa->atualizarSaldo(Conexao::getConexao(),$data->valor);
            if($result)
            {
                $response->success = true;
                $response->message = "Saldo atualizado com sucesso!";

            }
            else
            {
                $response->success = false;
                $response->message = "Erro ao atualizar o saldo!";
            }
        }   
        else
        {
            $response->success = false;
            $response->message = "Valor do acerto maior que o saldo do caixa!";
        }
        echo json_encode($response);
        return $response->success;
    }


?>