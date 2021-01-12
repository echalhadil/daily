<template>

    <div   class=" uk-width-1-2 uk-width-1-3@m uk-padding-small uk-float-left uk-flex uk-margin-remove uk-border-rounded ">
        <div class=" uk-flex uk-width-1-1 uk-box-shadow-small dropdown-item" >

            <img 
                class=" uk-border-rounded uk-margin-small-top uk-margin-small-bottom uk-margin-small-right uk-margin-small-left" 
                :src="'http://127.0.0.1:8000/'+friend.picture" 
                style="width: 3rem; height: 3rem;"
            >

            <inertia-link :href="'http://127.0.0.1:8000/profiles/'+friend.id" class=" uk-margin-auto-vertical">
                <p role="button" class=" uk-margin-remove uk-padding-remove uk-text-bold uk-text-capitalize " style="text-decoration:none; " > {{friend.firstname}} {{friend.lastname}}</p>
                <p role="button" class=" uk-text-small black uk-padding-remove uk-text-capitalize uk-margin-remove">{{'@'+friend.username}}</p>
            </inertia-link>

            

            <div class="uk-margin-auto-vertical uk-margin-auto-left uk-margin-small-right ">
            

                <i class="btn black fa fa-lg fa-ellipsis-v" type="button" >
                </i>
                <div  uk-dropdown class=" uk-list uk-padding-remove" >
                    <button 
                        v-if=" $page.profileUser.id == $page.user.id " 
                        @click="unfriend(friend)"
                        class="uk-width-1-1 uk-text-capitalize uk-button uk-button-default " 
                        type="button">
                        Unfriend
                    </button>
                    <button class="uk-width-1-1 uk-button uk-text-capitalize uk-button-default" type="button">Report</button>
                    <button class="uk-width-1-1 uk-button uk-text-capitalize uk-button-default" type="button">Block</button>

                    </div>


            
            </div>
        </div>

    </div>
</template>

<script>
export default {
    props:['friend'],
    methods: {
        unfriend(friend){
            if( ! this.userOwnsProfile)
            axios.post('/profiles/'+friend.id+'/unfriend')
                .then( Response => { this.$emit('unfriend',friend); } )
                .catch( Error => { console.log(Error) } )
        },
    },
}
</script>