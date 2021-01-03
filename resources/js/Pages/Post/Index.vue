<template>
    <ap-layout>

        <post-content :post="$page.post" :user="$page.user" />
        
    </ap-layout>
</template>

<script>
    import ApLayout from '@/Layouts/ApLayout'
    import PostContent from './Content'

    

    export default {
       

        components: {
            ApLayout,
            PostContent,
            
        },
    }
</script>
