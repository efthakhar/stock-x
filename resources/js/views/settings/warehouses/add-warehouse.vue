<script>
export default{


    data(){
        return{
            
            name    : '',
            phone   : '',
            email   : '',
            address : ''     
        }
    },
    methods:{
        
        async addWarehouse(){

            let data = { 
                name    : this.name,
                phone   : this.phone,
                email   : this.email,
                address : this.address 
            } 

    
            await  fetch(`${this.api_url}/api/warehouses`,{
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

            this.$router.push({ name: 'warehouses'})  
        },

    },
    

}  
</script>
    
<template>
<div class="row">
<div class="fullpage">
    
    <div class="page-content">
        <div class="col-md-6 p-2">
            <h6 class="m-2 mb-3">ADD NEW WAREHOUSE</h6>
            <form  class="m-2" enctype="multipart/form-data">

                <label class="mt-2 mb-1">warehouse name **</label>  
                <input type="text"  class="form-control" v-model="name">

                <label class="mt-2 mb-1">warehouse email **</label>  
                <input type="text"  class="form-control" v-model="email">

                <label class="mt-2 mb-1">warehouse phone **</label>  
                <input type="text"  class="form-control" v-model="phone">

                <label class="mt-2 mb-1">warehouse address **</label>  
                <textarea name="" class="form-control" v-model="address"> </textarea>
                    
                <a  class="btn btn-primary my-3" v-on:click="addWarehouse">SUBMIT</a>

            </form>
        </div>
        
    </div>
    
</div>
</div>  
</template>
    
    