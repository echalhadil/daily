<template>
    <div class="uk-flex uk-box-shadow-large uk-border-rounded dropdown-item  ">
        <a class=" uk-width-1-1 uk-flex" :href="'profiles/'+user.id" style="text-decoration: none;">
            <img class="uk-border-rounded object-fit-cover uk-margin-left uk-margin-right uk-margin-top uk-margin-bottom " :src="user.picture" style="width: 3rem; height: 3rem;">
            <div class=" uk-margin-auto-vertical ">
                <p role="button" class=" uk-margin-remove uk-text-bold black uk-padding-remove" >@{{user.username}}</p>
                <p role="button" class=" uk-text-small uk-margin-remove">{{user.firstname}} {{user.lastname}}</p>

            </div>
        </a>
    </div>
</template>

<script>
export default {
    props:{
        user:Object,
    },
}
</script>