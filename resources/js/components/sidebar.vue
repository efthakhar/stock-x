<script>
import SideNavItem from "./side-nav-item.vue"

export default{
     components:{ SideNavItem},
    data(){
        return{
            navlinks:[
                {   
                    navlinktext:'dashboard',
                    navlink:'/dashboard/overview',
                },
                {   
                    navlinktext:'product',
                    navlink:'',
                    subnavlinks:[
                        { subnavtext:'product list', subnavlink:'/dashboard/products'},
                        { subnavtext:'categories', subnavlink:'/dashboard/products/categories'},
                        { subnavtext:'brands', subnavlink:'/dashboard/products/brands'},
                        { subnavtext:'units', subnavlink:'/dashboard/products/units'}, 
                        { subnavtext:'adjustments', subnavlink:'/dashboard/products/adjustments'},            
                    ]

                },
                {   
                    navlinktext:'users',
                    navlink:'',
                    subnavlinks:[
                        { subnavtext:'users', subnavlink:'/dashboard/users'},
                        { subnavtext:'roles', subnavlink:'/dashboard/roles-permissions'},  
                    ]

                },
                {   
                    navlinktext:'settings',
                    navlink:'',
                    subnavlinks:[
                        { subnavtext:'warehouse', subnavlink:'/dashboard/warehouses'},
                        { subnavtext:'currency', subnavlink:'/dashboard/currencies'},      
                        { subnavtext:'tax', subnavlink:'/dashboard/taxes'},      
                    ]

                },

                {   
                    navlinktext:'media',
                    navlink:'/dashboard/files',
                },






                // {   
                //     navlinktext:'home',
                //     navlink:'/dashboard/home'
                // },
                // {   
                //     navlinktext:'dashboard',
                //     navlink:'',
                //     subnavlinks:[
                //         { subnavtext:'home', subnavlink:'/dashboard/overview'},
                        
                //     ]

                // },
                
            ]
        }
    }
}

</script>

<template>
    <div class="sidebar-logo">
        <a href="">RobustErp</a>
    </div>
    <ul class="sidebar-nav-items">  
        <SideNavItem v-for="navlink in navlinks" :key="navlink"
        :navdetails="navlink"
        /> 
    </ul>
</template>

<style>
.sidebar-logo{
    height: 60px;
    display: flex;
    align-items: center;
    padding-left: 10px;
}
.sidebar-logo a{
    display: block;
    font-size: 1.5rem;
    font-weight: 700; 
    color:#2d7bf0; 
    text-transform: uppercase;
}
.sidebar-nav-items{
    display: flex;
    flex-direction: column;
}
.side-nav-item{
   text-transform: uppercase !important;
}
.side-nav-link{
 
 color:#2d7bf0;
 margin:2px 0;
 box-shadow: 1px 1px 16px rgb(221, 221, 221);

}

.side-nav-sublinks{
    
    display:flex;
    flex-direction: column;
    padding: 0px 0px 0px 0px;
    padding: 13px;
}

.side-nav-sublink{
 background-color: whitesmoke;
 color: grey;
 border-top:1.2px solid #2d7bf0;
 /* border-left:6px solid #0B5ED7; */
 
}

.side-nav-link,.side-nav-sublink{
 
  display: block;
  padding: 7px 3px 7px 16px;
  font-size: .9rem;
  font-weight: 400;
  
}

.side-nav-link.active-nav-link,.active-nav-link.side-nav-sublink{
    background-color: #0B5ED7 !important;
    color: white !important;
}

</style>