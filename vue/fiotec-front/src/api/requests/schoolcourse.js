import axios from '@/api/axios'

export async function listSchoolCourses() {
  const request =  await axios.get('/api/v1/schoolcourses')
  return request.data.data
}

export async function createSchoolCourse(data) {
  await axios.post('/api/v1/schoolcourse', data)
}

export async function getSchoolCourse(id) {
  const request =  await axios.get('/api/v1/schoolcourse/' + id)
  return request.data.data
}

export async function updateSchoolCourse(id, data) {
  await axios.put('/api/v1/schoolcourse/' + id, data)
}

export async function deleteSchoolCourse(id) {
  await axios.delete('/api/v1/schoolcourse/' + id)
}

export async function enrollment(data) {
  await axios.post('/api/v1/schoolcourse/student', data)
}

export async function unenrollment(id) {
  await axios.delete('/api/v1/schoolcourse/student/' + id)
}

export async function createSchoolCourseSubject(data) {
  await axios.post('/api/v1/schoolcourse/subject', data)
}

export async function deleteSchoolCourseSubject(id) {
  await axios.delete('/api/v1/schoolcourse/subject/' + id)
}

export default {
  listSchoolCourses,
  createSchoolCourse,
  getSchoolCourse,
  updateSchoolCourse,
  deleteSchoolCourse,
  enrollment,
  unenrollment,
  createSchoolCourseSubject,
  deleteSchoolCourseSubject

}