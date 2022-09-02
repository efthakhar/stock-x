<script>
export default{

    data(){
        return{
            categories:[]
        }
    },

    methods:{
       async getCategories(){
             await fetch(`${this.api_url}/api/product-categories/`)
            .then(response => response.json())
            .then(data => this.categories = data)
        },
        async deleteCategory(id){

            fetch(`${this.api_url}/api/product-categories/${id}`,{
                method:  'DELETE',
                headers: {
                'Content-Type': 'application/json'
                },              
            })
            .then(response=> response.json())
            .then(res=>console.log(res.message))
            this.getCategories()

      },

     
    },
    mounted(){
        this.getCategories()
    }

}  
</script>

<template>
<div class="row">
<div class="fullpage">
    <div class="page-nav-section">
        <router-link :to="{ name: 'add-product-category' }" class="btn btn-primary">
            Add Category
        </router-link>
    </div>
    <div class="page-content">
        <div class="table-container">
            <table class="table  table-bordered my-2">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">logo</th>
                    <th scope="col">category name</th>
                    <th scope="col">category slug</th>
                    <th scope="col">parent category</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id">
                    <td scope="col">{{category.id}}</td>
                    <td scope="col" class="img_cell">
                        <img :src="category.category_img_url" alt="">
                    </td>
                    <td scope="col">{{category.category_name}}</td>
                    <td scope="col">{{category.category_slug}}</td>

                 
                    <td scope="col">{{categories[category.parent_category_id]!==undefined?categories[category.parent_category_id].category_name:''}}</td>

                    <td scope="col">
                        <router-link :to="{ name: 'edit-product-category', params: { id: category.id} }" 
                        class="btn btn-sm btn-primary">
                            edit
                        </router-link>
                        <a class="btn btn-sm btn-danger" v-on:click="deleteCategory(category.id)">
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

<style>
.fullpage{
position: relative;
}
.page-nav-section{
    position: sticky;
    left:0px;
    top:0px;
    background-color: whitesmoke;
    box-shadow: 1px 1px 2px grey;
    padding: 4px;
    display: block;
    width: 100% !important;
    z-index: 5;
    border-radius: 10px;
}
.img_cell{
    width:60px !important;
    min-width: 60px;
    height: 60px;
}
.img_cell img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>