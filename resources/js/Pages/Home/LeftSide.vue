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


        <div  v-if="posts.length==0" class="uk-margin-large uk-width-1-1 uk-text-center uk-margin-auto " style="color:#828282;">


        
            <p class="uk-h1 uk-margin-top uk-text-capitalize uk-h3 " style="color:#828282;"  > Aucune publication</p>
            <i class="fa fa-moon-stars fa-9x " aria-hidden="true"></i>
                

        </div>
      
    </div>
</template>

<script>
import AddPost from './AddPost'
import Post from './Post'

import swal from 'sweetalert';


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
        {
            
            let ps = this.posts
            

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this post",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Your post file has been deleted!", {
                    icon: "success",
                    button: "close",
                    });

                    this.posts = ps.filter(p => p != post)

                axios.delete('/posts/'+post.id,post)
                .then( response => { 
                    console.log(response.data)
                 } )
                .catch(error => { console.log(error)})
                } 
                
            });
             
            
        },
        editPost(post){
           
            swal({
                text: "Edit post :",
                content: { 
                    element: "input",
                    attributes: {
                        placeholder: "Type your post text",
                        type: "text",
                        value:post.text,
                    },
                },
                buttons: true,
                }).then((value) => {
                // if (!value) throw null;
        
                post.text = document.querySelector(".swal-content__input").value;

                 axios.put('posts/'+post.id,post)
                .then( response =>{
                    console.log(response.data)
                } )
                .catch(error =>{
                    console.log(response.error)
                });
            });


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