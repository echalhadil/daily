<template>
    <div class="uk-width-1-3 uk-margin-auto uk-margin-auto-vertical uk-flex">

        <home :active="route().current('main')" />

        <conversation-dropdown :conversations="conversations" />

        <notification-dropdown :notifications="notifications" />

        <profile-dropdown />

    </div>
</template>

<script>
    import Home from './Home'
    // import HeaderConversations from './HeaderConversations'
    // import HeaderNotifications from './HeaderNotifications'
    import ProfileDropdown from './ProfileDropdown'
    // import Dropdown from './Dropdown'
    import NotificationDropdown from './NotificationDropdown'
    import ConversationDropdown from './ConversationDropdown'




    export default {
        
        // props : ['conversations','notifications'],

        props:{
            notifications:Array,
            conversations:Array,
        },
        components : {
             Home,
            // HeaderConversations,
            // HeaderNotifications,
            ProfileDropdown,
            // Dropdown,
            NotificationDropdown,
            ConversationDropdown,
        }
        
    }

</script>