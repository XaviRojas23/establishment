<template>
    <div class="container my-5">
        <h2>Hospital</h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for=" hospital in this.hospitals" v-bind:key="hospital.id">
                <div class="card">
                    <img :src="`storage/${hospital.image_principal}`" alt="imagen Hospitale" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold"> {{ hospital.name }}</h3>
                        <p class="card-text"> {{hospital.address}} </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Horario:</span>
                            {{hospital.opening}} - {{hospital.closing}}
                        </p>
                        <router-link :to="{ name: 'establishment', params: {id: hospital.id}}">
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
        axios.get('/api/categories/hospital')
        .then(response =>{
            this.$store.commit("add_hospitals", response.data);
        })
    },
    computed:{
        hospitals(){
            return this.$store.state.hospitals;
        }
    }
}
</script>
