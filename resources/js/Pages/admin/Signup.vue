<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
      <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Registro</h1>

      <form @submit.prevent="handleRegister" class="space-y-4">
        <div>
          <label class="block text-gray-700 mb-2" for="name">Nombre</label>
          <input
            type="text"
            v-model="form.name"
            id="name"
            class="w-full border-gray-300 rounded p-3 focus:ring focus:ring-blue-200"
            required
          />
        </div>
        <div>
          <label class="block text-gray-700 mb-2" for="email">Correo electrónico</label>
          <input
            type="email"
            v-model="form.email"
            id="email"
            class="w-full border-gray-300 rounded p-3 focus:ring focus:ring-blue-200"
            required
          />
        </div>
        <div>
          <label class="block text-gray-700 mb-2" for="password">Contraseña</label>
          <input
            type="password"
            v-model="form.password"
            id="password"
            class="w-full border-gray-300 rounded p-3 focus:ring focus:ring-blue-200"
            required
          />
        </div>
        <div>
          <label class="block text-gray-700 mb-2" for="password_confirmation">Confirmar contraseña</label>
          <input
            type="password"
            v-model="form.password_confirmation"
            id="password_confirmation"
            class="w-full border-gray-300 rounded p-3 focus:ring focus:ring-blue-200"
            required
          />
        </div>

        <button
          type="submit"
          class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded transition"
        >
          Registrarse
        </button>
      </form>

      <div class="mt-6 text-center">
        <Link
          href="/login"
          class="inline-block text-blue-600 hover:text-blue-800 font-semibold transition"
        >
          ¿Ya tienes cuenta? Inicia sesión
        </Link>
      </div>

      <p v-if="error" class="text-red-600 mt-4 text-center">{{ error }}</p>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import axios from 'axios';
import { router, Link } from '@inertiajs/vue3';

const form = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});
const error = ref('');

const handleRegister = async () => {
  error.value = '';

  // Validación en el cliente: todos los campos requeridos
  if (!form.name || !form.email || !form.password || !form.password_confirmation) {
    error.value = 'Por favor completa todos los campos.';
    return;
  }

  if (form.password !== form.password_confirmation) {
    error.value = 'Las contraseñas no coinciden.';
    return;
  }
  
  try {
    await axios.post('/api/register', form);
    router.visit('/'); // Redirigir al home después del registro exitoso
  } catch (e) {
    error.value = 'No se pudo registrar. Revisa los datos e inténtalo de nuevo.';
  }
};
</script>
