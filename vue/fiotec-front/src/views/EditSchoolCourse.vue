<template>
  <div class="d-flex justify-center">
    <v-card
      color="grey-lighten-4"
      height="600px"
      width="600px"
      rounded="0"
      flat
    >
      <v-toolbar density="compact">
        <v-icon class="ml-2" @click="$router.go( -1 )">mdi-arrow-left-bold</v-icon>
        <v-skeleton-loader
          v-if="loading"
          width="400"
          color="transparent"
          type="list-item@1"
        />
        <v-toolbar-title v-else><strong> {{ schoolCourse?.name  }} </strong></v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn icon 
          @click="editSchoolCourse(item)"
          :disabled="loading"
        >
          <v-icon>mdi-pencil</v-icon>
        </v-btn>
      </v-toolbar>

      <div class="d-flex flex-row">
        <v-list lines="students" class="flex-grow-1">
            <div class="d-flex justify-space-around align-center mt-2">
              <h3>Alunos</h3>
              <AddStudent
                :school-course-id="schoolCourseId"
                :load="loading"
                @reload="getSchoolCourse"
              />
            </div>
            <div class="align-start mt-2">
              <v-skeleton-loader
                v-if="loading"
                type="list-item@3"
              />
              <v-list-item
                v-else
                v-for="student in schoolCourse.students"
                :key="student.id"
              >
              <v-list-item-title><strong> {{ student.name }} </strong></v-list-item-title>
                <template v-slot:append>
                  <v-btn
                    icon="mdi-account-minus"
                    size="small"
                    variant="text"
                    :disabled="loading"
                    @click="deleteStudent(student)"
                  />
                </template>
              </v-list-item>
          </div>
        </v-list>

        <v-list lines="subjects" class="flex-grow-1">
            <div class="d-flex justify-space-around align-center mt-2">
              <h3>Matérias</h3>
              <AddSubject
                :school-course-id="schoolCourseId"
                :load="loading"
                @reload="getSchoolCourse"
              />
            </div>
            <div class="align-start mt-2">
              <v-skeleton-loader
                v-if="loading"
                type="list-item@3"
              />
              <v-list-item
                v-else
                v-for="subject in schoolCourse.subjects"
                :key="subject.id"
                start
              >
              <v-list-item-title><strong> {{ subject.name }} </strong></v-list-item-title>
                <template v-slot:append>
                  <v-btn
                    icon="mdi-file-minus"
                    size="small"
                    variant="text"
                    :disabled="loading"
                    @click="deleteSchoolCourseSubject(subject)"
                  />
                </template>
              </v-list-item>
          </div>
        </v-list>
      </div>
    </v-card>

    <EditSchoolCourse
      v-model="dialogEditSchoolCourse"
      :school-course-id="schoolCourseId"
      :school-course-name="schoolCourseName"
      @reload="getSchoolCourse"
      @close="closeDialogs"
    />
  </div>
</template>
<script>
  import api from '@/api/api'
  import AddStudent from '@/components/schoolCourses/AddStudent.vue'
  import AddSubject from '@/components/schoolCourses/AddSubject.vue'
  import EditSchoolCourse from '@/components/schoolCourses/EditSchoolCourse.vue'
  import { useSnackBar } from '@/stores/snackBar.js'

    export default {
    name: 'EditSchoolCourses',

    components: {
      AddStudent,
      AddSubject,
      EditSchoolCourse
    },

    layout: 'Default',
      data: () => ({
        dialog: false,
        loading: false,
        dialogEditSchoolCourse: false,
        schoolCourseName: '',
        schoolCourse: {}
      }),
      computed: {
        schoolCourseId () {
          return parseInt(this.$route.params.id)
        },
        snackBar() {
          return useSnackBar()
        }
      },

      async created () {
        await this.getSchoolCourse()
      },

      methods: {
        editSchoolCourse () {
          this.schoolCourseName = this.schoolCourse.name
          this.dialogEditSchoolCourse = true
        },
        closeDialogs () {
          this.dialogEditSchoolCourse = false
          this.schoolCourseName = ''
        },
        async deleteStudent(student) {
          this.loading = true
          try {
            await api.unenrollment(student.pivot.id)
            await this.getSchoolCourse()
            this.snackBar.increment({show: true, msg: 'Aluno retirado da turma com sucesso', color: 'success'} )
            this.loading = false
          } catch (e) {
            this.loading = false
            const feedback = e?.response?.data?.message ?? 'Ocorreu um erro, tente novamente mais tarde'
            this.snackBar.increment({show: true, msg: feedback, color: 'warning'} )
          }
        },

        async deleteSchoolCourseSubject(subject) {
          this.loading = true
          try {
            await api.deleteSchoolCourseSubject(subject.pivot.id)
            await this.getSchoolCourse()
            this.snackBar.increment({show: true, msg: 'Matéria retirada da turma com sucesso', color: 'success'} )
            this.loading = false
          } catch (e) {
            this.loading = false
            const feedback = e?.response?.data?.message ?? 'Ocorreu um erro, tente novamente mais tarde'
            this.snackBar.increment({show: true, msg: feedback, color: 'warning'} )
          }
        },

        async getSchoolCourse () {
          this.loading = true
          try {
            const request = await api.getSchoolCourse(this.schoolCourseId)
            this.schoolCourse = request
            this.loading = false
          } catch (e) {
            this.loading = false
            const feedback = e?.response?.data?.message ?? 'Ocorreu um erro, tente novamente mais tarde'
            this.snackBar.increment({show: true, msg: feedback, color: 'warning'} )
          }
        }
      }
  }
</script>