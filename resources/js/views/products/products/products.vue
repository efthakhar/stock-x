<script>
export default{
    data(){
        return{
            products:[],
            
        }
    },
    methods:{

        async getProducts(){
                await fetch(`${this.api_url}/api/products/`)
            .then(response => response.json())
            .then(data => this.products = data)
        },

        async deleteProduct(id){

            fetch(`${this.api_url}/api/products/${id}`,{
                method:  'DELETE',
                headers: {
                'Content-Type': 'application/json'
                },              
            })
            .then(response=> response.json())
            .then(res=>console.log(res.message))
            this.getProducts()

        },

    },
    mounted(){
        this.getProducts()
    }

}
</script>

<template>
<div class="row">
<div class="fullpage">
    <div class="page-nav-section">
        <router-link :to="{ name: 'add-product' }" class="btn btn-primary">
            Add Product
        </router-link>
    </div>
    <div class="page-content">
        
        <div class="table-container">
            <table class="table  table-bordered my-2">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">logo</th>
                    <th scope="col">product name</th>
                    <th scope="col">product slug</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td scope="col">{{product.id}}</td>
                    <td scope="col" class="img_cell">
                        <img :src="product.product_img_url" alt="">
                    </td>
                    <td scope="col">{{product.product_name}}</td>
                    <td scope="col">{{product.product_slug}}</td>

                    <td scope="col">
                        <router-link :to="{ name: 'edit-product-product', params: { id: product.id} }" 
                        class="btn btn-sm btn-primary">
                            edit
                        </router-link> 

                        <a class="btn btn-sm btn-danger" v-on:click="deleteproduct(product.id)">
                            delete
                        </a>
                    </td>

                </tr>
            </tbody>
        </table>
        </div>
    </div>
    
</div>
</div>     
</template>
