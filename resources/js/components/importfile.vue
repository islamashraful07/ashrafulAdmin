<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Import xlsx file to User table </div>

                    <div class="card-body">
                    <form method="post" action="submit"  id="upload_form" name="upload_form" enctype="multipart/form-data" >
                    
                    
                    <div class="form-group">
                        <label for="name">xlsx</label>
                        <input type="file" class="form-control" name="file" id="file" />
                        
                        </div>

                        
                        <input type="submit" name="import" id="submit" value="import" class="btn btn-success" />
                    </form>
  
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data()
    {
        return{
            attachment:null,
            form: new FormData
        }
    },
    methods: {
        filedChange(e)
        {
            
            let selectedFile = e.target.files[0];
            this.attachment=selectedFile;
            console.log(selectedFile);

        },
        Uploadfile()
        {
            this.form.append('file',this.attachment);
            //console.log(this.form);
            const config={headers:{'Content-Type':"multipart/form-data"}};
            axios.post('/submit',this.form,config).then(response=>{

            })
            .catch(response=>{

            });
        }
        
    },
        mounted() {
            console.log('Component mounted.')
        }
    }

 
</script>

