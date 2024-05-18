import { defineStore } from 'pinia'

export const useCounterStore = defineStore('counter', {
  state() {
    return {
      count: 0
    }
  },

  actions: {
    increment() {
      this.$state.count++
    }
  },

  getters: {
    showCount() {
      return this.$state.count
    }
  }
})
