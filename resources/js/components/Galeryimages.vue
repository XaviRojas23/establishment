<template>
    <div>
        <h2 class="mt-4">Galeria de imagenes</h2>
        <ul class="row list-unstyled mt-4">
            <li class="col-md-4 mb-4" v-for="image in images" v-bind:key="image.id">
                <a :href='`/storage/${image.route_image}`' data-lightbox="images" data-title="Imagen Establecimiento">
                    <img class="img-fluid" :src='`/storage/${image.route_image}`' alt="">
                </a>
            </li>
        </ul>
    </div>
</template>
<script>
import Lightbox from 'lightbox2';
export default {
    computed:{
        images(){
            return this.$store.getters.get_Images
        }
    }
}
</script>

<style scoped>
    @import 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css';
</style>
