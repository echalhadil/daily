<template>
   <button 
   class="uk-text-capitalize uk-margin-auto-left uk-margin-auto-vertical uk-button uk-button-default uk-text-small" 
   style="margin-left: 2px; padding: 10px; color: #4A7FF3; border-color:#4a7ff370 ;">
        {{ text }}
    </button>
</template>
<script>
export default {
    props:{
        text:String,
    },
    computed: {
        
    },
    data() {
        return {
            
        }
    },
    methods: {

        friending()
        {
            this.text
        }
        
    },
}
</script>