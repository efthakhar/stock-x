<script>
import axios from 'axios';
export default{


    data(){
        return{
            categories: [],
            category_name : '',
            category_slug : '',
            parent_category_id: '',
            category_img_url:'',
            category_img:'',
            child_cats:[]
        }
    },
    methods:{
      async getCategory(){
              await fetch(`${this.api_url}/api/product-categories/${this.$route.params.id}`)
              .then(response => response.json())
              .then(data => {
                this.category_name = data.category_name,
                this.category_slug = data.category_slug,
                this.parent_category_id = data.parent_category_id,
                this.category_img_url = data.category_img_url
              })
      },

      async getCategories(){
              await fetch(`${this.api_url}/api/product-categories/`)
              .then(response => response.json())
              .then(data => this.categories = data)
      },

      async getChildCat(){
              await fetch(`${this.api_url}/api/product-categories/childcats/${this.$route.params.id}`)
              .then(response => response.json())
              .then(data => {
                this.child_cats= data
              })
              console.log(this.child_cats)
      },




      async editCategory(){
          let data = { 
              category_name : this.category_name,
              category_slug : this.category_slug,
              parent_category_id: this.parent_category_id,
              category_img_url: this.category_img_url
          }  
          
        await  fetch(`${this.api_url}/api/product-categories/${this.$route.params.id}`,{
              method:  'PUT',
              headers: {
              'Content-Type': 'application/json'
              },
              body: JSON.stringify(data)
          }).then(response=>response.json())
            .then(data => console.log(data))

            this.$router.push({ name: 'product-categories'})  
      },

     async uploadFile(e){
        this.category_img = e.target.files[0];
        let formData = new FormData(); 
        formData.append("file", e.target.files[0]);

        const config = { headers: 
                          {
                              'content-type': 'multipart/form-data',
                              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                          }
                         }

          axios.post('/file-control', formData, config)
          .then(response=>{
            this.category_img_url = response.data.file_name
            console.log(response.data.file_name)
          })
        

      },

    },
    mounted(){
      this.getCategories()
      this.getCategory()
      this.getChildCat()
    }
}  
</script>

<template>
<div class="row">
<div class="fullpage">
    
    <div class="page-content">
        <div class="col-md-4 p-2">
            <h6 class="m-2 mb-3">EDIT CATEGORY</h6>
            <form  class="m-2" enctype="multipart/form-data">

              <label class="mt-2 mb-1">Category Name **</label>  
              <input type="text"  class="form-control" v-model="category_name">

              <label class="mt-2 mb-1">Category slug **</label>  
              <input type="text"  class="form-control" v-model="category_slug">

              <label class="mt-2 mb-1">Parent Category</label>  
              <select class="form-control" v-model="parent_category_id">
                <option value="">none</option>
                <option v-for="category in categories" 
                  :key="category.id" :value="category.id"
                  :class="child_cats.includes(category.id)||category.id==this.$route.params.id?'hide_cat':''"
                >
                  {{category.category_name}}
                </option>
              </select>

              <label class="mt-2 mb-1" >Category Image</label>
              <div><img :src="category_img_url" alt="" class="cat_img" v-if="category_img_url"></div>  
              <input type="file" class="form-control" v-on:change="uploadFile">

              <a  class="btn btn-primary my-3" v-on:click="editCategory">
                SUBMIT
              </a>

            </form>
        </div>
       
    </div>
   
</div>
</div>  
</template>

<style>

.cat_img{
  width: 100px;
  height: 100px;
  object-fit: cover;
  margin:10px;
}
.hide_cat{ display: none;}
</style>

