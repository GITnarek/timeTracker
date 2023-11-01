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
            console.log(dataFromApi.value);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
};

onMounted(fetchDataFromApi);
</script>

<template>
    <Head title="Projects" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex ">
                        <div :class="styles.div1">
                            New project:
                        </div>
                        <TextInput model-value="">
                        </TextInput>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- Use v-for to loop through dataFromApi and render each project -->
                        <div :class="styles.grid_container">
                            <div :class="styles.grid_item" v-for="project in dataFromApi" :key="project.id">
                                <h2>{{ project.name }}</h2>
                                <p>{{ project.description }}</p>
                                <!-- Add additional content or styling for each square -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<style scoped>

</style>
