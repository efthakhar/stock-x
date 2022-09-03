<script>
    export default{
    
        data(){
            return{
                currencies:[]
            }
        },
        methods:{
            async getCurrencies(){
    
                await  fetch(`${this.api_url}/api/currencies`)
                .then(response=>response.json())
                .then(data => this.currencies = data)
    
            },
    
            async deleteCurrency(id){
    
                await  fetch(`${this.api_url}/api/currencies/${id}`,{
                    method:  'DELETE',
                    headers: {
                    'Content-Type': 'application/json'
                    },              
                })
                .then(response=>response.json())
                .then(data => console.log(data))
                this.getCurrencies()
    
            }
        },
        mounted(){
            this.getCurrencies()
        }
    
    }   
    </script>
    
    <template>
        <div class="row">
    <div class="fullpage">
        <div class="page-nav-section">
            <router-link :to="{ name: 'add-currency' }" class="btn btn-primary">
                Add currency
            </router-link>
        </div>
        <div class="page-content">
            
                <div class="table-container">
                <table class="table  table-bordered my-2">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">currency name</th>
                        <th scope="col">currency code</th>
                        <th scope="col">currency symbol</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="currency in currencies" :key="currency.id">
                        <td scope="col">{{currency.id}}</td>
                        <td scope="col">{{currency.currency_name}}</td>
                        <td scope="col">{{currency.currency_code}}</td>
                        <td scope="col">{{currency.currency_symbol}}</td>
                        <td scope="col">
                            <router-link :to="{ name: 'edit-currency', params: { id: currency.id} }" 
                            class="btn btn-sm btn-primary" >
                                edit
                            </router-link> 
    
                            <a class="btn btn-sm btn-danger" v-on:click="deleteCurrency(currency.id)">
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