<template>
    <div class="container">
        
        <h1>All Products</h1>
         <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
    
                <th scope="col">Category Name</th>
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
                    
                    <td>
                        {{item.category.name}} 
                      
                    </td>
                    <td>
                        {{item.details}}
                        
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
            books:[]

        }
    },
    methods:{
        async all_products(){
            const res = await this.callApi('get',`all_author/${this.$route.params.id}`)
            if(res.status == 200){
                this.books = res.data
            }
        },
        addItemToCart(p){
           this.addNewItemToMyCart(p);
           }
    },
    created(){
        this.all_products();
    }
}
</script>