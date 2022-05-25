<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Button from 'primevue/button';

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Projets
            </h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end">
                    <div>
                       <Button label="Creer un projet" />
                    </div>
                    
                </div>
            </div>
        </div>
    </AppLayout>
</template>
