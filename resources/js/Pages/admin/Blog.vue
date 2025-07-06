<template>
  <Sidebar />
  <div class="md:ml-64 min-h-screen bg-gray-50">
    <div class="max-w-5xl mx-auto p-6">
      <h2 class="text-2xl font-bold mb-2 text-gray-800">Crear Nuevo Blog Post</h2>

      <div class="flex md:flex-row flex-col md:space-x-2 space-y-2 md:space-y-0">
        <!-- Columna principal -->
        <div class="md:basis-2/3">
          <div class="bg-white p-8 rounded-xl shadow">
            <form @submit.prevent="handleSubmit" class="space-y-4">
              <div>
                <label class="block font-semibold mb-1" for="title">Título</label>
                <input id="title" v-model="form.title" type="text"
                  class="w-full border-gray-300 rounded-2xl px-3 py-1 focus:ring focus:ring-blue-200" required />
              </div>

              <div>
                <label class="block font-semibold mb-1" for="excerpt">Excerpt (resumen corto)</label>
                <textarea id="excerpt" v-model="form.excerpt" rows="2"
                  class="w-full border-gray-300 rounded-2xl px-3 py-1 focus:ring focus:ring-blue-200"></textarea>
              </div>

              <div>
                <label class="block font-semibold mb-1" for="content">Contenido</label>
                <textarea id="content" v-model="form.content" rows="6"
                  class="w-full border-gray-300 rounded-2xl px-3 py-1 focus:ring focus:ring-blue-200"></textarea>
              </div>

              <div>
                <label class="block font-semibold mb-1">Imagen (jpeg, png, jpg. max:5MB)</label>
                <input type="file" @change="handleFileChange" accept="image/*"
                  class="w-full rounded border-gray-400 border-dashed p-3" required />
              </div>

              <div v-if="preview" class="mt-4">
                <p class="font-semibold mb-2 text-gray-700">Previsualización:</p>
                <img :src="preview" alt="Previsualización" class="rounded shadow w-full max-h-60 object-cover" />
              </div>
            </form>
          </div>
        </div>

        <!-- Columna opciones -->
        <div class="md:basis-1/3">
          <div class="bg-white shadow rounded-xl p-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Opciones del Post</h3>

            <div>
              <label class="block font-semibold mb-1" for="category">Categoría</label>
              <select id="category" v-model="form.category_id"
                class="w-full border-gray-300 rounded-2xl p-3 focus:ring focus:ring-blue-200">
                <option disabled value="">Selecciona una categoría</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                  {{ category.name }}
                </option>
              </select>
              <button type="button" @click="creatingCategory = true"
                class="text-sm text-blue-600 hover:underline mt-2">+ Crear nueva categoría</button>
            </div>

            <div class="mt-4">
              <label class="block font-semibold mb-1" for="published">Estado</label>
              <select id="published" v-model="form.published"
                class="w-full border-gray-300 rounded-2xl p-3 focus:ring focus:ring-blue-200">
                <option :value="true">Publicado</option>
                <option :value="false">Borrador</option>
              </select>
            </div>

            <div v-if="creatingCategory" class="mt-6 border-t pt-4">
              <h4 class="font-semibold mb-2 text-gray-700">Nueva Categoría</h4>
              <input type="text" v-model="newCategory.name" placeholder="Nombre de la categoría"
                class="w-full border-gray-300 rounded-2xl p-3 mb-2 focus:ring focus:ring-blue-200" />
              <textarea v-model="newCategory.description" rows="2" placeholder="Descripción"
                class="w-full border-gray-300 rounded-2xl p-3 mb-2 focus:ring focus:ring-blue-200"></textarea>
              <button @click="createCategory" type="button"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded transition">
                Guardar categoría
              </button>
            </div>
          </div>
        </div>
      </div>

      <button type="submit" @click="handleSubmit"
        class="text-blue-500 hover:text-white font-bold p-3 w-full md:w-auto hover:bg-blue-500 mt-2 rounded transition"
        :disabled="loading">
        {{ loading ? 'Guardando...' : 'Crear Post' }}
      </button>

      <p v-if="error" class="text-red-600 text-center mt-4">{{ error }}</p>
      <p v-if="success" class="text-green-600 text-center mt-4">¡Post creado exitosamente 🎉!</p>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref, onMounted } from 'vue';
import axios from 'axios';
import Sidebar from '@/Components/Sidebar.vue';

const form = reactive({
  category_id: '',
  title: '',
  slug: '',
  excerpt: '',
  content: '',
  published: false,
});
const imageFile = ref(null);
const preview = ref(null);
const loading = ref(false);
const error = ref('');
const success = ref(false);

const categories = ref([]);
const creatingCategory = ref(false);
const newCategory = reactive({ name: '', description: '' });

onMounted(async () => {
  try {
    const res = await axios.get('/api/blog-categories');
    categories.value = res.data;
  } catch (e) {
    console.error(e);
  }
});

const handleFileChange = (e) => {
  imageFile.value = e.target.files[0];
  preview.value = imageFile.value ? URL.createObjectURL(imageFile.value) : null;
};

const handleSubmit = async () => {
  error.value = '';
  success.value = false;

  try {
    loading.value = true;
    const formData = new FormData();
    formData.append('category_id', form.category_id);
    formData.append('title', form.title);
    formData.append('slug', form.title.toLowerCase().replace(/\s+/g, '-'));
    formData.append('excerpt', form.excerpt);
    formData.append('content', form.content);
    formData.append('published', form.published ? 1 : 0);
    formData.append('image', imageFile.value);

    await axios.post('/api/blog-posts', formData, { headers: { 'Content-Type': 'multipart/form-data' } });

    success.value = true;
    Object.assign(form, { category_id: '', title: '', slug: '', excerpt: '', content: '', published: false });
    imageFile.value = null;
    preview.value = null;
  } catch (e) {
    console.error(e);
    error.value = 'Ocurrió un error al guardar el post.';
  } finally {
    loading.value = false;
  }
};

const createCategory = async () => {
  try {
    const res = await axios.post('/api/blog-categories', newCategory);
    categories.value.push(res.data);
    form.category_id = res.data.id;
    Object.assign(newCategory, { name: '', description: '' });
    creatingCategory.value = false;
  } catch (e) {
    console.error(e);
    alert('No se pudo crear la categoría.');
  }
};
</script>
