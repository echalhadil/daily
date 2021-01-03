<template>
    <ap-layout>
        <div class="uk-margin-medium-left uk-margin-medium-right uk-margin-top uk-flex" >
            <left />
            <div class="uk-width-4-5">

                <slot name="friendInfo" >
                </slot>

                <div  class="uk-width-1-1 uk-height-large uk-padding uk-padding-remove-top uk-overflow-auto" >

                    <slot></slot>

                    <!-- Empty conversation -->
                    <div v-if="empty" class="uk-width-1-1 uk-margin-xlarge-top" >
                        <p class="uk-h1 uk-text-center uk-text-bold" > Start your conversation </p>
                        <p class="mdi mdi-message-plus uk-text-center uk-h1" ></p>
                    </div>
                    <!-- Empty conversation -->

                </div>

                <slot name="sendMessage" >
                </slot>

            </div>

        </div>
    </ap-layout>
</template>

<script>
    import ApLayout from '@/Layouts/ApLayout'
    import Left from './Left'

    export default {
        components:{
            ApLayout,
            Left,
        },
        props:{
            // empty:Boolean,
            empty:{
                type:Boolean,
                default:true
            },
        },
       
        // data() {
        //     return {
        //         empty:true,
        //     }
        // },
    }
</script>