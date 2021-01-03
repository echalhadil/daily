<template>
    
    <div class="uk-border-rounded uk-padding-small uk-margin-top uk-flex uk-box-shadow-small pointer" uk-toggle="target: #addpost" type="button">
        <!-- profile picture -->
        <div class=" uk-width-1-5 " >
            <img class=" uk-width-4-5 uk-border-rounded " :src="user.picture" alt="">
        </div>
        <!-- profile picture -->

        <div class=" uk-width-4-5 " >
            <input role="button" type="text" class="uk-input " placeholder="Type Somethig Here">
            <div class="uk-flex uk-margin-auto-right uk-margin-small-top uk-text-center">
                <button class="uk-button-default uk-text-bold">
                    <i class="mdi mr-auto mdi-file-image mdi-24px " alt='add image'></i>Image
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
                
                            <div class=" uk-width-1-1 uk-padding-remove uk-margin-remove ">
                                <textarea name="Text" v-model="post.text" placeholder="type something !"  rows="8" class=" uk-width-1-1 uk-h5 uk-padding-remove uk-margin-remove uk-textarea border-0 text-dark appearance-none p-0 m-0  h5 w-100 "></textarea>
                            </div>

                            <div class=" uk-flex uk-width-1-1 uk-padding-small">
                                
                                <div uk-form-custom class=" uk-flex uk-margin-auto uk-text-center  ">
                                    <input type="file" accept="image/*" v-on:change="uploadfile()" id="input-image" name="picture">
                                    <button class="uk-button-default">
                                        <i class="mdi mr-auto mdi-file-image mdi-24px " alt='add image'></i>Image
                                    </button>
                                </div>
                    
                                <div uk-form-custom class="uk-flex uk-margin-auto uk-text-center">
                                    <input type="file" accept="video">
                                    <button class=" uk-button-default">
                                        <i class="mdi mdi-file-video mdi-24px " alt='add image'></i>Video
                                    </button>
                                </div>
                                
                                
                    
                            </div>

                            
                            <div class="uk-card-media-top border uk-padding-small uk-margin-small uk-width-1-4" v-if="preview_image!=null">
                                <i class=" uk-border-circle uk-float-right mdi mdi-close uk-padding-remove uk-margin-small-bottom black uk-button-small"  style=" background: #e4e6eb;width: 1.8rem; height: 1.8rem;" v-on:click="preview_image ='' " type="button"></i>
                                <img class=" uk-width-1-1 uk-border-rounded "  :src="preview_image" alt="image">
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
            preview_image:null,
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