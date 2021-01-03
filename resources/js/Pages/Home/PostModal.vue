  <!-- The popup post Modal -->
<template>
    <div  class="uk-modal-full" uk-modal> 
        <div class="uk-modal-dialog" style="background: #fafafa;">
            <button class="uk-modal-close-full " style="background: #fafafa;" type="button" uk-close></button>
            
            <div class="uk-modal-body uk-padding-remove uk-flex uk-margin-remove">
                        
                <div class=" uk-width-3-5 uk-margin-auto-vertical uk-flex uk-margin-auto"  >
                    <img class="uk-margin-auto uk-box-shadow-small" style=" height :570px; "  :src="post.picture" alt="fuck you">
                </div>

                <div class=" uk-width-1-4 uk-margin-auto-right uk-padding-remove black " style="background: white; border-left: 1px #efefef solid; ">
                
                    <!-- post owner -->
                    <div class="uk-box-shadow-small uk-width-1-1 uk-flex uk-padding-small" style=" border-bottom: 1px #efefef solid; " >
                        <!-- pic -->
                        <div class=" uk-width-1-6 " >
                            <img class="uk-width-3-4 uk-border-circle " v-bind:src="post.user.picture" style="width: 39px; height:39px;">
                        </div>
                        <!-- pic -->

                        <!-- username -->
                        <div class="uk-margin-auto-vertical" >
                            <p class="uk-margin-remove uk-text-capitalize uk-text-bold" > {{post.user.firstname}} {{post.user.lastname}}</p>
                            <span class="uk-text-small" >1d</span>
                        </div>
                        <!-- username -->

                        <!-- options -->
                        <div class="uk-margin-auto-left uk-margin-auto-vertical">
                            <span role="button" class="mdi mdi-18px mdi-dots-vertical " ></span>
                            <div uk-dropdown="mode: click" class="uk-padding-remove ">
                                <button class="uk-width-1-1 uk-margin-auto dropdown-item mdi mdi-pencil-outline uk-button-default uk-button  " type="button"> Edit</button> 
                                <button class="uk-width-1-1 uk-margin-auto  dropdown-item mdi mdi-trash-can-outline uk-button-default uk-button" type="button"> Delete</button> 
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
                                    <img class=" uk-border-circle uk-width-3-4 " :src="post.user.picture" style="width: 39px; height:39px;" >
                                    
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
                                    v-bind:key="comment.id"
                                    v-bind:comment="comment" />

                        </ul>


                    </div>

                    <!-- comments -->


                    <!-- post Reacts -->
                    <div class=" uk-width-5-6 uk-flex uk-margin-small-top uk-margin-small-bottom uk-margin-auto-left uk-margin-auto-right " > 

                        <div v-on:click="like(post)" class=" pointer uk-width-1-4 uk-border-rounded uk-text-center uk-text-danger " style=" background:#ffeded;" >
                            <p class=" uk-margin-small-top uk-margin-small-bottom" >
                                <i class="mdi" :class="{  'mdi-heart':(isLiked(post)),'mdi-heart-outline':(!isLiked(post))} " ></i> 
                                <b class="uk-text-normal">{{ post.likes.length }}</b>    
                            </p>
                        </div>

                        <div class="pointer uk-width-1-4 uk-margin-auto uk-border-rounded uk-text-center uk-text-warning " style="background: #fff8ed;">
                            <p class="uk-margin-small-top  uk-margin-small-bottom " >
                                <i class=" mdi mdi-message-outline " ></i>
                                <b class="uk-text-normal">{{ post.comments.length}}</b>
                            </p>
                        </div>

                        <div class="pointer uk-width-1-4 uk-border-rounded uk-text-center uk-text-primary " style="background: #eaf2fd;">
                            <p class=" uk-margin-small-top  uk-margin-small-bottom " >
                                <i class=" mdi mdi-share-outline " ></i> 
                                <b class="uk-text-normal">{{ post.shares.length}} </b>
                            </p>
                        </div>

                    </div>
                    <!--  post Reacts -->

                    <add-comment  :post="post" />
                                     
                    
                </div>
                
            </div>
        

        </div>
    </div>
</template>
  
<!--  The popup post Modal -->

<script>
import AddComment from './AddComment'
import Comment from './Comment'
export default {
    components:{
        AddComment,
        Comment,
    },
    props:['post','user'],
    methods: {

        isLiked(post){

        },
        like(post){

        },
        delete(post){

        }
    },
}
</script>