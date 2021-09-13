<template>
    <nav class="d-flex flex-column flex-md-row container justfiy-content-md-center">
        <a
            @click="selectAll()"
            class="style:color=white"
        >Todos</a>
        <a
            href="#"
            v-for="category in categories"
            v-bind:key="category.id"
            class="m-0"
            @click="selectcategory(category)">
            {{ category.name }}
         </a>
    </nav>
</template>
<script>
export default {
    created(){
        axios.get('/api/categories')
        .then(response =>{
            this.$store.commit('add_categories', response.data)
        })
    },
    computed:{
        categories(){
            return this.$store.getters.get_categories
        }
    },
    methods:{
        selectcategory(category){
            this.$store.commit('select_category', category.slug)
            //console.log(category.slug)
        },
        selectAll(){
            axios.get('/api/establishments')
            .then(response => {
                this.$store.commit('add_establishments2', response.data)
        })
        }
    }
}
</script>


<style scoped>
    div {
    background-color: #6272d4;
    }
    nav a {
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    padding: 0.5rem 2rem;
    text-align: center;
    flex: 1;
    }
    nav a:hover {
    color: white;
    cursor: pointer;
    }
    nav a:nth-child(1) {
    background-color: #a8004b;
    }
    nav a:nth-child(2) {
    background-color: #a000b7;
    }
    nav a:nth-child(3) {
    background-color: #591d03;
    }
    nav a:nth-child(4) {
    background-color: #ea6a00;
    }
    nav a:nth-child(5) {
    background-color: #edb220;
    }
    nav a:nth-child(6) {
    background-color: #dd0e3f;
    }
    nav a:nth-child(7) {
    background-color: #0448b5;
    }
    nav a:nth-child(8) {
    background-color: #00a81c;
    }
</style>
