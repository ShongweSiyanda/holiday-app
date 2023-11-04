import {createApp} from 'vue/dist/vue.esm-bundler.js';
import Home from './components/Home.vue';
import multiselect from 'vue-multiselect';

import 'vue-multiselect/dist/vue-multiselect.min.css';


const app = createApp({});

app.component('home-component', Home);
app.component('multi-select',multiselect);

app.mount("#app");
