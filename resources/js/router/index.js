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
      component: () =>  import('../views/products/category/product-categories.vue'),
    },
    {
      path: '/dashboard/products/add-category',
      name: 'add-product-category',
      component: () =>  import('../views/products/category/add-product-category.vue'),
    },
    {
      path: '/dashboard/products/edit-category/:id',
      name: 'edit-product-category',
      component: () =>  import('../views/products/category/edit-product-category.vue'),
    },

    // Product brands
    {
      path: '/dashboard/products/brands',
      name: 'product-brands',
      component: () =>  import('../views/products/brand/product-brands.vue'),
    },
    {
      path: '/dashboard/products/add-product-brand',
      name: 'add-product-brand',
      component: () =>  import('../views/products/brand/add-product-brand.vue'),
    },
    {
      path: '/dashboard/products/edit-product-brand/:id',
      name: 'edit-product-brand',
      component: () =>  import('../views/products/brand/edit-product-brand.vue'),
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
