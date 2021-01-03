<template>

    <!-- notification -->
    <div class="uk-margin-auto uk-margin-auto-vertical uk-margin-auto-vertical uk-padding-remove">
        <button  class="uk-margin-auto uk-padding-remove uk-text-bold uk-button uk-button-text">
            <i v-on:click="read()" class="black mdi mdi-24px mdi-bell-outline"></i>
            <span v-if="unreadedlength > 0"  class=" uk-border-circle  uk-position-top-right uk-label-danger " style="right: -5px; width: 1rem; height: 1rem;font-size: x-small;" >
             {{unreadedlength }} 
             </span>
        </button>

        <div  class="uk-padding-remove uk-width-1-5" uk-dropdown="mode: click">
    
            <div class=" uk-width-1-1 uk-padding-small uk-overflow-auto uk-margin-remove" style=" height:21rem; ">

                <div class=" uk-flex uk-text-bold d-flex font-weight-bold my-2">
                    <p class=" uk-margin-auto-right ">Notifications</p>
                    <!--<a class="uk-margin-auto-left uk-text-small uk-text-center " href="notifications.html" style="color: #4A7FF3; ">View all</a>
                    -->
                </div>

                <div class=" uk-margin-small-top">

                    <div 
                        v-if="hasNotifications() > 0" 
                        v-for="notification in notifications" 
                        v-bind:key="notification.id" 
                        class="uk-width-1-1 uk-margin-bottom">
                        <inertia-link  class='uk-flex black' :href="'http://127.0.0.1:8000/posts/'+notification.post_id" style="text-decoration:none;" >
                            <inertia-link  :href="'http://127.0.0.1:8000/profiles/'+notification.maker_id" style="width: 40px; height: 40px;">
                             <img class="uk-border-rounded object-fit-cover" :src="'http://127.0.0.1:8000/'+notification.maker.picture" alt="" style="width: 40px; height: 40px;" >
                            </inertia-link >
                            <div class="uk-margin-small-left uk-margin-auto-vertical ">
                                <p class=" uk-padding-remove uk-margin-remove uk-margin-auto-vertical uk-text-small  uk-text-capitalize "> 
                                    <inertia-link  :href="'http://127.0.0.1:8000/profiles/'+notification.maker_id" style="text-decoration:none;">
                                        <b>{{notification.maker.firstname}} {{notification.maker.lastname}}</b>
                                    </inertia-link>
                                        {{notificationPost(notification.type)}} 
                                    <inertia-link  :href="'http://127.0.0.1:8000/posts/'+notification.post_id" style="text-decoration:none;"> 
                                        <b>post</b>
                                    </inertia-link>.

                                </p>
                                <p class="uk-padding-remove uk-margin-remove">
                                    <small class=" uk-margin-auto-left uk-margin-auto-vertical" style="font-size: x-small;">{{reformDate(notification.created_at)}}</small>                            
                                </p>
                            </div>

                            <small v-if="! notification.readed" class="mdi uk-margin-auto-vertical uk-text-small uk-padding-remove mdi-circle" style="color: #4A7FF3;" aria-hidden="true"></small> 
                        </inertia-link >
                    
                    </div>

                    <div v-if="  hasNotifications() == 0" class="uk-width-1-1 uk-margin-bottom">
                        <p class="uk-h3 uk-text-center uk-margin-top uk-text-bold"  style="color:#9E9E9E;"> You Don't Have any notifications.</p>
                        <p class="mdi mdi-48px uk-text-center mdi-bell-off-outline uk-h3 " style="color:#9E9E9E;"></p>

                    </div>
                    

                </div>

            </div>
            
        </div>

    </div>
    <!-- notification -->

</template>

<script>
export default {
    

    props:['notifications',],

    data() {
        return {
        
        }
    },
    computed: {
        
      
    },
    
    methods: {
        hasNotifications(){
            return (this.notifications.length) ;
        },
        reformDate(LaravelDate){

            var year = LaravelDate.slice(0,4),
            month = LaravelDate.slice(5,7),
            day = LaravelDate.slice(8,10),
            houre = LaravelDate.slice(11,13),
            minute = LaravelDate.slice(14,16);

            return year+"-"+month+"-"+day+" at "+houre+":"+minute;
        },
        read(){
            axios.get('readed')
            .then( Response => { console.log(Response)} )
            .catch( Error => { console.log(Error)} )
            
        },
        unreadedlength(){
            let ns= this.notifications
            let num = ns.filter(n => n.readed == false);
            return ns.length
              

        },
        notificationPost(type){
            return (type=="like")
                ? 'liked your'
                :  'commented in your'

        }
    },
}
</script>