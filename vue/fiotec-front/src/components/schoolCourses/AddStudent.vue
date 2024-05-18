<template>
  <v-dialog
    v-model="dialogAddStudent"
    max-width="400"
  >
    <template v-slot:activator="{ props: activatorProps }">
        <v-btn
          v-bind="activatorProps"
          density="compact"
          icon="mdi-account-plus"
          variant="text"
          size="small"
          :disabled="load"
        />
    </template>
    <v-card
      prepend-icon="mdi-account-school"
      title="Adicionar Alunos"
    >
      <template v-slot:text>
        <v-list lines="students" class="flex-grow-1">
          <v-list-item
            v-for="student in students"
            :key="student.id"
            :title="student.name"
          >
            <template v-slot:append>
              <v-btn
                icon="mdi-plus"
                variant="text"
                :disabled="loading"
                @click="addStudent(student.id)"
              />
            </template>
          </v-list-item>
        </v-list>
      </template>
    </v-card>
  </v-dialog>
</template>
<script>
import api from '@/api/api';
import { useSnackBar } from '@/stores/snackBar.js'

export default {
  name: 'AddStudent',

  props: {
    schoolCourseId: {
      type: Number,
      default: null
    },
    load: {
      type: Boolean,
      default: false
    }
  },
  data: () => ({
    loading: false,
    dialogAddStudent: false,
    students: []
  }),
  computed: {
    snackBar() {
      return useSnackBar()
    }
  },

  async created () {
    await this.listStudents()
  },

  methods: {
    close () {
      this.dialogAddStudent = false
    },

    async listStudents () {
      this.loading = true
      try {
        this.students = await api.listStudents()
        this.loading = false
      } catch (e) {
        const feedback = e?.response?.data?.message ?? 'Ocorreu um erro, tente novamente mais tarde'
        this.snackBar.increment({show: true, msg: feedback, color: 'warning'} )
        this.loading = false
      }
    },

    async addStudent (studentId) {
      this.loading = true
      const data = {
        school_course_id: this.schoolCourseId,
        student_id: studentId
      }
      try {
        await api.enrollment(data)
        this.snackBar.increment({show: true, msg: 'Aluno incluido com sucesso', color: 'success'} )
        this.$emit('reload')
        this.loading = false
      } catch (e) {
        const feedback = e?.response?.data?.message ?? 'Ocorreu um erro, tente novamente mais tarde'
        this.snackBar.increment({show: true, msg: feedback, color: 'warning'} )
        this.loading = false
      }
    }
  }
}
</script>