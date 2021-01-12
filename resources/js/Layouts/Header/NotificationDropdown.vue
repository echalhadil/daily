<template>
    <dropdown 
        :icon="'fa-bell'"     
        :heigth="'21rem'"
        :width="'uk-width-1-4'" 
        :active="false"
        :isIcon="true"
        >
        <template #number>
            <span @click="read"
                v-if="unreadedLength > 0" 
                class=" uk-border-circle  uk-position-top-right uk-label-danger " 
                style="right: -5px; width: 1rem; height: 1rem;font-size: x-small;"
            >
            {{unreadedLength}}
            </span>         
        </template>
    
        <div class=" uk-flex uk-text-bold d-flex font-weight-bold my-2">
            <p class=" uk-margin-auto-right ">Notifications</p>
            
        </div>

        <div class=" uk-margin-small-top">

            <div 
                v-if="hasNotifications() > 0" 
                v-for="notification in notifications" 
                v-bind:key="notification.id" 
                class="uk-width-1-1 uk-border-rounded dropdown-item"
                >
                <inertia-link  class='uk-flex black' :href="'http://127.0.0.1:8000/posts/'+notification.post_id" style="text-decoration:none;" >
                    <inertia-link class="uk-margin-auto-vertical" :href="'http://127.0.0.1:8000/profiles/'+notification.maker_id" style="width: 40px; height: 40px;">
                        <img 
                            class="uk-border-rounded object-fit-cover" 
                            :src="'http://127.0.0.1:8000/'+notification.maker.picture" 
                            style="width: 40px; height: 40px;" 
                        >
                    </inertia-link >
                    <div class="uk-margin-small-left uk-margin-auto-vertical ">
                        <p class=" uk-padding-remove uk-margin-remove uk-margin-auto-vertical uk-text-small  uk-text-capitalize "> 
                            <inertia-link class="black" :href="'http://127.0.0.1:8000/profiles/'+notification.maker_id" style="text-decoration:none;">
                                <b>{{notification.maker.firstname}} {{notification.maker.lastname}}</b>
                            </inertia-link>
                                {{notificationPost(notification.type)}} 
                            <inertia-link @click="makeNotificationReaded(notification)" class="black" :href="'http://127.0.0.1:8000/posts/'+notification.post_id" style="text-decoration:none;"> 
                                <b>post</b>
                            </inertia-link>.

                        </p>
                        <p class="uk-padding-remove uk-margin-remove">
                            <small class=" uk-margin-auto-left uk-margin-auto-vertical" style="font-size: x-small;">{{reformDate(notification.created_at)}}</small>                            
                        </p>
                    </div>

                    <small v-if="! notification.readed" class="fas uk-margin-auto-vertical uk-text-small uk-padding-remove fa-circle" style="color: #4A7FF3;" aria-hidden="true"></small> 
                </inertia-link >
            
            </div>

            <div v-if="  hasNotifications() == 0" class="uk-width-1-1 uk-text-center uk-margin-bottom" style="color:#9E9E9E;">
                <p class="uk-h3 uk-text-center uk-margin-top uk-text-bold"  style="color:#9E9E9E;"> You Don't Have any notifications.</p>
                <i class="fa fa-bell-slash fa-4x uk-text-center" aria-hidden="true"></i>
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
        notifications:Array,
    },
    computed: {

         unreadedLength(){
            return this.notifications.filter(n => !n.readed).length
        },
        
      
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
            axios.get('http://127.0.0.1:8000/readed')
            .then( Response => { console.log(Response)} )
            .catch( Error => { console.log(Error)} )
            
        },
        notificationPost(type){
            return (type=="like")
                ? 'liked your'
                :  'commented in your'

        },

        makeNotificationReaded(notification){
            axios.put('http://127.0.0.1:8000/notifications/'+notification.id)
                .then( Response => { console.log(Response)} )
                .catch( Error => { console.log(Error)} )
        },

        
    },

}
</script>