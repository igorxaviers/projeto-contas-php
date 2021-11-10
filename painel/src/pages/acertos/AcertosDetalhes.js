import React from 'react';
import { toast, ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import axios from 'axios';
import BackButton from '../../components/BackButton/BackButton';

class AcertosDetalhes extends React.Component {
    constructor(props) {
        super(props);
        this.state = { 
            ace_id: '',
            ace_valor: '',
            ace_data: '',
            ace_tipo: '',
            ace_motivo: '',
            loading: false,
            tipos: [
                {id: 1, nome: 'Entrada'},
                {id: 2, nome: 'Saída'}
            ]
        }
    }

    componentDidMount() {
        const location = this.props.location.state;
        if(location) {
            this.setState({
                ace_id: location.ace_id,
                ace_valor: location.ace_valor,
                ace_data: location.ace_data,
                ace_tipo: location.ace_tipo,
                ace_motivo: location.ace_motivo,
                loading: false
            });
        }
    }

    handleChange = (event) => {
        const target = event.target;
        const value = target.value;
        const name = target.name;
        this.setState({
            [name]: value
        });
    }
    
    cadastrarAcerto = () => {
        this.setState({ loading: true });
        const acerto = {
            ace_valor: parseFloat(this.state.ace_valor),
            ace_data: this.state.ace_data,
            ace_tipo: parseInt(this.state.ace_tipo),
            ace_motivo: this.state.ace_motivo,
        };
        axios.post('http://localhost/ProjetoPHP/controllers/AcertoController.php', JSON.stringify({acao: 1, acerto}))
        .then(res => {
            const response = res.data;
            if(response.success)
                toast.success(response.message);
            else
                toast.error(response.message);
        })
        .catch(err => {
            toast.error('Erro ao alterar acerto!');
        })
        .finally(() => this.setState({ loading: false }));
    }

    alterarAcerto = () => {
        this.setState({ loading: true });
        const acerto = {
            ace_id: parseInt(this.state.ace_id),
            ace_valor: parseFloat(this.state.ace_valor),
            ace_data: this.state.ace_data,
            ace_tipo: parseInt(this.state.ace_tipo),
            ace_motivo: this.state.ace_motivo,
        };
        axios.post('http://localhost/ProjetoPHP/controllers/AcertoController.php', JSON.stringify({acao: 2, acerto}))
        .then(res => {
            const response = res.data;
            if(response.success)
                toast.success(response.message);
            else
                toast.error(response.message);
        })
        .catch(err => {
            toast.error('Erro ao alterar acerto!');
        })
        .finally(() => this.setState({ loading: false }));
    }


    render() { 
        return ( 
            <div>
                <BackButton />
                <h1 className="my-5 ">{this.state.ace_id ? 'Editar' : 'Cadastro'}</h1>
                <form>

                    <label htmlFor="valor">Valor:</label>
                    <div className="input-group mb-3" >
                        <span className="input-group-text" id="basic-addon2"><i className="fas fa-dollar-sign"></i></span>
                        <input 
                            type="text"
                            className="form-control"
                            name="ace_valor"
                            placeholder="Valor do acerto"
                            value={this.state.ace_valor}
                            onChange={this.handleChange}  />
                    </div>

                    <label htmlFor="data">Data:</label>
                    <div className="input-group mb-3">
                        <span className="input-group-text" id="basic-addon2"><i className="fas fa-calendar-alt"></i></span>
                        <input 
                            type="date"
                            className="form-control"
                            name="ace_data"
                            placeholder="Data do acerto"
                            value={this.state.ace_data}
                            onChange={this.handleChange}  />
                    </div>

                    <label htmlFor="tipo">Tipo:</label>
                    <div className="input-group mb-3" >
                    <span className="input-group-text" id="basic-addon2"><i className="fas fa-list"></i></span>
                        <select 
                            className="form-control"
                            name="ace_tipo"
                            value={this.state.ace_tipo}
                            onChange={this.handleChange}>
                            <option value="" disabled hidden>Selecione o tipo</option>
                            {this.state.tipos.map(tipo => (
                                <option key={tipo.id} value={tipo.id}>{tipo.nome}</option>
                            ))}
                        </select>
                    </div>
                    <div className="form-group">
                        <label htmlFor="motivo">Motivo:</label>
                        <textarea 
                            type="text"
                            className="form-control"
                            name="ace_motivo"
                            placeholder=""
                            value={this.state.ace_motivo}
                            onChange={this.handleChange}>
                        </textarea>
                    </div>

                    <button 
                        type="button" 
                        className="btn btn-primary mt-3"
                        onClick={this.state.ace_id ? this.alterarAcerto : this.cadastrarAcerto}>
                        Salvar</button>
                </form>

                <ToastContainer
                    position="bottom-right"
                    theme="colored"
                    autoClose={5000}
                    hideProgressBar={false}
                    newestOnTop={false}
                    closeOnClick
                    rtl={false}
                    pauseOnFocusLoss
                    draggable
                    pauseOnHover/>
            </div>
        );
    }
}
 
export default AcertosDetalhes;