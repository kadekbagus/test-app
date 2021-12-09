require('./bootstrap');

import Vue from 'vue'
import Listing from  './vue/notes/listNote'

const app = new Vue({
    el: '#app',
    components: {
        Listing
    }
});