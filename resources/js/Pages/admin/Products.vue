<template>
  <Sidebar />
  <div class="md:ml-64 min-h-screen bg-gray-50 p-6">
    

    <!-- Productos -->
    <div class="flex min-h-screen w-full md:p-8" >
        <section class="bg-white w-full rounded-xl shadow p-6">
        
        <div class="flex justify-between mb-4">
            <h3 class="text-2xl font-semibold mb-4 ">Productos</h3>
            <Link :href="'/products/new'" class="bg-blue-600 hover:bg-blue-700 text-white px-4 items-center justify-center rounded">
                Nuevo Producto
            </Link>
        </div>
        <table class="w-full table-auto text-left">
            <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Categoria</th>
                <th class="px-4 py-2">Precio</th>
                <th class="px-4 py-2">Stock</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products" :key="product.id" class="border-b hover:bg-gray-50">
                <td class="px-4 py-2">{{ product.id }}</td>
                <td class="px-4 py-2">{{ product.name }}</td>
                <td class="px-4 py-2">{{ product.category["name"] }}</td>
                <td class="px-4 py-2">{{ (product.price_with_tax).toFixed(2) }} $</td>
                <td class="px-4 py-2">{{ product.total_stock }}</td>
                <td class="px-4 py-2 space-x-2">
                <Link :href="'/product/'+product.id" class="text-blue-600 hover:underline" >Editar</Link>
                <button class="text-red-600 hover:underline" @click="deleteItem('products', product.id)">Eliminar</button>
                </td>
            </tr>
            </tbody>
        </table>
        </section>
    </div>
    


  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import Sidebar from '@/Components/Sidebar.vue'
import axios from 'axios'
import { Link } from '@inertiajs/vue3'

const products = ref([])

const loadData = async () => {
  try {
    products.value = (await axios.get('/api/products')).data
    
  } catch (e) {
    console.error('Error cargando datos:', e)
  }
}

const deleteItem = async (type, id) => {
  if (!confirm(`¿Eliminar ${type} #${id}?`)) return
  try {
    await axios.delete(`/api/${type}/${id}`)
    await loadData()
  } catch (e) {
    console.error('Error al eliminar:', e)
  }
}

onMounted(() => loadData())
</script>
