<template>
    <div class="uk-margin-auto-left uk-width-2-3@m uk-padding-remove uk-margin-auto-vertical ">
            
        <div class="uk-width-1-1  ">
            <div class=" uk-padding-remove uk-flex uk-width-1-1">

                <p class="uk-text-capitalize uk-padding-small uk-width-2-3 uk-padding-remove-left uk-padding-remove-right uk-margin-remove uk-h2 uk-text-bold ">{{'@'+user.username}}</p>
                    
                <!-- Add friend -->
                <button roll="button"  
                v-on:click="(buttonText == 'add friend')? addFriend() : cancel()"
                v-if=" ! userOwnsProfile" 
                class="uk-text-capitalize uk-margin-auto-left uk-margin-auto-vertical uk-button uk-button-default uk-text-small" style="margin-left: 2px; padding: 10px; color: #4A7FF3; border-color:#4a7ff370 ;">
                {{ buttonText }}
                </button>

                <!-- Responding to friendship request -->
                <div v-if="buttonText == 'responde'" class="uk-padding-remove uk-width-1-6" 
                uk-dropdown>
                    <button @click="confirm" class=" uk-width-1-1 uk-button uk-button-primary">
                           confirm
                    </button>
                    <button @click="cancel" class="uk-width-1-1 uk-button uk-button-default">
                           delete
                    </button>  
                </div>

                <!-- Option for unfriend a user -->
                <div v-if="buttonText == 'friends'" class="uk-padding-remove uk-width-1-6" 
                uk-dropdown>
                    <button @click="unfriend" class="uk-width-1-1 uk-button uk-button-default">
                           unfriend
                    </button>
                </div>

                <button v-if=" ! userOwnsProfile" class="uk-text-capitalize uk-margin-auto-vertical uk-button uk-button-default uk-text-small" style="margin-left: 2px; padding: 10px; color: #4A7FF3; border-color:#4a7ff370 ;" >message</button>
                <i v-if=" ! userOwnsProfile" class=" fa fa-ellipsis-v uk-margin-auto-vertical" style="margin-left: 2px;" ></i>  

                <button v-if="userOwnsProfile" class="uk-text-capitalize uk-margin-auto-vertical uk-button uk-padding-small uk-button-default  uk-border-rounded uk-text-small" style="color: #4A7FF3; border-color:#4a7ff370 ;"uk-toggle="target: #editprofile" >Edit profile</button>
                        
                <div v-if="userOwnsProfile" id="editprofile" uk-modal>
                    <div class="uk-modal-dialog">
                        <button class="uk-modal-close-default" type="button" uk-close></button>
                        <div class="uk-modal-header">
                            <h2 class="uk-modal-title uk-text-center uk-h6">Edit Profile</h2>
                        </div>
                        <div class="uk-modal-body">
                            <form>
                                <div class="mb-3 uk-margin-small-bottom">
                                    <label for="username" class="col-form-label">Username:</label>
                                    <input type="text" v-model="user.username" class="uk-input"  >
                                </div>
                                <div class="mb-3 uk-flex uk-margin-small-bottom d-flex">
                                    <div class=" uk-margin-small-right">
                                        <label for="fistname" class="  col-form-label">First Name:</label>
                                        <input type="text" v-model="user.firstname" class="uk-input" >
                                    </div>
                                    <div class="">
                                        <label for="lastname" class="col-form-label">Last Name:</label>
                                        <input type="text" v-model="user.lastname" class="uk-input "  >
                                    </div>
                                    
                                </div>
                                <div class="mb-3 uk-margin-small-bottom">
                                    <label for="lastname" class="col-form-label">Gender:</label>
                                    <input type="text" v-model="user.gender" class="uk-input "  >
                                    
                                </div>
                                
                            </form>
                        </div>
                        <div class="uk-modal-footer">
                            <!-- A button group with a dropdown -->
                            <div class="uk-button-group uk-float-right">
                                <button class="uk-button uk-button-default uk-margin-small-right uk-modal-close"  type="button">Cancel</button>
                                <button class="uk-button uk-button-primary" type="button">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        
            <p class="uk-text-capitalize uk-h4 uk-margin-remove  uk-padding-remove uk-text-normal" style="color: #a0aec0;">{{user.lastname}} {{user.firstname}}</p>

        </div>


        <div class=" uk-text-capitalize uk-width-1-1 uk-margin-small-top uk-flex ">
            <div class=" uk-text-center uk-margin-auto-right">
                <p class="uk-padding-remove uk-margin-small-bottom uk-h2 uk-text-bold">{{user.posts.length}}</p>
                <p class="uk-padding-remove uk-margin-remove uk-text-bold ">posts</p>
            </div>

            <div class=" uk-margin-auto-right uk-text-center">
                <p class="uk-padding-remove uk-margin-small-bottom uk-h2 uk-text-bold p-">{{user.friends.length}}</p>
                <p class="uk-padding-remove uk-margin-remove uk-text-bold">Friends</p>
            </div>

            <div class=" uk-text-center uk-margin-auto-right">
                <p class="uk-padding-remove uk-margin-small-bottom uk-h2 uk-text-bold"> 300</p>
                <p class="uk-padding-remove uk-margin-remove  uk-text-bold">photos</p>
            </div>

        </div>
        
    </div>
</template>

<script>
export default {
    props:['user','userOwnsProfile'],
    data() {
        return {
            pending:Boolean,
            buttonText:'add friend',
            request:Object,
            
        }
    },

    methods: {
        friendshipStatus(){
            if( ! this.userOwnsProfile)
            axios.post('/friendshipStatus',this.user)
                .then( Response => {  
                        if(Response.data)
                            this.buttonText = 'friends'
                    } )
                .catch( Error => { console.log(Error) } )
        
        },
        //get friendship status 
        status(){
            if( ! this.userOwnsProfile)
            axios.post('/profiles/'+this.user.id+'/status')
                .then( Response => {  
                        this.request = Response.data
                        if( Response.data == false)
                        {   
                        }
                        else{
                            if(Response.data.from_id == this.user.id)
                                this.buttonText = 'responde'
                            else
                                this.buttonText = ' cancel'
                        }


                    } )
                .catch( Error => { console.log(Error) } )
        },

        addFriend(){
            if( ! this.userOwnsProfile)
            axios.post('/friendshipRequests',this.user)
                .then( Response => {
                    if(Response.data !=false){
                        this.buttonText = 'cancel'
                        this.request = Response.data 
                    }                    
                } )
                .catch( Error => { console.log(Error) } )
                
        },

        cancel(){
            if( ! this.userOwnsProfile)
            axios.delete('/friendshipRequests/'+this.request.id)
                .then( Response => {
                    if(Response.data){
                     this.buttonText = 'add friend'
                     this.request = {}
                    }
                      } )
                .catch( Error => { console.log(Error) } )
                
        },

        confirm(){
            if( ! this.userOwnsProfile)
            axios.post('/profiles/'+this.request.id+'/confirm')
                .then( Response => {(Response.data)? this.buttonText = 'friends':'' } )
                .catch( Error => { console.log(Error) } )
                
        },
        unfriend(){
            if( ! this.userOwnsProfile)
            axios.post('/profiles/'+this.user.id+'/unfriend')
                .then( Response => {(Response.data)? this.buttonText = 'add friend':'' } )
                .catch( Error => { console.log(Error) } )
        }
    },
    mounted() {
        this.status();
        this.friendshipStatus();

        
    },

}
</script>