<template>
  <div class="d-flex justify-center">
    <v-data-table
      :headers="headers"
      :items="students"
      items-per-page="5"
      :loading="loading"
      style="max-width: 600px;"
    >
      <template v-slot:top>
        <v-toolbar
          flat
        >
          <v-toolbar-title>Alunos</v-toolbar-title>
          <v-divider
            class="mx-4"
            inset
            vertical
          />
          <v-spacer></v-spacer>
          <NewStudent
            @reload="listStudents"
          />
          <DeleteStudent
            v-model="dialogDeleteStudent"
            :student-id="studentId"
            :student-name="studentName"
            @reload="listStudents"
            @close="closeDialogs"
          />
          <EditStudent
            v-model="dialogEditStudent"
            :student-id="studentId"
            :student-name="studentName"
            @reload="listStudents"
            @close="closeDialogs"
          />
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon
          class="me-2"
          size="small"
          @click="editStudent(item)"
        >
          mdi-pencil
        </v-icon>
        <v-icon
          class="ml-4"
          size="small"
          @click="deleteStudent(item)"
        >
          mdi-delete
        </v-icon>
      </template>
      <template v-slot:no-data>
        Nenhum aluno cadastrado
      </template>
      <template v-slot:loading>
        <v-skeleton-loader type="table-row@5"></v-skeleton-loader>
      </template>
    </v-data-table>
</div>
</template>
<script>
  import api from '@/api/api'
  import NewStudent from '@/components/students/NewStudent.vue'
  import DeleteStudent from '@/components/students/DeleteStudent.vue'
  import EditStudent from '@/components/students/EditStudent.vue'
  import { useSnackBar } from '@/stores/snackBar.js'

    export default {
    name: 'Students',

    components: {
      NewStudent,
      DeleteStudent,
      EditStudent
    },

    layout: 'Default',
      data: () => ({
        dialog: false,
        dialogDeleteStudent: false,
        dialogEditStudent: false,
        studentName: '',
        studentId: null,
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

        { title: '',
          key: 'actions', 
          align: 'end',
          sortable: false
        },
        ],
        students: []
      }),

      computed: {
        snackBar() {
          return useSnackBar()
        }
      },

      watch: {
      },

      async created () {
        await this.listStudents()
      },

      methods: {
        editItem (item) {
          console.log(item)
        },

        deleteStudent (student) {
          this.studentId = student.id
          this.studentName = student.name
          this.dialogDeleteStudent = true
        },
        editStudent (student) {
          this.studentId = student.id
          this.studentName = student.name
          this.dialogEditStudent = true
        },

        closeDialogs () {
          this.dialogDeleteStudent = false
          this.dialogEditStudent = false
          this.studentId = null
          this.studentName = ''
        },

        async listStudents () {
          this.loading = true
          try {
            this.students = await api.listStudents()
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