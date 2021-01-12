<template>
    <div class="">
    
        <!-- the header -->
        <nav class=" uk-position-fixed uk-width-1-1 uk-box-shadow-large" style="background:white;">
            <div class="uk-flex uk-width-1-1 "> 
                <logo />
                <search-input />
                <options :notifications="notifications" :conversations="conversations" />
            </div>
        </nav>

        <!-- Page Content -->
        <main class="uk-background-muted main-content">
            <slot></slot>
  
        </main>

        <!-- this is the main footer -->
        <main-footer />
    
    </div>
</template>

<script>

    import Logo from './Header/Logo'
    import SearchInput from './Header/SearchInput'
    import Options from './Header/Options'
    import MainFooter from './Header/Footer'

    export default {
        // props : ['conversations','notifications'],
        data() {
            return {
                notifications:[],
                conversations:[],

            }
        },
        components : {
            Logo,
            SearchInput,
            Options,
            MainFooter,
        },
        
        methods: {
            getNotifications(){

                axios.get('/notifications')
                    .then( Response => { this.notifications = _.orderBy(Response.data, 'id','desc') } )
                    .catch( Error => { console.log(Error) })

            },
            getConversations(){
                axios.get('/conversations')
                    .then( Response => { this.conversations = _.orderBy(Response.data, 'id','desc') } )
                    .catch( Error => { console.log(Error) })
            },
            
        },
        mounted() {

            this.getNotifications();
            this.getConversations();

            // window.Echo.channel('notification-channel')
            // .listen('.my-event', e => {
            // console.log('fvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv');
            // });
           
        },

        created() {
            // window.Echo.private('notification-channel')
            // .listen('NotificationEvent',e =>{
            //     this.notifications.push(e.notification);
            //     console.log('the event : '+ e);
            // });


            

              
        },

       
    }
</script>
