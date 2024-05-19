<template>
  <v-dialog
    v-model="dialog"
    max-width="400"
    persistent
  >
    <v-card
      prepend-icon="mdi-account-school"
      title="Editar Turma"
    >
      <template v-slot:text>
        <v-progress-linear
          v-if="loading"
          color="#008ABD"
          indeterminate
        />
        <v-text-field
          v-model="name"
          label="Nome"
          variant="underlined"
          :disabled="loading"
        />
      </template>
      <template v-slot:actions>
        <v-spacer></v-spacer>
        <v-btn
          :disabled="loading"
          @click="close"
        >
          Cancela
        </v-btn>
        <v-btn
          :disabled="loading"  
          @click="update"
        >
          Atualizar
        </v-btn>
      </template>
    </v-card>
  </v-dialog>
</template>
<script>
import api from '@/api/api';
import { useSnackBar } from '@/stores/snackBar.js'

  export default {
    name: 'EditSchoolCourse',

    props: {
      schoolCourseId: {
        type: Number,
        default: null
      },
      schoolCourseName: {
        type: String,
        default: ''
      },
      dialogEditSchoolCourse: {
        type: Boolean,
        default: false
      }
    },
  data: () => ({
    loading: false,
    dialog: false,
    name: ''
  }),
  computed: {
    snackBar() {
      return useSnackBar()
    }
  },
  watch: {
    schoolCourseName () {
      this.name = this.schoolCourseName
    },
    dialogEditSchoolCourse () {
      this.dialog = this.dialogEditSchoolCourse ? this.dialogEditSchoolCourse : false
    }
  },
  created () {
    this.name = this.schoolCourseName
  },

  methods: {
    close () {
      this.$emit('close')
    },
    async update () {
      this.loading = true
      const data = {
        name: this.name
      }
      try {
        await api.updateSchoolCourse(this.schoolCourseId, data)
        this.$emit('reload')
        this.snackBar.increment({show: true, msg: 'Turma atualizada com sucesso', color: 'success'} )
        this.loading = false
        this.$emit('close')
      } catch (e) {
        this.loading = false
        const feedback = e?.response?.data?.message ?? 'Ocorreu um erro, tente novamente mais tarde'
        this.snackBar.increment({show: true, msg: feedback, color: 'warning'} )
      }
    }
  }
}
</script>