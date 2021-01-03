<template>
    <div class=" uk-visible@m uk-padding-remove uk-width-1-4 uk-margin-auto" >

        <user-right :user="user" />
        <right-conversations :conversations="conversations" />
        
    </div>
</template>

<script>
import RightConversations from './Conversations'
import UserRight from './UserRight'


export default {

    props:{
        user:Object,
    },
    data() {
        return {
            conversations:Array,
        }
    },
    components:{
        RightConversations,
        UserRight,
    },
    methods: {
         getConversations(){
                axios.get('/conversations')
                    .then( Response => { this.conversations = Response.data } )
                    .catch( Error => { console.log(Error) })
            },
    },
    mounted() {
        this.getConversations();
    },
}
</script>