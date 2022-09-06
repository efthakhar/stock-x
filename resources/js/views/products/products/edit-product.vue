<script>
import { useFileControl } from '../../../sharedFunction/filecontrol.js'

export default{

    setup() {
        const { uploadFile } = useFileControl()
        return {uploadFile}
    },


    data(){
        return{

            taxes: [],
            categories:[],
            brands:[],
            units:[],

            product_id: this.$route.params.id,
            
            product_code    : '',
            product_name    : '',
            product_slug    : '',

            unit_id         : '',
            category_id     : '',
            brand_id        : '',

            tax_id          : '',
            tax_inclusive   : false,

            product_cost    : '',
            product_price   : '',

            daily_sale_target : '',
            alert_quantity    : '',

            product_img_url     : '',
            product_description : '',

        }
    },

    methods:{
        async getProduct(id){
             await fetch(`${this.api_url}/api/products/${id}`)
            .then(response => response.json())
            .then(data => {
                    this.product_code = data.product_code   
                    this.product_name = data.product_name
                    this.product_slug = data.product_slug

                    this.unit_id       =  data.unit_id 
                    this.category_id   =  data.category_id
                    this.brand_id      =  data.brand_id

                    this.tax_id   =  data.tax_id 
                    this.tax_inclusive = data.tax_inclusive

                   this.product_cost   = data.product_cost
                   this.product_price  = data.product_price 

                   this.daily_sale_target = data.daily_sale_target
                   this.alert_quantity = data.alert_quantity   

                   this.product_img_url  = data.product_img_url    
                   this.product_description =  data.product_description 
                }  
            )
        },
        
        async addProduct(){
                let data = { 
                    product_code    : this.product_code,
                    product_name    : this. product_name,
                    product_slug    : this.product_slug,

                    unit_id         : this.unit_id,
                    category_id     : this.category_id,
                    brand_id        : this.brand_id,

                    tax_id          : this.tax_id,
                    tax_inclusive   : this.tax_inclusive,

                    product_cost    : this.product_cost ,
                    product_price   : this.product_price,

                    daily_sale_target : this.daily_sale_target,
                    alert_quantity    : this.alert_quantity,

                    product_img_url     : this.product_img_url ,
                    product_description : this.product_description,
                }  
                
                await  fetch(`${this.api_url}/api/products/${this.product_id}`,{
                    method:  'PUT',
                    headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.
                                querySelector('meta[name="csrf-token"]')
                                .content,
                    },
                    body: JSON.stringify(data)
                }).then(response=>response.json())
                .then(data => console.log(data))

                this.$router.push({ name: 'products'})  
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
        async getUnits(){

            await  fetch(`${this.api_url}/api/product-units`)
            .then(response=>response.json())
            .then(data => this.units = data)

        },
        async getTaxes(){

            await  fetch(`${this.api_url}/api/taxes`)
            .then(response=>response.json())
            .then(data => this.taxes = data)

        },

        async imageUpload(e){
            let url = await this.uploadFile(e)
            this.product_img_url =  url
        }

    },

    mounted(){
        this.getCategories()
        this.getBrands()
        this.getTaxes()
        this.getUnits()
        this.getProduct(this.product_id)
    }
    

}  
</script>

<template>
<div class="row">
<div class="fullpage">
    
    <div class="page-content">
        <div class=" p-2">
            <h6 class="m-2 mb-3">EDIT PRODUCT </h6>
            <form  class="m-2" enctype="multipart/form-data">

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="mt-2 mb-1">product name **</label>  
                        <input type="text"  class="form-control" v-model="product_name">
                    </div>
                    <div class="col-md-4">
                        <label class="mt-2 mb-1">product slug **</label>  
                        <input type="text"  class="form-control" v-model="product_slug">
                    </div>
                    <div class="col-md-4">
                        <label class="mt-2 mb-1">product code **</label>  
                        <input type="text"  class="form-control" v-model="product_code">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="mt-2 mb-1">unit **</label>  
                        <select class="form-control"  v-model="unit_id">
                           <option value="" selected>none</option>
                           <option v-for="unit in units" :key="unit.id"
                            :value="unit.id" >{{unit.unit_name}}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="mt-2 mb-1">category **</label>  
                        <select class="form-control"  v-model="category_id">
                           <option value="" selected>none</option>
                           <option v-for="category in categories" :key="category.id"
                            :value="category.id" >{{category.category_name}}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="mt-2 mb-1">brand </label>  
                        <select class="form-control" v-model="brand_id">
                            <option v-for="brand in brands" :key="brand.id"
                            :value="brand.id" >{{brand.brand_name}}</option>
                        </select>
                       
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="mt-2 mb-1">product cost **</label>  
                        <input type="text"  class="form-control" v-model="product_cost">
                    </div>
                    <div class="col-md-4">
                        <label class="mt-2 mb-1">product price **</label>  
                        <input type="text"  class="form-control" v-model="product_price">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="mt-2 mb-1">daily sale target</label>  
                        <input type="number" class="form-control" v-model="daily_sale_target">             
                    </div> 
                    <div class="col-md-4">
                        <label class="mt-2 mb-1">alert quantity</label>  
                        <input type="number" class="form-control" v-model="alert_quantity">             
                    </div>              
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="mt-2 mb-1">Tax</label>  
                        <select class="form-control" v-model="tax_id">         
                            <option v-for="tax in taxes" :key="tax.id"
                            :value="tax.id" >{{tax.tax_code}}</option>
                        </select>
                        <div class="my-3 form-check">
                            <!-- {{this.tax_inclusive}} -->
                        <input class="form-check-input" type="checkbox" 
                         :checked="tax_inclusive" v-on:change="tax_inclusive=!tax_inclusive" id="flexCheckDefault">
                        <label class=" form-check-label" for="flexCheckDefault">Tax Inclusive</label>             
                        </div>              
                    </div>             
                </div>

                <div class="row mb-3 mt-4">
                    <div class="col-md-4">
                        <label class="mt-2 mb-1">Product Image</label>
                        <div>
                        <img :src="product_img_url" alt="" class="uploaded_img" v-if="product_img_url">
                        <input type="file" class="form-control" v-on:change="imageUpload">
                        </div>           
                    </div> 
                    <div class="col-md-7">
                        <label class="mt-2 mb-1">description</label>  
                        <textarea class="form-control" v-model="product_description"  rows="5"></textarea>   
                    </div>              
                </div>
                
             
                
                

                <a  class="btn btn-primary my-3" v-on:click="addProduct">
                SUBMIT
                </a>

            </form>
        </div>
        
    </div>
    
</div>
</div>  
</template>

    
    