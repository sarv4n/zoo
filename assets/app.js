import { createApp } from 'vue';
import App from './components/ShipmentPriceCalculatorPage.vue';
import router from './router.js';

const app = createApp(App);
app.use(router);
app.mount('#app');
