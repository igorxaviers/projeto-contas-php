import React from 'react';
import axios from 'axios';
import { toast } from 'react-toastify';

class Alunos extends React.Component {

    constructor(props) {
        super(props);
        this.state = { 
            nome: '',
            dataNascimento: '',
            email: '',
            acertos: []
        };
    }

    componentDidMount() {
        this.getAcertos();
    }
    
    getAcertos = () => {
        const cors = 'https://cors-anywhere.herokuapp.com/';
        //https://contas-php.herokuapp.com/controllers/AcertoController.php
        axios.post(cors+'https://contas-php.herokuapp.com/controllers/AcertoController.php', {acao: 4})
        .then(res => {
            console.log(res.data);
            this.setState({ acertos: res.data });
        })
        .catch(err => console.log(err));

    }

    handleChange = (event) => {
        const target = event.target;
        const value = target.value;
        const name = target.name;
        this.setState({
            [name]: value
        });
    }

    handleSubmit = (event) => {
        event.preventDefault();
        const aluno = {
            nome: this.state.nome,
            dataNascimento: this.state.dataNascimento,
            email: this.state.email
        };
        console.log(aluno);
        axios.post('http://localhost/alunos/cadastro', aluno)
            .then(res => {
                console.log(res);
                console.log(res.data);
                toast.success('Aluno cadastrado com sucesso!');
            })
            .catch(error => {
                console.log(error);
                toast.error('Erro ao cadastrar aluno!');
            });    
            toast.error('Erro ao cadastrar aluno!');
            
        this.setState({
            nome: '',
            dataNascimento: '',
            email: ''
        });
    }

    render() { 
        const saida = 
        <div>
            <h1>Cadastro de Alunos</h1>
            
            <form onSubmit={this.handleSubmit}>
                <div className="form-group">
                    <label htmlFor="nome">Nome</label>
                    <input 
                        type="text" 
                        className="form-control" 
                        id="nome" 
                        name="nome"
                        placeholder="Nome" 
                        value={this.state.nome} 
                        onChange={this.handleChange} />
                </div>
                <div className="form-group">
                    <label htmlFor="dataNascimento">Data de Nascimento</label>
                    <input 
                        type="date" 
                        className="form-control" 
                        id="dataNascimento" 
                        name="dataNascimento"
                        placeholder="Data de Nascimento" 
                        value={this.state.dataNascimento} 
                        onChange={this.handleChange} />
                </div>
                <div className="form-group">
                    <label htmlFor="email">Email</label>
                    <input 
                        type="email" 
                        className="form-control" 
                        id="email" 
                        name="email"
                        placeholder="Email" 
                        value={this.state.email} 
                        onChange={this.handleChange} />
                </div>
                <button type="submit" className="btn btn-primary">Cadastrar</button>
            </form>
        </div>

        return (saida);
    }
}
 
export default Alunos;