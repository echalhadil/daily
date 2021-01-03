<template>
    <div class="uk-width-1-4 uk-padding-small ">
        <img class=" uk-width-1-1 object-fit-cover profile-picture uk-border-rounded " v-bind:src="'../'+user.picture" :alt="user.firstname +' '+user.lastname" >
        
        <div v-if="userOwnsProfile" class=" uk-float-right uk-position-relative uk-text-center uk-border-circle edit-profile-picture "  >  
            <span uk-toggle="target: #changepicture"  class="uk-position-relative uk-border-circle black uk-position-top-right mdi mdi-camera" > </span>
            <!-- This is the modal -->
            <div id="changepicture" class="uk-margin-auto-vertical"  uk-modal>
                <div class="uk-modal-dialog" >
                    <div class=" uk-modal-body ">


                        <div class="uk-flex" >
                            <!-- Edit photo -->
                            <div uk-form-custom class="uk-button uk-text-capitalize uk-margin-auto uk-width-1-3 "> 
                                <input type="file" id="newProfilePicture" v-on:change="previewPicture">
                                <p class=" uk-margin-remove " type="button"><i class="mdi mdi-image-plus mdi-24px" ></i> Select photo</p>
                            </div>
                            <!-- Edit photo -->

                            <div class=" uk-margin-auto-vertical ">
                                <p> -0R- </p>
                            </div>

                            <!-- remove photo -->
                            <div v-on:click="deleteProfilePicture" class="uk-button uk-text-capitalize uk-modal-close uk-margin-auto uk-width-1-3 ">
                                <p > <i class="mdi mdi-trash-can-outline mdi-24px" ></i> Remove photo</p>
                            </div>
                            <!-- remove photo -->

                        </div>
                        <!-- showing the new profile photo -->
                        <div v-if="newProfilePic" class="">
                            <i role="button" v-on:click="newProfilePic=''" class=" uk-position-relative uk-text-center uk-border-circle uk-float-right mdi mdi-close" style="top: 25px;right:2px;background: #dddddd; width: 24px;height: 24px;" ></i>
                            <img class=" uk-border-rounded " :src="newProfilePic" alt="" srcset="">
                        </div>
                        <!-- showing the new profile photo -->

                    </div>

                    <div class=" uk-modal-footer " >
                        <button v-on:click="newProfilePic=''" class=" uk-float-right uk-modal-close uk-button uk-button-default" type="button">Cancel</button>
                        <button v-if="newProfilePic" v-on:click="changePicture" class="uk-modal-close uk-float-right uk-button uk-button-primary uk-margin-small-left ">Save</button>
                    
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    props:{
        user:Object,
        userOwnsProfile:Boolean,
    },
    data() {
        return {
            newProfilePic:'',
            profilePic:'',
        }
    },
    methods: {
        previewPicture (){
            const reader = new FileReader();

            reader.readAsDataURL(document.getElementById('newProfilePicture').files[0]);

            this.profilePic = document.getElementById('newProfilePicture').files[0];       

            reader.onload = () => { this.newProfilePic = reader.result }
        },

        changePicture (){

                var formData = new FormData();
                formData.append('picture', this.profilePic);
                formData.set('id', this.user.id);
                               
                axios.post('http://127.0.0.1:8000/changePicture',formData , {headers: {'Content-Type': 'multipart/form-data',}}) 

                    .then( Response => {this.user.picture = Response.data, this.newProfilePic = this.profilePic = '';})

                    .catch(error => {console.log(error)})


        },
        deleteProfilePicture (){

            // if(confirm("Are you sure aboute that ?"))

            // axios.post('http://127.0.0.1:8000/deletePicture') 

            //     .then( Response => {this.user.picture = Response.data})

            //     .catch(error => {console.log(error)})
        }
    },

    
}
</script>