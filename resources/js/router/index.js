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

    // Product Units
    {
      path: '/dashboard/products/units',
      name: 'product-units',
      component: () =>  import('../views/products/unit/product-units.vue'),
    },
    {
      path: '/dashboard/products/add-unit',
      name: 'add-product-unit',
      component: () =>  import('../views/products/unit/add-product-unit.vue'),
    },
    {
      path: '/dashboard/products/edit-unit/:id',
      name: 'edit-product-unit',
      component: () =>  import('../views/products/unit/edit-product-unit.vue'),
    },


    // Warehouses
    {
      path: '/dashboard/warehouses',
      name: 'warehouses',
      component: () =>  import('../views/settings/warehouses.vue'),
    },
    {
      path: '/dashboard/add-warehouse',
      name: 'add-warehouse',
      component: () =>  import('../views/settings/add-warehouse.vue'),
    },
    {
      path: '/dashboard/edit-warehouse/:id',
      name: 'edit-warehouse',
      component: () =>  import('../views/settings/edit-warehouse.vue'),
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
