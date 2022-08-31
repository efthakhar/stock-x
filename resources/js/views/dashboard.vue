<script>
import { RouterLink, RouterView } from 'vue-router'
import { sidebarStatus } from '../stores/sidebar-status.js'

import Sidebar from '../components/sidebar.vue';
import Header from '../components/header.vue';



export default{
    components:{ Sidebar, Header},
    data(){
        return{
            sidebar_status: sidebarStatus()
        }
    },
    methods:{

    },
    mounted(){
        if (window.innerWidth < 760) {
            this.sidebar_status.hideSidebar()
        } 
    }
}

</script>

<template>

<div class="dashboard">

    <div class="dashboard-sidebar" 
     :class=" sidebar_status.collapsed == true ? 'dashboard-sidebar-responsive':''">
        <Sidebar/>
    </div>

    <div class="dashboard-content">
        <Header />
        <div class="main-content">
             <RouterView />
        </div>
       
    </div>

</div>

</template>

<style>
.dashboard{
    width: 100vw;
    height: 100vh;
    display: flex;
    overflow: hidden;
}

.dashboard-sidebar{
    border-right: 2px solid #5797F8;
    width: 200px;
    min-width: 200px !important;
    height: 100vh;
    background-color: rgba(255, 255, 255, 0.959);
    z-index: 100;
    box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.37);
    height: 100vh;
    overflow: auto;
    transition: all .5s;
}
.dashboard-content{
    width: 100%;
    flex: 1 1 auto;
    background-color: rgb(255, 255, 255);
      
}

.main-content{
    margin:10px;
    box-shadow: 1px 1px 12px grey;
    padding:10px;
    border-radius: 10px;
    height: calc(100vh - 80px); 
    width: auto;
    overflow: scroll;
    box-sizing: border-box;
    position: relative;
   
}
.main-content>*{   
   width: 100%;
   height: 100%;
}


.dashboard-sidebar-responsive{
        position: absolute;
        left:-100%;
}


/* @media (max-width:750px){
    .dashboard-sidebar-responsive{
        position: absolute;
        left:-100%;
    }
} */


/* dashboard header */
.dashboard-header{
    margin: 10px;
    box-shadow: 1px 1px 12px grey;
    padding:10px;
    border-radius: 10px; 
}

</style>