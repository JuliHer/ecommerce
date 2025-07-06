<template>
  <Sidebar />
  <div class="md:ml-64 min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto p-6">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Agregar Fecha de Tour</h2>

      <div class="bg-white rounded-xl shadow p-8">
        <form @submit.prevent="handleSubmit" class="space-y-6">

          <div>
            <label class="block font-semibold mb-1" for="date">Fecha</label>
            <input
              id="date"
              v-model="form.date"
              type="date"
              class="w-full border-gray-300 rounded-2xl px-3 py-2 focus:ring focus:ring-blue-200"
              required
            />
          </div>

          <div>
            <label class="block font-semibold mb-1" for="event">Evento / Lugar</label>
            <input
              id="event"
              v-model="form.event"
              type="text"
              class="w-full border-gray-300 rounded-2xl px-3 py-2 focus:ring focus:ring-blue-200"
              required
            />
          </div>

          <div>
            <label class="block font-semibold mb-1" for="location">Ubicación</label>
            <input
              id="location"
              v-model="form.location"
              type="text"
              class="w-full border-gray-300 rounded-2xl px-3 py-2 focus:ring focus:ring-blue-200"
              required
            />
          </div>

          <div>
            <label class="block font-semibold mb-1" for="tickets_url">URL de Boletos</label>
            <input
              id="tickets_url"
              v-model="form.tickets_url"
              type="url"
              class="w-full border-gray-300 rounded-2xl px-3 py-2 focus:ring focus:ring-blue-200"
            />
          </div>

          <div class="flex items-center space-x-2">
            <input
              id="sold_out"
              v-model="form.sold_out"
              type="checkbox"
              class="h-5 w-5 text-red-600"
            />
            <label for="sold_out" class="text-gray-700 font-semibold">Agotado</label>
          </div>

          <button
            type="submit"
            class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded transition"
            :disabled="loading"
          >
            {{ loading ? 'Guardando...' : 'Agregar Fecha' }}
          </button>

          <p v-if="error" class="text-red-600 text-center mt-4">{{ error }}</p>
          <p v-if="success" class="text-green-600 text-center mt-4">Fecha agregada exitosamente 🎉</p>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import axios from 'axios';
import Sidebar from '@/Components/Sidebar.vue';

const form = reactive({
  date: '',
  event: '',
  location: '',
  tickets_url: '',
  sold_out: false,
});

const loading = ref(false);
const error = ref('');
const success = ref(false);

const handleSubmit = async () => {
  error.value = '';
  success.value = false;

  try {
    loading.value = true;

    const response = await axios.post('/api/tour-dates', {
      date: form.date,
      venue: form.event,
      location: form.location,
      tickets_url: form.tickets_url,
      sold_out: form.sold_out ? 1 : 0,
    });

    console.log('Tour agregado:', response.data);

    Object.assign(form, { date: '', event: '', location: '', tickets_url: '', sold_out: false });
    success.value = true;
  } catch (e) {
    console.error(e);
    error.value = 'Ocurrió un error al guardar la fecha del tour.';
  } finally {
    loading.value = false;
  }
};
</script>
