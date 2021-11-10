import './App.css';
import {BrowserRouter as Router, Link, Route, Switch} from 'react-router-dom';
import AcertosListar from './pages/acertos/AcertosListar';
import AcertosDetalhes from './pages/acertos/AcertosDetalhes';
import Alunos from './pages/Alunos';
import MovimentosListar from './pages/movimentos/MovimentosListar';
import MovimentosDetalhes from './pages/movimentos/MovimentosDetalhes';

function App() {
  return (
    <div className="App bg-light">
      <nav className="navbar bg-white text-center shadow-sm">
        <h1 className="w-100 text-center">Painel de Controle</h1>
      </nav>
      <div className="col-12 col-md-8 col-lg-6 mx-auto">
        <Router>
          <div className="mt-4 row justify-content-evenly">
            <Link 
              to="/movimentos"
              className="btn bg-white col-2 shadow-sm">Movimentos</Link>

            <Link 
              to="/acertos"
              className="btn bg-white col-2 shadow-sm">Acertos</Link>

          </div>
          <Switch>
            <Route path="/alunos" exact component={Alunos} />
            <Route path="/acertos/" exact component={AcertosListar} />
            <Route path="/acertos/listar" exact component={AcertosListar} />
            <Route path="/acertos/detalhes" exact render={(props) => <AcertosDetalhes {...props} />} />

            <Route path="/movimentos" exact component={MovimentosListar} />
            <Route path="/movimentos/listar" exact component={MovimentosListar} />
            <Route path="/movimentos/detalhes" exact render={(props) => <MovimentosDetalhes {...props} />} />
          </Switch>
        </Router>
      </div>
    </div>
  );
}

export default App;
