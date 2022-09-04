<script>
    export default{
        data(){
            return{
                brands:[],
                
            }
        },
        methods:{
    
            async getBrands(){
                 await fetch(`${this.api_url}/api/product-brands/`)
                .then(response => response.json())
                .then(data => this.brands = data)
            },
            async deleteBrand(id){
    
                fetch(`${this.api_url}/api/product-brands/${id}`,{
                    method:  'DELETE',
                    headers: {
                    'Content-Type': 'application/json'
                    },              
                })
                .then(response=> response.json())
                .then(res=>console.log(res.message))
                this.getBrands()
    
          },
    
        },
        mounted(){
            this.getBrands()
        }
    
    }
    </script>
    
    <template>
    <div class="row">
    <div class="fullpage">
        <div class="page-nav-section">
            <router-link :to="{ name: 'add-adjustment' }" class="btn btn-primary">
                Add Brand
            </router-link>
        </div>
        <div class="page-content">
           
            <div class="table-container">
                <table class="table  table-bordered my-2">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">logo</th>
                        <th scope="col">brand name</th>
                        <th scope="col">brand slug</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="brand in brands" :key="brand.id">
                        <td scope="col">{{brand.id}}</td>
                        <td scope="col" class="img_cell">
                            <img :src="brand.brand_img_url" alt="">
                        </td>
                        <td scope="col">{{brand.brand_name}}</td>
                        <td scope="col">{{brand.brand_slug}}</td>
    
                        <td scope="col">
                            <router-link :to="{ name: 'edit-product-brand', params: { id: brand.id} }" 
                            class="btn btn-sm btn-primary">
                                edit
                            </router-link> 
    
                            <a class="btn btn-sm btn-danger" v-on:click="deleteBrand(brand.id)">
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
    