import axios from 'axios';
import React from 'react';
import { toast, ToastContainer } from 'react-toastify';

class AcertosDetalhes extends React.Component {
    constructor(props) {
        super(props);
        this.state = { 
            id: '',
            valor: '',
            data: '',
            tipo: '',
            motivo: '',
        }
    }

    componentDidMount() {
        const location = this.props.location.state;
        console.log(location);
        this.setState({
            id: location.ace_id,
            valor: location.ace_valor,
            data: location.ace_data,
            tipo: location.ace_tipo,
            motivo: location.ace_motivo,
            loading: false
        });
    }

    handleChange = (event) => {
        const target = event.target;
        const value = target.value;
        const name = target.name;
        console.log(name, target, value);

        this.setState({
            [name]: value
        });
    }

    alterarAcerto = () => {
        this.setState({ loading: true });
        const acerto = {
            ace_id: this.state.id,
            ace_valor: this.state.valor,
            ace_data: this.state.data,
            ace_tipo: this.state.tipo,
            ace_motivo: this.state.motivo,
        };
        const cors = 'https://cors-anywhere.herokuapp.com/';
        axios.post(cors+'https://contas-php.herokuapp.com/controllers/AcertoController.php', {acao: 2, acerto})
        .then(res => {
            console.log(res.data);
            toast.success('Acerto alterado com sucesso!');
        })
        .catch(err => toast.error('Acerto alterado com sucesso!'))
        .finally(() => this.setState({ loading: false }));
    }

    render() { 
        return ( 
            <div>
                <h1>Detalhes</h1>

                <form>
                    <div className="form-group">
                        <label htmlFor="id">ID</label>
                        <input 
                            type="text"
                            className="form-control"
                            name="id"
                            placeholder=""
                            value={this.state.id}
                            onChange={this.handleChange}
                            readOnly  />
                    </div>
                    <div className="form-group">
                        <label htmlFor="valor">Valor</label>
                        <input 
                            type="text"
                            className="form-control"
                            name="valor"
                            placeholder="Valor do acerto"
                            value={this.state.valor}
                            onChange={this.handleChange}  />
                    </div>
                    <div className="form-group">
                        <label htmlFor="data">Data</label>
                        <input 
                            type="date"
                            className="form-control"
                            name="data"
                            placeholder="Data do acerto"
                            value={this.state.data}
                            onChange={this.handleChange}  />
                    </div>
                    <div className="form-group">
                        <label htmlFor="tipo">Tipo</label>
                        <input 
                            type="text"
                            className="form-control"
                            name="tipo"
                            placeholder="Tipo do acerto"
                            value={this.state.tipo}
                            onChange={this.handleChange}  />
                    </div>
                    <div className="form-group">
                        <label htmlFor="motivo">Motivo</label>
                        <textarea 
                            type="text"
                            className="form-control"
                            name="motivo"
                            placeholder=""
                            value={this.state.motivo}
                            onChange={this.handleChange}>
                        </textarea>
                    </div>

                    <button 
                        type="button" 
                        className="btn btn-primary"
                        onClick={() => this.alterarAcerto}

                        >Salvar</button>
                </form>

                <ToastContainer/>
            </div>
        );
    }
}
 
export default AcertosDetalhes;