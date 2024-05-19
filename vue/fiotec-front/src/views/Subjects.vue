<template>
  <div class="d-flex justify-center">
    <v-data-table
      :headers="headers"
      :items="subjects"
      items-per-page="5"
      :loading="loading"
      style="max-width: 600px;"
    >
      <template v-slot:top>
        <v-toolbar
          flat
        >
          <v-toolbar-title>Matérias</v-toolbar-title>
          <v-divider
            class="mx-4"
            inset
            vertical
          />
          <v-spacer></v-spacer>
          <NewSubject
            @reload="listSubjects"
          />
          <DeleteSubject
            :dialog-delete-subject="dialogDeleteSubject"
            :subject-id="subjectId"
            :subject-name="subjectName"
            @reload="listSubjects"
            @close="closeDialogs"
          />
          <EditSubject
            :dialog-edit-subject="dialogEditSubject"
            :subject-id="subjectId"
            :subject-name="subjectName"
            @reload="listSubjects"
            @close="closeDialogs"
          />
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon
          class="me-2"
          size="small"
          @click="editSubject(item)"
        >
          mdi-pencil
        </v-icon>
        <v-icon
          class="ml-4"
          size="small"
          @click="deleteSubject(item)"
        >
          mdi-delete
        </v-icon>
      </template>
      <template v-slot:no-data>
        Nenhuma matéria cadastrada
      </template>
      <template v-slot:loading>
        <v-skeleton-loader type="table-row@5"></v-skeleton-loader>
      </template>
    </v-data-table>
</div>
</template>
<script>
  import api from '@/api/api'
  import NewSubject from '@/components/subjects/NewSubject.vue'
  import DeleteSubject from '@/components/subjects/DeleteSubject.vue'
  import EditSubject from '@/components/subjects/EditSubject.vue'
  import { useSnackBar } from '@/stores/snackBar.js'

    export default {
    name: 'Subjects',

    components: {
      NewSubject,
      DeleteSubject,
      EditSubject
    },

    layout: 'Default',
      data: () => ({
        dialog: false,
        loading: false,
        dialogDeleteSubject: false,
        dialogEditSubject: false,
        subjectName: '',
        subjectId: null,
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
        subjects: []
      }),

      computed: {
        snackBar() {
          return useSnackBar()
        }
      },

      watch: {
      },

      async created () {
        await this.listSubjects()
      },

      methods: {
        editItem (item) {
          console.log(item)
        },

        deleteSubject (subject) {
          this.subjectId = subject.id
          this.subjectName = subject.name
          this.dialogDeleteSubject = true
        },
        editSubject (subject) {
          this.subjectId = subject.id
          this.subjectName = subject.name
          this.dialogEditSubject = true
        },

        closeDialogs () {
          this.dialogDeleteSubject = false
          this.dialogEditSubject = false
          this.subjectId = null
          this.subjectName = ''
        },

        async listSubjects () {
          this.loading = true
          try {
            this.subjects = await api.listSubjects()
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