import axios from "axios";
// https://contas-php.herokuapp.com/controllers/AcertoController.php
// http://localhost/contas/controllers/AcertoController.php
const api = axios.create({
  baseURL: "https://contas-php.herokuapp.com/controllers/AcertoController.php",
});

export default api;