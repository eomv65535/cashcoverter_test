<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Listausuarios from '@/Components/Listausuarios.vue';
defineProps({
  users: Array,
  totalusuarios: Number,
  totalPages: Number,
  currentPage: Number,
  esadm:  String
});
</script>

<template>
    <AppLayout title="Usuarios" :esadm="esadm">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listado de usuarios
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Listausuarios :users="users" :totalusuarios="totalusuarios" :totalPages="totalPages" :currentPage="currentPage" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
