import { defineStore } from 'pinia'

export const useLayoutStore = defineStore('layout', {
  state() {
    return {
      layout: 'Default'
    }
  },

  actions: {
    increment(value) {
      this.$state.layout = value + '-layout'
    }
  },

  getters: {
    showLayout() {
      return this.layout
    }
  }
})
