<script>
    export default{
    
    
        data(){
            return{
                roles:[],
                
                name     : '',
                email    : '',
                password : '',
                role_id  : ''     
            }
        },
        methods:{

            async getRoles(){
                await  fetch(`${this.api_url}/api/roles`)
                .then(response=>response.json())
                .then(data => this.roles = data)
            },
            async getUser(id){
                await  fetch(`${this.api_url}/api/users/${id}`)
                .then(response=>response.json())
                .then(data =>{
                    this.name = data.name;
                    this.email = data.email;
                    this.password = '';
                    this.role_id = data.role_id
                  
                })
            },
            
            async editUser(){
    
                let data = { 
                    name    : this.name,
                    email   : this.email,
                    password: this.password,
                    role_id : this.role_id
                } 
    
        
                await  fetch(`${this.api_url}/api/users/${this.$route.params.id}`,{
                    method:  'PUT',
                    headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.
                                    querySelector('meta[name="csrf-token"]')
                                    .content,
                    },
                    body: JSON.stringify(data)
                })
                .then(response=>response.json())
                .then(data => data)
    
                this.$router.push({ name: 'users'})  
            },
    
        },
        
        mounted(){
            this.getRoles()
            this.getUser(this.$route.params.id)
        }
    
    }  
</script>

    
<template>
    <div class="row">
    <div class="fullpage">

        <div class="page-content">
            <div class="col-md-6 p-2">
                <h6 class="m-2 mb-3">EDIT USER</h6>
                <form  class="m-2" enctype="multipart/form-data">
    
                    <label class="mt-2 mb-1">name **</label>  
                    <input type="text"  class="form-control" v-model="name">
    
                    <label class="mt-2 mb-1">email **</label>  
                    <input type="text"  class="form-control" v-model="email">

                    <label class="mt-2 mb-1">role **</label>  
                    <select class="form-control"  v-model="role_id">
                        <option v-for="role in roles" :key="role.id"
                        :value="role.role_id" >{{role.role_name}}
                        </option>
                    </select>
    
                    <label class="mt-2 mb-1">password**</label>  
                    <input type="password" class="form-control" v-model="password">
                        
                    <a  class="btn btn-primary my-3" v-on:click="editUser">SUBMIT</a>
    
                </form>
            </div>
            
        </div>
        
    </div>
    </div>  
</template>
        