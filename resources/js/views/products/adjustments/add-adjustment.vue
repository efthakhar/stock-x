<script>

export default{

    data(){
        return{

            warehouses   :[],
            products     :[],

            current_stock: 0,
            
            warehouse_id : '',
            product_id   : '',
            product_name :'',
            quantity     : 0 ,
            is_addition  : 1,
            note         : '',    
        }
    },
    methods:{
        flush(){
            this.products    = [],

            this.current_stock = 0
            this.product_id   = ''
            this.product_name =''
            this.quantity     = 0 
            this.is_addition  = 1
            this. note        = ''  
        },

        async getProducts(e){
            await fetch(`${this.api_url}/api/products/search/${e.target.value}`)
            .then(response => response.json())
            .then(data => this.products = data)

           // console.log(this.products)
        },

        async getProductStock(id,wid){
            await fetch(`${this.api_url}/api/product-stocks/${id}/${wid}`)
            .then(response => response.json())
            .then(data => data.product_stock? this.current_stock =  data.product_stock:this.current_stock =  0 )

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

            this.getProductStock(id,this.warehouse_id)
        },
        
        async addAdjustment(){
            let data = { 
                warehouse_id : this.warehouse_id,
                product_id   : this.product_id,
                product_name : this.product_name,
                quantity     : this.quantity,
                is_addition  : this.is_addition,
                note         : this.note, 

                product_stock:  this.is_addition==1 ? 
                                (this.current_stock + this.quantity )
                              : ( this.current_stock - this.quantity )
            }  
            
        await  fetch(`${this.api_url}/api/stock-adjustments`,{
                method:  'POST',
                headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.
                                querySelector('meta[name="csrf-token"]')
                                .content,
                },
                body: JSON.stringify(data)
            }).then(response=>response.json())
            .then(data => console.log(data))

            this.$router.push({ name: 'adjustments'})  
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
                <select class="form-control"  v-model="warehouse_id" v-on:change="flush">
                    <option value="" selected>none</option>
                    <option v-for="warehouse in warehouses" :key="warehouse.id"
                    :value="warehouse.id" >{{warehouse.name}}</option>
                </select>

                <label class="mt-2 mb-1">product name **</label>  
                <input type="text"  class="form-control" :disabled="warehouse_id==''"
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

                <label class="mt-1 mb-1">current stock :</label>
                <input type="number" class="form-control" readonly  :value="current_stock?current_stock : 0">

                 <div>
                    <label class="mt-2 mb-1">Adjustment Type</label>
                    <select class="form-control my-1"  v-model="is_addition">
                    <option value="1" >addition</option>
                    <option value="0" >subtraction</option>  
                    </select>    
                 </div>

                 <div>
                    <label class="my-1">quantity</label>
                    <input min="0" type="number" class="form-control" v-model="quantity">
                 </div>

                 <div class="my-2">
                    <label class="my-1">adjustment note</label>
                    <textarea class="form-control " v-model="note" rows="5"></textarea>
                 </div>

                <div>
                    <a  class="btn btn-primary my-3" v-on:click="addAdjustment">
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