<script>
export default{

    data(){
        return{
            taxes:[]
        }
    },
    methods:{
        async getTaxes(){

            await  fetch(`${this.api_url}/api/taxes`)
            .then(response=>response.json())
            .then(data => this.taxes = data)

        },

        async deleteTax(id){

            await  fetch(`${this.api_url}/api/taxes/${id}`,{
                method:  'DELETE',
                headers: {
                'Content-Type': 'application/json'
                },              
            })
            .then(response=>response.json())
            .then(data => console.log(data))
            this.getTaxes()

        }
    },
    mounted(){
        this.getTaxes()
    }

}   
</script>

<template>
    <div class="row">
<div class="fullpage">
    <div class="page-nav-section">
        <router-link :to="{ name: 'add-tax' }" class="btn btn-primary">
            Add tax
        </router-link>
    </div>
    <div class="page-content">
        
            <div class="table-container">
            <table class="table  table-bordered my-2">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">tax name</th>
                    <th scope="col">tax code</th>
                    <th scope="col">tax rate</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="tax in taxes" :key="tax.id">
                    <td scope="col">{{tax.id}}</td>
                    <td scope="col">{{tax.tax_name}}</td>
                    <td scope="col">{{tax.tax_code}}</td>
                    <td scope="col">{{tax.tax_rate}} %</td>
                    <td scope="col">
                        <router-link :to="{ name: 'edit-tax', params: { id: tax.id} }" 
                        class="btn btn-sm btn-primary" >
                            edit
                        </router-link> 

                        <a class="btn btn-sm btn-danger" v-on:click="deleteTax(tax.id)">
                            delete
                        </a>
                    </td>

                </tr>
            </tbody>
        </table>
        </div> 
    </div>
    
</div>
</div>    
</template>