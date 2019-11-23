<template>
    <div class="container">
        <div>
            
               <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">Author Name</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in author" :key="index">
                    <td>
                        
                        <router-link :to="`/all_author/${item.id}`"  >{{item.first_name}} {{item.last_name}}</router-link></h5>
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
         author:[]

        }
    },
    methods:{
       
    },
    async created(){
        const res = await this.callApi('get','all_author')
        if(res.status == 200){
            this.author = res.data
            
        }
        
        
    }
    // computed:{
    //     message(){
    //         return this.store.state.message
    //     }
    // }
}
</script>