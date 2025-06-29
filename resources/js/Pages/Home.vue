<template>
  <div class="min-h-screen bg-gray-50 flex flex-col">
    <!-- Header -->
     <NavigationTop />

     
    <!-- Hero Section -->
    <main class="flex-grow flex flex-col ">

      <Carrusel />
      <div class="py-8 md:py-16 px-6">
        <div class="container  mx-auto ">
          <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 ">
            Novedades
          </h2>
          <div class="space-y-8">
  <!-- Card 1 -->
  <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col md:flex-row">
    <img
      src="https://picsum.photos/600/400?1"
      alt="Imagen del blog"
      class="w-full md:w-1/3 h-60 md:h-auto object-cover object-center"
    />
    <div class="p-6 flex flex-col justify-between">
      <div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">
          Próximo evento: Jules Live Tour 2025
        </h3>
        <p class="text-gray-600 mb-4">
          Acompáñanos en la gira oficial, descubre fechas y lugares para nuestros próximos conciertos.
        </p>
      </div>
      <a
        href="/blog/proximo-tour"
        class="inline-block text-blue-600 hover:text-blue-800 font-semibold mt-2"
      >
        Leer más →
      </a>
    </div>
  </div>

  <!-- Card 2 -->
  <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col md:flex-row">
    <img
      src="https://picsum.photos/600/400?2"
      alt="Imagen del blog"
      class="w-full md:w-1/3 h-60 md:h-auto object-cover object-center"
    />
    <div class="p-6 flex flex-col justify-between">
      <div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">
          Nuevo producto: Playera Oficial Jules
        </h3>
        <p class="text-gray-600 mb-4">
          ¡Ya disponible la nueva merch oficial de Jules!
        </p>
      </div>
      <a
        href="/blog/playera-oficial"
        class="inline-block text-blue-600 hover:text-blue-800 font-semibold mt-2"
      >
        Leer más →
      </a>
    </div>
  </div>
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
import { Link } from '@inertiajs/vue3';
import NavigationTop from '@/Components/NavigationTop.vue';
import Carrusel from '@/Components/Carrusel.vue';
</script>
