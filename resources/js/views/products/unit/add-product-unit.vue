<script>
export default{


    data(){
        return{
            
            unit_name    : '',
            unit_code    : '',
            isLocked     : false       
        }
    },
    methods:{
        
        async addUnit(){

            let data = { 
                unit_name    : this.unit_name,
                unit_code    : this.unit_code,
                locked       : false, 
            } 

            
            await  fetch(`${this.api_url}/api/product-units`,{
                method:  'POST',
                headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.
                                querySelector('meta[name="csrf-token"]')
                                .content,
                },
                body: JSON.stringify(data)
            })
            .then(response=>response.json())
            .then(data => console.log(data))

            this.$router.push({ name: 'product-units'})  
        },

    },
    

}  
</script>

<template>
<div class="row">
<div class="fullpage">
    
    <div class="page-content">
        <div class="col-md-4 p-2">
            <h6 class="m-2 mb-3">ADD NEW PRODUCT UNIT</h6>
            <form  class="m-2" enctype="multipart/form-data">

                <label class="mt-2 mb-1">Unit Name **</label>  
                <input type="text"  class="form-control" v-model="unit_name">

                <label class="mt-2 mb-1">Unit Code</label>  
                <input type="text"  class="form-control" v-model="unit_code">

                
                 <!-- <div class="form-check mt-3 mb-3">
                    <input class="form-check-input" type="checkbox" 
                    :checked="isLocked" v-on:change="!isLocked" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Read Only
                    </label>
                  </div> -->
                

                <a  class="btn btn-primary my-3" v-on:click="addUnit">
                SUBMIT
                </a>

            </form>
        </div>
        
    </div>
    
</div>
</div>  
</template>
    
    