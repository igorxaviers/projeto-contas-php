import React from 'react';
import { toast, ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import axios from 'axios';
import BackButton from '../../components/BackButton/BackButton';

class MovimentosDetalhes extends React.Component {
    constructor(props) {
        super(props);
        this.state = { 
            mov_id: '',
            mov_valor: '',
            mov_tipo: '',
            mov_acerto: '',
            mov_caixa: '',
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
                mov_id: location.mov_id,
                mov_valor: location.mov_valor,
                mov_acerto: location.mov_acerto,
                mov_tipo: location.mov_tipo,
                mov_caixa: location.mov_caixa,
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
                <h1 className="my-5 ">{this.state.mov_id ? 'Editar' : 'Cadastro'}</h1>
                <form>

                    <label htmlFor="valor">Valor:</label>
                    <div className="input-group mb-3" >
                        <span className="input-group-text" id="basic-addon2"><i className="fas fa-dollar-sign"></i></span>
                        <input 
                            type="text"
                            className="form-control"
                            name="mov_valor"
                            placeholder="Valor da movimentação"
                            value={this.state.mov_valor}
                            readOnly/>
                    </div>

                    <label htmlFor="data">Data:</label>
                    <div className="input-group mb-3">
                        <span className="input-group-text" id="basic-addon2"><i className="fas fa-calendar-alt"></i></span>
                        <input 
                            type="date"
                            className="form-control"
                            name="mov_acerto"
                            placeholder="Data da movimentação"
                            value={this.state.mov_acerto}
                            readOnly />
                    </div>

                    <label htmlFor="tipo">Tipo:</label>
                    <div className="input-group mb-3" >
                    <span className="input-group-text" id="basic-addon2"><i className="fas fa-list"></i></span>
                        <select 
                            className="form-control"
                            name="mov_tipo"
                            value={this.state.mov_tipo}
                            readOnly>

                        </select>
                    </div>
                    <div className="form-group">
                        <label htmlFor="motivo">Motivo:</label>
                        <textarea 
                            type="text"
                            className="form-control"
                            name="mov_acerto"
                            placeholder=""
                            value={this.state.mov_acerto}
                            readOnly>
                        </textarea>
                    </div>
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
 
export default MovimentosDetalhes;