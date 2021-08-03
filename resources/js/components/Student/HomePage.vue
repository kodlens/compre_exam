<template>
    <div>
        <div class="hero is-fullheight-with-navbar">
            <div class="hero-body">
                <div class="container">

                    <div class="columns">
                        <div class="column is-6 is-offset-3">
                            <div class="box">
                
                                <div class="instruction">
                                    <p class="title is-5">INTERNSHIP EXAM DIRECTIONS</p>
                                    <ul>
                                        <li>1. You will  take  five (5) sets of  tests; each consists of 18 - item multiple choice test.</li>
                                        <li>2. You will take a total of 90  test items randomly generated from our system.</li>
                                        <li>3. You are only given 10 minutes to finish each set of tests.</li>
                                        <li>4. Once you click each set, the timer will immediately start; you can find it at the bottom right of the screen; avoid clicking back without submitting the test.</li>
                                        <li>5. Answer each set of tests and click submit.</li>
                                        <li>6. After submitting, proceed to the next test.</li>
                                        <li>7. If done, wait for the admission results to be sent to your respective e-mail address.</li>
                                    </ul>

                                </div>

                                <div class="buttons mt-5 is-centered">
                                    <a href="/section" class="button is-primary is-outlined is-rounded">
                                        NEXT &nbsp;
                                        <b-icon icon="chevron-right"></b-icon>
                                    </a>
                                </div>

                               <b-loading :is-full-page="false" v-model="isLoading" :can-cancel="true"></b-loading>
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
    props: ['isNotScheduled', 'alreadyVisitedSection', 'isExist'],

    data() {
        return {


            isLoading: false,


        }
    },

    methods: {
    
   
    },


}
</script>

<style scoped>



    /*.instruction{*/
    /*    display: flex;*/
    /*    justify-content: center;*/
    /*    text-align: justify;*/
    /*    font-size: 20px;*/
    /*    font-weight: bold;*/
    /*    margin: 15px;*/
    /*    border-bottom: 1px solid darkgreen;*/
    /*    padding: 15px;*/
    /*}*/

    .horizontal-word {
        width: 100%;
        text-align: center;
        border-bottom: 1px solid darkgreen;
        line-height: 0.1em;
        margin: 10px 0 20px;
        font-weight: bold;
    }

    .horizontal-word > span {
        background: #fff;
        padding: 0 10px;
        color: darkgreen;
    }

    .box{
        border-top: 3px solid green;
    }

    .instruction{
        margin-top: 30px;
    }
    .instruction > ul > li{
        font-style: italic;
    }

</style>
