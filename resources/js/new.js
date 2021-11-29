require('./bootstrap');

import Vue from 'vue'
import Kadek from  './vue/kadek'

const app = new Vue({
    el: '#app',
    components: {
        Kadek
    }
});