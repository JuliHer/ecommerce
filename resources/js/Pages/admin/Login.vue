<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
      <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Login</h1>

      <form @submit.prevent="handleLogin" class="space-y-4">
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

        <button
          type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded transition"
        >
          Iniciar sesión
        </button>
      </form>

      <!-- Botón de registro -->
      <div class="mt-6 text-center">
        <Link
          href="/signup"
          class="inline-block text-blue-600 hover:text-blue-800 font-semibold transition"
        >
          ¿No tienes cuenta? Regístrate
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
  email: '',
  password: '',
});
const error = ref('');

const handleLogin = async () => {
  error.value = '';
  try {
    await axios.post('/login', form);
    router.visit('/');
  } catch (e) {
    error.value = 'Credenciales inválidas. Intenta de nuevo.';
  }
};
</script>
