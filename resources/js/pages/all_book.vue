<template>
    <div class="container mt-4">
        <div class="card"  style="width: 800px">
            <div class="card-body">
                <h5 class="card-title">{{book.name}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">$ {{book.price}}</h6>
                <h6 class="card-subtitle mb-2 text-muted"> <i>{{book.author.first_name}} {{book.author.last_name}}</i></h6>
                <p class="card-text">{{book.details}}</p>
                <div>
                    <!-- reaction template -->
                    <template>
                        <template>
                        <template v-if="dolike">
                            <button v-model="reaction.likes" class="fa fa-thumbs-up" @click="doclickedlikes">Like</button>
                            
                        </template>
                        <template v-if="undolike">

                        <button v-model="reaction.likes" class="fa fa-thumbs-up" @click="undoclickedlikes">Unlike</button>
                        </template>
                        <p v-if="book.reaction && book.total_likes">{{book.total_likes.totalLikes}} Likes</p>
                    </template>
                    <template>
                    <template v-if="dodislike">
                        <button v-model="reaction.dislikes" class="fa fa-thumbs-down" @click="doclickeddislikes">Disike</button>
                    </template>
                    <template v-if="undodislike">
                        <button v-model="reaction.dislikes" class="fa fa-thumbs-down" @click="undoclickeddislikes">UnDisike</button>
                    </template>
                    <p v-if="book.reaction && book.total_dislikes">{{book.total_dislikes.totalDislikes}} Dislikes</p>
                    </template>
                    </template>
                    
                </div>
                <h1 class="text-center">All Review</h1>
            <table class="table table-dark">
                    
            <thead>
                <tr>
                <th scope="col">Review No.</th>
                <th scope="col">User Name</th>
                <th scope="col">Book ID</th>
                <th scope="col">Review</th>
                <th scope="col">Rating</th>
                <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                <tr  v-for="(item,index) in book.review_and_rating" :key="index">
                     <td>{{index+1}} </td>
                     <td>{{item.user.first_name}} {{item.user.last_name}}</td>
                     <td>{{item.book_id}}</td>
                     <td>
                        <template v-if="isEditReview && index == editIndexOfReview">
                            <input type="text" v-model="edit_review.comment">
                        </template>
                        <template v-else>{{item.comment}}
                       </template>
                    </td>
                     <td>
                        <template v-if="isEditReview && index == editIndexOfReview">
                            <template>
                            <Rate v-model="edit_review.rating"/>
                        </template>
                        </template>
                        <template v-else>
                            <template v-for="i in 5">
                                <span :class="(item.rating >= i) ? 'fa fa-star checked' : 'fa fa-star' "></span>
                            </template>
                       </template>
                    </td>
                    <td>
                         <template v-if="isEditReview  && index == editIndexOfReview">
                                <button class="btn btn-success" @click="updateReviewAndRating">Save</button>
                                <button class="btn btn-warning" @click="isEditReview = false">Cancel</button>
                      </template>
                    
                       
                         <template v-else>
                            <template v-if="item.user.id==authUser.id">
                            <button class="btn btn-primary" @click="isEditReviewOn(item,index)">Edit</button>
                            <button class="btn btn-danger" @click="review_rating_delete(item,index)">Delete</button>
                        </template>
                        <template v-else>
                            <p> ok </p>
                        </template> 
                             
                         </template>
                          
                      
                        
                    </td>
                </tr>
            </tbody>
        </table>
                
              
                
                <hr>
                <div>
                   <div>

                     <template v-if="isClickedOn">
                         <input type="text" v-model="review.comment">
                         <template>
                            <Rate v-model="review.rating"/>
                        </template>
                         <button type="submit" class="btn btn-primary" @click="reviewAndRatingSubmit">Submit</button>
                         <button  class="btn btn-danger" @click="writeReview">Cancel</button>
                    
                    </template>
                    <template v-if="reviewSubmit">
                        <button class="btn btn-primary" @click="isClicked">Write Review and Rating</button>
                    </template>
                   </div>
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            book:{},
            isClickedOn: false,
            review:{},
            edit_review:{},
            isEditReview: false,
            editIndexOfReview: -1,
            reviewSubmit:true,
            reaction:{
                likes:0,
                dislikes:0
            },
            dolike:true,
            undolike:false,
            dodislike:true,
            undodislike:false
        
        }
    },
    methods :{
        async single_book(){
            const res = await this.callApi('get',`all_book/${this.$route.params.id}`)
            if(res.status == 200){   
                if (!res.data.total_dislikes) {
                  res.data.total_dislikes={}
                  if (!res.data.total_dislikes.totalDislikes) {
                     res.data.total_dislikes.totalDislikes =0
                  }
                }  
                 if (!res.data.total_likes) {
                  res.data.total_likes={}
                  if (!res.data.total_likes.totalLikes) {
                     res.data.total_likes.totalLikes = 0
                  }
                }
               
             this.book = res.data

                for (let val of this.book.review_and_rating) {
                    if (val.user.id==this.authUser.id)  this.reviewSubmit=false
                      
                }
                if (this.book.reaction) {
                  for (let val of this.book.reaction) {
                    if (val.user_id==this.authUser.id) {
                       if (val.likes ==1) {
                        this.reaction.likes=1
                          this.undolike = true 
                          this.dolike = false
                        }
                       if (val.dislikes ==1){
                        this.reaction.dislikes=1
                          this.undodislike = true
                          this.dodislike = false
                                                      }
                    }
                      
                }
                }
            }
                
       },

       
        isClicked(){

            this.isClickedOn = true
            this.reviewSubmit = false 
            


        },
         writeReview(){
            this.isClickedOn = false

            this.reviewSubmit = true
        },
       
        async reactionSubmit(){

                this.reaction.book_id = this.book.id

                this.reaction.user_id = this.authUser.id

                const res = await this.callApi('post','add_reaction',this.reaction)
                if (res.data == 201) {

                  for (let val of this.book.reaction) {
                    if (val.user_id==this.authUser.id) {
                       if (val.likes ==1) {
                          this.reaction.likes =1
                          this.undolike = true 
                          this.dolike = false
                          this.undodislike = false
                          this.dodislike = true
                          
                        }
                        if (val.likes ==0) {
                          this.reaction.likes =0
                          this.undolike = false 
                          this.dolike = true
                          this.undodislike = true
                          this.dodislike = false
                          
                        }
                       if (val.dislikes ==1){
                          this.reaction.dislikes =1
                          this.dolike = true
                          this.undolike = false
                          this.undodislike = true
                          this.dodislike = false
                          
                                                      }
                        if (val.dislikes ==0){
                           this.reaction.dislikes =0
                          this.dolike = false
                          this.undolike = true
                          this.undodislike = false
                          this.dodislike = true
                          
                                                      }
                    }
                      
                }
                }
                

        },
       async reviewAndRatingSubmit(){

            if (this.review.comment =='') return this.i("Review is Empty!")
            if (this.review.rating =='') return this.i("Rating is Empty!")
                this.review.book_id = this.book.id

                this.review.user_id = this.authUser.id
            const res = await this.callApi('post','add_review_rating',this.review)
            
            if(res.status == 201){
                this.s(' A review and a rating added successfully')
                res.data.user = this.authUser
                
               this.book.review_and_rating.push(res.data)
        
               
            }
            this.isClickedOn = false
            
           
            

        },
        async updateReviewAndRating(){

            if(this.edit_review.comment == '') return this.i("Review is empty!");
            if(this.edit_review.rating == '') return this.i("Rating is empty!");
            const res = await this.callApi('post','edit_review_rating',this.edit_review)
            
            if(res.status == 200){

                this.book.review_and_rating[this.editIndexOfReview].comment=this.edit_review.comment
                this.book.review_and_rating[this.editIndexOfReview].rating=this.edit_review.rating

               


                this.s("Review and Rating Updated!")
                 
                this.editIndexOfReview = -1
                this.isEditReview = false
            }
            else{
                this.swr();
            }
        },
        async review_rating_delete(item,index){
            if(!confirm("Are you sure to delete this Review")){
                return;
            }
            let ob = {
                id:item.id
            }
            const res = await this.callApi('post','delete_review_rating',ob)
            if(res.status == 200){
                this.i(' Review have been successfully Deleted!')
                this.book.review_and_rating.splice(index,1)
                this.review.comment=''
                this.review.rating=''
                this.reviewSubmit=true
            }
        },

        isEditReviewOn(item,index){
            this.isEditReview = true

            this.editIndexOfReview = index
            this.edit_review = _.clone(item)
            delete this.edit_review.user
        },
        doclickedlikes(){
            this.reaction.likes++
            
                         
            if (this.reaction.dislikes>0) {
                this.reaction.dislikes--
                
               }
            this.reactionSubmit()
            this.book.total_likes.totalLikes++
            if (this.reaction.dislikes==0 && this.book.total_dislikes.totalDislikes>0) {
                this.book.total_dislikes.totalDislikes--
                
              }
            this.dolike = false
            this.undolike = true
            this.dodislike = true
            this.undodislike = false

        },
        undoclickedlikes(){
         
            if (this.reaction.likes>0) {
                this.reaction.likes--
             }
            
            this.reactionSubmit()
            if (this.reaction.likes==0 && this.book.total_likes.totalLikes>0) {
                this.book.total_likes.totalLikes--
                
            }
            this.dolike = true
            this.undolike = false
            

        },
         doclickeddislikes(){
            this.reaction.dislikes++
            
            

           
          
            this.reactionSubmit()
             if (this.reaction.likes>0) {
                this.reaction.likes--
                if (this.book.total_likes.totalLikes>0) this.book.total_likes.totalLikes--
                
            }
            this.book.total_dislikes.totalDislikes++
           
            
            this.dolike = true
            this.undolike = false
            this.dodislike = false
            this.undodislike = true

        },
        undoclickeddislikes(){
            if (this.reaction.dislikes>0) {
                this.reaction.dislikes--
                
              }
           this.reactionSubmit()
           if (this.reaction.dislikes==0 && this.book.total_dislikes.totalDislikes>0) {
                this.book.total_dislikes.totalDislikes--
                
              }
         

            this.dodislike = true
            this.undodislike = false

        }
        
    },
    created(){
       
        this.single_book();
    }
}
</script>