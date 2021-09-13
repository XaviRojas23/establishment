<template>
    <div class="map">
        <l-map
            :zoom="zoom"
            :center="center"
            :options="mapOptions"
        >
            <l-tile-layer :url="url" :attribution="attribution"/>
            <l-marker :lat-lng="{lat, lng}">
                <l-tooltip>
                    <div> {{ establishment.name }} </div>
                </l-tooltip>
            </l-marker>
        </l-map>
    </div>
</template>
<script>
import {latLng} from 'leaflet';
import {LMap, LTileLayer, LMarker, LTooltip} from 'vue2-leaflet';
export default {
    components:{
        LMap,
        LTileLayer,
        LMarker,
        LTooltip
    },

    data() {
    return {
      zoom: 16,
      center: latLng(41.5614512, 2.0766842),
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      attribution:
        '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      currentZoom: 11.5,
      mapOptions: {
        zoomSnap: 0.5
      },
      showMap: true,
      lat: "",
      lng: ""
    };
  },
  created(){
      setTimeout(() => {
          this.lat = this.$store.getters.get_Establishment.lat;
          this.lng = this.$store.getters.get_Establishment.lng;
          this.center = latLng(this.lat, this.lng);
        },1200);
        console.log(this.center);
  },
  computed: {
        establishment() {
            return this.$store.getters.get_Establishment;
        }
    },
}
</script>

<style scoped>
    @import 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css';
    .map{
        height: 300px;
        width: 100%;
    }
</style>
