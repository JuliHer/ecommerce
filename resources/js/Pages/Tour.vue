<template>
  <div class="min-h-screen bg-gray-50 flex flex-col">
    <!-- Header -->
    <NavigationTop />

    <!-- Hero Section -->
    <main class="flex-grow flex flex-col text-center py-16 px-6">
      <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
        Jules Starry Tour
      </h2>
      <p class="text-lg text-gray-600 mb-8">
        conoce nuestras próximas fechas.
      </p>

      <div class="w-full space-y-4">
        <div class="hidden md:flex bg-gray-100 font-semibold text-gray-700 rounded-lg px-4 py-3">
          <div class="flex-1">Fecha</div>
          <div class="flex-1">Evento</div>
          <div class="flex-1">Ubicacion</div>
          <div class="flex-1">Boletos</div>
        </div>

        <!-- Filas / Cards -->
        <div v-for="venue in venues" class="flex flex-col md:flex-row md:items-center bg-white rounded-lg shadow px-4 py-4">
          <div class="flex-1 md:py-0 py-2">
            <span class="md:hidden font-bold text-gray-500">Fecha:</span> {{ venue.date }}
          </div>
          <div class="flex-1 md:py-0 py-2">
            <span class="md:hidden font-bold text-gray-500">Evento:</span> {{ venue.venue }}
          </div>
          <div class="flex-1 md:py-0 py-2">
            <span class="md:hidden font-bold text-gray-500">Ubicacion:</span> {{ venue.location }}
          </div>
          <div class="flex-1 md:py-0 py-2">
            <button v-if="venue.sold_out" class="text-red-600 rounded">Sold Out</button>
            <button v-if="!venue.sold_out" class="bg-blue-600 rounded text-white">Comprar</button>
          </div>
        </div>

      </div>
    </main>

    <!-- Footer -->
    <FooterPage />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import NavigationTop from '@/Components/NavigationTop.vue';
import FooterPage from '@/Components/FooterPage.vue';
import axios from 'axios';
import {ref, onMounted} from 'vue';

const venues = ref([]);
onMounted(async () => {
  try{
    const response = await fetch('/api/tour');
    if(!response.ok) throw new Error('error al cargar blogs');
    venues.value = await response.json();
  }catch(error){
    console.error('Error cargando blogs:', error);
  }
})
</script>
