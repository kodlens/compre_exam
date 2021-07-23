<template>
    <div>

        <div class="hero is-fullheight">
            <div class="w-navbar">
                <span class="w-navbar-title">GOV. ALFONSO D. TAN COLLEGE</span>
            </div>
            <div class="hero-body">
                <div class="container">

                    <div style="display: flex; justify-content: center;">
                        <img src="/img/logo_small.png" alt="..." style="height: 150px;"/>
                        <img src="/img/itelogo.png" alt="..." style="height: 150px;"/>
                    </div>
                    <div class="text-center mb-2">
                        <p class="title is-5">WELCOME TO INTERNSHIP EXAMINATION</p>  
                        <p class="subtitle">(Online Exam for ITE 4th Year Student)</p>
                    </div>

                    <div class="buttons is-centered">
                        <a class="button is-rounded is-outlined is-primary" href="/login">
                            <b-icon pack="fa" icon="arrow-right"></b-icon>
                            &nbsp; &nbsp;LOGIN NOW
                        </a>
                    </div>
                </div>
            </div>
        </div>



    </div><!--root navbar-->

</template>

<script>
export default {
    props: {
        isReg: {
            type: Boolean,
            default: 1,
        }
    }

}

</script>

<style scoped>
    .text-center{
        text-align: center;
    }

    .w-navbar{
        height: 60px;
        border-bottom: 1px solid rgb(8, 119, 8);
        padding: 15px 0;
        font-size: 20px;
        display: flex;
        justify-content: center;
    }

    .w-navbar-title {
        font-weight: bold;
    }

  
</style>

