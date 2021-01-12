<template>
    <ap-layout>
        <div  class="uk-background-muted uk-width-5-6 uk-margin-auto uk-padding uk-border-rounded uk-flex d-md-flex uk-height-viewport uk-overflow-auto">
            <left-side :user="$page.user"  />
            <right-side :user="$page.user" />
         

        </div>
    </ap-layout>
</template>

<script>
    import ApLayout from '@/Layouts/ApLayout'
    import RightSide from './Home/RightSide'
    import LeftSide from './Home/LeftSide'

    export default {
         props:{
            conversations:Array,
            user:Object,
        },
        components: {
            ApLayout,
            LeftSide,
            RightSide,
        },
       
    }
</script>
