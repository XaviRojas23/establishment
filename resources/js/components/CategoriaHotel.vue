<template>
    <div class="container my-5">
        <h2>Hotel</h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for=" hotel in this.hotels" v-bind:key="hotel.id">
                <div class="card">
                    <img :src="`storage/${hotel.image_principal}`" alt="imagen hotele" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold"> {{ hotel.name }}</h3>
                        <p class="card-text"> {{hotel.address}} </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Horario:</span>
                            {{hotel.opening}} - {{hotel.closing}}
                        </p>
                        <router-link :to="{ name: 'establishment', params: {id: hotel.id}}">
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
        axios.get('/api/categories/hotel')
        .then(response =>{
            this.$store.commit("add_hotels", response.data);
        })
    },
    computed:{
        hotels(){
            return this.$store.state.hotels;
        }
    }
}
</script>
