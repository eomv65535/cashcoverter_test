<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Listaprestamos from '@/Components/Listaprestamos.vue';
defineProps({
  loans: Array,
  esadm: String
});
</script>

<template>
    <AppLayout title="Usuarios" :esadm="esadm">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listado de Prestamos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Listaprestamos :loans="loans" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
