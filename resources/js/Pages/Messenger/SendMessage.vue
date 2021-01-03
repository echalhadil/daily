<template>

    <!-- send a message -->
    <div class=" uk-width-1-1 uk-padding uk-padding-remove-left uk-padding-remove-right " style=" background:#f4f4fb; ">
        <form @click.prevent.default class="uk-width-1-1 uk-padding-remove uk-margin-remove  uk-flex" action="">
            <input v-model="message.text" type="text" class=" uk-margin-auto uk-input uk-width-3-4 " placeholder="Type your message .."  >
            <button type="submit" v-on:click="send()"class=" uk-button uk-button-primary uk-margin-auto ">Send </button>
        </form>
    </div>
    <!-- send a message -->
    
</template>

<script>
export default {
    props:{
        messages:Array,
        id:Number,
    },
    data() {
        return {
            message:{text:'',conversation_id:''},

        }
    },
    methods: {
        send(){
            if(this.message.text!='')
            {
                this.message.conversation_id = this.id;    
                axios.post('http://127.0.0.1:8000/messages',this.message)
                    .then(Response => {
                        this.message.text ='' 
                        this.messages.push(Response.data)
                        this.$emit("update-messages",this.messages)
                        })
                    .catch(error => {console.table(error)})
               
            }
        },
    },
}
</script>