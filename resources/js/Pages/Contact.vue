<template>
  <div class="min-h-screen bg-gray-50 flex flex-col">
    <!-- Header -->
     <NavigationTop />

    <!-- Hero Section -->
    <main class="flex-grow flex flex-col items-center justify-center text-center py-16 px-6">
      <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Contáctanos</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <!-- Información de contacto -->
          <div>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Información</h2>
            <p class="text-gray-600 mb-4">
              ¿Tienes alguna pregunta o necesitas ayuda? Escríbenos y te responderemos lo antes posible.
            </p>

            <ul class="text-gray-600 space-y-4">
              <li class="flex items-center">
                contacto@jules-ecommerce.com
              </li>
              <li class="flex items-center">
                Lun - Vie: 9:00 - 18:00
              </li>
              <li class="flex items-center">
                Guadalajara, Jalisco, México
              </li>
            </ul>
          </div>

          <!-- Formulario de contacto -->
          <div>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Envíanos un mensaje</h2>
            <form @submit.prevent="handleSubmit" class="space-y-4">
              <div>
                <label class="block text-gray-700 mb-2" for="name">Nombre</label>
                <input
                  type="text"
                  id="name"
                  v-model="form.name"
                  class="w-full border-gray-300 rounded p-3 focus:ring focus:ring-blue-200"
                  required
                />
              </div>
              <div>
                <label class="block text-gray-700 mb-2" for="email">Email</label>
                <input
                  type="email"
                  id="email"
                  v-model="form.email"
                  class="w-full border-gray-300 rounded p-3 focus:ring focus:ring-blue-200"
                  required
                />
              </div>
              <div>
                <label class="block text-gray-700 mb-2" for="message">Mensaje</label>
                <textarea
                  id="message"
                  rows="4"
                  v-model="form.message"
                  class="w-full border-gray-300 rounded p-3 focus:ring focus:ring-blue-200"
                  required
                ></textarea>
              </div>
              <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded transition"
              >
                Enviar mensaje
              </button>
            </form>
          </div>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow mt-8">
      <div class="container mx-auto text-center py-4 text-gray-600">
        © {{ new Date().getFullYear() }} Jules Ecommerce. Todos los derechos reservados.
      </div>
    </footer>
  </div>
</template>

<script setup>
import { reactive } from 'vue';
import NavigationTop from '@/Components/NavigationTop.vue';

const form = reactive({
  name: '',
  email: '',
  message: '',
});

const handleSubmit = () => {
  alert(`Gracias por tu mensaje, ${form.name}!`);
  // Aquí podrías enviar los datos a tu backend usando axios o fetch.
  form.name = '';
  form.email = '';
  form.message = '';
};
</script>
