import './App.css';
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom';
import AcertosListar from './pages/acertos/AcertosListar';
import AcertosDetalhes from './pages/acertos/AcertosDetalhes';
import Alunos from './pages/Alunos';

function App() {
  return (
    <div className="App bg-light">
      <h1>Painel de Controle</h1>
      <div className="container">
        <Router>
          <Switch>
            <Route path="/alunos" exact component={Alunos} />
            <Route path="/acertos/" exact component={AcertosListar} />
            <Route path="/acertos/listar" exact component={AcertosListar} />
            <Route path="/acertos/detalhes" exact render={(props) => <AcertosDetalhes {...props} />} />
          </Switch>
        </Router>
      </div>
    </div>
  );
}

export default App;
