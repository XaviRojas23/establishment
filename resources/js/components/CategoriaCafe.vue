<template>
    <div class="container my-5">
        <h2>Cafés</h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for=" cafe in this.cafes" v-bind:key="cafe.id">
                <div class="card">
                    <img :src="`storage/${cafe.image_principal}`" alt="imagen restaurante" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold"> {{ cafe.name }}</h3>
                        <p class="card-text"> {{cafe.address}} </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Horario:</span>
                            {{cafe.opening}} - {{cafe.closing}}
                        </p>
                        <router-link :to="{ name: 'establishment', params: {id: cafe.id}}">
                            <a href="" class="btn btn-primary d-block">Ver Establecimiento</a>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    mounted() {
        axios.get('/api/categories/cafe')
        .then(response =>{
            this.$store.commit("add_cafes", response.data);
        })
    },
    computed:{
        cafes(){
            return this.$store.state.cafes;
        }
    }
}
</script>
