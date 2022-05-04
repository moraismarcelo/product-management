<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
import { Link } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';

const products = ref([])
const isLoading = ref(true)

onMounted(() => {
    getProducts()
})

function getProducts(){
    axios.get(route('api.products.index')).then(response => {
        if(response.data.products.length > 0){
            products.value = response.data.products
            isLoading.value = false
        }
    }).catch(error => {
            console.log(error)
    })
}

function deleteProduct(product){
    isLoading.value = true
    if(product){
        axios.delete(route('api.products.destroy', product.id))
        .then(response => {
            alert('Product deleted successfully!')
            getProducts()
            isLoading.value = false
        }).catch(error => {
            alert(error)
        })
    }
}

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Products
                </h2>
                <div>
                    <PulseLoader v-if="isLoading" />
                </div>
            </div>
        <div class="my-2">
        <Link
            :href="route('dashboard.product.create')"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            Add
        </Link>
        </div>
        </template>

        <div v-if="products" class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Brand
                </th>
                <th scope="col" class="px-6 py-3">
                    Voltage
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products" :key="product.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    {{product.name}}
                </th>
                <td class="px-6 py-4">
                    {{product.description}}
                </td>
                <td class="px-6 py-4">
                    {{product.brand}}
                </td>
                <td class="px-6 py-4">
                    {{product.voltage}}
                </td>
                <td class="px-6 py-4 text-center">
                    <Link :href="route('dashboard.product.form', product.id)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                    |
                    <a @click.prevent="deleteProduct(product)" href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
                </td>
            </tr>

            </tbody>
            </table>
            </div>

        </div>
        <div v-else class="py-12">
        <p>No products found :(</p>

        </div>
    </AppLayout>
</template>
