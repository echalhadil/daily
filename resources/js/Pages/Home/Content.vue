
<template>
    <div :class="contentClasses" >
        <p  v-if="! isModal" 
            class=" uk-margin-remove uk-padding-remove-left uk-padding-small uk-text-capitalize " >
            {{text}}
        </p>
        <img v-if="!isModal" 
            :uk-toggle="'target: #p'+id" 
            :class="contentPictureClasses" 
            :src="picture" 
        >
        <img v-if="isModal" 
            :class="contentPictureClasses" 
            :src="picture" 
        >
    </div>
</template>

<script>
    export default {
        props:{
            picture:String,
            id:Number,
            text:String,
            isModal:Boolean
        },
        computed: {
            contentClasses(){
                return this.isModal
                    ? 'uk-width-3-5 uk-margin-auto-vertical uk-flex uk-margin-auto'
                    : 'uk-width-1-1'
            },
            contentPictureClasses(){
                return this.isModal
                    ? 'uk-margin-auto uk-box-shadow-small modal-picture'
                    : 'uk-border-rounded uk-width-1-1 '
            },
        },
    }
</script>