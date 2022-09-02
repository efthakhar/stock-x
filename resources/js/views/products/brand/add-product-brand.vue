<script>
import { useFileControl } from '../../../sharedFunction/filecontrol.js'

export default{

    setup() {
        const { uploadFile } = useFileControl()
        return {uploadFile}
    },


    data(){
        return{
            
            brand_name : '',
            brand_slug : '',
            brand_img_url:'',        
        }
    },
    methods:{
        
        async addBrand(){
            let data = { 
                brand_name : this.brand_name,
                brand_slug : this.brand_slug,
                brand_img_url: this.brand_img_url
            }  
            
        await  fetch(`${this.api_url}/api/product-brands`,{
                method:  'POST',
                headers: {
                'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(response=>response.json())
            .then(data => console.log(data))

            this.$router.push({ name: 'product-brands'})  
        },

        async imageUpload(e){
            let url = await this.uploadFile(e)
            this.brand_img_url =  url
        }


    },
    

}  
</script>

<template>
<div class="row">
<div class="fullpage">
    
    <div class="page-content">
        <div class="col-md-4 p-2">
            <h6 class="m-2 mb-3">ADD NEW PRODUCT BRAND</h6>
            <form  class="m-2" enctype="multipart/form-data">

                <label class="mt-2 mb-1">Brand Name **</label>  
                <input type="text"  class="form-control" v-model="brand_name">

                <label class="mt-2 mb-1">Brand slug</label>  
                <input type="text"  class="form-control" v-model="brand_slug">


    
                <label class="mt-2 mb-1" >Brand Image</label>
                <div>
                <img :src="brand_img_url" alt="" class="uploaded_img" v-if="brand_img_url">
                <input type="file" class="form-control" v-on:change="imageUpload">
                </div>
                

                <a  class="btn btn-primary my-3" v-on:click="addBrand">
                SUBMIT
                </a>

            </form>
        </div>
        
    </div>
    
</div>
</div>  
</template>


