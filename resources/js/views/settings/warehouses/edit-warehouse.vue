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

        async getWarehouse(id){

        await  fetch(`${this.api_url}/api/warehouses/${id}`)
        .then(response=>response.json())
        .then(data => {
            this.name = data.name;
            this.phone = data.phone;
            this.email = data.email;
            this.address = data.address
        })

        },
        
        async editWarehouse(){

            let data = { 
                name    : this.name ,
                phone   : this.phone,
                email   : this.email,
                address : this.address 
            } 
    
            await  fetch(`${this.api_url}/api/warehouses/${this.$route.params.id}`,{
            method:  'PUT',
            headers: {
            'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)

            })
            .then(response=>response.json())
            .then(data => console.log(data))

            this.$router.push({ name: 'warehouses'})  
        },

    },

    mounted(){
        this.getWarehouse(this.$route.params.id)
    }
    

}  
</script>
        
<template>
<div class="row">
<div class="fullpage">
    
    <div class="page-content">
        <div class="col-md-6 p-2">
            <h6 class="m-2 mb-3">EDIT WAREHOUSE</h6>
            <form  class="m-2" enctype="multipart/form-data">

                <label class="mt-2 mb-1">warehouse name **</label>  
                <input type="text"  class="form-control" v-model="name">

                <label class="mt-2 mb-1">warehouse email **</label>  
                <input type="text"  class="form-control" v-model="email">

                <label class="mt-2 mb-1">warehouse phone **</label>  
                <input type="text"  class="form-control" v-model="phone">

                <label class="mt-2 mb-1">warehouse address **</label>  
                <textarea name="" class="form-control" v-model="address"> </textarea>
                    
                <a  class="btn btn-primary my-3" v-on:click="editWarehouse">SUBMIT</a>

            </form>
        </div>
        
    </div>
    
</div>
</div>  
</template>
    
    