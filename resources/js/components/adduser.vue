<template>
<div id="app">
  <form @submit.prevent="createUser" >
    <div class="form-group">
      
      <input v-model="form.name" type="text" name="name" placeHolder="Name"
        class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
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

    </div> <div class="form-group">
      
      <input v-model="form.password" type="password" name="password" placeHolder="Password" id="password"
        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
      <has-error :form="form" field="password"></has-error>
    </div>


    <button :disabled="form.busy" type="submit" class="btn btn-primary">Create</button>
  </form>
</div>  
</template>

<script>
  export default{
  data () {
    return {
      
      form: new Form({
        name:'',
        email:'',
        password:'',
        type:'',
        photo:''
      })
    }
  },
  methods: {
      createUser(){
          this.form.post('api/user')
          .then(()=>{
            toast.fire({
                type: 'success',
                title: 'user created successfully'
              })
            
              this.created();
              

          })
          .catch(()=>{

          })
          

      },
  created() {
      this.$router.push('/users');
      
  }
  },
 

}
</script>