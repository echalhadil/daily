<template>
    <!-- conversations -->
    <div class="uk-margin-auto uk-padding-remove">
        <button  class="uk-inline uk-margin-auto uk-margin-auto-vertical uk-padding-remove uk-text-bold uk-button uk-button-text"> 
            <i :class="classes"> </i> 
            <span  class=" uk-border-circle  uk-position-top-right uk-label-danger " style="right: -5px; width: 1rem; height: 1rem; font-size: x-small;" > {{ conversations.length }} </span>

        </button>

        <!-- Dropdown Messages -->
        <div class="uk-padding-remove uk-width-1-5" uk-dropdown="mode: click">

            <div class=" uk-width-1-1 uk-padding-small uk-overflow-auto uk-margin-remove" style=" height:21rem; ">

                <div class=" uk-flex uk-text-bold d-flex font-weight-bold my-2">
                    <p class=" uk-margin-auto-right ">Messages</p>
                    <a class="uk-margin-auto-left uk-text-small uk-text-center uk-text-capitalize " href="http://127.0.0.1:8000/messenger" style="color: #4A7FF3; ">new</a>
                </div>

                <div class=" uk-margin-small-top">

                    <div v-if=" conversations " v-for="conversation in conversations" v-bind:key="conversation.id" class=" uk-width-1-1 uk-flex uk-margin-bottom ">
                        <img class=" uk-margin-auto uk-margin-auto-vertical uk-border-rounded" :src="'http://127.0.0.1:8000/'+conversation.user.picture" alt="" style="width: 2.5rem; height: 2.5rem;">
                        <div class="uk-margin-small-left uk-margin-small uk-margin-auto-vertical">
                            
                            <div class=" uk-width-1-1 ">
                                <div class=" uk-flex">
                                <a :href="'http://127.0.0.1:8000/profiles/'+conversation.user.id" style="text-decoration:none;">
                                    <p class="uk-margin-remove uk-margin-auto-left uk-padding-remove  uk-text-bold  uk-text-capitalize ">  {{ conversation.user.firstname }} {{ conversation.user.lastname }} </p>
                                </a>
                                <small class=" uk-margin-auto-vertical uk-margin-auto-left uk-text-right" style="font-size: x-small;"> {{reformDate(conversation.updated_at) }} </small>

                                </div>
                                <div class="uk-flex">
                                    <p class="uk-text-truncate uk-text-small uk-padding-remove uk-margin-remove " style="width:180px;">
                                        {{ conversation.last_message }}
                                    
                                    </p>
                                    <i v-if=" ! conversation.readed" class="mdi uk-text-right uk-text-small mdi-circle" style="color: #4A7FF3;" aria-hidden="true"></i> 

                                </div>
                               

                            </div>

                        </div>    
                    </div>

                    <div v-if=" ! conversations " class="uk-width-1-1 uk-margin-bottom">
                        <p class="uk-h3 uk-text-center uk-margin-top uk-text-bold" style="color:#9E9E9E;"> You Don't Have any Messages.</p>
                        <p class="mdi mdi-48px uk-text-center mdi-message-bulleted-off uk-h3 " style="color:#9E9E9E;"></p>
                    </div>
                    


                </div>

            </div>

        </div>
        <!-- Dropdown Messages -->


        
    </div>
    <!-- conversations -->
</template>

<script>
export default {
    props:{
        conversations:Array,
        active:Boolean,
    },
    
    computed: {
        classes(){
            return this.active
                ? 'mdi mdi-message-outline text-dark mdi-24px daily-primary-color'
                : 'mdi mdi-message-outline text-dark mdi-24px black'
        },
    },
    methods: {
        hasConversation(){
            return (this.conversations == [])? true : false;
        },
        reformDate(LaravelDate){
    
            var year = LaravelDate.slice(0,4),
            month = LaravelDate.slice(5,7),
            day = LaravelDate.slice(8,10),
            houre = LaravelDate.slice(11,13),
            minute = LaravelDate.slice(14,16);
        

            return year+"-"+month+"-"+day+" at "+houre+":"+minute;
            
        },
    },
}
</script>