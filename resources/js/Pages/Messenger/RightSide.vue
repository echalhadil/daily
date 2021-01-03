<template>

    <div class=" uk-width-4-5 ">
        
        <!-- friends info -->
           <div v-if="friend!=null" class=" uk-width-1-1 uk-flex  uk-padding-small  " style=" border-bottom: #cccccc solid 1px; background:#f4f4fb; " >
                
                <!-- friend picture -->
                <div  class="  uk-margin-auto-vertical uk-margin-small-left uk-margin-small-right " style="width: 40px;" > 
                    <img :src="friend.picture" class=" uk-width-1-1 uk-border-circle" :alt="friend.firstname+' '+ friend.lastname" style="width: 40px; height:40px;" srcset="">
                </div>
                <!-- friend picture -->

                <!-- friend full name -->
                <div class=" uk-margin-auto-vertical  ">
                    <p class=" uk-h4 uk-text-bold uk-margin-remove uk-text-capitalize ">{{friend.firstname}} {{friend.lastname}}</p>
                </div>
                <!-- friend full name -->

                <!-- friend status -->
                <div class="uk-margin-auto-vertical uk-margin-auto-left uk-margin-small-right uk-flex" >
                    <p class=" uk-margin-remove uk-text-capitalize  "> 
                        <i class="mdi uk-text-small mdi-circle" :class="{'uk-text-success':( friend.status == 'online' )}" ></i> 
                        {{friend.status}}  
                    </p> 
                </div>
                <!-- friend status -->

                <!-- options -->
                <div class=" uk-margin-small " >
                    <i roll="button" class="mdi mdi-dots-vertical mdi-24px uk-text-bold" ></i>
                    <div class="uk-padding-remove" uk-dropdown="mode:click">
                        <button class="uk-button text-decoration-none uk-width-1-1">
                            <inertia-link 
                                class="black" 
                                :href="'http://127.0.0.1:8000/profiles/'+friend.id" 
                                style="text-decoration:none;" 
                                >
                                Go to profile
                            </inertia-link>
                        </button>
                        <button class="uk-button black uk-width-1-1">Delete All massages</button>
                    </div>
                </div>
                <!-- options -->

            </div>
     
        <!-- friends info -->

        <!-- current conversation -->
        <div  class=" uk-width-1-1 uk-height-large uk-padding uk-padding-remove-top uk-overflow-auto  " >


            <div v-for = "message in messages" :key="message.id"  class=" uk-width-1-1 uk-margin-medium-top" >
               
                <!-- friend message -->
                <div v-if="message.user_id != user.id" class=" uk-margin-auto-right uk-width-3-4@m uk-width-5-6  uk-flex  " >
                    <div class="  uk-text-left uk-padding-small uk-margin-remove uk-border-rounded uk-text-capitalize " style="color: black; background:#c2c2c2; "> {{message.text}} </div>
                    <div class="uk-margin-auto-right uk-margin-small-left uk-width-5-6 uk-margin-auto-vertical" style="font-size: x-small;" >{{reformDate(message.created_at)}} <i v-on:click="deleteMessage(message)" class="mdi mdi-dots-horizontal uk-margin-auto-vertical uk-margin-auto-right" > </i></div>
                </div>
                <!-- friend message -->

                <!-- your message -->
                <div v-else class="uk-margin-auto-left uk-width-3-4@m uk-width-5-6 uk-text-right uk-flex" >
                    <div class=" uk-width-5-6 uk-margin-auto-left uk-margin-small-right uk-margin-auto-vertical " style="font-size: x-small;" > 
                        <i class="mdi mdi-dots-horizontal uk-margin-auto-vertical" type="button" > </i>
                        <div uk-dropdown> 
                            <button class=" uk-text-capitalize uk-button" v-on:click="deleteMessage(message)">delete </button>
                        </div>
                        {{reformDate(message.created_at)}}
                     </div>
                    <div class="uk-text-right uk-padding-small uk-margin-remove uk-border-rounded uk-text-capitalize" style="color: white; background: rgb(0, 102, 255); ">{{message.text}}</div>
                </div>
                <!-- your message -->
            </div>

            <!-- Empty conversation -->
            <div v-if="messages == null || messages.length == 0" class="uk-width-1-1 uk-margin-xlarge-top  " >
                <p class=" uk-h1 uk-text-center uk-text-bold " > Start your conversation </p>
                <p class="mdi mdi-message-plus uk-text-center uk-h1  " ></p>
            </div>
            <!-- Empty conversation -->


        </div>
        <!-- current conversation -->

                
        <send-message
            :conversation="conversation" 
            v-if=" friend != null"
            @update-messages ="updateMessages"
        />
        
    </div>

    
</template>

<script>
    import SendMessage from './SendMessage'
    

    export default {
        props:{
            messages:null,
            conversation:Object,
            user:Object,
            friend:Object,

        },
        components:{
            SendMessage,
        },
        methods: {
            
            reformDate(LaravelDate){

                var year = LaravelDate.slice(0,4),
                month = LaravelDate.slice(5,7),
                day = LaravelDate.slice(8,10),
                houre = LaravelDate.slice(11,13),
                minute = LaravelDate.slice(14,16);

                return year+"-"+month+"-"+day+" at "+houre+":"+minute;
            },
            updateMessages(conversation){
                            
                                        
            },

            deleteMessage(message){

                this.$emit("delete-message",message);      


            }
           
        },

        
    }
</script>