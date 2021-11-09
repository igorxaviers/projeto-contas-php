import React from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import { confirmAlert } from 'react-confirm-alert'; // Import
import 'react-confirm-alert/src/react-confirm-alert.css'; // Import css

class AcertosListar extends React.Component {
    constructor(props) {
        super(props);
        this.state = { 
            acertos: [],
            loading: false
        }
    }

    componentDidMount() {
        this.getAcertos();

    }

    getAcertos = () => {
        this.setState({ loading: true });
        //https://contas-php.herokuapp.com/controllers/AcertoController.php
        const cors = 'https://cors-anywhere.herokuapp.com/';
        axios.post(cors+'https://contas-php.herokuapp.com/controllers/AcertoController.php', {acao: 4})
        .then(res => {
            console.log(res.data);
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
                    label: 'Yes',
                    onClick: () => {
                        this.setState({ loading: true });
                        axios.post('http://localhost/contas/controllers/AcertoController.php', {acao: 3, ace_id: id})
                        .then(res => {
                            console.log(res.data);
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

        // axios.post(cors+'https://contas-php.herokuapp.com/controllers/AcertoController.php', {acao: 5, id: id})

    }

    render() { 
        return ( 
            <>
                <h1>Acertos</h1>
                <div className="container">
                    <div className="mx-auto my-4">
                        {this.state.loading ? <i className="fas fa-circle-notch fa-spin mx-auto"></i> : ''}

                    </div>
                    <div className="row">
                        {
                            this.state.acertos.map(acerto => {
                                return (

                                    <div className="col-md-6" key={acerto.ace_id}>
                                        <div className="bg-white shadow-sm rounded b-0 mb-3 p-4" >
                                            <div class="row gx-5">
                                                <div class="col">
                                                    <h5 className="m-0">Acerto <strong className="badge text-black bg-light">{acerto.ace_id}</strong></h5>
                                                </div>
                                                <div class="col">
                                                    <p className="p-2 rounded bg-light text-dark"> <i class="far fa-calendar-alt"></i> {acerto.ace_data}</p>
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
                            })
                        }
                    </div>
                </div>
            </>
        );
    }
}
 
export default AcertosListar;