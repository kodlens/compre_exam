<template>
    <div>
        <div class="section">
            <div class="container">
                <form @submit.prevent="submit">
                    <div class="columns">
                        <div class="column is-6 is-offset-3">

                            <div class="instruction-container">
                                <div>
                                    Instruction: Choose the letter of your answer.
                                    <br>
                                    <!-- <strong><span style="color:red;">Reminder: Please refrain taking screenshots and posting any of the questions of the test.</span></strong> -->
                                </div>
                            </div>

                            <div class="question-box" v-show="isShow">
                                <!--question content-->
                                <div class="question-content">{{ questionCounter + 1 }}.)
                                    <span v-if="questions[questionCounter].is_question_img == 0">{{questions[questionCounter].question}}</span>

                                    <!-- <div v-else class="question-img">
                                        <img :src="`/storage/q/`+questions[questionCounter].question_img" alt="...">
                                    </div> -->
                                </div>
                                <!--question content-->

                                <!--option content-->
                                <div class="column">
                                    <div class="columns" v-for="(option, k) in questions[questionCounter].options" :key="k">
                                        <!--if question is text-->
                                        <div v-if="option.is_img == 0">
                                            <b-field>
                                                <b-radio
                                                    v-model="answers[questionCounter]"
                                                    :native-value="option.option_id">
                                                    {{option.letter}} - {{ option.content }}
                                                </b-radio>
                                            </b-field>
                                        </div>

                                        <!--if option is img-->
                                        <div v-else>
                                            <b-field>
                                                <b-radio
                                                    v-model="answers[questionCounter]" required
                                                    :native-value="option.option_id">

                                                    <div>{{option.letter}}. </div>
                                                    <img :src="`/storage/q/`+option.img_path" alt="..." class="img-container">

                                                </b-radio>
                                            </b-field>
                                        </div>
                                    </div>
                                    <!--option content-->
                                </div><!--option container-->

                                <div class="buttons mt-5">
                                    <div class="button is-success is-fullwidth" v-if="this.questions.length > this.questionCounter + 1" @click="next">NEXT</div>
                                    <div :class="btnClass" v-else @click="submit">DONE</div>
                                </div>
                            </div><!--question-box-->

                            <!-- <div class="buttons is-right mb-5">
                                <button :class="btnClass">SUBMIT ANSWER</button>
                            </div> -->

                        </div>
                    </div> <!--columns-->
                </form>
            </div><!--container-->
        </div><!--section-->

        <form id="form-section" action="/section" method="POST">
            <csrf></csrf>
            <input type="hidden" name="student_schedule_id" v-model="student_schedule_id" />
        </form>

        <div class="timer-container">
            <b-icon pack="fa" icon="clock-o"></b-icon> &nbsp;
            <div>{{ nTime }}</div>
        </div>

    </div><!--root div-->
</template>

<script>
export default {
    props: ['sectionId', 'studentschedId'],
    data(){
        return{
            questionCounter: 0,
            questions: [{}],
            errors: {},
            answers:{},
            btnClass:{
                'button': true,
                'is-success': true,
                'is-loading': false,
                'is-fullwidth' : true,

            },

            isShow: true,

            nTime: '',

            student_schedule_id: 0,

            s: null,
        }
    },
    methods: {
        loadQuestion: function(){

            this.student_schedule_id = this.studentschedId;

            axios.get('/taking-exam-question/'+this.sectionId).then(res=>{
                //5pxconsole.log(res.data);
                this.questions = res.data;
                this.startTimer(this.questions[0].set_time);
            });
        },

        startTimer(duration) {
           clearInterval(this.s);
            //duration = duration * 60;
            var timer = duration, minutes, seconds;
            this.s = setInterval( ()=> {
                //use arrow function so this keyword will refer to window.variable
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                this.nTime = minutes + ':' + seconds;

                if (--timer < 0) {
                    timer = duration;
                    //alert('done');
                    //clearInterval(this.s)
                    //console.log('stop');
                    //this.isShow = false;
                    //this.submit();
                    this.next();
                }
            }, 1000);
        },

        next: function(){

            if(this.questions.length-1 < this.questionCounter + 1){
                clearInterval(this.s);
                this.submit();
                return;
            }

            this.questionCounter = this.questionCounter + 1; //naglabad akong ulo nimo...
            this.startTimer(this.questions[this.questionCounter].set_time);
            console.log(this.questionCounter);
        },

        done: function(){
           console.log("done");
        },

        submit(){
            this.btnClass["is-loading"] = true;
            axios.post('/taking-exam-submit', {
                section_id: this.sectionId,
                answers: this.answers
            }).then(res=>{
                this.btnClass["is-loading"] = false;
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: 'SAVED.',
                        message: 'Your test successfully saved.',
                        confirmText: 'OK',
                        onConfirm: ()=> window.location = '/result-exam'
                    });
                }
                if(res.data.status === 'exist'){
                    this.$buefy.dialog.alert({
                        title: 'NOT ALLOWED!',
                        type: 'is-danger',
                        message: 'You already took the exam. Thank you.',
                        confirmText: 'OK',
                        onConfirm: ()=> window.location = '/home'
                    });
                }
            }).catch(err=>{
                this.btnClass["is-loading"] = false;
                if(err.response.status===422){
                    this.errors = err.response.data.errors;
                    console.log(this.errors[0]);
                }else{
                    this.$buefy.dialog.alert({
                        title: 'ERROR!',
                        type: 'is-danger',
                        message: 'An error occured during submitting your answer. Please check internet connectivity. \n ' + err.response.data.errors[0],
                        confirmText: 'OK',
                    });
                }
            });
        },

    },
    mounted(){
        this.loadQuestion();

    },
}
</script>

<style scoped>

    .instruction-container{
        background-color: #c1fad1;
        padding: 15px;
        margin-bottom: 5px;
    }

    .question-box{
        border-radius: 5px;
        background-color: rgb(238, 238, 238);
        padding: 20px;
        margin-bottom: 10px;
    }

    .question-content{
        font-weight: bold;
    }

    .question-img{
        padding: 10px;
        display: flex;
    }


    .option-container{
        display: flex;
    }
    .option-content{
        margin-left: 30px;
        padding: 5px 5px;
    }

    .timer-container{
        height: 55px;
        background-color: rgb(20, 83, 31);
        color: white;
        position: fixed;
        bottom: 50px;
        right: 0;
        width: 150px;
        padding: 15px;
        border-radius: 5px;
        transition: all 0.5s ease;
        display: flex;
        justify-content: center;
        font-size: 20px;
        align-items: center;
    }

    @media screen and (max-width: 992px) {
        .timer-container {
            width: 100%;
            bottom: 0;
            border-radius: 0;
            display: flex;
            justify-content: center;
        }

         .option-container{
            flex-direction: column;
            justify-content: center;

        }


    }



    .samplebox{
        height: 100px;
        width: 100px;
        border: 1px solid red;
    }

  

</style>
