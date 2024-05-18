<template>
  <v-dialog
    v-model="dialogAddSubject"
    max-width="400"
  >
    <template v-slot:activator="{ props: activatorProps }">
        <v-btn
         v-bind="activatorProps"
          density="compact"
          icon="mdi-file-plus"
          variant="text"
          size="small"
          :disabled="load"
        />
    </template>
    <v-card
      prepend-icon="mdi-file-multiple"
      title="Adicionar Matérias"
    >
      <template v-slot:text>
        <v-list lines="subjects" class="flex-grow-1">
          <v-list-item
            v-for="subject in subjects"
            :key="subject.id"
            :title="subject.name"
          >
            <template v-slot:append>
              <v-btn
                icon="mdi-plus"
                variant="text"
                :disabled="loading"
                @click="addSubject(subject.id)"
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
  name: 'AddSubject',

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
    dialogAddSubject: false,
    subjects: []
  }),
  computed: {
    snackBar() {
      return useSnackBar()
    }
  },
  async created () {
    await this.listSubjects()
  },

  methods: {
    close () {
      this.dialogAddSubject = false
    },

    async listSubjects () {
      this.loading = true
      try {
        this.subjects = await api.listSubjects()
        this.loading = false
      } catch (e) {
        const feedback = e?.response?.data?.message ?? 'Ocorreu um erro, tente novamente mais tarde'
        this.snackBar.increment({show: true, msg: feedback, color: 'warning'} )
        this.loading = false
      }
    },

    async addSubject (subjectId) {
      this.loading = true
      const data = {
        school_course_id: this.schoolCourseId,
        subject_id: subjectId
      }
      try {
        await api.createSchoolCourseSubject(data)
        this.snackBar.increment({show: true, msg: 'Matéria incluida com sucesso', color: 'success'} )
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