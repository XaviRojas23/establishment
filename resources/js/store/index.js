import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        cafes: [],
        hospitals: [],
        pubs: [],
        gyms: [],
        cinemas: [],
        restaurants: [],
        hotels: [],
        establishment: {},
        establishments: {},
        categories: [],
        category: '',



    },
    mutations: {
        add_cafes(state, cafes) {
            state.cafes = cafes;
        },
        add_restaurants(state, restaurants) {
            state.restaurants = restaurants;
        },
        add_hotels(state, hotels) {
            state.hotels = hotels;
        },
        add_pubs(state, pubs) {
            state.pubs = pubs;
        },
        add_hospitals(state, hospitals) {
            state.hospitals = hospitals;
        },
        add_gyms(state, gyms) {
            state.gyms = gyms;
        },
        add_cinemas(state, cinemas) {
            state.cinemas = cinemas;
        },
        add_establishments(state, establishment) {
            state.establishment = establishment
        },
        add_establishments2(state, establishments) {
            state.establishments = establishments
        },
        add_categories(state, categories) {
            state.categories = categories
        },
        select_category(state, category) {
            state.category = category
        }
    },
    getters: {
        get_Establishment: state => {
            return state.establishment
        },
        get_Images: state => {
            return state.establishment.images
        },
        get_Establishments: state => {
            return state.establishments
        },
        get_categories: state => {
            return state.categories
        },
        get_category: state => {
            return state.category
        }

    }


});