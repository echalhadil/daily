<template>
    <!-- post owner -->
    <div :class="ownerClasses" >
        <!-- pic -->
        <div class="uk-margin-small-right " >
            <img class="uk-border-rounded object-fit-cover " :src="picture" style="height: 50px; width: 50px;">
        </div>
        <!-- pic -->

        <!-- username -->
        <div class="uk-margin-auto-vertical" >
            <p class="uk-margin-remove uk-text-capitalize uk-text-bold" > 
                {{firstname}} {{lastname}} 
            </p>
            <span class="uk-text-small" >{{date}}</span>
        </div>
        <!-- username -->
        
        <!-- options -->
        <options 
            :isPostOwner="id == $page.user.id" 
            @delete-post="deletePost" 
            :postId="id"
            :postText="text"
            @edit-post="editPost"

        />
        <!-- options -->
    </div>
    <!-- post owner -->
</template>

<script>
    import Options from './Options'
    
export default {
    components:{
        Options,
    },
    props:{
        firstname:String,
        lastname:String,
        picture:String,
        date:String,
        text:String,
        id:Number,
        isModal:Boolean,
    },
    computed: {
        ownerClasses(){
            return this.isModal
                ? 'uk-box-shadow-small uk-width-1-1 uk-flex uk-padding-small border-buttom'
                : 'uk-width-1-1 uk-flex'
        }
    },
    methods: {
        deletePost(){
            this.$emit("delete-post");
        },
        editPost(text){
        this.$emit("edit-post",text);
        }
    },
}
</script>
