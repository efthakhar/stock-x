<script>
export default{
    data(){
        return{
           
            files: [],
            base_path:''
            
        }
    },
    methods:{

        async getFiles(){
            await fetch(`${this.api_url}/file-control`)
            .then(response => response.json())
            .then(data => {
                this.files = data[0]
                this.base_path = data[1]

                console.log(this.files)
            })
        },



        async deleteFile(path){

            console.log(path)

            fetch(`${this.api_url}/file-control`,{
                method:  'DELETE',
                headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.
                                querySelector('meta[name="csrf-token"]')
                                .content,
                },
                body: JSON.stringify({filename : path})             
            })
            .then(response=> response.json())
            .then(res=>console.log(res))
            this.getFiles()

        },

    },
    mounted(){
        this.getFiles()
    }

}
</script>

<template>
<div class="row">
<div class="fullpage">
    <!-- <div class="page-nav-section">
        <router-link :to="{ name: 'add-product' }" class="btn btn-primary">
            Add Product
        </router-link>
    </div> -->
    <div class="page-content">
        
        <div class="files">
            <div class="file" v-for="file in files" :key="file">
                <img :src="base_path+'/'+file.name" alt="" class="file_img">
                <button @click="deleteFile(file.name)" class="btn btn-sm btn-danger">delete</button>
            </div>
        </div>
      
    </div>
    
</div>
</div>     
</template>

<style>
/* .files{
    display: flex;
    flex-wrap: wrap;
} */
.file{
    display: inline-block;
    width: 100px;
    height: 100px;
    margin:20px;
    /* border: 2px solid grey; */
    box-shadow: 1px 1px 10px grey;
}
.file_img{
    width: 100%  !important;
    height: 100% !important;
    object-fit: cover;
    
}    
</style>