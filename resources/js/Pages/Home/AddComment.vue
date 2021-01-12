 <!-- add Comment  -->
<template>
    <form @submit.prevent="addComment()" class=" uk-width-5-6 uk-margin-bottom uk-flex uk-margin-auto-left uk-margin-auto-right ">
        <input  type="text" placeholder="add comment ..." v-model="comment.text" class="uk-input text-dark uk-width-1-1">
    </form>
</template>
<!--  add Comment -->   

<script>
export default {
    data() {
        return {
            comment:{text:null,post_id:null,},
        }
    },
    props:{
        post:Object,
    },
    methods: {
        addComment (post){
            if(this.comment.text!=null)
            {    
                try {
                    this.comment.post_id = this.post.id

                    axios.post('/comments',this.comment )
                    .then( Response => {
                        this.post.comments.push(Response.data);
                        this.comment = {text:null,post_id:null,};
                    })
                    .catch(error => {console.log(error)})
                    

                } catch (error) {
                    console.log(error);
                };

                
            }

        },
    },
}
</script>