<template>
    <ap-layout>
        <div class="uk-margin-medium-left uk-margin-medium-right uk-margin-top uk-flex" >
            <left-side 
                :conversations="sorting($page.conversations)" 
                :friends="$page.friends" 
                @update-friend="updatefriend"
                @update-conversation="updatemessages"

                

            /> 

            <right-side 
                :user="$page.user" 
                :messages="messages"
                :conversation="conversation"
                :friend="friend" 
                @update-conversation="updatemessages"
                @delete-message="deleteMessage"



            />
            
        </div>
    </ap-layout>
</template>

<script>

    import ApLayout from '@/Layouts/ApLayout'
    import LeftSide from './LeftSide'
    import RightSide from './RightSide'



    

    export default {
       
        components: {
            ApLayout,
            LeftSide,
            RightSide,
         
        },
        data() {
            return {
                messages:null,
                friend:null,
                conversation :null,
            }

        },
        computed: {
            
        },
        methods: {
            sorting(data){
                return _.orderBy(data, 'id','desc');
            },
            updatefriend(friend){
                this.friend = friend;
            },
            updatemessages(conversation){
                this.messages = conversation.messages;
                this.conversation = conversation;
                
             
            },

            deleteMessage(message){
         
            
            },


        },
        filters:{
            filterDeletedMessage(message){

            }
        }

    }
</script>
