<script setup>
import { getOrdersListFiltered } from '@/api';
import { ref} from 'vue';
import { VTextField, VBtn, VCol, VRow } from 'vuetify/lib/components/index.mjs';

const loadingFilters = ref(false);
const filters = ref({
    name: null,
    description: null,
    date: null
});

const emit = defineEmits(["create-order", "filtered-list", "reset-filter"]);

const fetchOrdersFiltered = async () => {
    loadingFilters.value = true;
    try {
        let res = await getOrdersListFiltered(filters.value);
        emit("filtered-list", res.orders);
    } catch (error) {
        console.error(error);
    }
    loadingFilters.value = false;
};

const resetFilters = () => {
    filters.value = {
        name: null,
        description: null,
        date: null
    };
    emit("reset-filter");
};

const createOrder = () => {
    emit("create-order");
};
</script>

<template>
    <VRow cols="12" class="mt-10">
        <VCol md="3" cols="12">
            <VTextField
                v-model="filters.name"
                :disabled="loadingFilters"
                label="Name"
            />
        </VCol>
        <VCol md="3" cols="12">
            <VTextField
                v-model="filters.description"
                :disabled="loadingFilters"
                label="Description"
            />
        </VCol>
        <VCol md="3" cols="12">
            <VTextField 
                v-model="filters.date" 
                label="Date"
                type="date"
            />
        </VCol>
        <VCol md="3" cols="12">
            <VRow cols="12" class="aling-content-center">
                <VCol md="4" cols="4">
                    <VBtn
                        icon="mdi-magnify"
                        color="primary"
                        @click="fetchOrdersFiltered"
                    />
                </VCol>
                <VCol md="4" cols="4">
                    <VBtn
                        text="Reset"
                        color="error"
                        @click="resetFilters"
                    />
                </VCol>
                <VCol md="4" cols="4">
                    <VBtn
                        text="Create"
                        color="success"
                        @click="createOrder"
                    />        
                </VCol>
            </VRow>
        </VCol>
    </VRow>
</template>
