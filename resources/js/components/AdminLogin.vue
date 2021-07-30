<template>
    <div>
        <div class="hero is-fullheight">
            <div class="hero-body">
                <div class="container">
                    <div class="columns">
                        <div class="column is-6-desktop is-offset-3-desktop is-8-tablet is-offset-2-tablet">
                            <div class="panel is-primary">
                                <div class="panel-heading">
                                    ADMINISTRATOR LOGIN
                                </div>
                                <form @submit.prevent="submit">
                                    <div class="panel-body">
                                        
                                        <b-field label="STUDENT ID NO." label-position="on-border" style="margin-bottom: 30px;">
                                            <b-input type="text" class="input-login" v-model="fields.StudID" placeholder="ID No." required></b-input>
                                        </b-field>
                                       
                                        

                                        <b-field label="PASSWORD" label-position="on-border">
                                            <b-input type="password" v-model="fields.password" password-reveal placeholder="Password" required></b-input>
                                        </b-field>

                                        <div v-if="this.errors.StudID">
                                            <span style="color:red; font-weight: bold;">{{ this.errors.StudID[0] }}</span>
                                        </div>

                                        <div class="buttons mt-5">
                                            <button :class="btnClass">LOGIN</button>
                                            <a class="button is-primary is-light" href="/password/reset">RESET PASSWORD</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!--container-->
            </div>
        </div>
    </div><!--root div-->
</template>

<script>
export default{
    data(){
        return{
            fields: {
              
            },
            errors: {},

            btnClass: {
                'button': true,
                'is-primary': true,
                'is-loading': false,
            }
        }
    },

    methods: {
        submit(){
            this.btnClass['is-loading'] = true;

            axios.post('/admin-login', this.fields).then(res=>{
                this.fields = {};
                this.btnClass['is-loading'] = false;
                window.location = '/login';
            }).catch(error=>{
                this.btnClass['is-loading'] = false;
                if(error.response.status === 422){
                    this.errors = error.response.data.errors;
                }
            });
        }
    }
}
</script>
<style scoped>
    .panel-body{
        padding: 15px;
    }

    .input-login {
        border: none !important;
    }

    
</style>
