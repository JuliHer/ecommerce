<template>
<aside :class="['w-64 bg-white shadow md:flex flex-col fixed inset-y-0 transform transition-transform z-30 duration-300 ease-in-out md:translate-x-0', sidebarOpen ? 'translate-x-0' : '-translate-x-full']">
       <div class="p-6 border-b flex justify-between items-center md:block">
        <h1 class="text-2xl font-bold text-gray-800 text-center">Admin Jules</h1>
        
      </div>
      <nav class="flex-1 p-6 space-y-4">
        <Link :href="'/'" class="block text-gray-700 hover:bg-gray-100 rounded px-4 py-2">Dashboard</Link>
        <Link :href="'/homepage'" class="block text-gray-700 hover:bg-gray-100 rounded px-4 py-2">Home Page</Link>
        <Link :href="'/tour'" class="block text-gray-700 hover:bg-gray-100 rounded px-4 py-2"> Tour </Link>
        <Link :href="'/products'" class="block text-gray-700 hover:bg-gray-100 rounded px-4 py-2">Productos</Link>
        <Link to="/orders" class="block text-gray-700 hover:bg-gray-100 rounded px-4 py-2">Pedidos</Link>
        <Link :href="'/inventory'" class="block text-gray-700 hover:bg-gray-100 rounded px-4 py-2">Inventario</Link>
        
        <Link :href="'/logout'" class="block text-red-600 hover:bg-gray-100 rounded px-4 py-2">Cerrar sesión</Link>
      </nav>
    </aside>

    <div
      v-if="sidebarOpen"
      class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"
      @click="sidebarOpen = false"
    ></div>
    <button class="text-gray-600 md:hidden absolute right-0 top-0 p-8 focus:outline-none" @click="sidebarOpen = true">
      ☰
    </button>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import {ref} from 'vue';
const sidebarOpen = ref(false)


</script>