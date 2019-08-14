<template>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="/"><i class="icon-home2 position-left"></i> Início</a></li>

            <li v-for="migalha in migalhas">

                <a :href="migalhas.url">{{ migalha.nome }}</a>
           </li>
         </ul>
    </div>
</template>

<script>
    export default {
        props: ['migalhas'],
        data: function () {
            return {
                visible: true
            }
        },
        methods: {
            closeAlert: function () {
                this.visible = false;
            }
        },
        mounted(){

        }
    }
</script>