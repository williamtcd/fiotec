<template>
  <v-dialog
    v-model="dialog"
    max-width="400"
    persistent
  >
    <template v-slot:activator="{ props: activatorProps }">
      <v-btn v-bind="activatorProps" color="#008ABD">
        Novo Aluno(a)
      </v-btn>
    </template>
    <v-card
      prepend-icon="mdi-account-school"
      title="Novo Aluno(a)"
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
          @click="dialog = false"
        >
          Cancela
        </v-btn>
        <v-btn
          :disabled="loading"  
          @click="save"
        >
          Salvar
        </v-btn>
      </template>
    </v-card>
  </v-dialog>
</template>
<script>
import api from '@/api/api';
import { useSnackBar } from '@/stores/snackBar.js'

  export default {
    name: 'NewStudents',
    layout: 'Default',

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
    dialog () {
      if (this.dialog === false) {
        this.name = ''
      }
    }
  },
  created () {
  },

  methods: {
    async save () {
      this.loading = true
      const data = {
        name: this.name
      }
      try {
        await api.createStudent(data)
        this.$emit('reload')
        this.snackBar.increment({show: true, msg: 'Aluno cadastrado com sucesso', color: 'success'} )
        this.dialog = false
        this.loading =false
      } catch (e) {
        this.loading =false
        const feedback = e?.response?.data?.message ?? 'Ocorreu um erro, tente novamente mais tarde'
        this.snackBar.increment({show: true, msg: feedback, color: 'warning'} )
      }
    }
  }
}
</script>