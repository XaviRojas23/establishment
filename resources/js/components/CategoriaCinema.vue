<template>
    <div class="container my-5">
        <h2>Cinema</h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for=" cinema in this.cinemas" v-bind:key="cinema.id">
                <div class="card">
                    <img :src="`storage/${cinema.image_principal}`" alt="imagen cinemae" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold"> {{ cinema.name }}</h3>
                        <p class="card-text"> {{cinema.address}} </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Horario:</span>
                            {{cinema.opening}} - {{cinema.closing}}
                        </p>
                        <router-link :to="{ name: 'establishment', params: {id: cinema.id}}">
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
        axios.get('/api/categories/cinema')
        .then(response =>{
            this.$store.commit("add_cinemas", response.data);
        })
    },
    computed:{
        cinemas(){
            return this.$store.state.cinemas;
        }
    }
}
</script>
