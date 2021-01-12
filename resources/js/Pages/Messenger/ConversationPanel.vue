<template>
   <main-panel :empty="isEmpty">

            <template #friendInfo >
                <!-- friends info -->
                <div class=" uk-width-1-1 uk-flex  uk-padding-small  " style=" border-bottom: #cccccc solid 1px; background:#f4f4fb; " >
                    
                    <!-- friend picture -->
                    <div  class="uk-margin-auto-vertical uk-margin-small-left uk-margin-small-right"> 
                        <inertia-link
                            class="black far fa-2x fa-arrow-left uk-width-1-1 uk-border-circle" 
                            href="http://127.0.0.1:8000/messenger"> 
                        </inertia-link>
                    </div>
                    <!-- friend picture -->

                    <!-- friend picture -->
                    <div  class="  uk-margin-auto-vertical uk-margin-small-left uk-margin-small-right " style="width: 40px;" > 
                        <img :src="'http://127.0.0.1:8000/'+$page.friend.picture" class="uk-width-1-1 uk-border-rounded" :alt="$page.friend.firstname+' '+ $page.friend.lastname" style="width: 40px; height:40px;" srcset="">
                    </div>
                    <!-- friend picture -->

                    <!-- friend full name -->
                    <div class=" uk-margin-auto-vertical  ">
                        <p class=" uk-h4 uk-text-bold uk-margin-remove uk-text-capitalize ">{{$page.friend.firstname}} {{$page.friend.lastname}}</p>
                    </div>
                    <!-- friend full name -->

                    <!-- friend status -->
                    <div class="uk-margin-auto-vertical uk-margin-auto-left uk-margin-small-right uk-flex" >
                        <p class=" uk-margin-remove uk-text-capitalize  "> 
                            <i class="fa uk-text-small fa-circle" :class="{'uk-text-success':( $page.friend.status == 'online' )}" ></i> 
                            {{$page.friend.status}}  
                        </p> 
                    </div>
                    <!-- friend status -->

                    <!-- options -->
                    <div class=" uk-margin-small " >
                        <i roll="button" class="fa fa-ellipsis-v fa-lg uk-text-bold" ></i>
                        <div class="uk-padding-remove" uk-dropdown>
                            <div class="uk-button button text-decoration-none uk-width-1-1">
                                <inertia-link 
                                    class="black button" 
                                    :href="'http://127.0.0.1:8000/profiles/'+$page.friend.id" 
                                    style="text-decoration:none;" 
                                    >
                                    <i class="fal fa-user" aria-hidden="true"></i>
                                    Go to profile
                                </inertia-link>
                            </div>
                            <div class="uk-button button black uk-width-1-1" @click="deleteAll">
                            <i class="fal fa-trash" aria-hidden="true"></i>
                            Delete All massages</div>
                        </div>
                    </div>
                    <!-- options -->

                </div>
                <!-- friends info -->
            </template>

        <!-- current conversation -->
        <div v-if="id = $page.id"  >


            <div  
                v-for = "message in messages" 
                :key="message.id"  
                class=" uk-width-1-1 uk-margin-medium-top" 
                >
            
                <!-- friend message -->
                <div v-if="message.user_id != $page.user.id" class="uk-margin-auto-right uk-width-3-4@m uk-width-5-6 uk-flex" >
                    <div class="uk-text-left friend-message uk-margin-remove uk-border-rounded uk-text-capitalize " > {{message.text}} </div>
                    <div class="uk-margin-auto-right uk-margin-small-left uk-width-5-6 uk-margin-auto-vertical" style="font-size: x-small;" >{{reformDate(message.created_at)}} <i v-on:click="deleteMessage(message)" class="far fa-ellipsis-h uk-margin-auto-vertical uk-margin-auto-right" > </i></div>
                </div>
                <!-- friend message -->

                <!-- your message -->
                <div v-else class="uk-margin-auto-left uk-width-3-4@m uk-width-5-6 uk-text-right uk-flex" >
                    <div class=" uk-width-5-6 uk-margin-auto-left uk-margin-small-right uk-margin-auto-vertical" style="font-size: x-small;" > 
                        <i class="far fa-ellipsis-h uk-margin-auto-vertical" type="button" > </i>
                        <div uk-dropdown="mode:click"> 
                            <button class=" uk-text-capitalize uk-button" v-on:click="deleteMessage(message)">delete </button>
                        </div>
                        
                        {{reformDate(message.updated_at)}}
                    </div>
                    <div class="uk-text-right my-message uk-margin-remove uk-border-rounded uk-text-capitalize">{{message.text}}</div>
                </div>
                <!-- your message -->
                
            </div>

            <div v-if="waiting" class="loading uk-margin-medium-top uk-width-1-5 uk-margin-auto" >
            <span> </span>
            <span> </span>
            <span> </span>
            <span> </span>
            </div>


        </div>
        <!-- current conversation -->


        <template #sendMessage>
            <send-message
                :messages="messages" 
                :id="id"
                @update-messages ="updateMessages"
            />
        </template>
   </main-panel>
</template>

<script>
    import MainPanel from './Main'
    import SendMessage from './SendMessage'
    import Dropdown from '@/Layouts/Header/Dropdown'


    export default {
        components:{
            MainPanel,
            SendMessage,
            Dropdown,
         
        },
        data() {
            return {
                messages:[],
                id:Number,
                waiting:true,
            }
        },
        computed: {
            isEmpty()
            {
                return this.messages.length > 0
                ? false
                : true
            }
        },
        methods: {
            getMessages(){
                axios.get('http://127.0.0.1:8000/conversations/'+ this.id)
                    .then( Response => { 
                        this.messages = _.orderBy(Response.data.messages, 'id','desc');
                        this.waiting = false;
                    } )
                    .catch( Error => { console.log(Error) })
            },
            reformDate(LaravelDate){

                var year = LaravelDate.slice(0,4),
                month = LaravelDate.slice(5,7),
                day = LaravelDate.slice(8,10),
                houre = LaravelDate.slice(11,13),
                minute = LaravelDate.slice(14,16);

                return year+"-"+month+"-"+day+" at "+houre+":"+minute;
            },
            updateMessages(){

            },
            deleteMessage(message){

                this.messages = this.messages.filter(n => (n != message) )


            },
            deleteAll(){
                if(confirm('ff'))
                this.messages=[];
                
            }
        },
        mounted() {
            this.getMessages();
        },
    }
</script>
<style >
.button:hover{
     color:#8931bf;
}
    
</style>