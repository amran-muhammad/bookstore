<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <Form :model="formItem" :label-width="60">
                        <FormItem label="First Name">
                            <Input v-model="formItem.first_name" placeholder="Enter..."></Input>
                        </FormItem>
                        <FormItem label="Last Name">
                            <Input v-model="formItem.last_name" placeholder="Enter something..."></Input>
                        </FormItem>
                        <FormItem label="Email">
                            <Input v-model="formItem.email" placeholder="Enter something..."></Input>
                        </FormItem>
                        <FormItem label="Phone Number 1">
                            <Input v-model="formItem.phone1" placeholder="Enter your phone number"></Input>
                        </FormItem>
                        <FormItem label="Phone Number 2">
                            <Input v-model="formItem.phone2" placeholder="Allternative phone number"></Input>
                        </FormItem>
                        <FormItem label="Country">
                            <Input v-model="formItem.country" placeholder="Enter your country"></Input>
                        </FormItem>
                        <FormItem label="City">
                            <Input v-model="formItem.city" placeholder="Enter your city"></Input>
                        </FormItem>
                        <FormItem label="Area">
                            <Input v-model="formItem.area" placeholder="Enter your area"></Input>
                        </FormItem>
                        <FormItem label="Address">
                            <Input v-model="formItem.address" placeholder="Enter your address"></Input>
                        </FormItem>
                        
                        
                        
                        <FormItem>
                            <Button type="primary" @click="submitShippingInformation" >Submit</Button>
                        </FormItem>
                </Form>
                     
                           
            </div>
            <div class="col-md-4">
                <h1>Checkout Summary</h1>
                <hr>
                <template>
                <table class="table table-dark" style="width: 100%">
                <thead>
                    <tr>
                        
                        <th class="product-name">SL</th>
                        <th class="product-name">Book Name</th>
                        <th class="product-name">Quantity</th>
                        <th class="product-name">Rate</th>
                        <th class="product-price ">Price</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
                    <tr class="product-item-details" v-for="(item,index) of cartItem[0]" :key="index" >
                        
                        <td class="product-name pr-4">
                            <span class="pr-4"> {{index+1}}</span>
                        </td>
                        <td class="product-name pr-4">
                            <span class="pr-4"> {{item.name}}</span>
                        </td>
                        <td>
                        {{item.quantity}}
                            
                        </td>
                        <td>
                            {{item.price}}
                        </td>


                        <td class="product-price">
                            
                        
                            <template>
                                <span class="pr-4">{{item.price*item.quantity}}</span>
                            </template>
                            
                        </td>
                           
                    </tr>
                    <tr>
                        
                        
                    </tr>
                    <tr>Sub Total = {{total}} Taka</tr>
                    <tr>Shipping Cost = 40 Taka</tr>
                    <tr>Discount = 0 Taka</tr>
                    <tr>Total = {{total+40}} Taka</tr>

                    
                    
                </tbody>
                </table>
               
                                           
            </template>


            </div>
          
        </div>
       
            
    </div>
</template>

<script>
export default {
    data(){
        return{
                
                formItem: {
                first_name:'',
                last_name:'',
                email:'',
                phone1:'',
                phone2:'',
                country:'',
                city:'',
                area:'',
                address:''
                  
                },
                editQuantity: false,
                totalButtonisClicked: false,
                total:0,

                


        }
    },
    methods:{
       async submitShippingInformation(){

            if(this.formItem.first_name=='' ) return this.i("First Name is required!");
            if(this.formItem.last_name=='' ) return this.i("Last is required!");
            if(this.formItem.email=='' ) return this.i("Email is required!");
            if(this.formItem.phone1=='' ) return this.i("Phone Number is required!");
            if(this.formItem.phone2=='' ) return this.i("Alternative Number is required!");
            if(this.formItem.country=='' ) return this.i("Country is required!");
            if(this.formItem.city=='' ) return this.i("City is required!");
            if(this.formItem.area=='' ) return this.i("Area Name is required!");
            if(this.formItem.address=='' ) return this.i("Address is required!");
            this.formItem.user_id = this.authUser.id
            
            
            const res = await this.callApi('post','add_shipping_information',this.formItem)
                if(res.status===201){
                    this.s("Shipping informations added Successfully!");
                    
                    
                    this.$router.push(`/confirm_order/${res.data.id}`)
                  
                }
                

        },
	
			
		
		totalCart(){
			this.total=0
			this.totalButtonisClicked = true
			for (var i = 0; i < this.cartItem[0].length; i++) {
				this.total +=this.cartItem[0][i].price*this.cartItem[0][i].quantity
				
			}
			return this.total
		}
	
        

		
		
	},
	 
    created(){
        
         this.getFullCartFromLocalStorage()
         this.totalCart();
         
    }
    // computed:{
    //     message(){
    //         return this.store.state.message
    //     }
    // }
}
</script>