<template>
    <div class="uk-width-1-1 uk-width-1-2@m uk-margin-auto-left">
        <add-post :user="user" :posts="posts" />
        <post 
            v-if="! waiting"
            v-for="post in posts" 
            :post="post" 
            :key="post.id"
            :user="user"
            @delete-post="deletePost" 
            @edit-post="editPost"
        />
        
        <div v-if="waiting" class="loading uk-margin-medium-top uk-width-1-5 uk-margin-auto" >
            <span> </span>
            <span> </span>
            <span> </span>
            <span> </span>
        </div>
      
    </div>
</template>

<script>
import AddPost from './AddPost'
import Post from './Post'

export default {

    props:{
        user:Object,
    },

    components:{
        AddPost,
        Post,

    },
    data() {
        return {
            posts:Array,
            waiting:true,
        }
    },
    methods: {

        deletePost(post)
        {  let ps = this.posts
                    this.posts = ps.filter(p => p != post)

            axios.delete('/posts/'+post.id,post)
                .then( response => { 
                    console.log(response.data)
                 } )
                .catch(error => { console.log(error)})

             
            
        },
        editPost(text,post){
            post.text = text;
        },

        getPosts(){

            axios.get('/posts')
                .then(Response => {this.waiting=false, this.posts = _.orderBy(Response.data, 'id','desc')})
                .catch(error => {console.log(error)})
        },
    },
    mounted() {
        this.getPosts();
    },
}
</script>