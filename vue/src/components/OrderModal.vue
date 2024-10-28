<script setup>
import { saveOrder } from '@/api';
import { requiredField } from '@/common/utils';
import { ref } from 'vue';
import { VTextField, VDatePicker, VBtn, VCol, VRow, VTextarea } from 'vuetify/lib/components/index.mjs';

const props = defineProps({
  order: {
    type: Object,
    required: true,
  },
  show: {
    type: Boolean,
    required: true
  },
  products: {
    type: Array,
    default() {
        return [];
    } 
  }
});

const savingOrder = ref(false);
const orderForm = ref(null);

const emit = defineEmits(["close"]);

const initSaving = async  () => {
    let isValid = await orderForm.value.validate();
    if(isValid) save();
};

const save = async () => {
    savingOrder.value = true;
    try {
        let res = await saveOrder(props.order);
        props.order.id = res.id;
        props.order.products = props.products.filter(p => props.order.selectedProductsIds.includes(p.id));
        emit("close", props.order);
    } catch (error) {
        console.error(error);
    }
    savingOrder.value = false;
};

const close = () => {
    emit("close", null);
};
</script>

<template>
    <VDialog
        :modelValue="props.show"
        width="800"
        persistent
    >
        <VCard>
            <VCardTitle class="d-flex justify-space-between align-center">
                <div class="text-h5 text-medium-emphasis ps-2">
                  {{ props.order.id ? 'UPDATE' : 'CREATE' }} ORDER
                </div>
                <VBtn
                    icon="mdi-close"
                    variant="text"
                    color="error"
                    @click="close()"
                />
            </VCardTitle>
            <VForm ref="orderForm">
                <VCardText>
                    <VDivider />
                    <VRow cols="12">
                        <VCol sm="12" md="4">
                            <VTextField
                                v-model="props.order.name"
                                label="Name"
                                :rules="[requiredField]"
                            />
                        </VCol>
                        <VCol sm="12" md="4">
                            <VTextField 
                                v-model="props.order.date" 
                                label="Date"
                                type="date"
                                :rules="[requiredField]"
                            />
                        </VCol>
                    </VRow>
                    <VRow cols="12">
                        <VCol sm="12" md="12">
                            <VSelect
                                v-model="props.order.selectedProductsIds"
                                label="PRODUCTS"
                                :items="props.products"
                                item-title="name"
                                item-value="id"
                                closable-chips
                                chips
                                multiple
                                :rules="[requiredField]"
                            />
                        </VCol>
                    </VRow>
                    <VRow cols="12">
                        <VCol sm="12" md="12">
                            <VTextarea
                                v-model="props.order.description"
                                label="Description"
                                :rules="[requiredField]"
                            />
                        </VCol>
                    </VRow>
                </VCardText>
            </VForm>
            <VCardActions>
                <VBtn 
                    text="SAVE" 
                    variant="flat" 
                    color="primary" 
                    @click="initSaving()" 
                />
            </VCardActions>
        </VCard>
    </VDialog>
</template>
