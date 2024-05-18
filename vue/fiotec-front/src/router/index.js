import { createWebHistory, createRouter } from 'vue-router'
import api from '@/api/api'

import Login from '@/views/Login.vue'
import Error404 from '@/views/Error-404.vue'
import Subjects from '@/views/Subjects.vue'
import Students from '@/views/Students.vue'
import SchoolCourses from '@/views/SchoolCourses.vue'
import EditSchoolCourse from '@/views/EditSchoolCourse.vue'
import Home from '@/views/Home-default.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'login',
      component: Login
    },
    {
      path: '/home',
      name: 'home',
      component: Home
    },
    {
      path: '/alunos',
      name: 'students',
      component: Students
    },
    {
      path: '/materias',
      name: 'subjects',
      component: Subjects
    },
    {
      path: '/turmas',
      name: 'schoolcourses',
      component: SchoolCourses
    },
    {
      path: '/turma/:id',
      name: 'edit-schoolcourse',
      component: EditSchoolCourse
    },
    {
      path: '/:pathMatch(.*)*',
      name: 'not-found',
      component: Error404
    }
  ]
})
router.beforeEach((to, from, next) => {
  if (to.name !== 'login' && api.checkStatus() === false) next({ name: 'login' })
  else if (to.name === 'login' && api.checkStatus() === true) next({ name: 'home' })
  else next()
})

export default router