<script>
    export default{
    
        data(){
            return{
               
                role_id: '' ,
                roles:[],
                permissions:[],
                role_specific_permissions:[]
            }
        },
        methods:{
            async getRoles(){
                    await  fetch(`${this.api_url}/api/roles`)
                    .then(response=>response.json())
                    .then(data => this.roles = data)
            },
            
            async getPermissions(){
                    await  fetch(`${this.api_url}/api/permissions`)
                    .then(response=>response.json())
                    .then(data => this.permissions = data)
            },

            async get_role_sp_permissions(){
                await  fetch(`${this.api_url}/api/permissions/byrole/${this.role_id}`)
                    .then(response=>response.json())
                    .then(data => this.role_specific_permissions = data)
                    console.log(this.role_specific_permissions)
            },

            async alterPermission(id)
            {
                if(!this.role_specific_permissions.includes(id)){
                    this.role_specific_permissions.push(id)
                }else{
                    this.role_specific_permissions.
                    splice(this.role_specific_permissions.indexOf(id),1)
                }

            },

            async updatePermissionsForRole(){

               

                await  fetch(`${this.api_url}/api/permissions/change/${this.role_id}`,{
                    method:  'PUT',
                    headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.
                                    querySelector('meta[name="csrf-token"]')
                                    .content,
                    },
                    body: 
                    JSON.stringify({role_sp_permissions_ids: this.role_specific_permissions})
                })
                .then(response=>response.json())
                .then(data => console.log(data))

                // this.role_id = ''  
                // this.role_specific_permissions = [] 
                window.location.reload()            
            }
            
            
        },
        mounted(){
            this.getRoles()
            this.getPermissions()
            this.get_role_sp_permissions()
        }
    
    }   
    </script>
    
<template>
    <div class="row">
    <div class="fullpage">
        <div class="page-nav-section">  
            <a class="btn btn-primary">Roles & Permissions</a>    
        </div>
        <!-- {{role_specific_permissions}} -->
        <div class="page-content row">
            <div class="main-page-area col-md-6">
                <div class="roles my-3">
                    <label class="my-2">Choose A Role</label>
                    <select v-model="role_id" class="form-control" v-on:change="get_role_sp_permissions">
                        <!-- <option value="" selected disabled>choose a role</option> -->
                        <option :value="role.role_id" v-for="role in roles" :key="role.role_id">
                            {{role.role_name}}
                        </option>
                    </select>
                </div>   
                <div class="permissions">
                    <div class="form-check  m-3 "
                        v-for="permission in permissions" :key="permission.permission_id"
                        >
                            <input class="form-check-input" type="checkbox" 
                            v-on:click="alterPermission(permission.permission_id)"
                            :id="permission.permission_id" :value="permission.permission_id"
                            :checked="role_specific_permissions.includes(permission.permission_id)"
                            />

                            <label class="form-check-label" :for="permission.permission_id">
                                {{permission.permission_name}}
                            </label>

                        </div>
                        <a v-on:click="updatePermissionsForRole" class="btn btn-primary my-2">update</a>
                </div> 
            </div> 
            <div class="col-md-4 ms-auto">
                <h4>Selected Permissions </h4>
                <button class="btn btn-sm m-1 pm-btn btn-success" v-for="permission in role_specific_permissions" :key="permission.permission_id">
                 {{permissions[permission].permission_name}}
                </button>
                <!-- <button class="btn btn-sm m-1 pm-btn"
                v-for="permission in permissions" :key="permission.permission_id"
                :class="[role_specific_permissions.includes(permission.permission_id) ? 'btn-success' : ' ' ]"
                >
                 {{permission.permission_name}}
                </button> -->
            </div>   
        </div>    
    </div>
    </div>     
</template>

<style>
.pm-btn{
    box-shadow: 1px 1px 12px grey;
}
</style>