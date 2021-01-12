<template>
    
    <div class="uk-border-rounded uk-padding-small uk-flex uk-box-shadow-small pointer uk-background-default" uk-toggle="target: #addpost" type="button">
        <!-- profile picture -->
        <div class=" uk-width-1-5 " >
            <img class=" uk-width-4-5 uk-border-rounded " :src="user.picture" alt="">
        </div>
        <!-- profile picture -->

        <div class=" uk-width-4-5 " >
            <input role="button" type="text" class="uk-input " placeholder="Type Somethig Here">
            <div class="uk-flex uk-margin-auto-right uk-margin-small-top uk-text-center">
                <button class="uk-button-default uk-flex uk-border-rounded uk-text-bold">
                    <i class="fal fa-image   fa-2x  " style="padding:2px;"></i>
                    <p class=" uk-margin-auto-vertical "style="padding-left:2px;">Image</p>
                   
                    
                </button>
            </div>
        </div>


        <div class=" uk-margin-auto-vertical" uk-modal id="addpost">

            <div class=" uk-modal-dialog ">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-modal-container ">
                
                    <!-- Modal Header -->
                    <div class="uk-modal-header uk-text-center uk-text-center">
                        <h4 class="uk-modal-title "> New post </h4>
                                                    
                    <!-- Modal body -->
                        <div class="uk-modal-body uk-padding-remove uk-margin-remove ">
                            <hr>
                            <div class=" uk-width-1-1 uk-padding-remove uk-flex uk-margin-remove ">
                                <div class=" uk-width-1-6" >
                                    <img class=" uk-width-small uk-border-rounded uk-width-1-2" :src="$page.user.picture" >
                                </div>

                                <div class=" uk-margin-auto-vertical uk-width-3-4">
                                 <input type="text" name="Text" v-model="post.text" placeholder="type something !" class=" uk-width-1-1 uk-h5 uk-padding-remove uk-margin-remove  uk-textarea" style="height: 82px;">
                                </div>

                            </div>
                            <hr>
                            <div class=" uk-flex uk-width-1-1 ">
                                
                                <div uk-form-custom class="   ">
                                    <input type="file" accept="image/*" id="input-image" v-on:change="uploadfile()"  name="picture">
                                    <button class="uk-button-default">
                                        <i class="far mr-auto uk-padding-small fa-image fa-lg" alt='add image'></i>Image
                                    </button>
                                </div>

                            </div>

                            
                            <div class="uk-card-media-top uk-box-shadow-small uk-padding-small uk-margin-small uk-width-1-2" v-if="preview_image!=''">
                                <i class=" uk-border-circle uk-float-right far fa-times pointer uk-padding-remove uk-margin-small-bottom black uk-button-small "  style=" background: #e4e6eb;width: 1.8rem; height: 1.8rem;margin-bottom: -32px;position: relative;" v-on:click="preview_image ='' " type="button"></i>
                                <img class=" uk-width-1-1 uk-cover-object uk-border-rounded "  :src="preview_image" alt="image">
                            </div>

            
                            <div class="col-11 uk-width-5-6 uk-padding-small uk-margin-auto ">
                                <button  type="submit" @click='addpost()' aria-disabled="true" class=" uk-width-1-1 uk-border-rounded uk-button-primary uk-modal-close uk-button uk-text-bold"  style="background: #4A7FF3;">Post</button>
                            </div>
            
                        </div>               
                    
                    </div>
            
                </div>
            </div>
            
        </div>

    </div>

</template>

<script>
export default {
    props:['user','posts'],
    data() {
        return {
            post:{text:null,picture:null},
            preview_image:'',
        }
    },
    methods: {
        uploadfile(){
            const reader = new FileReader();
    
            reader.readAsDataURL(document.getElementById('input-image').files[0]);
            
            this.post.picture = document.getElementById('input-image').files[0];
            
            reader.onload = () => { this.preview_image = reader.result }
        },
        addpost(){
           if(this.preview_image!=''&& this.post.text){

                var formData = new FormData();
                formData.set('text', this.post.text);
                formData.append('picture', this.post.picture);
                    
                axios.post('/posts',formData,{headers: {'Content-Type': 'multipart/form-data',}} )
                    .then( Response => {
                        this.posts.unshift(Response.data);
                        this.preview_image = null;
                        this.post = {text:null,picture:null,};
                    })
                    .catch(error => {console.log(error)})
                
            }
        },

    },
}
</script>