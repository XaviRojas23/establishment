<template>
    <div class="container my-5">
        <h2>Restaurant</h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for=" restaurant in this.restaurants" v-bind:key="restaurant.id">
                <div class="card">
                    <img :src="`storage/${restaurant.image_principal}`" alt="imagen restaurante" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold"> {{ restaurant.name }}</h3>
                        <p class="card-text"> {{restaurant.address}} </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Horario:</span>
                            {{restaurant.opening}} - {{restaurant.closing}}
                        </p>
                        <router-link :to="{ name: 'establishment', params: {id: restaurant.id}}">
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
        axios.get('/api/categories/restaurant')
        .then(response =>{
            this.$store.commit("add_restaurants", response.data);
        })
    },
    computed:{
        restaurants(){
            return this.$store.state.restaurants;
        }
    }
}
</script>
