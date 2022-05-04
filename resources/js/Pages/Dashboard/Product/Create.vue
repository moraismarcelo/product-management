<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
import { Link } from '@inertiajs/inertia-vue3';
import JetFormSection from '@/Jetstream/FormSection.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';

const isLoading = ref(true)

const props = defineProps({
    brands: Array,
    voltages: Array,
});

const form = useForm({
    name: '',
    description: '',
    product_brand_id: '',
    product_voltage_id: '',
});

</script>

<template>
    <AppLayout title="Create Product">
        <template #title>
            Profile Information
        </template>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Products
                </h2>
                <div>
                    <PulseLoader v-if="isLoading" />
                </div>
            </div>
        </template>

        <JetFormSection @submit.prevent="form.post(route('dashboard.product.store'))">

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="name" value="Name" />
                <JetInput
                    id="name"
                    type="text"
                    v-model="form.name"
                    class="mt-1 block w-full"
                    autocomplete="current-password"
                />
                <JetInputError :message="form.errors.name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="description" value="Description" />
                <JetInput
                    id="description"
                    type="text"
                    v-model="form.description"
                    class="mt-1 block w-full"
                    autocomplete="current-password"
                />
                <JetInputError :message="form.errors.description" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="product_brand_id" value="Brands" />
                <select
                    v-if="props.brands.length > 0"
                    id="product_brand_id"
                    v-model="form.product_brand_id"
                     class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    autocomplete="current-password"
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
                    autocomplete="current-password"
                >
                <option selected value="">Select a voltage</option>
                <option v-for="voltage in props.voltages" :key="voltage.id" :value="voltage.id">{{voltage.voltage}}</option>

                </select>
                <JetInputError :message="form.errors.product_voltage_id" class="mt-2" />
            </div>

        </template>

        <template #actions>
            <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </JetActionMessage>

            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </JetButton>
        </template>
    </JetFormSection>


    </AppLayout>
</template>
