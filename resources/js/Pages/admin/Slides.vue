<template>
    <Sidebar />
    <div class="md:ml-64 min-h-screen  bg-gray-50">
        <div class="max-w-5xl mx-auto p-6">
            <h2 class="text-2xl font-bold mb-2 text-gray-800 ">Crear Nuevo Slide</h2>
            <div class="flex md:flex-row flex-col md:space-x-2 space-y-2 md:space-y-0">
                <div class="md:basis-2/3">
                    <div class="bg-white p-8 rounded-xl shadow">
                        <form @submit.prevent="handleSubmit" class="space-y-4">
                            <div>
                                <label class="block font-semibold mb-1" for="title">Título</label>
                                <input id="title" v-model="form.title" type="text"
                                    class="w-full border-gray-300 rounded-2xl px-3 py-1 focus:ring focus:ring-blue-200"
                                    required />
                            </div>
                            <div>
                                <label class="block font-semibold mb-1" for="description">Descripción</label>
                                <textarea id="description" v-model="form.description" rows="3"
                                    class="w-full border-gray-300 rounded-2xl px-3 py-1 focus:ring focus:ring-blue-200"></textarea>
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">Imagen (jpeg, png, jpg. max:5MB)</label>
                                <input type="file" @change="handleFileChange" accept="image/*"
                                    class="w-full rounded border-gray-400 border-dashed p-3 " required />
                            </div>

                            <div v-if="preview" class="mt-4">
                                <p class="font-semibold mb-2 text-gray-700">Previsualización:</p>
                                <img :src="preview" alt="Previsualización"
                                    class="rounded shadow w-full max-h-60 object-cover" />
                            </div>

                            
                        </form>
                    </div>
                </div>
                <div class=" md:basis-1/3">
                    <div class="bg-white shadow rounded-xl p-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Opciones Slide</h3>

                    <div>
                        <label class="block font-semibold mb-1" for="active_select">Estado del slide</label>
                        <select id="active_select" v-model="form.active"
                            class="w-full border-gray-300 rounded-2xl mb-1 p-3 focus:ring focus:ring-blue-200">
                            <option :value="true">Activo</option>
                            <option :value="false">Inactivo</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1" for="cta_text_2">Texto del CTA</label>
                        <input id="cta_text_2" v-model="form.cta_text" type="text"
                            class="w-full border-gray-300 rounded-2xl  p-3 focus:ring focus:ring-blue-200" />
                    </div>

                    <div>
                        <label class="block font-semibold mb-1" for="cta_url_2">URL del CTA</label>
                        <input id="cta_url_2" v-model="form.cta_url" type="url"
                            class="w-full border-gray-300 rounded-2xl p-3 focus:ring focus:ring-blue-200" />
                    </div>
                    </div>
                </div>
            </div>
            <button type="submit"
                @click="handleSubmit"
                class=" text-blue-500 hover:text-white font-bold p-3 w-full md:w-auto hover:bg-blue-500 mt-2 rounded transition"
                :disabled="loading">
                {{ loading ? 'Guardando...' : 'Crear Slide' }}
            </button>

            <p v-if="error" class="text-red-600 text-center mt-4">{{ error }}</p>
            <p v-if="success" class="text-green-600 text-center mt-4">Slide creado exitosamente 🎉</p>
        </div>

    </div>

</template>

<script setup>
import { reactive, ref } from 'vue';
import axios from 'axios';

import Sidebar from '@/Components/Sidebar.vue';

const form = reactive({
    title: '',
    description: '',
    cta_text: '',
    cta_url: '',
    active: false,
});
const imageFile = ref(null);
const preview = ref(null);
const loading = ref(false);
const error = ref('');
const success = ref(false);

const handleFileChange = (e) => {
    imageFile.value = e.target.files[0];
    if (imageFile.value) {
        preview.value = URL.createObjectURL(imageFile.value);
    } else {
        preview.value = null;
    }
};

const handleSubmit = async () => {
    error.value = '';
    success.value = false;

    try {
        loading.value = true;
        const formData = new FormData();
        formData.append('title', form.title);
        formData.append('description', form.description);
        formData.append('cta_text', form.cta_text);
        formData.append('cta_url', form.cta_url);
        formData.append('active', form.active ? 1 : 0);
        formData.append('image', imageFile.value);
        console.log(imageFile.value);

        const response = await axios.post('/api/slides/new', formData, {
            headers: { 'Content-Type': 'multipart/form-data' },
        });

        success.value = true;
        Object.assign(form, { title: '', description: '', cta_text: '', cta_url: '', active: false });
        imageFile.value = null;
        preview.value = null;

        console.log('Slide creado:', response.data);
    } catch (e) {
        console.error(e);
        error.value = 'Ocurrió un error al guardar el slide.';
    } finally {
        loading.value = false;
    }
};
</script>
