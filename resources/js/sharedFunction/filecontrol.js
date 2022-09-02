import axios from 'axios';
export function useFileControl (){

    async function uploadFile(e){

        let uploaded_file_url = ''
        this.category_img = e.target.files[0];
        let formData = new FormData(); 
        formData.append("file", e.target.files[0]);

        const config =
         { headers: 
            {
                'content-type': 'multipart/form-data',
                'X-CSRF-TOKEN': document.
                                querySelector('meta[name="csrf-token"]')
                                .content,
            }
         }

         await axios.post('/file-control', formData, config)
           .then(response=>{
            uploaded_file_url = response.data.file_name
          })

          return uploaded_file_url

    }


    return { uploadFile }

}