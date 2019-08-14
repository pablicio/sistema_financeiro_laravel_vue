<template>
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> {{ elementos.nome }}</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a v-if="elementos.url != ''" :href="elementos.url"
                   class="btn btn-success">
                    <span> Adicionar {{ elementos.nome }}</span></a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['elementos'],
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