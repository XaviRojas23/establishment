<template>
    <div class="container my-5">
        <h2>Pub</h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for=" pub in this.pubs" v-bind:key="pub.id">
                <div class="card">
                    <img :src="`storage/${pub.image_principal}`" alt="imagen pube" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold"> {{ pub.name }}</h3>
                        <p class="card-text"> {{pub.address}} </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Horario:</span>
                            {{pub.opening}} - {{pub.closing}}
                        </p>
                        <router-link :to="{ name: 'establishment', params: {id: pub.id}}">
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
        axios.get('/api/categories/pub')
        .then(response =>{
            this.$store.commit("add_pubs", response.data);
        })
    },
    computed:{
        pubs(){
            return this.$store.state.pubs;
        }
    }
}
</script>
