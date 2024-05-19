<template>
  <v-dialog
    v-model="dialog"
    max-width="500"
    persistent
  >
    <v-card
      prepend-icon="mdi-delete"
      title="APAGAR MATÉRIA"
    >
      <template v-slot:text>
        <v-progress-linear
          v-if="loading"
          color="#008ABD"
          indeterminate
        />
        Tem certeza que deseja apagar a matéria {{ subjectName }} ?
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
          @click="deleteSubjectConfirm"
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
  name: 'DeleteSubject',

  props: {
    subjectId: {
      type: Number,
      default: null
    },
    subjectName: {
      type: String,
      default: ''
    },
    dialogDeleteSubject: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    snackBar() {
      return useSnackBar()
    }
  },

  data: () => ({
    loading: false,
    name: '',
    dialog: false
  }),
  watch: {
    dialogDeleteSubject () {
      this.dialog = this.dialogDeleteSubject ? this.dialogDeleteSubject : false
    }
  },

  methods: {
    close () {
      this.$emit('close')
    },
    async deleteSubjectConfirm () {
      this.loading = true
      try {
        await api.deleteSubject(this.subjectId)
        this.$emit('reload')
        this.snackBar.increment({show: true, msg: 'Matéria apagada com sucesso', color: 'success'} )
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