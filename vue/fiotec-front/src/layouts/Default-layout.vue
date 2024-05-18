
<script>
import Appbar from '@/components/home/Appbar.vue'
export default {
  components: {
    Appbar
  },
  layout: 'Default'
}
</script>

<template>
  
  <v-layout class="default-layout">

    <Appbar />
    <v-main style="background-color: #E2E4E5;">
      <slot />
    </v-main>
  </v-layout>
</template>

<style scoped>
.default-layout {
  min-height: calc(100vh - 64px);
  background-color: #E2E4E5;
}
</style>
