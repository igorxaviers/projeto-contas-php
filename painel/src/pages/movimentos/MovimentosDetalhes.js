import React from 'react';
import { toast, ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import axios from 'axios';
import BackButton from '../../components/BackButton/BackButton';

class MovimentosDetalhes extends React.Component {
    constructor(props) {
        super(props);
        this.state = { 
            id: '',
            valor: '',
            tipo: '',
            acerto: '',
            caixa: '',
            loading: false,
        }
    }

    componentDidMount() {
        const location = this.props.location.state;
        if(location) {
            this.setState({
                id: location.id,
                valor: location.valor,
                acerto: location.acerto,
                tipo: location.tipo,
                caixa: location.caixa,
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

    render() { 
        return ( 
            <div>
                <BackButton />
                <h1 className="my-5 ">Detalhes da Movimentação</h1>
                <form>

                    <label htmlFor="valor">Valor:</label>
                    <div className="input-group mb-3" >
                        <span className="input-group-text" id="basic-addon2"><i className="fas fa-dollar-sign"></i></span>
                        <input 
                            type="text"
                            className="form-control"
                            name="valor"
                            placeholder="Valor da movimentação"
                            value={this.state.valor}
                            readOnly/>
                    </div>

                    <label htmlFor="data">Data:</label>
                    <div className="input-group mb-3">
                        <span className="input-group-text" id="basic-addon2"><i className="fas fa-calendar-alt"></i></span>
                        <input 
                            type="date"
                            className="form-control"
                            name="acerto_data"
                            placeholder="Data da movimentação"
                            value={this.state.acerto.data}
                            readOnly />
                    </div>

                    <label htmlFor="tipo">Tipo:</label>
                    <div className="input-group mb-3" >
                    <span className="input-group-text" id="basic-addon2"><i className="fas fa-list"></i></span>
                        <input 
                            className="form-control"
                            name="tipo"
                            value={this.state.tipo === 1 ? 'Entrada' : 'Saída'}
                            readOnly/>
                    </div>
                    <div className="form-group">
                        <label htmlFor="motivo">Motivo:</label>
                        <textarea 
                            type="text"
                            className="form-control"
                            name="acerto_motivo"
                            placeholder=""
                            value={this.state.acerto.motivo}
                            readOnly>
                        </textarea>
                    </div><br/>
                    
                    <label htmlFor="tipo">Caixa da movimentação:</label>
                    <div className="input-group mb-3" >
                    <span className="input-group-text" id="basic-addon2"><i className="fas fa-list"></i></span>
                        <input 
                            className="form-control"
                            name="caixa"
                            value={this.state.caixa.id}
                            readOnly/>
                    </div>
                </form>
                <br/><br/><br/>
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
 
export default MovimentosDetalhes;