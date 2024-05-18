import axios from '@/api/axios'

export async function listSubjects() {
  const request =  await axios.get('/api/v1/subjects')
  return request.data.data
}

export async function createSubject(data) {
  await axios.post('/api/v1/subject', data)
}

export async function getSubject(id) {
  await axios.get('/api/v1/subject/' + id)
}

export async function updateSubject(id, data) {
  await axios.put('/api/v1/subject/' + id, data)
}

export async function deleteSubject(id) {
  await axios.delete('/api/v1/subject/' + id)
}

export default {
  listSubjects,
  createSubject,
  getSubject,
  updateSubject,
  deleteSubject
}