<script>
export default{

    data(){
        return{
            users:[],
        }
    },
    methods:{
        // async getRoles(){
        //         await  fetch(`${this.api_url}/api/roles`)
        //         .then(response=>response.json())
        //         .then(data => this.roles = data)
        // },
        async getUsers(){

            await  fetch(`${this.api_url}/api/users`)
            .then(response=>response.json())
            .then(data => this.users = data)

        },

        async deleteUser(id){

            await  fetch(`${this.api_url}/api/users/${id}`,{
                method:  'DELETE',
                headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },              
            })
            .then(response=>response.json())
            .then(data => console.log(data))
            this.getUsers()

        }
    },
    mounted(){
        this.getUsers()
    }

}   
</script>

<template>
    <div class="row">
<div class="fullpage">
    <div class="page-nav-section">
        <router-link :to="{ name: 'add-user' }" class="btn btn-primary">
            Add User
        </router-link>
    </div>
    <div class="page-content">
        
            <div class="table-container">
            <table class="table  table-bordered my-2">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">role</th>
                    <th scope="col">email</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td scope="col">{{user.id}}</td>
                    <td scope="col">{{user.name}}</td>
                    <td scope="col">{{user.role_name}}</td>
                    <td scope="col">{{user.email}}</td>

                    <td scope="col">
                        <router-link :to="{ name: 'edit-user', params: { id: user.id} }" 
                        class="btn btn-sm btn-primary" >
                            edit
                        </router-link> 

                        <a class="btn btn-sm btn-danger" v-on:click="deleteUser(user.id)">
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