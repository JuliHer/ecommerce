<template>
  <header class="bg-white shadow sticky top-0 z-50">
    <div class="container mx-auto flex justify-between md:justify-normal md:space-x-5 items-center py-4 px-6">
      <Link href="/" class="text-2xl font-bold text-gray-800 hover:text-blue-600 transition">
        Jules 
      </Link>

      <nav class="hidden md:flex space-x-5 text-gray-700 font-medium">
        <Link href="/" class="hover:text-blue-600 transition">Inicio</Link>
        <Link href="/tour" class="hover:text-blue-600 transition">Tour</Link>
        <Link href="/products" class="hover:text-blue-600 transition">Catálogo</Link>
        <Link href="/contact" class="hover:text-blue-600 transition">Contacto</Link>
      </nav>

      <!-- Mobile menu icon -->
      <button @click="isOpen = !isOpen" class="md:hidden focus:outline-none">
        <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>

    <!-- Mobile menu -->
    <div v-if="isOpen" class="md:hidden bg-white border-t border-gray-200 px-6 py-4 space-y-4">
      <Link href="/" class="block text-gray-700 hover:text-blue-600">Inicio</Link>
      <Link href="/tour" class="block text-gray-700 hover:text-blue-600">Tour</Link>
      <Link href="/products" class="block text-gray-700 hover:text-blue-600">Catálogo</Link>
      <Link href="/contact" class="block text-gray-700 hover:text-blue-600">Contacto</Link>
    </div>
  </header>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const isOpen = ref(false);
</script>
