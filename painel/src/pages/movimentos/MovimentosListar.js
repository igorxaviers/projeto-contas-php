import React from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import { toast, ToastContainer } from 'react-toastify';


class MovimentosListar extends React.Component {
    constructor(props) {
        super(props);
        this.state = { 
            movimentos: [],
            loading: false,
            busca: ''
        }
    }

    componentDidMount() {
        this.getMovimentos();
    }

    handleSearch = (e) => {
        this.setState({
            busca: e.target.value
        })
    }

    getMovimentos = () => {
        this.setState({ loading: true });
        const cors = 'https://cors-anywhere.herokuapp.com/';
        // axios.post(cors+'https://contas-php.herokuapp.com/controllers/AcertoController.php', {acao: 4})
        axios.post('http://localhost/ProjetoPHP/controllers/MovimentoCaixaController.php', JSON.stringify({acao: 4}))
        .then(res => {
            this.setState({ movimentos: res.data });
        })
        .catch(err => console.log(err))
        .finally(() => this.setState({ loading: false }));
    }



    render() { 
        return ( 
            <>
                <h1>Movimentos</h1>

                <div>
                    <label htmlFor="valor">Busca:</label>
                    <div className="input-group mb-5" >
                        <span className="input-group-text" id="basic-addon2"><i className="fas fa-search"></i></span>
                        <input 
                            type="search"
                            className="form-control"
                            name="busca"
                            placeholder="Busque "
                            value={this.state.busca}
                            onChange={this.handleSearch}  />
                    </div>

                    <div className="loading">
                        {this.state.loading ? <i className="fas fa-circle-notch fa-spin mx-auto"></i> : ''}
                    </div>

                    <div className="row">
                        {
                            this.state.movimentos.map(movimento => {
                                if(true)
                                {
                                    //Condição do if: movimento.acerto.ace_motivo.toLowerCase().includes(this.state.busca.toLowerCase())
                                    return (
                                        <div className="col-md-6" key={movimento.mov_id}>
                                            <div className="bg-white shadow-sm rounded b-0 mb-3 p-4" >
                                                <div className="row gx-5">
                                                    <div className="col">
                                                        <h5 className="m-0">Movimento <strong className="badge text-black bg-light">{movimento.mov_id}</strong></h5>
                                                    </div>  
                                                </div>
                                                
                                                <div className="">
                                                    <h5 className="">R$ {movimento.mov_valor}</h5>
                                                    <p className="">{movimento.mov_tipo === 1 ? 'Entrada' : 'Saída'}</p>
                                                    <p className="my-0 fw-bold">Motivo</p>
                                                    <p className="p-2 rounded bg-light">{movimento.mov_acerto}</p>
                                                </div>
    
                                                <div className="d-grid gap-2 d-md-flex justify-content-md-end">
                                                    <Link 
                                                        to={{pathname: '/movimentos/detalhes', state: movimento}}
                                                        className="btn btn-warning btn-sm">
                                                        Ver detalhes
                                                    </Link>
                                                </div>
                                            </div>
                                        </div>
                                    )
                                }
                            })
                        }
                    </div>
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
            </>
        );
    }
}
 
export default MovimentosListar;