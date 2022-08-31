import { createRouter, createWebHistory } from 'vue-router'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [

    
    {
      path: '/dashboard/overview',
      name: 'overview',
      component: () =>  import('../views/overview.vue'),
    },

    // Product categories
    {
      path: '/dashboard/products/categories',
      name: 'product-categories',
      component: () =>  import('../views/products/product-categories.vue'),
    },
    {
      path: '/dashboard/products/add-product-category',
      name: 'add-product-category',
      component: () =>  import('../views/products/add-product-category.vue'),
    },



    // {
    //   path: '/dashboard/overview',
    //   name: 'overview',
    //   component: () =>  import('../views/overview.vue'),
    //   children:[
    //         {
    //           path: 'home',
    //           name: 'home',
    //           component: () =>  import('../components/home.vue')
    //         },
    //   ]

    // },
   
  ]
})

export default router
