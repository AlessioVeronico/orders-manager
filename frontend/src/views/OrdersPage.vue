<script setup>
import { getOrdersList, getProductList } from '@/api';
import { ref, onMounted } from 'vue';
import { VProgressCircular, VDivider } from 'vuetify/lib/components/index.mjs';
import Filter from '../components/Filter.vue'
import OrderModal from '@/components/OrderModal.vue';
import OrderCard from '@/components/OrderCard.vue';


const loadingOrders = ref(false);
const loadingProducts = ref(false);
const orders = ref([]);
const products = ref([]);
const selectedOrder = ref(null);
const showOrderModal = ref(false);

const fetchOrders = async () => {
    loadingOrders.value = true;
    try {
        let res = await getOrdersList();
        orders.value = res.orders;
    } catch(error) {
        console.error(error)
    }
    loadingOrders.value = false;
};

const fetchProducts = async () => {
    loadingProducts.value = true;
    try {
        let res = await getProductList();
        products.value = res.products;
    } catch(error) {
        console.error(error)
    }
    loadingProducts.value = false;
};

const updateList = (filteredList) => {
    orders.value = filteredList;
};

const createOrder = () => {
    selectedOrder.value = {
        id: null,
        name: null,
        description: null,
        date: null
    };
    showOrderModal.value = true;
};

const removeOrderArchived = (id) => {
    orders.value = orders.value.filter(o => o.id !== id);
};

const editOrder = (id) => {
    let order = orders.value.find(o => o.id === id);
    selectedOrder.value = order;
    showOrderModal.value = true;
};

const closeOrderModal = (order) => {
    showOrderModal.value = false;
    if(order && !orders.value.find(o => o.id === order.id)) orders.value.unshift(order);
};

onMounted(() => {
   fetchOrders();
   fetchProducts();
});
</script>
<template>
    <div class="ml-4 mr-4">
        <div v-if="!loadingOrders">
            <Filter @create-order="createOrder" @filtered-list="updateList" @reset-filter="fetchOrders"/>
            <VDivider class="mt-4"/>
            <div v-if="orders.length" >
                <VRow cols="12">
                    <VCol cols="12" md="6" v-for="order in orders">
                        <OrderCard
                            :order="order"
                            @archived="removeOrderArchived"
                            @edit="editOrder"
                        /> 
                    </VCol>
                </VRow>
            </div>
            <div v-else>
                <h3 class="mt-3" style="color: red">No Orders To Display!</h3>
            </div>
        </div>
        <VProgressCircular v-else />
        <OrderModal
            v-if="showOrderModal"
            :order="selectedOrder"
            :show="showOrderModal"
            :products="products"
            @close="closeOrderModal"
        />
    </div>
</template>