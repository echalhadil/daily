


<template>
    <div class="uk-margin-auto-left uk-margin-auto-vertical">
        <span 
            @click="isVisible =! isVisible" 
            :class="buttonClasses" 
            :aria-expanded="isVisible" >
        </span>
        <div :class="dropdownClasses">

            <!--edit -->
            <button 
                @click="isVisible =! isVisible" 
                v-if="isPostOwner" 
                :uk-toggle="'target: #pe'+postId" 
                class="uk-width-1-1 uk-margin-auto dropdown-item mdi mdi-pencil-outline uk-button-default uk-button" 
                type="button"
            > Edit</button> 
          
            <div v-if="isPostOwner" :id="'pe'+postId" class="uk-margin-auto-vertical" uk-modal>
                
                <div class="uk-modal-dialog uk-modal-body">
                    <h2 class="uk-modal-title">edit post</h2>
                    <div class=" uk-width-1-1 uk-form-blank ">
                      <input class="uk-input" type="text" v-model="text">
                    </div>
                    <button @click="editPost" class="uk-modal-close" type="button">save</button>
                </div>

            </div>

            <!--delete -->
            <button 
                @click="isVisible =! isVisible" 
                v-if="isPostOwner" 
                v-on:click="deletePost" 
                class="uk-width-1-1 uk-margin-auto dropdown-item mdi mdi-trash-can-outline uk-button-default uk-button" 
                type="button"
            > 
            Delete
            </button> 

            <!--repport -->
            <button 
                v-if="! isPostOwner" 
                :uk-toggle="'target: #ps'+postId" 
                @click="isVisible =! isVisible" 
                class="uk-width-1-1 uk-margin-auto dropdown-item mdi mdi-information-outline uk-button-default uk-button" 
                type="button"
            > 
                Repport
            </button> 
            <div v-if="isPostOwner" :id="'ps'+postId" class="uk-margin-auto-vertical" uk-modal>     
                <div class="uk-modal-dialog uk-modal-body">
                    <h2 class="uk-modal-title">edit post</h2>
                    <button class="uk-modal-close" type="button">save</button>
                </div>
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
            this.$emit("edit-post",this.text)
        },  
        
    },
    computed: {
        buttonClasses(){
            return this.isVisble
                ? 'mdi mdi-18px mdi-dots-vertical uk-open'
                : 'mdi mdi-18px mdi-dots-vertical '
        },
        dropdownClasses(){
            return this.isVisible
                ? 'uk-padding-remove uk-width-1-6 uk-dropdown uk-dropdown-bottom-left uk-open'
                : 'uk-padding-remove uk-width-1-6 uk-dropdown uk-dropdown-bottom-left'

        },
    },
}
</script>