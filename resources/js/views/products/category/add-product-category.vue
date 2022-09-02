<script>
import { useFileControl } from '../../../sharedFunction/filecontrol.js'

import axios from 'axios';
export default{

  setup() {
    const { uploadFile } = useFileControl()
    return {uploadFile}
  },


    data(){
        return{
            categories: [],
            category_name : '',
            category_slug : '',
            parent_category_id: '',
            category_img_url:'',
            category_img:'',
           
        }
    },
    methods:{
      async getCategories(){
              await fetch(`${this.api_url}/api/product-categories/`)
              .then(response => response.json())
              .then(data => this.categories = data)
      },
      async addCategory(){
          let data = { 
              category_name : this.category_name,
              category_slug : this.category_slug,
              parent_category_id: this.parent_category_id,
              category_img_url: this.category_img_url
          }  
          
        await  fetch(`${this.api_url}/api/product-categories`,{
              method:  'POST',
              headers: {
              'Content-Type': 'application/json'
              },
              body: JSON.stringify(data)
          }).then(response=>response.json())
            .then(data => console.log(data))

          this.$router.push({ name: 'product-categories'})  
      },
      async imageUpload(e){
          let url = await this.uploadFile(e)
          this.category_img_url =  url
      }


    },
    mounted(){
      this.getCategories()
    }


}  
</script>

<template>
<div class="row">
<div class="fullpage">
  
    <div class="page-content">
        <div class="col-md-4 p-2">
            <h6 class="m-2 mb-3">ADD NEW PRODUCT CATEGORY</h6>
            <form  class="m-2" enctype="multipart/form-data">

              <label class="mt-2 mb-1">Category Name **</label>  
              <input type="text"  class="form-control" v-model="category_name">

              <label class="mt-2 mb-1">Category slug **</label>  
              <input type="text"  class="form-control" v-model="category_slug">

              <label class="mt-2 mb-1">Parent Category</label>  
              <select class="form-control" v-model="parent_category_id">
                <option value="">none</option>
                <option v-for="category in categories" :key="category.id" :value="category.id" >
                  {{category.category_name}}
                </option>
              </select>

   
              <label class="mt-2 mb-1" >Category Image</label>
              <div>
                <img :src="category_img_url" alt="" class="cat_img" v-if="category_img_url">
                <input type="file" class="form-control" v-on:change="imageUpload">
              </div>
              

              <a  class="btn btn-primary my-3" v-on:click="addCategory">
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
</style>

