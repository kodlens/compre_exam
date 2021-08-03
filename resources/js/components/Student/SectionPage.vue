<template>
    <div>
        <div class="section">

            <b-notification v-if="notAllowed == 1" class="is-danger">
                EXAM IS CLOSE.
            </b-notification>

            <b-notification v-if="isExist == 1" class="is-danger">
                ALREADY TAKEN THE EXAM.
            </b-notification>

            <div class="section-wrapper">
                <div v-for="(item, index) in sectionsJSON" :key="index" @click="proceedTakingExam(item.section_id)" class="img-wrapper">
                    <img :src="'/img/' + item.img_filename" class="img-size" alt="..." />
                    <p>SECTION: {{ item.section }}</p>
                    <p>TIME: {{ item.set_time }} minutes</p>
                </div>
            </div>

            <form method="POST" id="form-taking-exam" action="/taking-exam">
                <csrf></csrf>
                <input type="hidden" id="section_id" name="section_id" />
            </form>
        </div>
    </div><!--root div-->
</template>

<script>


export default {
    props:['sections', 'notAllowed', 'isExist'],

    data(){
        return{
            sectionsJSON: null,
        }
    },

    methods: {
        initializeData(){
            this.sectionsJSON = JSON.parse(this.sections);
        },

        proceedTakingExam: function (sectionId){
            let form = document.getElementById('form-taking-exam');
            //let var1 = document.getElementById('schedule_id').value = schedId;
            let section_id = document.getElementById('section_id').value = sectionId;

            if(section_id){
                form.submit();
            }else{
                alert('An error occured. Please check your internet connectivity and start the step from home page. If' +
                    ' the problem still exist, please contact CISO Personnel.');
            }

        }
    },


    mounted() {
        this.initializeData()
    }
}
</script>

<style scoped>
    .section-wrapper{
        margin: auto;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        max-width: 500px;
    }

    .img-wrapper{
        /* border: 1px solid red; */
        margin: 15px;
        padding: 15px;
        border-radius: 10px;
        border: 1px solid #c7c7c7;
        transition: all 0.2s ease;
        background: white;
    }

    .img-wrapper:hover{

        box-shadow: 1px 1px 25px green;
    }

    .img-size{
        height: 150px;
    }

    /* @media screen and (max-width: 992px) {
        .section-wrapper{

            justify-content:center;
            flex-direction: column;
            align-items: center;

        }

    } */
</style>

