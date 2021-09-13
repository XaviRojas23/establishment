import { OpenStreetMapProvider } from 'leaflet-geosearch';
const provider = new OpenStreetMapProvider();

document.addEventListener('DOMContentLoaded', () => {

    const lat = document.querySelector('#lat').value === '' ? 41.5604965 : document.querySelector('#lat').value;
    const lng = document.querySelector('#lng').value === '' ? 2.0761738 : document.querySelector('#lng').value;

    const map = L.map('map').setView([lat, lng], 16);

    let markers = new L.FeatureGroup().addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);


    let marker;

    marker = new L.marker([lat, lng], {
        draggable: true,
        autoPan: true
    }).addTo(map);

    markers.addLayer(marker);

    var geocodeService = L.esri.Geocoding.geocodeService({
        apikey: 'AAPK50d46f33808d4c5e8bbb2d6cd51dffa92Kr9mCpBoL5Fqq28yWFz7D8aKmElQEBODQpt2TlQSmcKJIcgshiJRvepMIKHRYv0' // replace with your api key - https://developers.arcgis.com
    });

    const buscador = document.querySelector('#formsearch');
    buscador.addEventListener('blur', buscarDireccion);

    reubicarPin(marker)

    function reubicarPin(marker) {
        marker.on('moveend', function(e) {
            marker = e.target;
            const posicion = marker.getLatLng();
            // Centrar automaticamente
            map.panTo(new L.LatLng(posicion.lat, posicion.lng));

            geocodeService.reverse().latlng(posicion).run(function(error, result) {
                //console.log(result.address)
                /*if (error) {
                    console.log(error)
                    return;
                }*/
                //L.marker(result.latlng).addTo(map).bindPopup(result.address.Match_addr).openPopup();
                marker.bindPopup(result.address.Match_addr);
                marker.openPopup();
                llenarInputs(result);
                //LLenar los campos
            })
        });
    }

    function buscarDireccion(e) {
        if (e.target.value.length > 1) {
            provider.search({ query: e.target.value + ' Sabadell BCN ' })
                .then(result => {
                    if (result) {

                        // Limpiar los pines previos
                        markers.clearLayers();

                        // Reverse Geocoding, cuando el usuario reubica el pin
                        geocodeService.reverse().latlng(result[0].bounds[0], 16).run(function(error, result) {

                            // Llenar los inputs
                            llenarInputs(result);

                            // Centrar el map
                            map.setView(result.latlng)


                            // Agregar el Pin
                            marker = new L.marker(result.latlng, {
                                draggable: true,
                                autoPan: true
                            }).addTo(map);

                            // asignar el contenedor de markers el nuevo pin
                            markers.addLayer(marker);


                            // Mover el pin
                            reubicarPin(marker);

                        })
                    }
                })
                .catch(error => {
                    // console.log(error)
                })
        }
    }


    function llenarInputs(result) {
        // console.log(result)
        document.querySelector('#address').value = result.address.Address || '';
        document.querySelector('#lat').value = result.latlng.lat || '';
        document.querySelector('#lng').value = result.latlng.lng || '';
    }
});