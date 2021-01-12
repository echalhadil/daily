<template>
    <div class="uk-background-default uk-width-1-1 uk-border-rounded uk-margin-small-top border uk-box-shadow-small">
        <div class=" uk-flex uk-text-bold uk-padding-small ">
            
            <p class="mx-auto uk-margin-auto-right ">Messages</p>
            <a class="mx-auto uk-margin-auto-left uk-text-small text-sm-center" href="" style="color: #4A7FF3; ">View All</a>
        </div>

        <div class="">
           

            <div v-for="conversation in conversations" :key="conversation.id"  class=" uk-width-1-1 uk-flex  uk-margin ">

                <img class="uk-margin-left uk-margin-right uk-border-circle " :src="conversation.user.picture" alt="" style="width: 2.5rem; height: 2.5rem;">
                <div class=" uk-margin-auto-vertical ">
                    <p class=' uk-margin-remove uk-text-bold '> 
                        {{ conversation.user.firstname }} {{ conversation.user.lastname }}
                    </p>
                    
                    <p class='uk-margin-remove uk-text-small' style="font-size: x-small;">
                        {{ reformDate(conversation.updated_at) }}
                    </p>
                </div>
                <i v-if=" ! conversation.readed" class="mdi mdi-circle uk-text-small uk-margin-auto-left uk-margin-auto-vertical uk-margin-right " style="color: #4A7FF3;" aria-hidden="true"></i> 


            </div>

            <div v-if=" conversations.length == 0 "  class="uk-width-1-1 uk-margin-bottom">
                <p class="uk-h4 uk-text-center uk-margin-top uk-text-bold" style="color:#9E9E9E;"> You Don't Have any Messages.</p>
                <p class="mdi mdi-48px uk-text-center mdi-message-bulleted-off uk-h4 uk-padding-remove-top uk-padding-small " style="color:#9E9E9E;"></p>
            </div>
           
          

            
        </div>

    </div>
</template>

<script>
export default {
    props:['conversations'],

    methods: {
        hasConversation(){
            // return (this.conversations == 0)? true : false;
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