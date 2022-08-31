<script>
export default{
    props:{ navdetails: Object },

    data(){
        return{
            subnav : this.navdetails.subnavlinks? true : false,
            isOpened: false,
           
       }      
    },
    methods:{
        toggle(){
            this.isOpened = !this.isOpened
           
        }
    }

}
</script>

<template>

<div class="side-nav-item">

             <RouterLink :to="subnav ?'' : navdetails.navlink" 
              :class="this.$route.path==navdetails.navlink && !subnav ?'active-nav-link':''"
              class="side-nav-link" @click="toggle">
              {{navdetails.navlinktext}}
             </RouterLink>

             <div class="side-nav-sublinks" v-if="isOpened&&subnav">

                <RouterLink v-for="sublink in navdetails.subnavlinks" :key="sublink"
                 :class="this.$route.path==sublink.subnavlink?'active-nav-link':''"
                 :to="sublink.subnavlink" class="side-nav-sublink">
                 {{sublink.subnavtext}}
                 </RouterLink>

             </div>
</div>



</template>

