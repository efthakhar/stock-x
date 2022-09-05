<script>

export default{

    data(){
        return{

            warehouses   :[],

            current_stock: 0,
  
            warehouse_id : '',
            product_id   : '',
            product_name :'',
            quantity     : 0 ,

            prev_quantity: 0,
            prev_is_additon: 1,

            is_addition  : 1,
            note         : '',  
            
            // final_stock : 0
        }
    },
    methods:{

        async getAdjustment(id){
                 await fetch(`${this.api_url}/api/stock-adjustments/${id}`)
                .then(response => response.json())
                .then( data => {
                    this.warehouse_id       = data.warehouse_id
                    this.product_id         = data.product_id
                    this.product_name       = data.product_name
                    this.prev_quantity     = data.quantity
                    this.quantity          = data.quantity
                    this.is_addition       = data.is_addition
                    this.prev_is_additon   = data.is_addition
                    this.note         = data.note  
                    
                })
        },

        async getProductStock(id,wid){
            await fetch(`${this.api_url}/api/product-stocks/${id}/${wid}`)
            .then(response => response.json())
            .then(data => {data.product_stock?
             this.current_stock = data.product_stock
            :this.current_stock =  0 })
            console.log(this.current_stock)

        },  

        async getWarehouses(){

            await  fetch(`${this.api_url}/api/warehouses`)
            .then(response=>response.json())
            .then(data => this.warehouses = data)
            await this.getAdjustment(this.$route.params.id)
            await this.getProductStock(this.product_id,this.warehouse_id)

        },

        async editAdjustment(){

            let product_stock = 0

            if(this.prev_is_additon==1)
            {
                product_stock = this.current_stock  - this.prev_quantity

            }
            else if(this.prev_is_additon==0)
            {
                product_stock = this.current_stock  + this.prev_quantity

            }

            if(this.is_addition == 1 ){
                product_stock = product_stock  + this.quantity
            }else if(this.is_addition == 0){
                product_stock = product_stock  - this.quantity
            }

            // this.final_stock = product_stock



            // this.is_addition== 1 ? 
            //                     (this.current_stock  - this.prev_quantity + this.quantity)
            //                   : (this.current_stock  + this.prev_quantity - this.quantity )

        
            let data = { 
                warehouse_id : this.warehouse_id,
                product_id   : this.product_id,
                product_name : this.product_name,
                quantity     : this.quantity,
                is_addition  : this.is_addition,
                note         : this.note, 

                product_stock:  product_stock
            }  
            
        await  fetch(`${this.api_url}/api/stock-adjustments/${this.$route.params.id}`,{
                method:  'PUT',
                headers: {
                'Content-Type': 'application/json'
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
            <h6 class="m-2 mb-3">Edit ADJUSTMENT</h6>
            <form  class="m-2" enctype="multipart/form-data">

                <label class="mt-2 mb-1">warehouse **</label>  
                <select class="form-control"  v-model="warehouse_id" v-on:change="flush" disabled>
                    <option value="" selected>none</option>
                    <option v-for="warehouse in warehouses" :key="warehouse.id"
                    :value="warehouse.id" >{{warehouse.name}}</option>
                </select>

                <label class="mt-2 mb-1">product name **</label>  
                <input type="text"  class="form-control" disabled
                v-model="product_name" v-on:keyup="getProducts">
               

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
                    <a  class="btn btn-primary my-3" v-on:click="editAdjustment">
                     Update
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