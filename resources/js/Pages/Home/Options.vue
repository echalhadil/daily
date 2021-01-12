


<template>
    <div class="uk-margin-auto-left uk-margin-auto-vertical">
        <span 
            @click="isVisible =! isVisible" 
            :class="buttonClasses" 
            :aria-expanded="isVisible" >
        </span>
        <div :class="dropdownClasses">

            <!--edit -->
            <div 
                @click="isVisible =! isVisible" 
                v-if="isPostOwner" 
                v-on:click="editPost"
                class="uk-text-capitalize button-top uk-width-1-1 uk-margin-auto dropdown-item  button "
                 
              
            > 
                <i class="fal fa-pencil" style="padding-right:3px;" aria-hidden="true"></i>
            Edit</div> 
          
            

            <!--delete -->
            <div 
                @click="isVisible =! isVisible" 
                v-if="isPostOwner" 
                v-on:click="deletePost" 
                class="uk-width-1-1 uk-text-capitalize uk-margin-auto dropdown-item button" 
                type="button"
            > 
            <i class="fal fa-trash" style="padding-right:3px;" aria-hidden="true"></i>
            Delete
            </div> 

            <!--repport -->
            <div 
               
                @click="isVisible =! isVisible" 
                class="uk-width-1-1 button-bottom uk-text-capitalize uk-margin-auto dropdown-item button " 
                
            > 
                <i class="fal fa-user" style="padding-right:3px;" aria-hidden="true"></i>
                view Profile
            </div> 
            

        </div>
    </div>
</template>


<script>
export default {
    props:{
        isPostOwner:Boolean,
        postId:Number,
        postText:String,
    },
    data() {
        return {
            isVisible:false,
            text:'',
        }
        
    },
    computed: {
        fetch(){
            return this.postText;
        }
    },
    methods: {
        deletePost(){
            this.$emit("delete-post");
        },
        editPost(){
            this.$emit("edit-post")
        },  
        
    },
    computed: {
        buttonClasses(){
            return this.isVisble
                ? ' fas fa-ellipsis-v button  uk-open'
                : 'fas fa-ellipsis-v button'
        },
        dropdownClasses(){
            return this.isVisible
                ? 'uk-padding-remove uk-padding button uk-dropdown uk-dropdown-bottom-left uk-text-capitalize uk-open'
                : 'uk-padding-remove uk-padding button uk-dropdown uk-dropdown-bottom-left uk-text-capitalize '

        },
    },
}
</script>

<style >

.button{
    padding: 0.5rem 1rem;
    cursor:pointer;
}
.button:hover{
    color:#8931bf;

}
.button-bottom{
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
}

.button-top{
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
}
    
</style>