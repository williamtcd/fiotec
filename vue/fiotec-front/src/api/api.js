import auth from '@/api/requests/auth.js'
import subject from '@/api/requests/subject.js'
import schoolcourse from '@/api/requests/schoolcourse.js'
import student from '@/api/requests/student.js'

export default {
  ...auth,
  ...subject,
  ...schoolcourse,
  ...student
}
