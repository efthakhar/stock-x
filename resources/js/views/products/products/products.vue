<script>
export default{
    data(){
        return{
            products:[],
            categories:[],
            brands:[]
            
        }
    },
    methods:{

        async getProducts(){
                await fetch(`${this.api_url}/api/products/`)
            .then(response => response.json())
            .then(data => this.products = data)
        },
        async getCategories(){
             await fetch(`${this.api_url}/api/product-categories/`)
            .then(response => response.json())
            .then(data => this.categories = data)
        },
        async getBrands(){
             await fetch(`${this.api_url}/api/product-brands/`)
            .then(response => response.json())
            .then(data => this.brands = data)
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
        this.getCategories()
        this.getBrands()
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
                    <th scope="col">code</th>
                    <th scope="col">image</th>
                    <th scope="col">product</th>
                    <th scope="col">category</th>
                    <th scope="col">brand</th>
                    <th scope="col">cost price</th>
                    <th scope="col">sale price</th>
                    <th scope="col">current stock</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td scope="col">{{product.product_code}}</td>
                    <td scope="col" class="img_cell">
                        <img :src="product.product_img_url" alt="" class="product_img">
                    </td>
                    <td scope="col">{{product.product_name}}</td>
                    <td scope="col">
                        {{categories[product.category_id]!=undefined ?
                        categories[product.category_id].category_name : ''}}
                    </td>
                    <td scope="col">
                        {{brands[product.brand_id]!=undefined ?
                        brands[product.brand_id].brand_name : ''}}
                    </td>
                    <td scope="col">{{product.product_cost}}</td>
                    <td scope="col">{{product.product_price}}</td>
                    <td scope="col">--</td>

                    <td scope="col">
                        <router-link :to="{ name: 'edit-product', params: { id: product.id} }" 
                        class="btn btn-sm btn-primary">
                            edit
                        </router-link> 

                        <a class="btn btn-sm btn-danger" v-on:click="deleteProduct(product.id)">
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

<style>
.product_img{
    width: 50px  !important;
    height: 50px !important;
    
}    
</style>