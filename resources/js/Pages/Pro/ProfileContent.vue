<template>
    <div  class="uk-margin-auto-left uk-margin-auto-right  uk-margin-medium-bottom uk-border-rounded" >

        <div class="uk-width-2-3 uk-width-1-3@m uk-margin-top uk-margin-bottom black uk-flex uk-margin-auto">

            <div role="button"  @click="showing('timeline')" v-bind:class="{'uk-background-primary text-white':showtimeline}" class="uk-background-default uk-width-1-3 uk-margin-small-left uk-margin-small-right uk-margin-small-top uk-border-rounded uk-margin-small-bottom uk-padding-small uk-box-shadow-large"  >
                <p  class=" uk-text-center text-center"> <i class="mdi mdi-36px mdi-timeline-outline"></i></p>
                <p class="uk-text-center uk-margin-small text-center">Timeline</p>
            </div>
            

            <div role="button" @click="showing('pictures')" v-bind:class="{'uk-background-primary text-white':showpictures}" class="uk-background-default uk-width-1-3 uk-margin-small-left uk-margin-small-top uk-margin-small-bottom uk-border-rounded uk-margin-small-right uk-padding-small uk-box-shadow-large">
                <p  class="uk-text-center text-center rounded-lg "><i class="mdi mdi-36px mdi-camera-outline"></i></p>
                <p class="uk-text-center uk-margin-small text-center">Pictures</p>
            </div>

            <div role="button" @click="showing('friends')" class="uk-background-default uk-width-1-3 uk-margin-small-left uk-margin-small-top uk-margin-small-bottom uk-border-rounded uk-margin-small-right uk-padding-small uk-box-shadow-large" v-bind:class="{'uk-background-primary text-white':showfriends}"  >
                <p  class="uk-text-center text-center"><i class="mdi mdi-36px mdi-account-outline"></i></p>
                <p class="uk-text-center uk-margin-small text-center">Friends</p>
            </div>
            
        </div>

        <!-- Timeline -->
        <div  class="uk-width-3-5 uk-child-width-1-3  uk-margin-auto uk-margin-top uk-margin-bottom " v-bind:class="{ 'uk-hidden ':!showtimeline }">
            
            <profile-post 
                v-if="posts.length > 0"
                v-for="post in posts" 
                :post="post" 
                :key="post.id" 
            />

            <div v-if="posts.length === 0"  class="uk-margin-auto uk-margin-auto-vertical uk-padding-small uk-width-1-1  uk-border-rounded ">

                <div class=" uk-width-1-1 uk-padding-remove uk-margin-large-top uk-border-rounded uk-text-center"  >
                    
                    <p class="uk-h1 uk-text-capitalize" >no posts </p>
                    <i class="mdi mdi-48px mdi-camera" ></i>
                </div>

            </div>

        </div>
        <!-- Timeline -->


        <!-- Friends -->
        <div  class="uk-width-3-4 uk-margin-auto" :class="{ 'uk-hidden':! showfriends }">
        
            <profile-friends 
                v-if="friends.length > 0" 
                v-for="friend in friends"
                :key="friend.id"
                :friend="friend" 
                @unfriend = "unfriend"
            />

            <div v-if="friends.length == 0" class="uk-margin-auto uk-margin-auto-vertical uk-padding-small uk-width-1-1  uk-border-rounded ">

                <div class=" uk-width-1-1 uk-padding-remove uk-margin-large-top uk-border-rounded uk-text-center"  >
                    
                    <p class=" uk-h1 uk-text-capitalize " >no friends </p>
                    <i class=" mdi mdi-48px mdi-account " ></i>
                </div>

            </div>
            
        </div>
        <!-- Friends -->

        <!-- pictures -->

        <!-- pictures -->

    </div>
</template>

<script>

    import ProfilePost from './ProfilePost'
    import ProfileFriends from './ProfileFriends'

    export default {
        props:['posts','friends'],
        components:{
            ProfileFriends,
            ProfilePost,
        },
        data() {
            return {
                showtimeline :true,
                showpictures :false,
                showfriends :false,

            }
        },
        methods: {
            showing (div){
                if(div =='timeline')
                {
                    this.showtimeline = true; this.showpictures = false; this.showfriends =false;
                }
                if(div=='friends')
                {
                    this.showtimeline = false; this.showpictures = false; this.showfriends = true;
                }
                if(div=='pictures')
                {
                    this.showtimeline = false; this.showpictures = true; this.showfriends = false;
                }
            },

            unfriend(friend){
                this.friends = this.friends.filter(f => f =! friend)
            },

        },
        mounted() {

        },
        
    }
</script>