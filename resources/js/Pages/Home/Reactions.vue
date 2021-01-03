<template>
    <div :class="classes" >
        <!-- likes -->
        <div v-on:click="like" class=" pointer uk-width-1-4 uk-border-rounded uk-text-center uk-text-danger " style=" background:#ffeded;" >
            <p class=" uk-margin-small-top uk-margin-small-bottom" >
                <i :class="heartReact" ></i> 
                <b class="uk-text-normal">{{ hasLikes }}</b>    
            </p>
        </div>
        <!-- comments -->
        <div class="pointer uk-width-1-4 uk-margin-auto uk-border-rounded uk-text-center uk-text-warning " style="background: #fff8ed;">
            <p class="uk-margin-small-top  uk-margin-small-bottom " >
                <i class=" mdi mdi-message-outline " ></i>
                <b class="uk-text-normal">{{ hasComments }}</b>
            </p>
        </div>
        <!-- shares -->
        <div class="pointer uk-width-1-4 uk-border-rounded uk-text-center uk-text-primary " style="background: #eaf2fd;">
            <p class=" uk-margin-small-top  uk-margin-small-bottom " >
                <i class=" mdi mdi-share-outline " ></i> 
                <b class="uk-text-normal">{{ hasShares }}</b>
            </p>
        </div>

    </div>
</template>

<script>
export default {
    props:{
        inModel:Boolean,
        likesNumber:Number,
        commentsNumber:Number,
        sharesNumber:Number,
        isLiked:Boolean,

    },

    computed: {
        classes(){
            return this.inModel
            ? 'uk-width-5-6 uk-flex uk-margin-small-top uk-margin-small-bottom uk-margin-auto-left uk-margin-auto-right'
            : 'uk-width-1-1 uk-flex uk-margin-small-top'
        },
        hasLikes(){
            return this.likesNumber > 0
            ? ''+this.likesNumber
            : ''
        },
        hasComments(){
            return this.commentsNumber > 0
            ? this.commentsNumber
            : ''
        },
        hasShares(){
            return this.sharesNumber > 0
            ? this.sharesNumber
            : ''
        },
        heartReact(){
            return this.isLiked 
            ? 'mdi mdi-heart'
            : 'mdi mdi-heart-outline'


        },

        
    },
    methods: {
        like(){
            this.$emit('like');             

        },
    },
}
</script>