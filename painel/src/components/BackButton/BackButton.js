import React from 'react';
import './Backbutton.scss';

class BackButton extends React.Component {
    constructor(props) {
        super(props);
        this.state = {  }
    }

    // Função para voltar para a página anterior
    backPage = () => {
        window.history.back();
    }

    render() { 
        return ( 
            <i  
                className="fas fa-arrow-left back"
                onClick={this.backPage}>
            </i>
         );
    }
}
 
export default BackButton;