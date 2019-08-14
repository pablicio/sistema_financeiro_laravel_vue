<script>
    export default {
        props: ['noticias'],
        data(){
            return {
                list: [],
                sortProperty: 'tilulo',
                sortDirection: 1
            }
        },
        mounted (){
            this.list = JSON.parse(this.noticias)
        }
    }
</script>

<template>

    <table class="table table-responsive table-hover">
        <thead>
        <tr>
            <th width="10%">#</th>
            <th width="10%">Data</th>
            <th>Título</th>
            <th>Texto</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="noticia in list">
            <th scope="row">{{ noticia.id }}</th>
            <th width="10%">{{ noticia.nome }}</th>
            <td width="10%">{{ noticia.referencia }}</td>
            <td>{{ noticia.valor }}</td>
        </tr>
        </tbody>
    </table>

</template>
