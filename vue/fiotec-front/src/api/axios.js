import axios from 'axios'

axios.defaults.withCredentials = true
axios.defaults.baseURL = "http://localhost:8181"

export default axios
