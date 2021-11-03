import './App.css';
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom';
import Alunos from './pages/Alunos';

function App() {
  return (
    <div className="App">
      <h1>Painel de Controle</h1>
      <Router>
        <Switch>
          <Route path="/alunos" exact component={Alunos} />
        </Switch>
      </Router>
    </div>
  );
}

export default App;
