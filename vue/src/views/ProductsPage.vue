<script setup>
import { deleteProduct, getProductList, saveProduct } from '@/api';
import { ref, onMounted } from 'vue';
import { VProgressCircular, VCard, VDivider } from 'vuetify/lib/components/index.mjs';
import { requiredField } from '@/common/utils';


const loadingProducts = ref(false);
const deletingProduct = ref(false);
const savingProduct = ref(false);
const products = ref([]);
const showErrors = ref(false);

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
    else showErrors.value = true;
}

const save = async (product) => {
    showErrors.value = false;
    savingProduct.value = true;
    try {
        let res = await saveProduct(product);
        product.id = res.id;
    } catch(error) {
        console.error(error)
    }
    savingProduct.value = false;
};

const addProduct = () => {
    products.value.unshift({
        id: null,
        name: null,
        price: null
    });
};

const archive = async (id) => {
    deletingProduct.value = true;
    try {
        let res = await deleteProduct(id);
        products.value = products.value.filter(p => p.id === id);
    } catch(error) {
        console.error(error)
    }
    deletingProduct.value = false;
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
                <VCol v-for="product in products" sm="4">
                    <VCard>
                        <VCardTitle>
                            <div class="text-medium-emphasis ps-2">
                                {{ product.id ? 'UPDATE' : 'CREATE' }} PRODUCT {{ product.id ? `(ID: ${product.id})` : '' }}
                            </div>
                            <VBtn 
                                :icon="product.id ? 'mdi-pencil' : 'mdi-content-save-outline'"
                                variant="text"
                                color="primary"
                                @click="initSaving(product)"
                                :loading="savingProduct"
                            />
                            <VBtn
                                v-if="product.id"
                                icon="mdi-trash-can"
                                variant="text"
                                color="error"
                                @click="archive(product.id)"
                                :loading="deletingProduct"
                            />
                        </VCardTitle>
                        <VCardText>
                            <VDivider class="mb-3"/>
                            <VRow cols="12">
                                <VCol sm="6">
                                    <VTextField
                                        v-model="product.name"
                                        label="Name"
                                    />
                                </VCol>
                                <VCol sm="6">
                                    <VTextField
                                        v-model="product.price"
                                        label="Price"
                                        type="number"
                                        prefix="€"
                                    />
                                </VCol>
                            </VRow>
                            <h4 v-if="showErrors" class="mt-5" style="color: red;" >
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