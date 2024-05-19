<script>
import CardLogin from '@/components/auth/CardLogin.vue'
export default {
  components: {
    CardLogin
  },
  layout: 'auth'
}
</script>

<template>
  <div class="d-flex justify-center align-center layout">
    <CardLogin />
  </div>
</template>
<style scoped>
.layout {
  min-height: calc(100vh - 128px);
}
</style>
