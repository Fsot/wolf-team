
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./vendors/bootstrap-datepicker.min');
require('gentelella/build/js/custom.min');
var SimpleMDE = require('simplemde/dist/simplemde.min');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.


    Vue.component('example', require('./components/Example.vue'));

    const app = new Vue({
        el: '#app'
    });

 */

var MDtextarea = $("#mdeditor")[0];

if(MDtextarea){
    var simplemde = new SimpleMDE({
        element: MDtextarea
    });
}