<script>

export default{

    data(){
        return{

            warehouses   :[],
            products     :[],

            current_stock: '',
            
            warehouse_id : '',
            product_id   : '',
            product_name :'',
            quantity     : '',
            is_addition  : true,
            note         : '',    
        }
    },
    methods:{

        async getProducts(e){
            await fetch(`${this.api_url}/api/products/search/${e.target.value}`)
            .then(response => response.json())
            .then(data => this.products = data)

           // console.log(this.products)
        },

        async getProductStock(id){
            await fetch(`${this.api_url}/api/product-stocks/${id}`)
            .then(response => response.json())
            .then(data => this.current_stock = data.product_stock)

           // console.log(this.products)
        },

        

        async getWarehouses(){

            await  fetch(`${this.api_url}/api/warehouses`)
            .then(response=>response.json())
            .then(data => this.warehouses = data)

        },

        selectProduct(e,id,name){
            this.product_id = id
            this.product_name = name
            this.products = []

            this.getProductStock(id)
        },
        
        async addBrand(){
            let data = { 
                warehouse_id : this.warehouse_id,
                product_id   : this.product_id,
                product_name : this.product_name,
                quantity     : this.quantity,
                is_addition  : this.is_addition,
                note         : this.note, 
            }  
            
        await  fetch(`${this.api_url}/api/stock-adjustments`,{
                method:  'POST',
                headers: {
                'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(response=>response.json())
            .then(data => console.log(data))

            this.$router.push({ name: 'product-adjustments'})  
        },

    },

    mounted(){
        this.getWarehouses();
        
    }
    

}  
</script>

<template>
<div class="row">
<div class="fullpage">
    
    <div class="page-content">
        <div class="col-md-4 p-2">
            <h6 class="m-2 mb-3">ADD ADJUSTMENT</h6>
            <form  class="m-2" enctype="multipart/form-data">

                <label class="mt-2 mb-1">warehouse **</label>  
                <select class="form-control"  v-model="warehouse_id">
                    <option value="" selected>none</option>
                    <option v-for="warehouse in warehouses" :key="warehouse.id"
                    :value="warehouse.id" >{{warehouse.name}}</option>
                </select>

                <label class="mt-2 mb-1">Product Name **</label>  
                <input type="text"  class="form-control" 
                v-model="product_name" v-on:keyup="getProducts">
               
                <div class="my-2" v-if="products">
                    <ul class="list-group">
                        <li class="list-group-item list-product-item" 
                        v-for="product in products"
                        v-on:click="selectProduct(e,product.id,product.product_name)"
                        :key="product.id"
                        >
                        {{product.product_name}}
                        </li>
                    </ul>
                </div>

                <label class="mt-2 mb-1">Current Stock : {{current_stock?current_stock : 0}}</label>

                <div>
                    <a  class="btn btn-primary my-3" v-on:click="addBrand">
                    SUBMIT
                    </a>
                </div>

            </form>
        </div>
        
    </div>
    
</div>
</div>  
</template>


<style>
.list-product-item{
    cursor: pointer;
}
.list-product-item:hover{
    border: 2px solid blue;
}
</style>