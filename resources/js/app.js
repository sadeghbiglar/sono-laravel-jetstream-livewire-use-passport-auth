import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';

document.addEventListener('DOMContentLoaded', function () {
    const app = createApp({});
    app.component('example-component', ExampleComponent);
    app.mount('#app');
});
