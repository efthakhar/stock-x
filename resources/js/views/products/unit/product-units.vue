<script>
export default{

    data(){
        return{
            units:[]
        }
    },
    methods:{
        async getUnits(){

            await  fetch(`${this.api_url}/api/product-units`)
            .then(response=>response.json())
            .then(data => this.units = data)

        },
        async deleteUnit(id){

            await  fetch(`${this.api_url}/api/product-units/${id}`,{
                method:  'DELETE',
                headers: {
                'Content-Type': 'application/json'
                },              
            })
            .then(response=>response.json())
            .then(data => console.log(data))
            this.getUnits()

        }
    },
    mounted(){
        this.getUnits()
    }

}   
</script>

<template>
 <div class="row">
<div class="fullpage">
    <div class="page-nav-section">
        <router-link :to="{ name: 'add-product-unit' }" class="btn btn-primary">
            Add UNIT
        </router-link>
    </div>
    <div class="page-content">
       
         <div class="table-container">
            <table class="table  table-bordered my-2">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">unit name</th>
                    <th scope="col">unit code</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="unit in units" :key="unit.id">
                    <td scope="col">{{unit.id}}</td>
                    <td scope="col">{{unit.unit_name}}</td>
                    <td scope="col">{{unit.unit_code}}</td>

                    <td scope="col">
                        <router-link :to="{ name: 'edit-product-unit', params: { id: unit.id} }" 
                        class="btn btn-sm btn-primary" >
                            edit
                        </router-link> 

                        <a class="btn btn-sm btn-danger" v-if="!unit.locked" v-on:click="deleteUnit(unit.id)">
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