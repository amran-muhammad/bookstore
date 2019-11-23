<template>
    <div class="container">
        <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Average Rating</th>
                <th scope="col">Author Name</th>
                <th scope="col">Details</th>
                <th scope="col">Price</th>
                <th scope="col">ISBN Number</th>
                <th scope="col">Language</th>
                 <th scope="col">Add To Cart</th>


                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in books" :key="index">
                    <th scope="row">{{index+1}}</th>
                    <td>
                        {{item.id}} 
                    </td>
                    <td>
                        <router-link :to="`/all_book/${item.id}`"  >{{item.name}} </router-link>
                        </td>
                    <td>{{item.category.name}}</td>
                     <td>
                        <template v-if="item.average">
                            <template v-for="i in 5">
                                <span :class="(item.average.averageRating >= i) ? 'fa fa-star checked' : 'fa fa-star' "></span>
                            </template>
                        </template>
                        
                        <template v-else>
                        <i>no rating here</i>
                        </template>
                    </td>
                    <td>
                        {{item.author.first_name}} {{item.author.last_name}}
                        <!-- <div v-if="item.tags.length>0">
                            <div v-for="(i,x) in item.tags" :key="x">
                                <span v-if="x!==0"  >,</span>
                                <span >{{i.tag.name}}  </span> 
                            </div>
                        </div> -->
                    </td>
                    <td>
                        {{item.details}}
                        <!-- <template v-if="item.average">
                            <template v-for="i in 5">
                                <span :class="(item.average.averageRating >= i) ? 'fa fa-star checked' : 'fa fa-star' "></span>
                            </template>
                        </template>
                        
                        <template v-else>
                        <i>no rating here</i>
                        </template> -->
                    </td>
                    <td>৳{{item.price}}</td>
                    <td>{{item.isbn_number}}</td>
                    <td>{{item.language}}</td>
                    <td><button @click="addItemToCart(item)">ADD CART</button></td>
                </tr>
            </tbody>
            </table>
        

        
            
    </div>
</template>

<script>
export default {
    data(){
        return{
          user:{},
          books:[]

        }
    },
    methods:{
       async single_user(){
            this.$route.params.id = this.authUser.id
            const res = await this.callApi('get',`user/${this.$route.params.id}`)
            if(res.status == 200){
                this.user = res.data
            }
        },
       async all_books(){
            const res = await this.callApi('get','all_books')
            if (res.status == 200) {
                this.books = res.data
            }
        },
        addItemToCart(p){
           this.addNewItemToMyCart(p);
           }
        
    },
    created(){
        this.single_user();
        this.all_books();
        
    },
    // computed:{
    //     message(){
    //         return this.store.state.message
    //     }
    // }
}
</script>