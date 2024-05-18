import axios from '@/api/axios'

export async function listStudents() {
  const request =  await axios.get('/api/v1/students')
  return request.data.data
}

export async function createStudent(data) {
  await axios.post('/api/v1/student', data)
}

export async function getStudent(id) {
  await axios.get('/api/v1/student/' + id)
}

export async function updateStudent(id, data) {
  await axios.put('/api/v1/student/' + id, data)
}

export async function deleteStudent(id) {
  await axios.delete('/api/v1/student/' + id)
}

export default {
  listStudents,
  createStudent,
  getStudent,
  updateStudent,
  deleteStudent
}