<template>
    <div class="container my-5">
        <h2>Gym</h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for=" gym in this.gyms" v-bind:key="gym.id">
                <div class="card">
                    <img :src="`storage/${gym.image_principal}`" alt="imagen gym" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold"> {{ gym.name }}</h3>
                        <p class="card-text"> {{gym.address}} </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Horario:</span>
                            {{gym.opening}} - {{gym.closing}}
                        </p>
                        <router-link :to="{ name: 'establishment', params: {id: gym.id}}">
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
        axios.get('/api/categories/gym')
        .then(response =>{
            this.$store.commit("add_gyms", response.data);
        })
    },
    computed:{
        gyms(){
            return this.$store.state.gyms;
        }
    }
}
</script>
