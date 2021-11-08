import React from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';

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

    render() { 
        return ( 
            <>
                <h1>Acertos</h1>
                <div className="container">
                    {this.state.loading ? <i className="fas fa-circle-notch fa-spin"></i> : ''}
                    <div className="row">
                        {
                            this.state.acertos.map(acerto => {
                                return (

                                    <div className="col-md-6" key={acerto.ace_id}>
                                        <div className="bg-white shadow-sm rounded b-0 mb-3 p-4" >
                                            <div className="row justify-content-between">
                                                <h5 className="m-0">Acerto data: </h5>
                                                <p className="badge bg-light text-dark">{acerto.ace_data}</p>

                                            </div>
                                            <div className="">
                                                <h5 className="">R$ {acerto.ace_valor}</h5>
                                                <p className="">{acerto.ace_tipo == 1 ? 'Entrada' : 'Saída'}</p>
                                                <p className="">{acerto.ace_motivo}</p>
                                            </div>


                                                <Link to={{
                                                    pathname: `/acertos/detalhes`,
                                                    state: acerto
                                                }}>Editar   </Link>

                                            
                                        </div>
                                    </div>

                                    // <div key={acerto.ace_id}>
                                    //     <p>{acerto.ace_id}</p>
                                    //     <p>{acerto.ace_data}</p>
                                    //     <p>{acerto.ace_valor}</p>
                                    //     <p>{acerto.ace_tipo}</p>
                                    //     <p>{acerto.ace_motivo}</p>
                                    // </div>
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