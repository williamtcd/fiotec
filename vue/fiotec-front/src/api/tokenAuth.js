// import UAParser from 'ua-parser-js'
// import api from '@/plugins/api'
// import axios from 'api/axios'

// export function getCookie () {
//   // does nothign
// }

// export function checkLogin () {
//   if (!localStorage.getItem('user')) {
//     return false
//   }
//   return true
// }

// export async function login (data) {
//   const device = new UAParser()
//   data.device_name = device.getOS().name + '-' + device.getOS().version
//   const res = await api.tokenLogin(data)
//   axios.defaults.headers.common.Authorization = `Bearer ${res.data.data.token}`
//   localStorage.setItem('token', res.data.data.token)
// }

// export async function lookUp (data) {
//   return api.lookUp(data)
// }

// export async function logout () {
//   const r = await api.tokenLogout()
//   delete axios.defaults.headers.common.Authorization
//   return r
// }

// export default {
//   getCookie,
//   checkLogin,
//   login,
//   lookUp,
//   logout
// }
