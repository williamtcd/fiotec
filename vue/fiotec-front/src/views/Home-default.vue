<script>
export default {
  name: 'Home',
  layout: 'Default',
  components: {
  },
  data: () => ({
  }),
  methods: {
  }
}
</script>
<template>
  <div class="d-flex justify-center">
    <div class="d-flex flex-row flex-wrap justify-center align-center mt-10 w-100" style="max-width: 900px">
      <div class="mx-5 my-5">
        <v-card
          class="mx-auto white"
          max-width="344"
        >
          <v-card-actions class="d-flex justify-end">
            <v-btn
              variant="text"
              color="teal-accent-4"
              @click="$router.push({ name: 'students'})"
            >
              <div class="d-flex text-h6 mb-1 align-center">
                <v-icon class="mr-4">
                  mdi-account-school
                </v-icon>
                Cadastro dos alunos
              </div>
            </v-btn>
          </v-card-actions>
        </v-card>
      </div>
      <div class="mx-5 my-5">
        <v-card
          class="mx-auto white"
          max-width="344"
        >
          <v-card-actions class="d-flex justify-end">
            <v-btn
              variant="text"
              color="teal-accent-4"
              @click="$router.push({ name: 'subjects'})"
            >
              <div class="d-flex text-h6 mb-1 align-center">
                <v-icon class="mr-4">
                  mdi-file-multiple
                </v-icon>
                Cadastro das matérias
              </div>
            </v-btn>
          </v-card-actions>
        </v-card>
      </div>
      <div class="mx-5 my-5">
        <v-card
          class="mx-auto white"
          max-width="344"
        >
          <v-card-actions class="d-flex justify-end">
            <v-btn
              variant="text"
              color="teal-accent-4"
              @click="$router.push({ name: 'schoolcourses'})"
            >
              <div class="d-flex text-h6 mb-1 align-center">
                <v-icon class="mr-4">
                  mdi-google-classroom
                </v-icon>
                Cadastro das turmas
              </div>
            </v-btn>
          </v-card-actions>
        </v-card>
      </div>
    </div>
  </div>
</template>
