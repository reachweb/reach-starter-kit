window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import LazyLoad from 'vanilla-lazyload'

var _ = require('lodash');

import { createApp } from 'vue'
import Trans from './components/mixins/Trans.vue'
import store from './store/index'
import PrimeVue from 'primevue/config'
import gsap from 'gsap'
import { ScrollToPlugin } from "gsap/ScrollToPlugin"
import { ScrollTrigger } from "gsap/ScrollTrigger"
gsap.registerPlugin(ScrollToPlugin)
gsap.registerPlugin(ScrollTrigger)

const app = createApp({})
app.use(PrimeVue, {ripple: true});
app.use(store)
app.mixin(Trans)
store.dispatch('breakpoint')
store.commit('setTrans', window.translations)

app.component('MobileMenu', require('./components/menus/MobileMenu.vue').default)
app.component('ImageSlider', require('./components/slider/ImageSlider.vue').default)
app.component('ImageGallery', require('./components/slider/ImageGallery.vue').default)
app.component('GoogleMap', require('./components/google/GoogleMap.vue').default)
app.component('FormComponent', require('./components/forms/FormComponent.vue').default)
app.component('Newsletter', require('./components/newsletter/Newsletter.vue').default)
app.component('FullscreenGallery', require('./components/gallery/FullscreenGallery.vue').default)

app.mount('#app')

window.addEventListener('resize', _.debounce((event) => store.dispatch('breakpoint'), 100))

// 100% height on mobile
const appHeight = () => {
    const doc = document.documentElement
    doc.style.setProperty('--app-height', `${window.innerHeight}px`)
}
const headerHeight = () => {
	const doc = document.documentElement
    const header = document.getElementById('header')
    doc.style.setProperty('--header-height', `${header.clientHeight}px`)
}
window.addEventListener('resize', appHeight)
window.addEventListener('resize', headerHeight)
appHeight()
headerHeight()

// Smooth scroll
const scrollTos = document.querySelectorAll(".scroll-to")
	
for (const scrollTo of scrollTos) {
	scrollTo.addEventListener("click", scrollHandler)
}
	
function scrollHandler(e) {
	const target = this.dataset.scroll;
	const offset = parseInt(window.getComputedStyle(document.querySelector(target)).getPropertyValue('margin-top'));
	gsap.to(window, {duration: 1, scrollTo: {y: target, offsetY: offset}})
}

if (!document.lazyLoadInstance) {
    document.lazyLoadInstance = new LazyLoad();
}