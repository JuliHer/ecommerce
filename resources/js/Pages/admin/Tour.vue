<template>
  <Sidebar />
  <div class="md:ml-64 min-h-screen bg-gray-50">
    <div class="max-w-6xl mx-auto p-6">
      <div class="flex justify-between items-center mb-6 ">
        <h2 class="text-2xl font-bold text-gray-800">Control de Fechas de Tour</h2>
        <Link :href="'/tour/new'" class="bg-blue-600  hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
          + Nueva Fecha
        </Link>
      </div>

      <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-left min-w-[600px]">
          <thead class="bg-gray-100 text-gray-700">
            <tr>
              <th class="px-6 py-4">Fecha</th>
              <th class="px-6 py-4">Evento</th>
              <th class="px-6 py-4">Ubicación</th>
              <th class="px-6 py-4">Tickets</th>
              <th class="px-6 py-4">Estado</th>
              <th class="px-6 py-4 text-right">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="tour in tours" :key="tour.id" class="border-t">
              <td class="px-6 py-4">{{ tour.date }}</td>
              <td class="px-6 py-4">{{ tour.venue }}</td>
              <td class="px-6 py-4">{{ tour.location }}</td>
              <td class="px-6 py-4">
                <a v-if="tour.tickets_url" :href="tour.tickets_url" target="_blank" class="text-blue-600 underline">
                  Comprar
                </a>
                <span v-else class="text-gray-500 italic">No disponible</span>
              </td>
              <td class="px-6 py-4">
                <span :class="tour.sold_out ? 'text-red-600 font-bold' : 'text-green-600 font-bold'">
                  {{ tour.sold_out ? 'Agotado' : 'Disponible' }}
                </span>
              </td>
              <td class="px-6 py-4 text-right space-x-2">
               
                <button @click="deleteTour(tour.id)" class="text-red-500 hover:text-red-600 font-semibold">
                  Eliminar
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <p v-if="error" class="text-red-600 text-center mt-4">{{ error }}</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Sidebar from '@/Components/Sidebar.vue';
import { router, Link } from '@inertiajs/vue3';


const tours = ref([]);
const error = ref('');

const fetchTours = async () => {
  try {
    const response = await axios.get('/api/tour-dates');
    tours.value = response.data;
  } catch (e) {
    console.error(e);
    error.value = 'Error al cargar las fechas del tour.';
  }
};

const deleteTour = async (id) => {
  if (!confirm('¿Estás seguro de que quieres eliminar esta fecha?')) return;
  try {
    await axios.delete(`/api/tour-dates/${id}`);
    tours.value = tours.value.filter(t => t.id !== id);
  } catch (e) {
    console.error(e);
    error.value = 'Error al eliminar la fecha.';
  }
};

onMounted(fetchTours);
</script>
