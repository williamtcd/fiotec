import { createApp } from 'vue'
import { createPinia } from 'pinia'

// Vuetify
import { createVuetify } from 'vuetify'
import './plugins/vuetify.js'
import 'vuetify/styles'
import router from './router'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { useLayoutStore } from '@/stores/layout'
import { mdi } from 'vuetify/iconsets/mdi'
import '@mdi/font/css/materialdesignicons.css'

// Components
import App from './App.vue'

const vuetify = createVuetify({
  icons: {
    defaultSet: 'mdi',
    sets: {
      mdi
    }
  },
  components,
  directives
})

const app = createApp(App)

app.use(createPinia())
app.use(vuetify)
app.use(router)

const setlayout = useLayoutStore()
function setLayoutForNextPage(to) {
  let layout = to.matched[0]?.components.default.layout

  if (!layout) {
    layout = 'default-layout'
  }

  setlayout.increment(layout)
}
router.afterEach(setLayoutForNextPage)
app.mount('#app')