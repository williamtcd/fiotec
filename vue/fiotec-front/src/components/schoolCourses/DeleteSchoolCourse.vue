<template>
  <v-dialog
    v-model="dialog"
    max-width="500"
    persistent
  >
    <v-card
      prepend-icon="mdi-delete"
      title="APAGAR TURMA"
    >
      <template v-slot:text>
        <v-progress-linear
          v-if="loading"
          color="#008ABD"
          indeterminate
        />
        Tem certeza que deseja apagar a turma {{ schoolCourseName }} ?
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
          @click="deleteSchoolCourseConfirm"
        >
          Apagar
        </v-btn>
      </template>
    </v-card>
  </v-dialog>
</template>
<script>
  import api from '@/api/api';
  import { useSnackBar } from '@/stores/snackBar.js'

  export default {
  name: 'DeleteSchoolCourse',

  props: {
    schoolCourseId: {
      type: Number,
      default: null
    },
    schoolCourseName: {
      type: String,
      default: ''
    },
    dialogDeleteSchoolCourse: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    snackBar() {
      return useSnackBar()
    }
  },
  watch: {
    dialogDeleteSchoolCourse () {
      this.dialog = this.dialogDeleteSchoolCourse ? this.dialogDeleteSchoolCourse : false
    }
  },

  data: () => ({
    loading: false,
    name: '',
    dialog: false
  }),

  methods: {
    close () {
      this.$emit('close')
    },
    async deleteSchoolCourseConfirm () {
      this.loading = true
      try {
        await api.deleteSchoolCourse(this.schoolCourseId)
        this.$emit('reload')
        this.snackBar.increment({show: true, msg: 'Turma apagada com sucesso', color: 'success'} )
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