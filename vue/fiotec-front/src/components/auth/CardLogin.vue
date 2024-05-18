<script>
import api from '@/api/api'
import { useSnackBar } from '@/stores/snackBar.js'

export default {
  name: 'CardLogin',
  data: () => ({
    showPass: false,
    login: 'adminFiotec',
    password: 'passFiotec',
    loading: false
  }),
  computed: {
    snackBar() {
      return useSnackBar()
    }
  },
  methods: {
    async requestlogin() {
      this.loading = true
      try {
        const data = {
          login: this.login,
          password: this.password
        }
        await api.login(data)
        this.$router.push({ name: 'home' })
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

<template>
  <v-card class="px-6 pb-8 pt-2" width="300">
    <div class="mb-5 mt-5" style="max-width: 250px">
      <img src="@/assets/logo-fiotec2.png"style="max-width: 100%" />
    </div>
    <v-form @submit.prevent>
      <v-text-field
        v-model="login"
        label="E-mail"
        variant="underlined"
      />
      <v-text-field
        v-model="password"
        class="mb-5"
        label="Senha"
        variant="underlined"
        :type="showPass ? 'text' : 'password'"
      >
        <template v-slot:append-inner>
          <v-icon
            style="cursor: pointer"
            icon="acount"
            @click="showPass = !showPass"
          />
          <v-icon
            size="small"
            style="cursor: pointer"
            class="me-2"
            @click="showPass = !showPass"
          >
            {{ showPass? 'mdi-eye-outline': 'mdi-eye-off-outline' }}
          </v-icon>
        </template>
      </v-text-field>
      <v-btn block class="mt-2 text-white" color="#008ABD" :loading="loading" @click="requestlogin">
        <span class="font-weight-medium"> Login </span>
      </v-btn>
    </v-form>
  </v-card>
</template>
