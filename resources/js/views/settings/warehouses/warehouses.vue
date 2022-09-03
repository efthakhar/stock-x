<script>
export default{

    data(){
        return{
            warehouses:[]
        }
    },
    methods:{
        async getWarehouses(){

            await  fetch(`${this.api_url}/api/warehouses`)
            .then(response=>response.json())
            .then(data => this.warehouses = data)

        },

        async deleteWarehouse(id){

            await  fetch(`${this.api_url}/api/warehouses/${id}`,{
                method:  'DELETE',
                headers: {
                'Content-Type': 'application/json'
                },              
            })
            .then(response=>response.json())
            .then(data => console.log(data))
            this.getWarehouses()

        }
    },
    mounted(){
        this.getWarehouses()
    }

}   
</script>

<template>
    <div class="row">
<div class="fullpage">
    <div class="page-nav-section">
        <router-link :to="{ name: 'add-warehouse' }" class="btn btn-primary">
            Add Warehouse
        </router-link>
    </div>
    <div class="page-content">
        
            <div class="table-container">
            <table class="table  table-bordered my-2">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">phone</th>
                    <th scope="col">email</th>
                    <th scope="col">address</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="warehouse in warehouses" :key="warehouse.id">
                    <td scope="col">{{warehouse.id}}</td>
                    <td scope="col">{{warehouse.name}}</td>
                    <td scope="col">{{warehouse.phone}}</td>
                    <td scope="col">{{warehouse.email}}</td>
                    <td scope="col">{{warehouse.address}}</td>

                    <td scope="col">
                        <router-link :to="{ name: 'edit-warehouse', params: { id: warehouse.id} }" 
                        class="btn btn-sm btn-primary" >
                            edit
                        </router-link> 

                        <a class="btn btn-sm btn-danger" v-on:click="deleteWarehouse(warehouse.id)">
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