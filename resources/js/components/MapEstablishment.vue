<template>
    <div class="map">
        <l-map
            :zoom="zoom"
            :center="center"
            :options="mapOptions"
        >
            <l-tile-layer :url="url" :attribution="attribution"/>
            <l-marker v-for="establishment in establishments" v-bind:key="establishment.id" :lat-lng="getCoordinates(establishment)" :icon="iconEstablishment(establishment)" @click="redirect(establishment.id)">
                <l-tooltip>
                    <div>
                        {{ establishment.name }} - {{ establishment.category.name }}
                    </div>
                </l-tooltip>
            </l-marker>
        </l-map>
    </div>
</template>
<script>
import {latLng} from 'leaflet'
import {LMap, LTileLayer, LMarker, LTooltip, LIcon} from 'vue2-leaflet'
export default {
    components:{
        LMap,
        LTileLayer,
        LMarker,
        LTooltip,
        LIcon
    },

    data() {
        return {
            zoom: 13,
            center: latLng(41.5614512, 2.0766842),
            url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            attribution:
                '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            currentZoom: 11.5,
            currentCenter: latLng(41.5614512, 2.0766842),
            showParagraph: false,
            mapOptions: {
                zoomSnap: 0.5
            },
            showMap: true
        };
    },
    created(){
        axios.get('/api/establishments')
        .then(response => {
            this.$store.commit('add_establishments2', response.data)
        })
    },
    computed:{
        establishments(){
            return this.$store.getters.get_Establishments
        }
    },
    methods: {
        getCoordinates(establishment){
            //console.log(establishment)
            return {
                lat: establishment.lat,
                lng: establishment.lng
            }
        },
        iconEstablishment(establishment){
            const { slug } = establishment.category
            return L.icon({
                iconUrl:`images/icons/${slug}.png`,
                iconSize: [40,50]
            })
        },
        redirect(id){
            this.$router.push({name: 'establishment', params: { id }})
        }
    },
    watch:{
        "$store.state.category": function(){
            axios.get('/api/' + this.$store.getters.get_category)
            .then(response =>{
                this.$store.commit('add_establishments2', response.data)
            })
        }
    }
}
</script>
<style scoped>
    .map{
        height: 600px;
        width: 100%;
    }
</style>
