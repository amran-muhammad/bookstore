<template>
    <div class="container">
        <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                


                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in orders" :key="index">
                    <th scope="row">{{index+1}}</th>
                    <td>
                        {{item.order_id}} 
                    </td>
                    
                    
                </tr>
            </tbody>
            </table>
        

        
            
    </div>
</template>

<script>
export default {
    data(){
        return{
    
          orders:[]

        }
    },
    methods:{
       
       async all_orders(){
            const res = await this.callApi('get','all_orders')
            if (res.status == 200) {
                this.orders = res.data
            }
        }
        
    },
    created(){
        
        this.all_orders();
    },
    // computed:{
    //     message(){
    //         return this.store.state.message
    //     }
    // }
}
</script>