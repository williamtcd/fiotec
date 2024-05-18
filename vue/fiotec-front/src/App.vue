<template>
  <component :is="layout.showLayout" v-if="layout.showLayout !== ''">
    <RouterView  />
    <v-snackbar
      v-model="snackBar.show"
      :key="snackBar.id"
      multi-line
      timeout="2000"
    >
      {{ snackBar.msg }}

      <template v-slot:actions>
        <v-btn
          :color="snackBar.color"
          variant="text"
          @click="snackBar.show = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
  </component>
</template>

<script>
import DefaultLayout from '@/layouts/Default-layout.vue'
import AuthLayout from '@/layouts/Auth-layout.vue'
import { useLayoutStore } from '@/stores/layout.js'
import { useSnackBar } from '@/stores/snackBar.js'
import axios from '@/api/axios'
export default {
  name: 'App',
  components: {
    DefaultLayout,
    AuthLayout
  },
  data: () => ({
    textSnackBar: ''
  }),

  computed: {
    layout() {
      return useLayoutStore()
    },
    snackBar () {
      return useSnackBar().showSnackBar
    }
  },
  async created () {
    this.setupAxiosToken()
  },
  methods: {
    setupAxiosToken () {
      if (localStorage.getItem('token')) {
        axios.defaults.headers.common.Authorization = `Bearer ${localStorage.getItem('token')}`
      }
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
