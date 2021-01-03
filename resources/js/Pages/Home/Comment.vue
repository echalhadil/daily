<template>
    <li  class="uk-width-1-1 uk-padding-small uk-padding-remove-bottom uk-margin-small-top uk-margin-small-bottom uk-margin-remove uk-flex ">
                            
        <div class="uk-padding-remove">
            <img class=" uk-border-rounded uk-width-3-4 object-fit-cover " :src="'http://127.0.0.1:8000/'+comment.user.picture" style="width: 40px; height:40px;">
        </div>

        <div class=" uk-margin-small-left uk-padding-remove uk-width-5-6">
            
            <p class=" uk-width-1-1 uk-margin-remove uk-text-small"> 
                <b class=" uk-text-bold black uk-text-capitalize "> {{comment.user.firstname}} {{comment.user.lastname}}</b>
                {{comment.text}}
            </p>
        <small style=" font-size:xx-small "> {{ reformDate(comment.created_at) }}</small>

        </div>
    </li>
</template>

<script>
export default {
    
    props:{
        comment:Object,
    },
    methods: {
        reformDate(LaravelDate){

            var year = LaravelDate.slice(0,4),
            month = LaravelDate.slice(5,7),
            day = LaravelDate.slice(8,10),
            houre = LaravelDate.slice(11,13),
            minute = LaravelDate.slice(14,16);

            return year+"-"+month+"-"+day+" at "+houre+":"+minute;
        },
        deleteComment(comment){
            
        }
        
    },
}

</script>