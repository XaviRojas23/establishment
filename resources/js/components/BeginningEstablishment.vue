<template>
<div>
    <list-categories></list-categories>
    <map-establishment></map-establishment>
    <categoria-restaurant></categoria-restaurant>
    <categoria-cafe></categoria-cafe>
    <categoria-hotel></categoria-hotel>1
    <categoria-hospital></categoria-hospital>
    <categoria-pub></categoria-pub>
    <categoria-gym></categoria-gym>
    <categoria-cinema></categoria-cinema>


</div>
</template>
<script>
    import ListCategories from './ListCategories'
    import CategoriaCafe from './CategoriaCafe'
    import CategoriaRestaurant from './CategoriaRestaurant'
    import CategoriaHotel from './CategoriaHotel'
    import CategoriaHospital from './CategoriaHospital'
    import CategoriaPub from './CategoriaPub'
    import CategoriaGym from './CategoriaGym'
    import CategoriaCinema from './CategoriaCinema'
    import MapEstablishment  from './MapEstablishment'

    export default ({
        components:{
            ListCategories,
            MapEstablishment,
            CategoriaCafe,
            CategoriaRestaurant,
            CategoriaHotel,
            CategoriaHospital,
            CategoriaPub,
            CategoriaGym,
            CategoriaCinema
        }
    })
</script>
