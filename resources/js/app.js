
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/*
	手动修改preset的bug 
*/
try {
	window.Popper = require('popper.js').default;
	window.$ = window.jQuery = require('jquery');
	require('bootstrap');
} catch (e) {}

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//Vue.component('step', require('./components/StepComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import steps from './components/Steps.vue';
// import elasticSearch from './components/elasticSearch.vue';
import chat from './components/chat.vue';
import notification from './components/notification.vue';
const app = new Vue({
	el: '#app',
	components : { steps , chat , notification }

});
// const elastic  = new Vue({
// 	el: '#elasticSearch',
// 	components: { elasticSearch }
// });
