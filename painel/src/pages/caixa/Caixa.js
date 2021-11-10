import React from 'react';
import './Caixa.scss'
import axios from 'axios';

class Caixa extends React.Component {
    constructor(props) {
        super(props);
        this.state = { 
            caixa: {
                id: '',
                saldoInicial: 0,
                saldoFinal: 0,
                status: 0,
            }
         }
    }

    componentDidMount() {
        console.log(this.props.caixa);
        this.getCaixa();
    }

    getCaixa = () => {
        console.log('CARREGOU O CAIXA');
        if(this.state.caixa.id === 0)
        {
            axios.get('http://localhost/contas/controllers/CaixaController.php')
            

        }

    }

    verificaStatusCaixa = () => {
        if(this.state.caixa.status === 0)
        {
            this.abrirCaixa();
        }
        else
        {
            this.fecharCaixa();
        }
    }

    abrirCaixa = () => {
        axios.post('http://localhost/contas/controllers/CaixaController.php', {
            acao: 'abrirCaixa',
            saldoInicial: this.state.caixa.saldoInicial,
            saldoFinal: this.state.caixa.saldoFinal,
            status: this.state.caixa.status,
        })
        .then(res => {
            console.log(res);
            this.setState({
                caixa: res.data
            });
        })
        .catch(error => {
            console.log(error);
        });
    }



    render() { 
        return (  
            <div className="switch__container">
                <input 
                id="switch-shadow" 
                className="switch switch--shadow" 
                type="checkbox"
                onChange={this.verificaStatusCaixa}
                />
                <label for="switch-shadow"></label>
            </div>
        );
    }
}
 
export default Caixa;