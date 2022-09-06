<script>
export default{


    data(){
        return{      
            currency_name : '',
            currency_code : '',
            currency_symbol  : '',    
        }
    },
    methods:{
        
        async addCurrency(){

            let data =
            { 
                currency_name    : this.currency_name,
                currency_code    : this.currency_code,
                currency_symbol  : this.currency_symbol,
            } 

    
            await  fetch(`${this.api_url}/api/currencies`,{
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
                this.currency_name   = data.currency_name;
                this.currency_code   = data.currency_code;
                this.currency_symbol = data.currency_symbol;
            })

            this.$router.push({ name: 'currencies'})  
        },

    },
    

}  
</script>
    
<template>
<div class="row">
<div class="fullpage">
    
    <div class="page-content">
        <div class="col-md-6 p-2">
            <h6 class="m-2 mb-3">ADD NEW CURRENCY</h6>
            <form  class="m-2" enctype="multipart/form-data">

                <label class="mt-2 mb-1">currency name **</label>  
                <input type="text"  class="form-control" v-model="currency_name">

                <label class="mt-2 mb-1">currency code **</label>  
                <input type="text"  class="form-control" v-model="currency_code">

                <label class="mt-2 mb-1">currency symbol **</label>  
                <input type="text"  class="form-control" v-model="currency_symbol">
                    
                <a  class="btn btn-primary my-3" v-on:click="addCurrency">SUBMIT</a>

            </form>
        </div>
        
    </div>
    
</div>
</div>  
</template>
        
        