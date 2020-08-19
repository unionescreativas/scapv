import Vue from 'vue'
import Chartkick from 'vue-chartkick'
import Chart from 'chart.js'
import VueSpeedometer from "vue-speedometer";
Vue.use(Chartkick.use(Chart))
Vue.component('VueSpeedometer',VueSpeedometer)
// Vue.use(VueSpeedometer)
