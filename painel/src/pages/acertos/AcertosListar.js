import React from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import { toast, ToastContainer } from 'react-toastify';
import { confirmAlert } from 'react-confirm-alert'; // Import
import 'react-confirm-alert/src/react-confirm-alert.css'; // Import css
import './Acertos.scss';


class AcertosListar extends React.Component {
    constructor(props) {
        super(props);
        this.state = { 
            acertos: [],
            loading: false,
            busca: ''
        }
    }

    componentDidMount() {
        this.getAcertos();
    }

    handleSearch = (e) => {
        this.setState({
            busca: e.target.value
        })
    }

    getAcertos = () => {
        this.setState({ loading: true });
        const cors = 'https://cors-anywhere.herokuapp.com/';
        // axios.post(cors+'https://contas-php.herokuapp.com/controllers/AcertoController.php', {acao: 4})
        axios.post('http://localhost/contas/controllers/AcertoController.php', JSON.stringify({acao: 4}))
        .then(res => {
            this.setState({ acertos: res.data });
        })
        .catch(err => console.log(err))
        .finally(() => this.setState({ loading: false }));
    }

    excluirAcerto = (id) => {
        confirmAlert({
            title: 'Confirmar exclusão',
            message: 'Deseja mesmo excluir o acerto?.',
            buttons: [
                {label: 'Não'},
                {
                    label: 'Sim',
                    onClick: () => {
                        this.setState({ loading: true });
                        axios.post('http://localhost/contas/controllers/AcertoController.php', JSON.stringify({acao: 3, ace_id: id}))
                        .then(res => {
                            const response = res.data;
                            console.log(response);
                            if(response.success)
                                toast.success(response.message);
                            else
                                toast.error(response.message);
                            let acertos = this.state.acertos;
                            acertos.splice(acertos.findIndex(acerto => acerto.ace_id === id), 1);
                            this.setState({ acertos });
                        })
                        .catch(err => console.log(err))
                        .finally(() => this.setState({ loading: false }));
                    }
                }
            ]
        });
    }



    render() { 
        return ( 
            <>
                <h1>Acertos</h1>
                <div className="text-end">
                    <Link 
                        to={{pathname: '/acertos/detalhes'}}
                        className="btn btn-dark">
                        <i className="fas fa-plus"></i> Novo acerto
                    </Link>
                </div>
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
                            this.state.acertos.map(acerto => {
                                if(acerto.ace_motivo.toLowerCase().includes(this.state.busca.toLowerCase()))
                                {
                                    return (
                                        <div className="col-md-6" key={acerto.ace_id}>
                                            <div className="bg-white shadow-sm rounded b-0 mb-3 p-4" >
                                                <div className="row gx-5">
                                                    <div className="col">
                                                        <h5 className="m-0">Acerto <strong className="badge text-black bg-light">{acerto.ace_id}</strong></h5>
                                                    </div>
                                                    <div className="col">
                                                        <p className="p-2 rounded bg-light text-dark"> <i className="far fa-calendar-alt"></i> {acerto.ace_data}</p>
                                                    </div>
                                                </div>
                                                
                                                <div className="">
                                                    <h5 className="">R$ {acerto.ace_valor}</h5>
                                                    <p className="">{acerto.ace_tipo === 1 ? 'Entrada' : 'Saída'}</p>
                                                    <p className="my-0 fw-bold">Motivo</p>
                                                    <p className="p-2 rounded bg-light">{acerto.ace_motivo}</p>
                                                </div>
    
                                                <div className="d-grid gap-2 d-md-flex justify-content-md-end">
                                                    <Link 
                                                        to={{pathname: '/acertos/detalhes', state: acerto}}
                                                        className="btn btn-warning btn-sm">
                                                        Editar
                                                    </Link>
    
                                                    <button 
                                                        className="btn btn-danger btn-sm"
                                                        onClick={() => this.excluirAcerto(acerto.ace_id)}>
                                                        Excluir
                                                    </button>
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
 
export default AcertosListar;