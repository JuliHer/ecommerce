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
            <div v-for="blog in blogs" :key="blog.id" class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col md:flex-row">
              <img
                :src="blog.image || 'https://picsum.photos/600/400?1'"
                alt="blog.title"
                class="w-full md:w-1/3 h-60 md:h-auto object-cover object-center"
              />
              <div class="p-6 flex flex-col justify-between">
                <div>
                  <h3 class="text-2xl font-bold text-gray-800 mb-2">
                    {{ blog.title }}
                  </h3>
                  <p class="text-gray-600 mb-4">
                    {{blog.excerpt}}
                  </p>
                </div>
                <Link
                  :href="'/blog/${blog.slug}'"
                  class="inline-block text-blue-600 hover:text-blue-800 font-semibold mt-2"
                >
                  Leer más →
              </Link>
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
import {ref, onMounted} from 'vue';
import { Link } from '@inertiajs/vue3';
import NavigationTop from '@/Components/NavigationTop.vue';
import Carrusel from '@/Components/Carrusel.vue';

const blogs = ref([]);

onMounted(async () => {
  try{
    const response = await fetch('/api/blogs');
    if(!response.ok) throw new Error('error al cargar blogs');
    blogs.value = await response.json();
  }catch(error){
    console.error('Error cargando blogs:', error);
  }
})
</script>
