<script>
import { defineComponent } from 'vue'

import api from '@/api/api'

export default defineComponent({
  name: 'NavbarPadrao',
  components: {
  },
  data: () => ({
    drawer: true,
    group: null,
    items: [
      {
        title: 'Home',
        to: { name: 'home' },
        icon: 'mdi-home'
      },
      {
        title: 'Alunos',
        icon: 'mdi-account-school',
        to: { name: 'students' }
      },
      {
        title: 'Turmas',
        icon: 'mdi-google-classroom',
        to: { name: 'schoolcourses' }
      },
      {
        title: 'Matérias',
        icon: 'mdi-file-multiple',
        to: { name: 'subjects' }
      }
    ]
  }),
  methods: {
    logout() {
      api.logOut()
      this.$router.push({ name: 'login' })
    }
  }
})
</script>
<template>
  <v-app-bar color="#008ABD">
    <div class="d-flex flex-row justify-start align-center ml-2">
      <v-btn icon @click="drawer = !drawer">
        <v-icon>
          mdi-menu
        </v-icon>
      </v-btn>
      <span class="font-weight-bold text-white text-h5">Fiotec</span>
    </div>
  </v-app-bar>
  <v-navigation-drawer v-model="drawer" location="left" fixed clipped app>
    <v-list>
      <v-list-item v-for="item in items" :key="item.title" :to="item.to" color="#008ABD">
        <template v-slot:prepend>
          <v-icon>
            {{ item.icon }}
          </v-icon>
        </template>
        {{ item.title }}
      </v-list-item>
    </v-list>

    <template v-slot:append>
      <div class="pa-2">
        <v-btn block @click="logout" color="#008ABD">
          <v-icon>
            mdi-logout
          </v-icon>
          Sair
        </v-btn>
      </div>
    </template>
  </v-navigation-drawer>
</template>
<style></style>
