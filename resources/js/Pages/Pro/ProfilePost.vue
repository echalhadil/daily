<template>
    <div class="uk-margin-auto uk-margin-auto-vertical uk-padding-small uk-width-1-1 uk-width-1-3@m profile-posts uk-border-rounded uk-float-left">

        <div class=" uk-width-1-1 uk-padding-remove uk-margin-remove uk-border-rounded" style="background:#aeaeaf" >
        <img role="button" class="object-fit-cover uk-border-rounded uk-box-shadow-small profile-posts-image" v-bind:src="url+post.picture" :uk-toggle="'target: #p'+post.id" > 
        </div>


        <!-- post modal -->
        <div :id="'p'+post.id" class="uk-modal-full" uk-modal> 
            <div class="uk-modal-dialog" style="background: #fafafa;">
                <button class="uk-modal-close-full " style="background: #fafafa;" type="button" uk-close></button>
                
                <div class="uk-modal-body uk-padding-remove uk-flex uk-margin-remove">
                            
                    <div class=" uk-width-3-5 uk-margin-auto-vertical uk-flex uk-margin-auto"  >
                        <img class="uk-margin-auto uk-box-shadow-small" style=" height :570px; "  :src="url+post.picture" alt="fuck you">
                    </div>

                    <div class=" uk-width-1-4 uk-margin-auto-right uk-padding-remove black " style="background: white; border-left: 1px #efefef solid; ">
                    
                        <!-- post owner -->
                        <div class="uk-box-shadow-small uk-width-1-1 uk-flex uk-padding-small" style=" border-bottom: 1px #efefef solid; " >
                            <!-- pic -->
                            <div class=" uk-width-1-6 " >
                                <img class="uk-width-3-4 uk-border-circle " :src="url+post.user.picture" style="width: 39px; height:39px;">
                            </div>
                            <!-- pic -->

                            <!-- username -->
                            <div class="uk-margin-auto-vertical" >
                                <p class="uk-margin-remove uk-text-capitalize uk-text-bold" > {{post.user.firstname}} {{post.user.lastname}}</p>
                                <span class="uk-text-small" >{{reformDate(post.created_at)}}</span>
                            </div>
                            <!-- username -->

                            <!-- options -->
                            <div class="uk-margin-auto-left uk-margin-auto-vertical">
                                <span role="button" class="mdi mdi-18px mdi-dots-vertical " ></span>
                                <div uk-dropdown="mode: click" class="uk-padding-remove ">
                                    <button class="uk-width-1-1 uk-margin-auto dropdown-item mdi mdi-pencil-outline uk-button-default uk-button  " type="button"> Edit</button> 
                                    <button v-if=" post.user.id == $page.user.id " class="uk-width-1-1 uk-margin-auto  dropdown-item mdi mdi-trash-can-outline uk-button-default uk-button" type="button"> Delete</button> 
                                    <button class="uk-width-1-1 uk-margin-auto  dropdown-item mdi mdi-information-outline uk-button-default uk-button" type="button"> Repport</button> 
                                </div>
                            </div>
                            <!-- options -->
                        </div>
                        <!-- post owner -->
                        
                        <!-- comments -->
                        <div class=" uk-width-1-1 uk-flex  " style="border-bottom: 1px #efefef solid;">
                        
                            <ul class=" uk-width-1-1  uk-overflow-auto uk-padding-remove" style="height: 430px;">
                                <!-- post Text -->
                                <li v-if="post.text" class="uk-width-1-1 uk-padding-small uk-padding-remove-bottom uk-margin-small-top uk-margin-small-bottom uk-margin-remove uk-flex ">
                                    <div class=" uk-width-1-6 uk-padding-remove">
                                        <img class=" uk-border-circle uk-width-3-4 " :src="url+post.user.picture" style="width: 39px; height:39px;" >
                                        
                                    </div>

                                    <div class=" uk-padding-remove uk-width-5-6">
                                        
                                        <p class=" uk-width-1-1 uk-margin-remove uk-text-small"> 
                                            <b class=" uk-text-bold black uk-text-capitalize "> {{post.user.firstname}} {{post.user.lastname}}</b>
                                            {{post.text}}
                                        </p>

                                    </div>
                                </li>
                                <!-- Post Text -->

                                <comment v-if="post.comments.length>0"  
                                        v-for="comment in post.comments" 
                                        :key="comment.id"
                                        :comment="comment" />

                            </ul>


                        </div>

                        <!-- comments -->


                        <!-- post Reacts -->
                        <div class=" uk-width-5-6 uk-flex uk-margin-small-top uk-margin-small-bottom uk-margin-auto-left uk-margin-auto-right " > 

                            <div v-on:click="like(post,$page.user)" class=" pointer uk-width-1-4 uk-border-rounded uk-text-center uk-text-danger " style=" background:#ffeded;" >
                                <p class=" uk-margin-small-top uk-margin-small-bottom" >
                                    <i class="mdi" :class="{  'mdi-heart':isLiked(post,$page.user),'mdi-heart-outline': ! isLiked(post,$page.user)} " ></i> 
                                    <b class="uk-text-normal">{{ hasLikes(post) }}</b>    
                                </p>
                            </div>

                            <div class="pointer uk-width-1-4 uk-margin-auto uk-border-rounded uk-text-center uk-text-warning " style="background: #fff8ed;">
                                <p class="uk-margin-small-top  uk-margin-small-bottom " >
                                    <i class=" mdi mdi-message-outline " ></i>
                                    <b class="uk-text-normal">{{ hasComments(post) }}</b>
                                </p>
                            </div>

                            <div class="pointer uk-width-1-4 uk-border-rounded uk-text-center uk-text-primary " style="background: #eaf2fd;">
                                <p class=" uk-margin-small-top  uk-margin-small-bottom " >
                                    <i class=" mdi mdi-share-outline " ></i> 
                                    <b class="uk-text-normal">{{ hasShares(post) }}</b>
                                </p>
                            </div>

                        </div>
                        <!--  post Reacts -->

                        <add-comment  :post="post" />
                                        
                        
                    </div>
                    
                </div>
            

            </div>
        </div>
        <!-- post modal -->

    </div>
   
</template>

<script>
    

    import AddComment from '../Home/AddComment'
    import Comment from '../Home/Comment'


    export default {
        data() {
            return {
                url : "http://127.0.0.1:8000/",
            }
        },

        components:{
            AddComment,
            Comment,
        },
        
        props:['post','user'],

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

                return (post.likes.filter(like => (like.user_id == user.id)).length > 0); //returns true or false
           

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

                    axios.delete(window.Laravel.url+'/likes/'+localeLike.id, localeLike , {headers: {'X-XSRF-TOKEN':window.Laravel.csrfToken}})
                        .then( Response => {
                            post.likes = post.likes.filter(like => like.id != localeLike.id)
                            console.log('unlike')
                        } )
                        .catch( error =>{console.log(error)} )
                }
                 

            },
            deletePost(post){

                
                if(confirm("are you sure ?"))
                
                console.table(this.post)

                this.post= {}
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