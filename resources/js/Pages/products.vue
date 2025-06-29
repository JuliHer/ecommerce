<template>
  <div class="min-h-screen bg-gray-50 flex flex-col">
    <!-- Header -->
     <NavigationTop />

    <!-- Hero Section -->
    <main class="flex-grow flex flex-col container mx-auto py-16 px-6">
        <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
            Productos
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Producto 1 -->
            <div class="rounded-3xl border-2 p-4">
                <img src="https://picsum.photos/600/600" alt="Producto 1" class="w-full aspect-[1/1] object-cover rounded-2xl" />
                <h3 class="text-lg font-semibold mt-4">Producto 1</h3>
                <p class="text-gray-600">$25.00</p>
                <button class="mt-4 w-full rounded-2xl border-2 border-blue-500 text-blue-500 py-2 px-4 hover:text-white hover:bg-blue-700 transition">Comprar</button>
            </div>

            <!-- Producto 2 -->
            <div class="bg-white rounded-lg shadow p-4">
            <img src="https://picsum.photos/600/600?2" alt="Producto 2" class="w-full aspect-[1/1] object-cover rounded" />
            <h3 class="text-lg font-semibold mt-4">Producto 2</h3>
            <p class="text-gray-600">$30.00</p>
            <button class="mt-4 bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">Comprar</button>
            </div>

            <!-- Producto 3 -->
            <div class="bg-white rounded-lg shadow p-4">
            <img src="https://picsum.photos/600/600?3" alt="Producto 3" class="w-full aspect-[1/1] object-cover rounded" />
            <h3 class="text-lg font-semibold mt-4">Producto 3</h3>
            <p class="text-gray-600">$20.00</p>
            <button class="mt-4 bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">Comprar</button>
            </div>

            <!-- Puedes seguir agregando productos -->
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
</script>
