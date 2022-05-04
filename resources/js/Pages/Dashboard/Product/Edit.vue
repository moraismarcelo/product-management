<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';
import { defineProps, ref, onMounted } from 'vue';
import axios from 'axios';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import JetLabel from '@/Jetstream/Label.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';

const props = defineProps({
    product: Object,
    brands: Array,
    voltages: Array,
});

const editing = ref(false);

const form = useForm({
    _method: 'POST',
    name: props.product.name && '',
    description: props.product.description && '',
    brand_id: props.product.brand_id && '',
    voltage_id: props.product.voltage_id && '',
});

onMounted(() => {
    if (props.product) {
        editing.value = true;
    }
});

const sendForm = () => {
    if (editing.value) {
        form._method = 'PUT';
    }

    form.post(route('dashboard.product.store'), {
        errorBag: 'sendForm',
        preserveScroll: true,
        onSuccess: () => {
            if (editing.value) {
                Inertia.replace(route('product.show', { id: props.product.id }));
            } else {
                Inertia.replace(route('product.index'));
            }
        },
    });
};


</script>

<template>
    <AppLayout :title="props.product ? 'Editing Product' : 'Creating Product'">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Products Form
                </h2>
            </div>
        </template>

        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="name" value="Name" />
                <JetInput
                    id="name"
                    v-model="props.product.name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="name"
                />
                <JetInputError :message="form.errors.name" class="mt-2" />
            </div>
        </div>
        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="description" value="Description" />
                <JetInput
                    id="description"
                    v-model="props.product.description"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="description"
                />
                <JetInputError :message="form.errors.description" class="mt-2" />
            </div>
        </div>
        <div class="flex justify-center">
            <div class="mb-3 xl:w-96">
                <select class="form-select appearance-none
                block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding bg-no-repeat
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example"
                v-if="props.brands.length > 0"
                >
                    <option>Open this select menu</option>
                    <option v-for="brand in props.brands" :key="brand.id" :value="brand.id" :selected="product.id === brand.id" >{{brand.name}}</option>
                </select>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="mb-3 xl:w-96">
                <select class="form-select appearance-none
                block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding bg-no-repeat
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example"
                v-if="props.voltages.length > 0"
                >
                    <option>Open this select menu</option>
                    <option v-for="voltage in props.voltages" :key="voltage.id" :value="voltage.id" :selected="product.id === voltage.id" >{{voltage.voltage}}</option>
                </select>
            </div>
        </div>
        <div >
            <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </JetActionMessage>

            <JetButton @click="sendForm" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </JetButton>
        </div>
    </AppLayout>
</template>
