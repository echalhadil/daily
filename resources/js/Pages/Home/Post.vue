<template>
    <div class=" uk-border-rounded uk-padding-small uk-margin-top uk-box-shadow-small" >
        
        <!-- post owner -->     
        <owner
            :firstname="post.user.firstname"
            :lastname="post.user.lastname"
            :picture="post.user.picture"
            :date="reformDate(post.created_at)"
            :id="post.user.id"
            :isModal="false"
            @delete-post="deletePost" 
            @edit-post="editPost"
            :text="post.text"            
        />
        <!-- post owner -->
        
        <!-- post content -->
        <profile-content
            :id="post.id"
            :picture="post.picture"
            :text="post.text"
            :isModal="false"
        /> 
        <!-- post content -->

        <!-- reactions -->
        <reactions  
            :inModel="false" 
            :likesNumber="post.likes.length" 
            :commentsNumber="post.comments.length" 
            :sharesNumber="post.shares.length" 
            :isLiked="isLiked(post,$page.user)"
            @like="like(post,$page.user)"
        />
        <!-- reactions -->

        


        <!-- post modal -->
        <div :id="'p'+post.id" class="uk-modal-full" uk-modal> 
            <div class="uk-modal-dialog" style="background: #fafafa;">
                <button class="uk-modal-close-full " style="background: #fafafa;" type="button" uk-close></button>
                
                <div class="uk-modal-body uk-padding-remove uk-flex uk-margin-remove">

                    <!-- post content -->
                    <profile-content
                        :id="post.id"
                        :picture="post.picture"
                        :text="post.text"
                        :isModal="true"
                    />
                    <!-- post content -->

                    <div class=" uk-width-1-4 uk-margin-auto-right uk-padding-remove black " style="background: white; border-left: 1px #efefef solid; ">
                     
                        <!-- post owner -->
                        <owner
                            :firstname="post.user.firstname"
                            :lastname="post.user.lastname"
                            :picture="post.user.picture"
                            :date="reformDate(post.created_at)"
                            :id="post.user.id"
                            :isModal="true"
                            @delete-post="deletePost" 
                            
                        />
                        <!-- post owner -->
                        
                        <!-- comments -->
                        <div class=" uk-width-1-1 uk-flex  " style="border-bottom: 1px #efefef solid;">
                        
                            <ul class=" uk-width-1-1  uk-overflow-auto uk-padding-remove" style="height: 430px;">
                                <!-- post Text -->
                                <li v-if="post.text" class="uk-width-1-1 uk-padding-small uk-padding-remove-bottom uk-margin-small-top uk-margin-small-bottom uk-margin-remove uk-flex ">
                                    <div class=" uk-width-1-6 uk-padding-remove">
                                        <img class=" uk-border-rounded object-fit-cover  uk-width-3-4 " :src="post.user.picture" style="width:40px; height:40px;" >
                                        
                                    </div>

                                    <div class=" uk-padding-remove uk-width-5-6">
                                        
                                        <p class=" uk-width-1-1 uk-margin-remove uk-text-small"> 
                                            <b class=" uk-text-bold black uk-text-capitalize "> {{post.user.firstname}} {{post.user.lastname}}</b>
                                            {{post.text}}
                                        </p>

                                    </div>
                                </li>
                                <!-- Post Text -->

                                <comment 
                                    v-if="post.comments.length>0"  
                                    v-for="comment in post.comments" 
                                    v-bind:key="comment.id"
                                    v-bind:comment="comment" 
                                />

                            </ul>


                        </div>
                        <!-- comments -->


                        <!-- post Reacts -->
                        <reactions  
                            :inModel="true" 
                            :likesNumber="post.likes.length" 
                            :commentsNumber="post.comments.length" 
                            :sharesNumber="post.shares.length" 
                            :isLiked="isLiked(post,$page.user)"
                            @like="like(post,$page.user)"
                        />
                        <!-- post Reacts -->


                        <add-comment  :post="post" />
                                        
                        
                    </div>
                    
                </div>
            

            </div>
        </div>
        <!-- post modal -->


    </div>               
</template>

<script>
    import Owner from './Owner'
    import ProfileContent from './Content'
    import AddComment from './AddComment'
    import Comment from './Comment'
    import Reactions from './Reactions'

    export default {
        components:{
            ProfileContent,
            AddComment,
            Comment,
            Reactions,
            Owner,
        },
        props:['post','user'],
        computed: {
            
        },
        methods: {
            hasLikes(post){
                return  (post.likes.length > 0 )? post.likes.length : '';
            },
            hasComments(post){
                return  (post.comments.length > 0 )? post.comments.length : '';
            },
            hasShares(post){
                return  (post.shares.length > 0 )? post.shares.length : '';
            },
            isLiked(post,user){

                return (post.likes.filter(like => (like.user_id == user.id)).length > 0)
                ? true
                : false
                 //returns true or false
            },

            like(post,user){
                if(!this.isLiked(post,user))
                {
                    axios.post('/likes',post)
                        .then( Response => { this.post.likes.push(Response.data) } )
                        .catch( Error => { console.log(Error) } )
                    console.log('like')
                    
                }
                else
                {
                    var localeLike = {};
                    
                    post.likes.forEach(like => { if(like.user_id == user.id)  localeLike = like });

                    axios.delete('http://127.0.0.1:8000/likes/'+localeLike.id, localeLike)
                        .then( Response => {
                            post.likes = post.likes.filter(like => like.id != localeLike.id)
                            console.log('unlike')
                        } )
                        .catch( error =>{console.log(error)} )
                }
                 

            },
            deletePost(){

                
                if(confirm("are you sure ?"))
                
                this.$emit("delete-post",this.post);
                
            },
            reportPost(){

            },
            editPost(text){
                 this.$emit("edit-post",[text,this.post]);
            },
            reformDate(LaravelDate){

                var year = LaravelDate.slice(0,4),
                month = LaravelDate.slice(5,7),
                day = LaravelDate.slice(8,10),
                houre = LaravelDate.slice(11,13),
                minute = LaravelDate.slice(14,16);

                return year+"-"+month+"-"+day+" at "+houre+":"+minute;
            },
        },
    }
</script>