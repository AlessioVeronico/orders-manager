<script setup>
import { deleteOrder } from '@/api';
import { ref, computed } from 'vue';
import { VTextField, VDatePicker, VBtn, VCol, VRow, VTextarea } from 'vuetify/lib/components/index.mjs';

const props = defineProps({
  order: {
    type: Object,
    required: true,
  }
});

const emit = defineEmits(["archived", "edit"]);
const deletingOrder = ref(false);

const archive = async () => {
    deletingOrder.value = true;
    try {
        let res = await deleteOrder(props.order.id);
        emit("archived", props.order.id);
    } catch (error) {
        console.error(error);
    }
    deletingOrder.value = false;
};

const edit = () => {
    emit("edit", props.order.id);
};
</script>

<template>
        <VCard class="mt-4 mb-4">
            <VCardTitle class="d-flex justify-space-between align-center">
                <VRow cols="12">
                    <VCol sm="12" md="9">
                        <div class="text-h5 text-medium-emphasis ps-2">
                            ORDER {{ props.order.id }}
                        </div>
                    </VCol>
                    <VCol sm="12" md="3">
                        <VBtn
                            icon="mdi-pencil"
                            variant="text"
                            color="primary"
                            @click="edit()"
                        />
                        <VBtn
                            icon="mdi-trash-can"
                            variant="text"
                            color="error"
                            @click="archive()"
                        />
                    </VCol>
                </VRow>
            </VCardTitle>
            <VCardText>
                <VDivider />
                <VRow cols="12">
                    <VCol sm="12" md="4">
                        <VList class="card-list mt-2">
                            <VListItem>
                            <VListItemSubtitle>
                                <span class="text-body-1">NAME</span>
                            </VListItemSubtitle>
                            <VListItemTitle >
                                <h6 class="text-h6">
                                    {{ props.order.name }}
                                </h6>
                            </VListItemTitle>
                            </VListItem>
                        </VList>
                    </VCol>
                    <VCol md="4" sm="12">
                        <VList class="card-list mt-2">
                            <VListItem>
                            <VListItemSubtitle>
                                <span class="text-body-1">DATE</span>
                            </VListItemSubtitle>
                            <VListItemTitle>
                                <h6 class="text-h6">
                                    {{ props.order.date }}
                                </h6>
                            </VListItemTitle>
                            </VListItem>
                        </VList>
                    </VCol>
                    <VCol md="4" sm="12">
                        <VList class="card-list mt-2">
                            <VListItem>
                            <VListItemSubtitle>
                                <span class="text-body-1">PRODUCTS</span>
                            </VListItemSubtitle>
                            <VListItemTitle v-for="p in order.products">
                                <h6 class="text-h6">{{ p.name }}</h6>
                            </VListItemTitle>
                            </VListItem>
                        </VList>
                    </VCol>
                </VRow>
                <VRow cols="12">
                    <VCol sm="12" md="12">
                        <VList class="card-list mt-2">
                            <VListItem>
                            <VListItemSubtitle>
                                <span class="text-body-1">DESCRIPTION</span>
                            </VListItemSubtitle>
                            <VListItemTitle>
                                <h6 class="text-h6 text-wrap">
                                    {{ props.order.description }}
                                </h6>
                            </VListItemTitle>
                            </VListItem>
                        </VList>
                    </VCol>
                </VRow>
            </VCardText>
        </VCard>
</template>
