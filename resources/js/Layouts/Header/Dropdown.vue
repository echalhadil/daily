<template>
    <div class="uk-margin-auto uk-margin-auto-vertical uk-margin-auto-vertical uk-padding-remove">
        <button 
        :class="[buttonClasses]" 
        v-on:click="isVisible =! isVisible"
        :aria-expanded="isVisible"
        > 
            <i v-if="isIcon" class="mdi mdi-24px" :class="[icon,color]" />
            <b v-else :class="color"  >{{ icon }}</b>
            <slot name="number"></slot>
        </button>
        <div :class="[bropdownClasses,width]" style="transform: translate(-170px,0);" >
            <div 
                class="uk-padding-small uk-overflow-auto uk-margin-remove" 
                :style="'height:'+heigth+';' "
            >
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        icon:String,
        active:Boolean,
        heigth:String,
        width:String,
        isIcon:Boolean,

    },
    data() {
        return {
            isVisible:false,
        }
    },

    computed: {
        buttonClasses(){
            return this.isVisible
                ? 'uk-inline uk-button uk-button-text uk-margin-auto uk-padding-remove uk-text-bold uk-open'
                : 'uk-inline uk-button uk-button-text uk-margin-auto uk-padding-remove uk-text-bold '
        },

        bropdownClasses(){
            return this.isVisible
                ? 'uk-padding-remove uk-dropdown uk-open uk-dropdown-bottom-right'
                : 'uk-padding-remove uk-dropdown uk-dropdown-bottom-right'

        }, 
        color(){
            return this.active
                ? 'daily-primary-color'
                : 'black'
        },
        
        
    },
    methods: {
        
    },
}
</script>