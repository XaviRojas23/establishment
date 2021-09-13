<template>
    <div class="container my-5">
        <h2 class="text-center mb-5"> {{establishment.name}} </h2>

        <div class="row align-items-start">
            <div class="col-md-8 order-2">
                    <img :src="`../storage/${establishment.image_principal}`" class="img-fluid" alt="imagen establishment">
                    <p class="mt-3"> {{establishment.description}} </p>
                    <galeryimages></galeryimages>
            </div>

            <aside class="col-md-4 order-1">
                <div>
                    <mapubication></mapubication>
                </div>

                <div class="p-4 bg-primary ">
                    <h2 class="text-center text-white mt-2 mb-4">Más Información</h2>

                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                            Ubicación:
                        </span>
                        {{ establishment.address }}
                    </p>

                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                            Horario:
                        </span>
                        {{ establishment.opening }} – {{ establishment.closing }}
                    </p>

                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                            Teléfono:
                        </span>
                        {{ establishment.tlf }}
                    </p>
                </div>
            </aside>
        </div>
    </div>
</template>
<script>
import mapubication from './mapubication.vue';
import Galeryimages from './Galeryimages.vue';
export default {
    components:{
        mapubication,
        Galeryimages
    },

    mounted() {
        const { id } = this.$route.params;
        axios.get('/api/establishments/' + id)
        .then(response =>{
            this.$store.commit('add_establishments', response.data)
        })
    },
    computed:{
        establishment(){
            return this.$store.state.establishment;
        }

    }
}
</script>
