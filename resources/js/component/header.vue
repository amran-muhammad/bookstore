<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <router-link to="/" class="nav-link"   >
                        Home <span class="sr-only">(current)</span>
                    </router-link>
                </li>
                <template v-if="authUser.usertype=='admin'">
                <li class="nav-item">
                     <router-link to="/add_book" class="nav-link">
                        Add Book 
                    </router-link>
                </li>
                
                <li class="nav-item">
                     <router-link to="/add_category" class="nav-link">
                        Add Category 
                    </router-link>
                </li>
                <li class="nav-item">
                     <router-link to="/all_order" class="nav-link">
                        All Order 
                    </router-link>
                </li>
            
                </template>
                 <li class="nav-item">
                     <router-link to="/all_category" class="nav-link">
                        Categories
                    </router-link>
                </li>
                <li class="nav-item">
                     <router-link to="/all_author" class="nav-link">
                        Authors
                    </router-link>
                </li>
                
                <li class="nav-item">
                     <router-link to="/about" class="nav-link">
                        About 
                    </router-link>
                </li>
                <template v-if="isLoggedIn">
                     <li class="nav-item">
                        <a href="/logout"  class="nav-link" >Logout</a>
                    </li>
                    <li class="nav-item nav-link" style="color: green">
                        <router-link :to="`/user/${authUser.id}`" class="nav-link">
                        {{authUser.first_name}} 
                    </router-link>
                    </li>
                </template>
                <template v-else>
                     <li class="nav-item">
                        <router-link to="/login" class="nav-link">
                            Login 
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/registration" class="nav-link"   >
                            Registration 
                        </router-link>
                    </li>
                </template>
                     <li class="nav-item">
                        <!-- <router-link to="/add_cart" class="nav-link"   > -->
                        <!-- <router-link :to="{name: 'add_cart'}">link</router-link> -->
                        <a :href="$router.resolve({name: 'add_cart'}).href"><i class="fa fa-shopping-cart">Cart</i> </a>
                            
                        <!-- </router-link> -->
                    </li>
               
               
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>


export default {
    data(){
        return {
            user:{}
        }
    },
    methods:{
        async single_user(){
            
            this.$route.params.id = this.authUser.id
            const res = await this.callApi('get',`user/${this.$route.params.id}`)
            if(res.status == 200){
                this.user = res.data
                
            }
        }
    },
  

  created(){
      //this.single_user();
     
  }

}
</script>