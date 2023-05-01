<script>
import { computed } from "vue";
import { router } from "@inertiajs/vue3";

export default {
  props: {
    loans: Array,
  },
  setup(props) {
      
    const from = computed(() => {
      return (props.loans.current_page - 1) * 10 + 1;
    });

    const to = computed(() => {
      let to = props.loans.current_page * 10;
      if (to > props.totalusuarios) {
        to = props.totalusuarios;
      }
      return to;
    });

    const previousPage = () => {
      if (props.loans.current_page > 1) {
        if(props.loans.current_page -1 == 1)
            router.visit(route('usuarios'));  
        else
            router.visit(route('usuarios', { page: props.loans.current_page -1}));       
      }
    };

    const nextPage = () => {
      if (props.loans.current_page < props.loans.total) {
        router.visit(route('usuarios', { page: props.loans.current_page +1}));        
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
                Client ID
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Amount
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Instalments
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Int rate
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Start date
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="loan in loans.data" :key="loan.id">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ loan.id }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ loan.client_id }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ loan.amount }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ loan.instalments }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ loan.int_rate }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ loan.start_date }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900"><a :href="'/loan/'+loan.id+'/operations'">Operations</a></div>
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
          Prestamos
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
  
                 
  

