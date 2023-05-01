<script>
import axios from "axios";

export default {
  props: ["loan_number", "operations", "client_id"],
  data() {
    return {

      newOperation: {
        loan_number: null,
        client_id: null,
        ingress_paid: null,
        ingress_bank: null,
        ingress_comment: null,
        ingress_type: null,
      },
    };
  },
  created() {
    //this.fetchOperations();
  },
  methods: {
    
    createOperation() {
      this.newOperation.client_id = this.client_id
      this.newOperation.loan_number = this.loan_number
      axios
        .post(`/loan/${this.loan_number}/operations`, this.newOperation)
        .then((response) => {
          this.newOperation = {
            loan_number: null,
            client_id: null,
            ingress_paid: null,
            ingress_bank: null,
            ingress_comment: null,
            ingress_type: null,
          };
         location.reload()
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
<template>
  <div>
    <div class="py-12">
      <h2 class="mx-auto sm:px-6 lg:px-8 text-2xl mb-4">Pagos de Préstamo {{ loan_number }}</h2>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                  Cliente</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Monto Pagado</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Forma de pago</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Comentarios</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Tipo de ingreso</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="(operation, index) in operations.data" :key="index">
                <td class="px-6 py-4 whitespace-nowrap">{{ operation.id }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ operation.client_id }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ operation.ingress_paid }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ operation.ingress_bank }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ operation.ingress_comment }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ operation.ingress_type }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="max-w-md mx-auto">
      <form @submit.prevent="createOperation" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="ingress_paid">Monto pagado:</label>
          <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            type="text" id="ingress_paid" v-model="newOperation.ingress_paid" required/>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="ingress_bank">Forma de pago:</label>
          <select
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="ingress_bank" v-model="newOperation.ingress_bank" required>
            <option value="Efectivo" selected>Efectivo</option>
            <option value="Transferencia">Transferencia</option>
            <option value="TPV">TPV</option>
            <option value="BIZUM">BIZUM</option>
          </select>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="ingress_comment">Comentario:</label>
          <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            type="text" id="ingress_comment" v-model="newOperation.ingress_comment" required/>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="ingress_type">Forma de pago:</label>
          <select
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="ingress_type" v-model="newOperation.ingress_type" required>
            <option value="Efectivo" selected>Efectivo</option>
            <option value="Transferencia">Transferencia</option>
            <option value="TPV">TPV</option>
            <option value="BIZUM">BIZUM</option>
          </select>
        </div>
        <div class="flex items-center justify-between">
          <button type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</template>
  
  
  