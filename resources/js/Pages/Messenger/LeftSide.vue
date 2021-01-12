<template>

    <div class="uk-width-1-5 uk-border-rounded " style="background:#f4f4fb; ">
        <!-- section name -->
        <div class="uk-width-1-1 uk-text-bold uk-margin-small-top uk-flex">
            
            <!-- show chats section -->
            <div role="button"  @click="changeSection('chats')" v-bind:class="{  'profile-b':showChats,'bg-white':!showChats}" class="uk-width-1-3 uk-text-small pointer uk-text-center uk-text-capitalize uk-margin-auto-left  uk-border-rounded uk-padding-small "  >
                <i class="fa fa-message-bulleted mdi-24px "></i>
                <p class="uk-margin-remove" > chats </p>
                
            </div>
            <!-- show chats section -->

            <!-- show friends section -->
                <div role="button" @click="changeSection('pictures')" v-bind:class="{'profile-b':showFriends,'bg-white':!showFriends}" class="uk-width-1-3 pointer uk-text-center uk-text-small uk-text-capitalize uk-margin-small-left uk-border-rounded uk-margin-auto-right uk-padding-small">
                <i class="fa fa-users fa-lg" aria-hidden="true"></i>
                <p class="uk-margin-remove" >friends</p>
            </div>
            <!-- show friends section -->



        </div>
        <!-- section name -->

        <!-- search for firends -->
        <div  class=" uk-width-1-1  uk-padding-small " >
                <input v-model="input"  v-on:change="searchFriend" type="text" class=" uk-input uk-text-small uk-border-rounded uk-padding-small uk-margin-auto  uk-width-1-1 " style="background:#edf2f7" placeholder="Search for messages or friends.." name="" id="">
        </div>
        <!-- search for firends -->

        <!-- friends -->
        <div v-if="showFriends"  class=" uk-width-1-1 uk-padding-small uk-overflow-auto uk-height-large overflow-y-auto ">
            <div  
                v-for=" friend in friends" 
                :key="friend.id" 
                v-on:click="selectFriend(friend)" 
                class=" uk-margin-small-bottom uk-width-1-1 uk-border-rounded uk-padding-small uk-flex" 
                style=" background:white; cursor: pointer;" 
                >
                <div class=" uk-margin-auto-vertical" style="height:40px;width:40px;"> 
                    <img :src="friend.picture" class=" uk-width-1-1 uk-border-rounded " style="height:40px;width:40px;" alt="" srcset="">
                    <span  class=" fa fa-circle uk-padding-remove uk-position-relative uk-text-small uk-float-right" :class="{ 'uk-text-success':(friend.status=='online') }" style="top: -15px; font-size: small;" > </span>
                </div> 
                <div class=" uk-margin-small-left  uk-margin-auto-vertical " >
                    <p class=" uk-text-bold uk-padding-remove uk-margin-remove uk-text-capitalize ">{{ friend.firstname }} {{friend.lastname}} </p>
                    <p class=" uk-padding-remove uk-margin-remove uk-text-small uk-text-capitalize " > {{friend.status}} </p>
                </div>
            </div> 
        </div>
        <!-- friends -->

        <!-- Chats -->
        <div v-if="showChats"  class=" uk-width-1-1 uk-padding-small uk-overflow-auto uk-height-large overflow-y-auto ">
            <div  
                v-for=" conversation in conversations" 
                :key="conversation.id" 
                @click="selectConversation(conversation)"  
                class=" uk-margin-small-bottom uk-width-1-1 uk-border-rounded uk-padding-small uk-flex" 
                style=" background:white; cursor: pointer;" 
                >
                <div class="uk-margin-auto-vertical" style=" height:40px; width:40px; "  > 
                    <img 
                    :src="conversation.user.picture" 
                    class="uk-width-1-1 uk-border-rounded" 
                    style="width: 40px; height:40px;"
                    >
                    <span  
                    class="fa fa-circle uk-padding-remove uk-position-relative uk-text-small uk-float-right" v-bind:class="{'  uk-text-success':conversation.user.status}"  style="top: -15px; font-size: small;" > </span>
                </div> 
                <div class="uk-margin-small-left  uk-margin-auto-vertical " >
                    <p class=" uk-text-bold uk-padding-remove uk-margin-remove uk-text-capitalize ">
                    {{ conversation.user.firstname }} {{conversation.user.lastname}} 
                    </p>
                    <div class=" uk-flex" style="width: 146px;" >
                        <p class=" uk-padding-remove uk-margin-remove uk-text-small uk-text-capitalize uk-text-truncate " > 
                            {{conversation.last_message}} 
                        </p>
                        <i v-if="!conversation.readed" class=" fa fa-circle uk-text-small uk-text-primary uk-margin-small-left "></i>
                    </div>
                </div>
                
            </div>
        
        
        </div>
        <!-- Chats -->

    </div>
    
</template>
<script>
    export default {
        props:{
            conversations:Array,
            friends:Array,
            friend:Object,
            messages:Array,



        },    
        data() {
            return {
                showChats:true,
                showFriends:false,
                input:'',
             
                
                
            }
        },
        methods:{
            changeSection  (selectedSection) {
                switch (selectedSection) {
                    case 'chats':
                        
                        this.showChats = true
                        this.showFriends = false
                        break;
                
                    default:

                        this.showChats = false
                        this.showFriends = true
                        break;
                }

            }

            ,
            find(){

            }
            ,selectConversation(conversation){

                axios.get('http://127.0.0.1:8000/conversations/'+conversation.id)
                    .then( Response => { 
                        let myConversation = this.conversation;
                        let myFriend = this.friend;
                        
                        myConversation  = Response.data ;
                        myFriend  = conversation.user ;
                        console.log(this.friend);
                        this.$emit("update-conversation",myConversation);
                        this.$emit("update-friend",myFriend);

                        } )
                    .catch( Error => { console.log(Error)})



            }
            ,
            selectFriend(friend){
                     axios.get('http://127.0.0.1:8000/conversations/user/'+friend.id)
                    .then( Response => { 
                        let myConversation = this.conversation;

                        let myFriend = this.friend;

                        myConversation  = Response.data ;
                       
                        myFriend  = friend ;
                        console.log(this.friend);
                        this.$emit("update-conversation",myConversation);
                        this.$emit("update-friend",myFriend);

                        } )
                    .catch( Error => { console.log(Error)})
            },
            searchFriend(){
               console.log( this.friends.filter( f => { f.id == this.input || f.lastname == this.input }))
            }
        }
}
</script>