<template>
    <div class="container">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Users</h3>

              <div class="box-tools">
                
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
            
             
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Type</th>
                  <th>Registered At</th>
                  <th>Midify</th>
                </tr>
                <tr v-for="user in users" ::key="user.id">
                  <td>{{user.id}}</td>
                  <td>{{user.name}}</td>
                  <td>{{user.email}}</td>
                  <td>{{user.type}}</td>
                  <td>{{user.created_at}}</td>

                  <td>
                    <a @click="newModal(user)">
                    <i class="fa fa-edit btn btn-info"></i>
                    </a>
                    
                    <a  @click="deleteUser(user.id)">
                    <i class="fa fa-trash btn btn-danger "></i>
                    </a>
                  </td>
                </tr>
                
                
                
              </tbody></table>
              <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form @submit.prevent="updateUser()">
                                <div class="form-group">
                                  
                                  <input v-model="form.name" type="text" name="name" placeHolder="Name"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                  <has-error :form="form" field="name"></has-error>
                                </div>

                                <div class="form-group">
                                  
                                  <input v-model="form.email" type="email" name="email" placeHolder="Email"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                  <has-error :form="form" field="email"></has-error>
                                </div>

                                <div class="form-group">
                                  
                                  <select  v-model="form.type" id="type" name="type" 
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option value="">Selete User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">Standard user</option>

                                  </select> 
                                  <has-error :form="form" field="type"></has-error>

                                </div> 
                                <div class="form-group">
                                  
                                  <input v-model="form.password" type="password" name="password" placeHolder="Password" id="password"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                  <has-error :form="form" field="password"></has-error>
                                </div>


                                <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button :disabled="form.busy" type="submit" class="btn btn-primary">Save changes</button>
                                  </div>
                              </form>
                        </div>
                        
                      </div>
                    </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>
</template>

<script>
  export default{
  data () {
    return {
      
     users:{},
     form: new Form({
        id:'',
        name:'',
        email:'',
        password:'',
        type:'',
        photo:''
      })
    }
  },
  methods: {
    updateUser(id){
      this.form.put('api/user/'+this.form.id)
      .then(()=>{
        $("#addModal").modal('hide');
        swal.fire(
                  'Updated!',
                  'Information has been updated .',
                  'success'
                )
                Fire.$emit('AfterCreated');
      })
      .catch(()=>{

      })
    },
    newModal(user){
      
      $('#addModal').modal('show');
      this.form.fill(user);
    },
    deleteUser(id){
      swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              axios.delete('api/user/'+id)
              .then(()=>{
                  swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                Fire.$emit('AfterCreated');
              
            }).catch(()=>{
              swal.fire ('Failed!',"There is something wrong",'warning');
            })
            });
    },
      loadUsers(){
          axios.get("api/user").then(({data})=>(this.users=data.data))

      }
  },
  created()  {
      this.loadUsers();
      Fire.$on('AfterCreated',()=>{
        this.loadUsers();
      });
      
  },

}
</script>
