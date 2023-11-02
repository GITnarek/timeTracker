<script setup>
import { ref, onMounted } from 'vue';
import axios from '../axios-config.js';
import { Head } from '@inertiajs/vue3';
import styles from '@/Pages/Css/styles.module.css';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const dataFromApi = ref(null);

const fetchDataFromApi = () => {
    axios.get('/projects')
        .then((response) => {
            dataFromApi.value = response.data;
        })
        .catch((error) => {
            console.error('Error:', error);
        });
};

onMounted(fetchDataFromApi);

defineProps({
    dataFromApi: {
        type: Array
    }
})

const columns = [
    { data: 'id' },
    { data: 'name' },
    { data: 'description' }
];
</script>

<template>
    <Head title="Projects" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 ">
                        <DataTable :data="dataFromApi" :columns="columns"
                        >
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Tools</th>
                            </tr>
                            </thead>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<style scoped>

</style>
