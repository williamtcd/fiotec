<template>
  <div class="d-flex justify-center">
    <v-data-table
      :headers="headers"
      :items="schoolCourses"
      items-per-page="5"
      :loading="loading"
      style="max-width: 600px;"
    >
      <template v-slot:top>
        <v-toolbar
          flat
        >
          <v-toolbar-title>Turmas</v-toolbar-title>
          <v-divider
            class="mx-4"
            inset
            vertical
          />
          <v-spacer />
          <NewSchoolCourse
            @reload="listSchoolCourses"
          />
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon
          class="me-2"
          size="small"
          @click="editSchoolCourse(item)"
        >
          mdi-pencil
        </v-icon>
        <v-icon
          class="ml-4"
          size="small"
          @click="deleteSchoolCourse(item)"
        >
          mdi-delete
        </v-icon>
      </template>
      <template v-slot:no-data>
        Nenhuma turma cadastrada
      </template>
      <template v-slot:loading>
        <v-skeleton-loader type="table-row@5"></v-skeleton-loader>
      </template>
    </v-data-table>

    <DeleteSchoolCourse
      :dialog-delete-school-course="dialogDeleteSchoolCourse"
      :school-course-id="schoolCourseId"
      :school-course-name="schoolCourseName"
      @reload="listSchoolCourses"
      @close="closeDialogs"
    />

    <EditSchoolCourse
      :dialog-edit-school-course="dialogEditSchoolCourse"
      :school-course-id="schoolCourseId"
      :school-course-name="schoolCourseName"
      @reload="listSchoolCourses"
      @close="closeDialogs"
    />
</div>
</template>
<script>
  import api from '@/api/api'
  import NewSchoolCourse from '@/components/schoolCourses/NewSchoolCourse.vue'
  import DeleteSchoolCourse from '@/components/schoolCourses/DeleteSchoolCourse.vue'
  import EditSchoolCourse from '@/components/schoolCourses/EditSchoolCourse.vue'
  import { useSnackBar } from '@/stores/snackBar.js'
  
    export default {
    name: 'SchoolCourses',

    components: {
      NewSchoolCourse,
      DeleteSchoolCourse,
      EditSchoolCourse
    },

    layout: 'Default',
      data: () => ({
        dialog: false,
        loading: false,
        dialogDeleteSchoolCourse: false,
        dialogEditSchoolCourse: false,
        schoolCourseName: '',
        schoolCourseId: null,
        headers: [
          {
            title: 'ID',
            align: 'center',
            key: 'id',
            sortable: false
          },
          {
            title: 'Nome',
            align: 'center',
            key: 'name',
            sortable: false
          },
          { 
            title: '',
            key: 'actions', 
            align: 'end',
            sortable: false
          },
        ],
        schoolCourses: []
      }),
      computed: {
        snackBar() {
          return useSnackBar()
        }
      },

      async created () {
        await this.listSchoolCourses()
      },

      methods: {
        deleteSchoolCourse (schoolCourse) {
          this.schoolCourseId = schoolCourse.id
          this.schoolCourseName = schoolCourse.name
          this.dialogDeleteSchoolCourse = true
        },
        editSchoolCourse (schoolCourse) {
          this.$router.push({ name: 'edit-schoolcourse', params: { id: schoolCourse.id } })
        },

        closeDialogs () {
          this.dialogDeleteSchoolCourse = false
          this.dialogEditSchoolCourse = false
          this.schoolCourseId = null
          this.schoolCourseName = ''
        },

        async listSchoolCourses () {
          this.loading = true
          try {
            this.schoolCourses = await api.listSchoolCourses()
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