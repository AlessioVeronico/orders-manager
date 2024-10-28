import { createRouter, createWebHistory } from 'vue-router'
import OrdersPage from '../views/OrdersPage.vue'
import ProductsPage from '../views/ProductsPage.vue'
import HomePage from '../views/HomePage.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/', component: HomePage },
    { path: '/orders', component: OrdersPage },
    { path: '/products', component: ProductsPage },
   ]
})

export default router
