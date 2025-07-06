<template>
    <Sidebar />
    <div class="  md:ml-64 bg-gray-50 p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Home Page</h1>
        
        <!-- Slides del Carrusel -->
        <section class="m-5 bg-white shadow p-6 mb-4 rounded-xl  flex-1">
            <header class="flex justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-700">Slides del Carrusel</h2>
                <Link :href="'/new/slide'" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">Nuevo</Link>
            </header>

            <ul v-if="slides.length" class="divide-y">
                <li v-for="slide in slides" :key="slide.id" class="py-4 flex justify-between items-center">
                <div>
                    <strong>{{ slide.title }}</strong>
                    <p class="text-gray-600">{{ slide.description }}</p>
                </div>
                <div class="space-x-2">
                    <button @click="editSlide(slide)" class="text-blue-600 hover:underline">{{ slide.active ? 'Desactivar' : 'Activar' }}</button>
                    <button @click="deleteSlide(slide)" class="text-red-600 hover:underline">Eliminar</button>
                </div>
                </li>
            </ul>
            <p v-else class="text-gray-500">No hay slides registrados.</p>
        </section>
        <!-- Categorías del Blog -->
      
        <!-- Posts del Blog -->
        <section class="m-5 bg-white shadow p-6 mb-4 rounded-xl  flex-1">
        <header class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-700">Posts del Blog</h2>
            <Link :href="'/blog/new'" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">Nuevo</Link>
        </header>

        <ul v-if="posts.length" class="divide-y">
            <li v-for="post in posts" :key="post.id" class="py-4 flex flex-col md:flex-row justify-between items-center">
            <div>
                <strong>{{ post.title }}</strong>
                <p class="text-gray-600">{{ post.excerpt }}</p>
            </div>
            <div class="space-x-2">
                <button @click="editPost(post.id)" class="text-blue-600 hover:underline">Editar</button>
                <button @click="deletePost(post.id)" class="text-red-600 hover:underline">Eliminar</button>
            </div>
            </li>
        </ul>
        <p v-else class="text-gray-500">No hay posts registrados.</p>
        </section>

        
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import axios from 'axios';
import Sidebar from '@/Components/Sidebar.vue';


const categories = ref([]);
const posts = ref([]);
const slides = ref([]);


const fetchPosts = async () => {
  try {
    const { data } = await axios.get('/api/blog-posts');
    posts.value = data;
  } catch (e) {
    console.error('Error cargando posts', e);
  }
};

const fetchSlides = async () => {
  try {
    const { data } = await axios.get('/api/slides');
    slides.value = data;
  } catch (e) {
    console.error('Error cargando slides', e);
  }
};

const editPost = (post) => {
  console.log('Editar post', post);
};

const deletePost = async (id) => {
  await axios.delete(`/admin/homepage/posts/${id}`);
  fetchPosts();
};

const editSlide = async (slide) => {
  
  await axios.post(`/api/slides/update`, slide);
  fetchSlides();
};

const deleteSlide = async (slide) => {
  await axios.post(`/api/slides/delete`, slide);
  fetchSlides();
};

onMounted(() => {
  fetchPosts();
  fetchSlides();
});
</script>
