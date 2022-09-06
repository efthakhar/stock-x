<script>
export default{


    data(){
        return{      
            tax_name : '',
            tax_code : '',
            tax_rate : '',    
        }
    },
    methods:{
        
        async addTax(){

            let data =
            { 
                tax_name    : this.tax_name,
                tax_code    : this.tax_code,
                tax_rate    : this.tax_rate,
            } 

    
            await  fetch(`${this.api_url}/api/taxes`,{
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
            .then(data => {
                this.tax_name   = data.tax_name;
                this.tax_code   = data.tax_code;
                this.tax_rate   = data.tax_rate;
            })

            this.$router.push({ name: 'taxes'})  
        },

    },
    

}  
</script>
    
<template>
<div class="row">
<div class="fullpage">
    
    <div class="page-content">
        <div class="col-md-6 p-2">
            <h6 class="m-2 mb-3">ADD NEW TAX</h6>
            <form  class="m-2" enctype="multipart/form-data">

                <label class="mt-2 mb-1">tax name **</label>  
                <input type="text"  class="form-control" v-model="tax_name">

                <label class="mt-2 mb-1">tax code **</label>  
                <input type="text"  class="form-control" v-model="tax_code">

                <label class="mt-2 mb-1">tax rate **</label>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" v-model="tax_rate" >
                    <span class="input-group-text">%</span>
                </div>
                    
                <a  class="btn btn-primary my-3" v-on:click="addTax">SUBMIT</a>

            </form>
        </div>
        
    </div>
    
</div>
</div>  
</template>
        
            