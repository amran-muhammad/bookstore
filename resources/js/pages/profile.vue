<template>
    <div class="container">
        <div>
            

            <template v-if="isEdit">
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
                        <Button type="primary" @click="submitMyProfileInformation" >Submit</Button>
                        <button class="btn btn-secondary" @click="isEdit=false">Cancel</button>
                    </FormItem>
                </Form>
            </template>
            <template v-else>
                
                <table class="table table-dark">
                    <tbody>
                        <tr>
                            <td>First Name</td> <td>{{user.first_name}}</td>
                        </tr>
                        <tr>
                            <td>Last Name</td> <td>{{user.last_name}}</td>
                        </tr>
                        <tr><td>Email</td><td>{{user.email}}</td></tr>
                        <tr><td>User Type</td><td v-if="user.usertype">{{user.usertype}}</td></tr>
                        <tr><td>Phone 1</td><td v-if="user.phone1">{{user.phone1}}</td></tr>
                        <tr><td>Phone 2</td><td v-if="user.phone2">{{user.phone2}}</td></tr>
                        <tr><td>Country</td> <td v-if="user.country">{{user.country}}</td></tr>
                        <tr><td>City</td> <td v-if="user.city">{{user.city}}</td></tr>
                        <tr><td>Area</td><td v-if="user.area">{{user.area}}</td></tr>
                        <tr> <td>Address</td><td v-if="user.address">{{user.address}}</td></tr>
                      <tr v-if="user.author"><td>Author Additional Details</td><td>{{user.author.details}}</td></tr>      
                        

                    </tbody>
                </table>
                <button class="btn btn-secondary" @click="isEditOn">Edit</button>
                <template v-if="user.usertype=='author'">
               <template v-if="isClicked">
                    <Input v-model="detailsText.details" type="textarea" :rows="4" placeholder="Enter something..." />
                 
                    <button class="btn btn-primary" @click="add_details_of_author">Save</button>
                    <button class="btn btn-secondary" @click="isClicked=false">Cancel</button>
                </template>
                <template v-else>
                
                    <button class="btn btn-secondary" @click="isClicked=true">Add  Details</button>
                </template>
            </template>
            </template>
            
            
        </div>
        

        
            
    </div>
</template>

<script>
export default {
    data(){
        return{
                user:{},
                formItem: {
                  usertype:'', 
                  phone1:'',
                  phone2:'',
                  country:'',
                  city:'',
                  area:'',
                  address:''
                  
                },
                isEdit: false,
                isClicked: false,
                detailsText: {
                    details:'',
                    user_id:''
                }

        }
    },
    methods:{
       async submitMyProfileInformation(){
            if(this.formItem.phone1=='' ) return this.i("Phone Number is required!");
            if(this.formItem.phone2=='' ) return this.i("Alternative Number is required!");
            if(this.formItem.country=='' ) return this.i("Country is required!");
            if(this.formItem.city=='' ) return this.i("City is required!");
            if(this.formItem.area=='' ) return this.i("Area Name is required!");
            if(this.formItem.address=='' ) return this.i("Address is required!");
            this.formItem.id = this.authUser.id
            this.formItem.usertype = 'user'
            const res = await this.callApi('post','add_user_information',this.formItem)
                if(res.status===200){
                    this.s("Profile informations added Successfully!");
                    this.isEdit = false
                    this.user.push(res.data)
                    this.$router.push('/')
                  
                }
                

        },
        async single_user(){
            
            const res = await this.callApi('get',`user/${this.$route.params.id}`)
            if(res.status == 200){
                this.user = res.data
                this.detailsText.details = this.user.author.details
            }
        },
        isEditOn(){
            this.isEdit = true
            this.formItem = _.clone(this.user)
        },
        
         async add_details_of_author(){
            this.detailsText.user_id = this.user.id
            const res = await this.callApi('post','add_details_of_author',this.detailsText)
            if(res.status == 201 || res.status == 200){
                this.s("Details added!")
                this.$router.push('/')
                // this.user.details = res.data.details
            }
        }
       
    },
    created(){
        this.single_user();
        
    },
    // computed:{
    //     message(){
    //         return this.store.state.message
    //     }
    // }
}
</script>