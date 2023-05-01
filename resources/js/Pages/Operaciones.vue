<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Listaoperaciones from '@/Components/Listaoperaciones.vue';
defineProps({
    operations: Object,
    loan_number: Number,
    client_id: Number,
    esadm:  String
});
</script>

<template>
    <AppLayout title="Usuarios" :esadm="esadm">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listado de Operaciones
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Listaoperaciones :operations="operations" :loan_number="loan_number" :client_id="client_id" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
