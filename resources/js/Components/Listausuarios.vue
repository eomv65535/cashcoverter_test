<script>
import { computed } from "vue";
import { router } from "@inertiajs/vue3";

export default {
  props: {
    users: Array,
    totalusuarios: Number,
    totalPages: Number,
    currentPage: Number,
  },
  setup(props) {
    const from = computed(() => {
      return (props.currentPage - 1) * 10 + 1;
    });

    const to = computed(() => {
      let to = props.currentPage * 10;
      if (to > props.totalusuarios) {
        to = props.totalusuarios;
      }
      return to;
    });

    const previousPage = () => {
      if (props.currentPage > 1) {
        if(props.currentPage -1 == 1)
            router.visit(route('usuarios'));  
        else
            router.visit(route('usuarios', { page: props.currentPage -1}));       
      }
    };

    const nextPage = () => {
      if (props.currentPage < props.totalPages) {
        router.visit(route('usuarios', { page: props.currentPage +1}));        
      }
    };

    return {
      from,
      to,
      previousPage,
      nextPage,
    };
  },
};
</script>



<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                ID
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                First Name
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Last Name
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Email
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="user in users" :key="user.id">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ user.id }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ user.first_name }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ user.last_name }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ user.email }}</div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div
      class="flex items-center justify-between px-4 py-3 bg-gray-50 border-t border-gray-200 sm:px-6"
    >
      <div class="hidden sm:block">
        <p class="text-sm text-gray-700">
          Mostrando de
          <span class="font-medium">{{ from }}</span>
          a
          <span class="font-medium">{{ to }}</span
          >, Total
          <span class="font-medium">{{ totalusuarios }}</span>
          Usuarios
        </p>
      </div>
      <div class="flex-1 flex justify-between sm:justify-end">
        <button
          v-if="currentPage > 1"
          @click="previousPage"
          :disabled="currentPage === 1"
          class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
        >
          Anterior
        </button>
        <button
          v-if="currentPage < totalPages"
          @click="nextPage"
          :disabled="currentPage === totalPages"
          class="ml-3 relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
        >
          Siguiente
        </button>
      </div>
    </div>
  </div>
</template>
  
                 
  

