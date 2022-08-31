import { defineStore } from 'pinia'

export const sidebarStatus = defineStore('sidebar_status', {

    state: () =>
     ({ 
        collapsed: false,
     }),

    getters: {
      getSidebarStatus: (state) => state.collapsed,
    },

    actions: {
      toggleCollapse() {
         this.collapsed = !this.collapsed
      },
      hideSidebar(){
        this.collapsed = true
      }
    },
})
