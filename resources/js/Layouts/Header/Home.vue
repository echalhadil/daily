<template>
    <!-- home -->
    <div class="uk-margin-auto uk-padding-remove">
        <button class=" uk-margin-auto uk-margin-auto-vertical uk-padding-remove uk-text-bold uk-button uk-button-small uk-button-text button-ligne"> 
            <inertia-link  :href="route('main')" >
                <i :class="classes" ></i> 
            </inertia-link>
        </button> 
    </div>
    <!-- home -->
</template>

<script>
export default {
    props:{
        active:Boolean,
    },
    computed: {
        classes(){
            return this.active
                ? 'mdi mdi-home-outline text-dark mdi-24px daily-primary-color'
                : 'mdi mdi-home-outline text-dark mdi-24px black'
        },
    },
    
}
</script>