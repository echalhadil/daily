<template>
    <ap-layout>

        <profile-information 
            :user="$page.profileUser" 
            :userOwnsProfile="  $page.profileUser.id === $page.user.id" 
        />
        <profile-content 
            :posts="$page.profileUser.posts" 
            :friends="$page.profileUser.friends"  
        /> 

        
    </ap-layout>

</template>

<script>
    import ApLayout from '@/Layouts/ApLayout'
    import ProfileInformation from './ProfileInformation'
    import ProfileContent from './ProfileContent'

    export default {
      
        data() {
            return {
            }
        },
        components: {
            ApLayout,
            ProfileInformation,
            ProfileContent,
            
        },
        methods: {            
        },
        mounted() {
            

        },
      
    }
</script>
