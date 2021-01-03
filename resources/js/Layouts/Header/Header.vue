<template>
    <header class=" uk-margin-medium-left uk-margin-medium-right uk-margin-top uk-box-shadow-large">
        <nav class="uk-flex uk-width-1-1 uk-padding-small"> 
            <logo />
            <search-input />
            <header-options :notifications="notifications" :conversations="conversations" />
        </nav>
    </header>
        
</template>

<script>
    import Logo from './Logo'
    import SearchInput from './SearchInput'
    import HeaderOptions from './HeaderOptions'


    export default {
        
        // props : ['conversations','notifications'],

        props:{
            notifications:Array,
            conversations:Array,
        },
        components : {
            Logo,
            SearchInput,
            HeaderOptions,
        },
    }
</script>