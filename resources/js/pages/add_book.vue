<template>
    <div class="container">
        <div>
            
                <Form :model="formItem" :label-width="60">
                    <FormItem label="Name">
                        <Input v-model="formItem.name" placeholder="Enter..."></Input>
                    </FormItem>
                    <FormItem label="Details">
                        <Input v-model="formItem.details" placeholder="Enter something..."></Input>
                    </FormItem>
                    <FormItem label="Price">
                        <Input v-model="formItem.price" placeholder="Enter something..."></Input>
                    </FormItem>
                    <FormItem label="Author Name">
                        <Select v-model="formItem.author_id"  >
                        <Option v-for="item in author" :value="item.id" :key="item.id">{{ item.first_name }} {{ item.last_name }}</Option>
                    </Select>
                        
                    </FormItem>
                    <FormItem label="Category Name">
                        <Select v-model="formItem.category_id"  >
                        <Option v-for="item in category" :value="item.id" :key="item.id">{{ item.name }}</Option>
                    </Select>
                    </FormItem>

                    <FormItem label="ISBN Number">
                        <Input v-model="formItem.isbn_number" placeholder="Enter your country"></Input>
                    </FormItem>
                    <FormItem label="Language">
                        <Input v-model="formItem.language" placeholder="Enter your city"></Input>
                    </FormItem>
                    
                    
                    
                    
                    <FormItem>
                        <Button type="primary" @click="submitBookInformation" >Submit</Button>
                    </FormItem>
                </Form>
            
            
      
        </div>
        

        
            
    </div>
</template>

<script>
export default {
    data(){
        return{
          book:{},
                formItem: {
                  name:'', 
                  price:'',
                  details:'',
                  author_id:'',
                  category_id:'',
                  language:'',
                  isbn_number:''
                  
                },
                category:[],
                author:[]

        }
    },
    methods:{
        async submitBookInformation(){
            if(this.formItem.name=='') return this.i("Book Name is required!");
            if(this.formItem.price=='') return this.i("Book Price is required!");
            if(this.formItem.details=='') return this.i("Book Details is required!");
            if(this.formItem.author_id=='') return this.i("Book Author Name is required!");
            if(this.formItem.category_id=='') return this.i("Book Category Name is required!");
            if(this.formItem.language=='') return this.i("Book Language is required!");
            if(this.formItem.isbn_number=='') return this.i("Book ISBN Number is required!");

            const res = await this.callApi('post','create_book',this.formItem)
                if(res.status===201){
                    this.s("Book added Successfully!");  
                  this.$router.push('/')
                }

        }
       
       
    },
    async created(){
        const [ res1, res2] = await Promise.all([
            this.callApi('get','all_category'),
            this.callApi('get','all_author')
        ])
        if(res1.status == 200 && res2.status == 200){
            this.category = res1.data
            this.author = res2.data
        }
        
        
    }
    // computed:{
    //     message(){
    //         return this.store.state.message
    //     }
    // }
}
</script>