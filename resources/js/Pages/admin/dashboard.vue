<template>
  <div class="min-h-screen flex bg-gray-100">
    <!-- Sidebar -->
    <Sidebar />
    <!-- Main content -->
    <div class="flex-1 md:ml-64 p-8 space-y-8">
    
      <!-- Título -->
      <h2 class="text-3xl font-bold text-gray-800">Dashboard</h2>

      <!-- Cards de métricas -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
          <h3 class="text-xl font-semibold text-gray-700 mb-2">Productos</h3>
          <p class="text-3xl font-bold text-blue-600">{{ stats.products }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
          <h3 class="text-xl font-semibold text-gray-700 mb-2">Pedidos</h3>
          <p class="text-3xl font-bold text-green-600">{{ stats.orders }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
          <h3 class="text-xl font-semibold text-gray-700 mb-2">Clientes</h3>
          <p class="text-3xl font-bold text-purple-600">{{ stats.users }}</p>
        </div>
      </div>

      <!-- Secciones rápidas -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition flex flex-col">
          <h3 class="text-xl font-semibold text-gray-700 mb-4">Últimos Pedidos</h3>
          <ul class="space-y-2">
            <li v-for="order in recentOrders" :key="order.id" class="flex justify-between text-gray-600">
              <span>{{ order.client }}</span>
              <span class="font-semibold text-green-600">${{ order.total }}</span>
            </li>
          </ul>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition flex flex-col">
          <h3 class="text-xl font-semibold text-gray-700 mb-4">Acciones rápidas</h3>
          <div class="flex flex-wrap gap-4">
            <router-link to="/admin/products" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">Gestionar productos</router-link>
            <router-link to="/admin/orders" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition">Ver pedidos</router-link>
            <router-link to="/admin/blog" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded transition">Publicar blog</router-link>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="text-gray-600 text-center py-4 mt-8">
        © {{ new Date().getFullYear() }} Jules Ecommerce Admin. Todos los derechos reservados.
      </footer>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { reactive } from 'vue';
import Sidebar from '@/Components/Sidebar.vue';

const stats = reactive({
  products: 120,
  orders: 54,
  users: 340,
});

const recentOrders = [
  { id: 1, client: 'Juan Pérez', total: 250 },
  { id: 2, client: 'Ana Gómez', total: 99 },
  { id: 3, client: 'Carlos Díaz', total: 180 },
];
</script>
