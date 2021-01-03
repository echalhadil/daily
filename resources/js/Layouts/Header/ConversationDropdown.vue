<template>
    <dropdown 
    :icon="'mdi-message-outline'" 
    :heigth="'21rem'"
    :width="'uk-width-1-4'"
    :isIcon="true"
    :active="route().current('messenger.index')" >
        <template #number>
            <span 
                v-if="unreded >0" 
                class=" uk-border-circle  uk-position-top-right uk-label-danger " 
                style="right: -5px; width: 1rem; height: 1rem;font-size: x-small;" 
            >
            {{ unreded }}
            </span>         
        </template>
    
        <div class=" uk-flex uk-text-bold d-flex font-weight-bold my-2">
            <p class=" uk-margin-auto-right ">Messages</p>
            <inertia-link class="uk-margin-auto-left uk-text-small uk-text-center uk-text-capitalize " href="http://127.0.0.1:8000/messenger" style="color: #4A7FF3; ">new</inertia-link>
        </div>

        <div class=" uk-margin-small-top">

            <inertia-link 
                v-if=" conversations " 
                v-for="conversation in conversations" 
                :key="conversation.id" 
                class="black uk-border-rounded uk-width-1-1 uk-flex dropdown-item"
                style="text-decoration:none;"
                :href="'http://127.0.0.1:8000/messenger/c/'+conversation.id"
            >

                <inertia-link class="uk-margin-auto-vertical" style="width: 2.5rem; height: 2.5rem;" :href="'http://127.0.0.1:8000/profiles/'+conversation.user.id">
                    <img 
                        class="uk-margin-auto-vertical uk-border-rounded" 
                        :src="'http://127.0.0.1:8000/'+conversation.user.picture" 
                        style="width: 2.5rem; height: 2.5rem;"
                    
                    >
                </inertia-link>
                <div class="dropdown-text uk-margin-small-left uk-margin-small uk-margin-auto-vertical">
                    <div class=" uk-width-1-1 ">
                        <div class=" uk-flex">
                            <inertia-link :href="'http://127.0.0.1:8000/profiles/'+conversation.user.id" style="text-decoration:none;">
                                <p class="uk-margin-remove uk-margin-auto-left uk-padding-remove  uk-text-bold black uk-text-capitalize"> 
                                    {{ conversation.user.firstname }} {{ conversation.user.lastname }} 
                                </p>
                            </inertia-link>

                            <small class=" uk-margin-auto-vertical uk-margin-auto-left uk-text-right" style="font-size: x-small;"> 
                                {{reformDate(conversation.updated_at) }} 
                            </small>
                        </div>
                        <div class="uk-width-1-1 uk-flex">
                            <p class="uk-text-truncate uk-text-small uk-padding-remove uk-margin-remove " style="width:180px;">
                                {{ conversation.last_message }}
                            </p>
                            <i v-if=" ! conversation.readed" class="mdi uk-margin-auto-left uk-text-right uk-text-small mdi-circle" style="color: #4A7FF3;" aria-hidden="true"></i> 

                        </div>
                        

                    </div>

                </div>    
            </inertia-link>

            <div v-if="! conversations.length " class="uk-width-1-1 uk-margin-bottom">
                <p class="uk-h3 uk-text-center uk-margin-top uk-text-bold" style="color:#9E9E9E;"> You Don't Have any Messages.</p>
                <p class="mdi mdi-48px uk-text-center mdi-message-bulleted-off uk-h3 " style="color:#9E9E9E;"></p>
            </div>
          
            


        </div>

    </dropdown>
</template>

<script>
    import Dropdown from './Dropdown'
export default {
    components:{
        Dropdown,
    },
      props:{
        conversations:Array,
        active:Boolean,
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
    computed: {
        unreded(){
            return this.conversations.filter(c => (! c.readed)).length ;
        },
    },
}
</script>