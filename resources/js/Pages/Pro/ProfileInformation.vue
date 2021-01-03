<template>
    <div class="uk-width-1-1 uk-margin-medium-top uk-padding-small uk-border-rounded ">
        <div class=" uk-width-2-3 uk-margin-small-top uk-margin-small-bottom uk-flex uk-margin-auto ">
            
            <profile-picture :user="user" :userOwnsProfile="userOwnsProfile" />
            <profile-data :user="user"  :userOwnsProfile="userOwnsProfile" />
            
        </div>
    </div>
</template>
<script>
    import ProfilePicture from './ProfilePicture'
    import ProfileData from './ProfileData'

    export default {
        props:['user','userOwnsProfile'],
         
        components:{
            ProfilePicture,
            ProfileData,
        },
    }

</script>