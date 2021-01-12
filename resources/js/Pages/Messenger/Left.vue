<template>
    <div class="uk-width-1-5 uk-border-rounded " style="background:#f4f4fb; ">
        <!-- section name -->
        <div class="uk-width-1-1 uk-text-bold uk-margin-small-top uk-flex">
            
            <!-- show chats section -->
            <div role="button"  @click="changeSection('chats')" v-bind:class="{  'profile-b':showChats,'bg-white':!showChats}" class="uk-width-1-3 uk-text-small pointer uk-text-center uk-text-capitalize uk-margin-auto-left  uk-border-rounded uk-padding-small "  >
                <i class="fas fa-comment-alt fa-lg"></i>
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
                <input 
                    type="text" 
                    class=" uk-input uk-text-small uk-border-rounded uk-padding-small uk-margin-auto  uk-width-1-1 " 
                    style="background:#edf2f7" 
                    placeholder="Search for messages or friends.."
                />
        </div>
        <!-- search for firends -->

        <!-- Chats -->
        <div v-if="showChats" class=" uk-width-1-1 uk-padding-small uk-overflow-auto uk-height-large overflow-y-auto ">
            <inertia-link 
                :href="'http://127.0.0.1:8000/messenger/c/'+conversation.id" 
                v-for=" conversation in conversations" 
                :key="conversation.id" 
                class="dropdown-item uk-margin-small-bottom uk-width-1-1 uk-border-rounded uk-padding-small uk-flex" 
                style="color:black; text-decoration:none; cursor: pointer;" 
                >
                <div class="uk-margin-auto-vertical" style=" height:40px; width:40px; "  > 
                    <img 
                        :src="'http://127.0.0.1:8000/'+conversation.user.picture" 
                        class="uk-width-1-1 uk-border-rounded" 
                        style="width: 40px; height:40px;"
                    >
                    <span  
                    class="mdi mdi-circle uk-padding-remove uk-position-relative uk-text-small uk-float-right" v-bind:class="{'  uk-text-success':conversation.user.status}"  style="top: -15px; font-size: small;" > </span>
                </div> 
                <div class="uk-margin-small-left  uk-margin-auto-vertical " >
                    <p class=" uk-text-bold uk-padding-remove uk-margin-remove uk-text-capitalize ">
                    {{ conversation.user.firstname }} {{conversation.user.lastname}} 
                    </p>
                    <div class="uk-flex" style="width: 146px;" >
                        <p class=" uk-padding-remove uk-margin-remove uk-text-small uk-text-capitalize uk-text-truncate " > 
                            {{conversation.last_message}} 
                        </p>
                        <i v-if="!conversation.readed" class=" mdi mdi-circle uk-text-small uk-text-primary uk-margin-small-left "></i>
                    </div>
                </div>
                
            </inertia-link>

            <div v-if="! conversations.length " class="uk-width-1-1 uk-margin-bottom">
                <p class="uk-h3 uk-text-center uk-margin-top uk-text-bold uk-text-capitalize" style="color:#9E9E9E;"> You Don't Have any conversations.</p>
                <p class="mdi mdi-48px uk-margin-remove uk-text-center mdi-message-bulleted-off uk-h3 " style="color:#9E9E9E;"></p>
            </div>
        
        </div>
        <!-- Chats -->


        <!-- friends -->
        <div v-if="showFriends"  class=" uk-width-1-1 uk-padding-small uk-overflow-auto uk-height-large overflow-y-auto ">
            <inertia-link  
                v-for=" friend in friends" 
                :key="friend.id" 
                :href="'http://127.0.0.1:8000/messenger/'+friend.id+'/new'"
                class="dropdown-item uk-margin-small-bottom uk-width-1-1 uk-border-rounded uk-padding-small uk-flex" 
                style="color:black; text-decoration:none; cursor: pointer;"
                >
                <div class=" uk-margin-auto-vertical" style="height:40px;width:40px;"> 
                    <img :src="'http://127.0.0.1:8000/'+friend.picture" class=" uk-width-1-1 uk-border-rounded " style="height:40px;width:40px;" alt="" srcset="">
                    <span  class=" mdi mdi-circle uk-padding-remove uk-position-relative uk-text-small uk-float-right" :class="{ 'uk-text-success':(friend.status=='online') }" style="top: -15px; font-size: small;" > </span>
                </div> 
                <div class=" uk-margin-small-left  uk-margin-auto-vertical " >
                    <p class=" uk-text-bold uk-padding-remove uk-margin-remove uk-text-capitalize ">{{ friend.firstname }} {{friend.lastname}} </p>
                    <p class=" uk-padding-remove uk-margin-remove uk-text-small uk-text-capitalize " > {{friend.status}} </p>
                </div>
            </inertia-link> 
        </div>
        <!-- friends -->

    </div>
        
</template>

<script>
export default {
    data() {
        return {
            conversations:Array,
            showChats:true,
            showFriends:false,
            friends:Array,
        }
    },
    methods: {
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
        // fun to get conversations for the user @returns array.
        getConversations(){
            axios.get('http://127.0.0.1:8000/conversations')
                    .then( Response => { this.conversations = _.orderBy(Response.data, 'id','desc') } )
                    .catch( Error => { console.log(Error) })
        },

        // fun to get the friends for the user @returns array.
        getFriends(){
            axios.get('http://127.0.0.1:8000/friends')
                    .then( Response => { this.friends = _.orderBy(Response.data, 'id','desc') } )
                    .catch( Error => { console.log(Error) })
        },

        //set an event for the parent @ selecting conversation 
        selectConversation(){
            this.$emit('select-conversation');
        }
    },
    mounted() {
        this.getConversations();
        this.getFriends();
        
    },
}
</script>