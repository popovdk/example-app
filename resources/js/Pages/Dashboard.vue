<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import VerfyCodeForm from "@/Pages/Dashboard/Partials/VerfyCodeForm.vue";
import NewsBlock from "@/Pages/Dashboard/Partials/NewsBlock.vue";

defineProps({
    isVerify: Boolean,
  news: {
    type: Array,
    default: () => [],
  },
  query: String
});

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <VerfyCodeForm v-if="!isVerify" />
                <NewsBlock :news="news" :query="query" v-else />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
