<template>   
    <dropdown 
        :icon="'me'"   
        :heigth="'auto'"
        :width="'uk-width-1-6'"
        :isIcon="false"
        :active="route().current('profiles.show')"  
       
        >
    <!-- account -->
     

        <div class="uk-width-1-1 uk-border-rounded uk-margin-small-top dropdown-item">
            <inertia-link class="uk-flex " :href="'http://127.0.0.1:8000/profiles/'+$page.user.id"  style="text-decoration:none;">
                <img class="uk-margin-small-right uk-border-rounded uk-margin-auto-vertical object-fit-cover"
                    :src="'http://127.0.0.1:8000/'+$page.user.picture" 
                    alt="" style="width: 36px; height: 36px;"/>
                <p class="black uk-padding-remove uk-text-capitalize uk-margin-auto-vertical text-reset">
                   {{ $page.user.firstname }} {{  $page.user.lastname }}
                </p>
            </inertia-link>
        </div>


        <div class="uk-width-1-1 uk-border-rounded uk-margin-small-top dropdown-item">
            <button @click="logout" class="black uk-flex uk-button uk-button-text" style=" height: 36px;text-decoration:none;">
                <i class="uk-margin-small-right fal fa-sign-out fa-lg uk-margin-auto-vertical"></i>
                <p class="uk-padding-remove uk-width-1-1 uk-text-capitalize uk-margin-auto-vertical text-reset">log out</p>
            </button>
        </div>

    </dropdown>
    <!-- account -->  
</template>

<script>
    import Dropdown from './Dropdown'

export default {
    components:{
        Dropdown,
    },

    methods: {
        logout() {
            axios.post(route('logout').url()).then(response => {
                window.location = '/';
            })
        },
    },
    computed: {
        classes(){
            return this.active
                ? 'daily-primary-color'
                : 'black'
        },
    },
}
</script>