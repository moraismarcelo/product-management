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

const form = useForm(props.product);

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
        <form @submit.prevent="form.patch(route('dashboard.product.update', props.product.id))">

        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="name" value="Name" />
                <JetInput
                    id="name"
                    v-model="form.name"
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
                    v-model="form.description"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="description"
                />
                <JetInputError :message="form.errors.description" class="mt-2" />
            </div>
        </div>

        <div class="col-span-6 sm:col-span-4">
                <JetLabel for="product_brand_id" value="Brands" />
                <select
                    v-if="props.brands.length > 0"
                    id="product_brand_id"
                    v-model="form.product_brand_id"
                     class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >
                <option selected value="">Select a brand</option>
                <option v-for="brand in props.brands" :key="brand.id" :value="brand.id">{{brand.name}}</option>

                </select>
                <JetInputError :message="form.errors.product_brand_id" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="product_voltage_id" value="Voltages" />
                <select
                    v-if="props.voltages.length > 0"
                    id="product_voltage_id"
                    v-model="form.product_voltage_id"
                     class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >
                <option selected value="">Select a voltage</option>
                <option v-for="voltage in props.voltages" :key="voltage.id" :value="voltage.id">{{voltage.voltage}}</option>

                </select>
                <JetInputError :message="form.errors.product_voltage_id" class="mt-2" />
            </div>

        <div >
            <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </JetActionMessage>

            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </JetButton>
        </div>
        </form>
    </AppLayout>
</template>
