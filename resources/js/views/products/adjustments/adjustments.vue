<script>
    export default{
        data(){
            return{
                warehouses: [],
                adjustments:[],
                ad_to_del: null
                
                
            }
        },
        methods:{
            async getWarehouses(){

                await  fetch(`${this.api_url}/api/warehouses`)
                .then(response=>response.json())
                .then(data => this.warehouses = data)

            },
                
            async getAdjustments(){
                 await fetch(`${this.api_url}/api/stock-adjustments/`)
                .then(response => response.json())
                .then(data => this.adjustments = data)
                
            },
            async getAdjustment(id){
                 await fetch(`${this.api_url}/api/stock-adjustments/${id}`)
                .then(response => response.json())
                .then( data => {this.ad_to_del = data})
            },

            async deleteAdjustment(id){
               await this.getAdjustment(id)
                console.log(this.ad_to_del)
               
                
    
               await fetch(`${this.api_url}/api/stock-adjustments`,{
                    method:  'DELETE',
                    headers: {
                    'Content-Type': 'application/json'
                    }, 
                    body: JSON.stringify(this.ad_to_del)             
                })
                .then(response=> response.json())
                .then(res=>console.log(res))

                this.getAdjustments()
    
          },
    
        },
        mounted(){
            this.getWarehouses()
            this.getAdjustments()
        }
    
    }
    </script>
    
    <template>
    <div class="row">
    <div class="fullpage">
        <div class="page-nav-section">
            <router-link :to="{ name: 'add-adjustment' }" class="btn btn-primary">
                Add new Adjustment
            </router-link>
        </div>
        <div class="page-content">
          
            <div class="table-container">
                <table class="table  table-bordered my-2">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">product</th>
                        <th scope="col">warehouse</th>
                        <th scope="col">quantity</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="ad in adjustments" :key="ad.id">
                        <td scope="col">{{ad.id}}</td>
                        <td scope="col">{{ad.product_name}}</td>
                        <td scope="col">{{warehouses[ad.warehouse_id].name}}</td>
                        <td scope="col">{{ad.is_addition==1?'+':'-'}} {{ad.quantity}}</td>
    
                        <td scope="col">
                            <router-link :to="{ name: 'edit-adjustment', params: { id: ad.id} }" 
                            class="btn btn-sm btn-primary">
                                edit
                            </router-link> 
    
                            <a class="btn btn-sm btn-danger" v-on:click="deleteAdjustment(ad.id)">
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
    