<template>
    <div>
        
         <Form>
                <FormItem>
                     <Button type="success" @click="final_order">Order Now</Button>    
                 </FormItem> 
                </Form>
    </div>
</template>


<script>
export default {
    data(){
        return{
            shipping:{},
            order:[]

        }
    },
    methods:{
        async show_shipping_information(){
			 
                 const res = await this.callApi('get',`show_shipping_information/${this.$route.params.id}`)
                 if (res.status == 200) {
                    this.shipping = res.data
                     
                 }
            
	
			  
        },
        	final_order(){
			
			let orderJson1 = this.cartItem[0]
	
			
				for(let i in orderJson1){
		
			let ob = {
            order_id: this.shipping.id,    
			user_id: this.authUser.id, 
			name: orderJson1[i].name,
			price: orderJson1[i].price,
			quantity: orderJson1[i].quantity
			}
			this.order.push(ob)

			}	
			
			this.send_order();
		
		
		},
		 async send_order(){
			 for(let i in this.order){
                 const res = await this.callApi('post','create_order',this.order[i])
                 if (res.status ==201) {
                     if (i == this.order.length-1) {
                         this.s("Your order is sent!");
                         this.$ls.set('localcart', [])
                         this.$router.push('/')

                     }
                 }
            
             }
             //
			  
        }

    },
    created(){
       this.show_shipping_information();
       this.getFullCartFromLocalStorage()
    }
}
</script>


