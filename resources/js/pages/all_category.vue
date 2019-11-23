<template>
    <div class="container">
        <div>
            
               <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">Category Name</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in category" :key="index">
                    <td>
                        <router-link :to="`/all_category/${item.id}`"  >{{item.name}} </router-link></h5>
                     </td>    
                </tr>
            </tbody>
            </table> 
            
            
      
        </div>
        

        
            
    </div>
</template>

<script>
export default {
    data(){
        return{
         category:[]

        }
    },
    methods:{
       
    },
    async created(){
        const res = await this.callApi('get','all_category')
        if(res.status == 200){
            this.category = res.data
            
        }
        
        
    }
    // computed:{
    //     message(){
    //         return this.store.state.message
    //     }
    // }
}
</script>