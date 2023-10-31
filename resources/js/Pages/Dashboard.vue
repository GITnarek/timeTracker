<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import styles from './Css/styles.module.css'
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div :class="styles.div"></div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

