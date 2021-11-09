import './App.css';
import {BrowserRouter as Router, Link, Route, Switch} from 'react-router-dom';
import AcertosListar from './pages/acertos/AcertosListar';
import AcertosDetalhes from './pages/acertos/AcertosDetalhes';
import Alunos from './pages/Alunos';

function App() {
  return (
    <div className="App bg-light">
      <nav className="navbar bg-white text-center shadow-sm">
        <h1 className="w-100 text-center">Painel de Controle</h1>
      </nav>
      <div className="container">
        <Router>
          <div className="mt-4 row justify-content-evenly">
            <Link 
              to="/asdasd"
              className="btn bg-white col-2 shadow-sm">asdasd</Link>

            <Link 
              to="/acertos"
              className="btn bg-white col-2 shadow-sm">Acertos</Link>

          </div>
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
