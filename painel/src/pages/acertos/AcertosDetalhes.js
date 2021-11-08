import axios from 'axios';
import React from 'react';
import { toast, ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
class AcertosDetalhes extends React.Component {
    constructor(props) {
        super(props);
        this.state = { 
            ace_id: '',
            ace_valor: '',
            ace_data: '',
            ace_tipo: '',
            ace_motivo: '',
            loading: false
        }
    }

    componentDidMount() {
        const location = this.props.location.state;
        console.log(location);
        this.setState({
            ace_id: location.ace_id,
            ace_valor: location.ace_valor,
            ace_data: location.ace_data,
            ace_tipo: location.ace_tipo,
            ace_motivo: location.ace_motivo,
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
        console.log(this.state);
        this.setState({ loading: true });
        const acerto = {
            ace_id: this.state.ace_id,
            ace_valor: this.state.ace_valor,
            ace_data: this.state.ace_data,
            ace_tipo: this.state.ace_tipo,
            ace_motivo: this.state.ace_motivo,
        };
        const cors = 'https://cors-anywhere.herokuapp.com/';
        // axios.post(cors+'https://contas-php.herokuapp.com/controllers/AcertoController.php', {acao: 2, acerto})
        axios.post('http://localhost/contas/controllers/AcertoController.php', {acao: 2, acerto})
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
                            name="ace_id"
                            placeholder=""
                            value={this.state.ace_id}
                            onChange={this.handleChange}
                            readOnly  />
                    </div>
                    <div className="form-group">
                        <label htmlFor="valor">Valor</label>
                        <input 
                            type="text"
                            className="form-control"
                            name="ace_valor"
                            placeholder="Valor do acerto"
                            value={this.state.ace_valor}
                            onChange={this.handleChange}  />
                    </div>
                    <div className="form-group">
                        <label htmlFor="data">Data</label>
                        <input 
                            type="date"
                            className="form-control"
                            name="ace_data"
                            placeholder="Data do acerto"
                            value={this.state.ace_data}
                            onChange={this.handleChange}  />
                    </div>
                    <div className="form-group">
                        <label htmlFor="tipo">Tipo</label>
                        <input 
                            type="text"
                            className="form-control"
                            name="ace_tipo"
                            placeholder="Tipo do acerto"
                            value={this.state.ace_tipo}
                            onChange={this.handleChange}  />
                    </div>
                    <div className="form-group">
                        <label htmlFor="motivo">Motivo</label>
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
                        className="btn btn-primary"
                        onClick={this.alterarAcerto}

                        >Salvar</button>
                </form>

                <ToastContainer/>
            </div>
        );
    }
}
 
export default AcertosDetalhes;