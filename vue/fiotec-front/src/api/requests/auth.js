import axios from '@/api/axios'


export async function login(data) {
  const res = await axios.post('/api/auth/login', data)
  axios.defaults.headers.common.Authorization = `Bearer ${res.data.access_token}`
  localStorage.setItem('token', res.data.access_token)
}

export function loadUser() {
}
export function checkStatus() {
  if (localStorage.getItem('token')) {
    return true
  } else {
    return false
  }
}

export function logOut() {
  localStorage.removeItem('token')
}

export default {
  login,
  logOut,
  checkStatus
}