<script setup>
import { deleteProduct, getProductList, saveProduct } from '@/api';
import { ref, onMounted } from 'vue';
import { VProgressCircular, VCard, VDivider } from 'vuetify/lib/components/index.mjs';

const loadingProducts = ref(false);
const products = ref([]);

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

const initSaving = async (product) => {
    if(product.name && product.price) save(product);
    else product.showErrors = true;
}

const save = async (product) => {
    product.showErrors = false;
    product.saving = true;
    try {
        let res = await saveProduct(product);
        product.id = res.id;
    } catch(error) {
        console.error(error)
    }
    product.saving = false;
};

const addProduct = () => {
    products.value.unshift({
        id: null,
        name: null,
        price: null
    });
};

const remove = (product) => {
    if(product.id) archive(product);
    else products.value = products.value.filter(p => p.id !== null);
};

const archive = async (product) => {
    product.deleting = true;
    try {
        await deleteProduct(product.id);
        products.value = products.value.filter(p => p.id !== product.id);
    } catch(error) {
        console.error(error)
    }
    product.deleting = false;
};

onMounted(() => {
   fetchProducts();
});
</script>
<template>
    <div>
        <div v-if="!loadingProducts">
            <VBtn @click="addProduct" color="primary" text="ADD" class="mt-4"/>
            <VDivider class="mt-4 mb-4"/>
            <VRow cols="12">
                <VCol v-for="(product, index) in products" md="4" cols="12">
                    <VCard :key="index">
                        <VCardTitle>
                            <div class="text-medium-emphasis ps-2">
                                {{ product.id ? 'UPDATE' : 'CREATE' }} PRODUCT {{ product.id ? `(ID: ${product.id})` : '' }}
                            </div>
                            <VBtn 
                                :icon="product.id ? 'mdi-pencil' : 'mdi-content-save-outline'"
                                variant="text"
                                color="primary"
                                @click="initSaving(product)"
                                :loading="product.saving"
                            />
                            <VBtn
                                icon="mdi-trash-can"
                                variant="text"
                                color="error"
                                @click="remove(product)"
                                :loading="product.deleting"
                            />
                        </VCardTitle>
                        <VCardText>
                            <VDivider class="mb-3"/>
                            <VRow cols="12">
                                <VCol md="6" cols="12">
                                    <VTextField
                                        v-model="product.name"
                                        label="Name"
                                    />
                                </VCol>
                                <VCol md="6" cols="12">
                                    <VTextField
                                        v-model="product.price"
                                        label="Price"
                                        type="number"
                                        prefix="€"
                                    />
                                </VCol>
                            </VRow>
                            <h4 v-if="product.showErrors" class="mt-5" style="color: red;" >
                                Insert Every Field!
                            </h4>
                        </VCardText>
                    </VCard> 
                </VCol>
            </VRow>
        </div>
        <VProgressCircular v-else />
    </div>
</template>