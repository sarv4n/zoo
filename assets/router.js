import { createRouter, createWebHistory } from 'vue-router';
import ShippingPriceCalculator from './components/ShipmentPriceCalculatorPage.vue';

const routes = [
    { path: '/shipping-price-calculator', component: ShippingPriceCalculator },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
