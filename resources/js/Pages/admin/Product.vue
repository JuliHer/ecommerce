<template>
    <Sidebar />
    <div class="md:ml-64 min-h-screen bg-gray-50">
        <div class="max-w-5xl mx-auto p-6">
            <h2 class="text-2xl font-bold mb-2 text-gray-800">Crear Nuevo Producto</h2>

            <div class="flex md:flex-row flex-col md:space-x-2 space-y-2 md:space-y-0 ">
                <!-- Columna principal -->
                <div class="md:basis-2/3">
                    <div class="bg-white p-4 rounded-xl shadow space-y-4 mb-2">
                        <div>
                            <label class="block  mb-1" for="name">Nombre del producto</label>
                            <input id="name" v-model="form.name" type="text" placeholder="Camiseta de Manga Larga"
                                class="w-full border-gray-300 rounded-2xl px-3 py-1 focus:ring focus:ring-blue-200"
                                required />
                        </div>

                        <div>
                            <label class="block  mb-1" for="description">Descripción</label>
                            <textarea id="description" v-model="form.description" rows="4"
                                class="w-full border-gray-300 rounded-2xl px-3 py-1 focus:ring focus:ring-blue-200"></textarea>
                        </div>


                        <div>
                            <label class="block  mb-1 ">Imagen principal</label>
                            <input type="file" @change="handleFileChange" accept="image/*" multiple
                                class="w-full rounded-2xl border-gray-400 border border-dashed px-3 py-6" />
                        </div>

                        <div v-if="previews.length" class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div v-for="(src, index) in previews" :key="index" class="relative">
                                <img :src="src" alt="Previsualización"
                                    class="rounded shadow w-full  aspect-square object-cover" />
                                <button type="button" @click="removeImage(index)"
                                    class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-700">
                                    ✕
                                </button>
                            </div>
                        </div>






                    </div>
                    <div class="bg-white p-4 rounded-xl shadow space-y-4 mb-2">
                        <p class="font-semibold mb-1">Precios</p>
                        <div class="flex space-x-2">
                            <div class="w-1/2">
                                <label class="block  mb-1" for="price">Precio</label>
                                <input id="price" v-model="form.price" placeholder="0.00 $" type="number" min="0"
                                    class="w-full border-gray-300 rounded-2xl px-3 py-1 focus:ring focus:ring-blue-200" />
                            </div>
                            <div class="w-1/2">
                                <label class="block  mb-1" for="cost">Costo</label>
                                <input id="cost" v-model="form.cost" placeholder="0.00 $" type="number" min="0"
                                    class="w-full border-gray-300 rounded-2xl px-3 py-1 focus:ring focus:ring-blue-200" />
                            </div>
                        </div>
                        <div class="flex space-x-2 border-t">
                            <div class="w-1/2">
                                <label class="block  mb-1" for="price">Beneficio</label>
                                <p class="w-full border-gray-300 border text-gray-500 rounded-2xl px-3 py-1">
                                    {{ benefits }} $
                                </p>

                            </div>
                            <div class="w-1/2">
                                <label class="block  mb-1" for="cost">Margen</label>
                                <p class="w-full border-gray-300 border text-gray-500 rounded-2xl px-3 py-1">
                                    {{ marge }} %
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow space-y-4 mb-2">
                        <p class="block mb-1 font-semibold">Envío</p>
                        <div>
                            <label class="block  mb-1" for="weight">Peso (kg)</label>
                            <input id="weight" v-model="form.weight" type="number" placeholder="0.0" step="0.01" min="0"
                                class="w-full border-gray-300 rounded-2xl px-3 py-1 focus:ring focus:ring-blue-200" />
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow space-y-4 mb-2">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800  mb-2">Variantes</h3>
                            <div v-for="(variant, index) in form.variants" :key="index" class="border rounded p-3 mb-2">
                                <div class="flex justify-between items-center">
                                    <strong>Variante {{ index + 1 }}</strong>
                                    <button type="button" @click="removeVariant(index)"
                                        class="text-red-600 hover:underline">Eliminar</button>
                                </div>
                                <input v-model="variant.name" type="text" placeholder="Nombre de la variante"
                                    class="w-full border-gray-300 rounded-2xl p-2 mb-2 focus:ring focus:ring-blue-200" />
                                <input v-model="variant.sku" type="text" placeholder="SKU"
                                    class="w-full border-gray-300 rounded-2xl p-2 mb-2 focus:ring focus:ring-blue-200" />
                                <input v-model="variant.price_modifier" type="number"
                                    placeholder="Modificador de precio"
                                    class="w-full border-gray-300 rounded-2xl p-2 mb-2 focus:ring focus:ring-blue-200" />
                                <input v-model="variant.stock" type="number" placeholder="Stock"
                                    class="w-full border-gray-300 rounded-2xl p-2 mb-2 focus:ring focus:ring-blue-200" />
                            </div>
                            <button type="button" @click="addVariant" class="text-sm text-blue-600 hover:underline">+
                                Agregar variante</button>
                        </div>
                    </div>
                </div>

                <!-- Columna opciones -->
                <div class="md:basis-1/3">

                    <div class="bg-white shadow rounded-xl p-4 space-y-4 mb-2">
                        <div>
                            <label class="block  mb-1" for="category">Categoría</label>
                            <select id="category" v-model="form.category_id"
                                class="w-full border-gray-300 rounded p-3 focus:ring focus:ring-blue-200" required>
                                <option disabled value="">Selecciona una categoría</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                            <button v-if="!creatingCategory" type="button" @click="creatingCategory = true"
                                class="text-sm text-blue-600 hover:underline mt-2">+ Crear nueva categoría</button>
                        </div>
                        <div v-if="creatingCategory" class="mt-6 border-t pt-4">
                            <h4 class=" mb-2 text-gray-700">Nueva Categoría</h4>
                            <input type="text" v-model="newCategory.name" placeholder="Nombre de la categoría"
                                class="w-full border-gray-300 rounded-2xl p-3 mb-2 focus:ring focus:ring-blue-200" />
                            <textarea v-model="newCategory.description" rows="2" placeholder="Descripción"
                                class="w-full border-gray-300 rounded-2xl p-3 mb-2 focus:ring focus:ring-blue-200"></textarea>
                            <button @click="createCategory" type="button"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded transition">
                                Guardar categoría
                            </button>
                        </div>

                        <div>
                            <label class="block  mb-1" for="tax">Impuesto</label>
                            <select id="tax" v-model="form.tax_id"
                                class="w-full border-gray-300 rounded p-3 focus:ring focus:ring-blue-200" required>
                                <option disabled value="">Selecciona un impuesto</option>
                                <option v-for="tax in taxes" :key="tax.id" :value="tax.id">{{ tax.name }}</option>
                            </select>
                            <button v-if="!creatingTax" type="button" @click="creatingTax = true"
                                class="text-sm text-blue-600 hover:underline mt-2">+ Crear nuevo Impuesto</button>
                        </div>
                        <div v-if="creatingTax" class="mt-6 border-t pt-4">
                            <h4 class=" mb-2 text-gray-700">Nuevo Impuesto</h4>
                            <input type="text" v-model="newTax.name" placeholder="Nombre del impuesto"
                                class="w-full border-gray-300 rounded-2xl p-3 mb-2 focus:ring focus:ring-blue-200" />
                            <input type="number" v-model="newTax.percentage" placeholder="percentage %"
                                class="w-full border-gray-300 rounded-2xl p-3 mb-2 focus:ring focus:ring-blue-200" />
                            <textarea v-model="newTax.description" rows="2" placeholder="Descripción"
                                class="w-full border-gray-300 rounded-2xl p-3 mb-2 focus:ring focus:ring-blue-200"></textarea>
                            <button @click="createTax" type="button"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded transition">
                                Guardar proveedor
                            </button>
                        </div>

                        <div>
                            <label class="block  mb-1" for="provider">Proveedor</label>
                            <select id="provider" v-model="form.provider_id"
                                class="w-full border-gray-300 rounded p-3 focus:ring focus:ring-blue-200" required>
                                <option disabled value="">Selecciona un proveedor</option>
                                <option v-for="provider in providers" :key="provider.id" :value="provider.id">{{
                                    provider.name }}</option>
                            </select>
                            <button v-if="!creatingProvider" type="button" @click="creatingProvider = true"
                                class="text-sm text-blue-600 hover:underline mt-2">+ Crear nuevo proveedor</button>
                        </div>



                        <div v-if="creatingProvider" class="mt-6 border-t pt-4">
                            <h4 class=" mb-2 text-gray-700">Nuevo Proveedor</h4>
                            <input type="text" v-model="newProvider.name" placeholder="Nombre del proveedor"
                                class="w-full border-gray-300 rounded-2xl p-3 mb-2 focus:ring focus:ring-blue-200" />
                            <input type="email" v-model="newProvider.contact_email" placeholder="Email de contacto"
                                class="w-full border-gray-300 rounded-2xl p-3 mb-2 focus:ring focus:ring-blue-200" />
                            <input type="text" v-model="newProvider.phone" placeholder="Teléfono"
                                class="w-full border-gray-300 rounded-2xl p-3 mb-2 focus:ring focus:ring-blue-200" />
                            <button @click="createProvider" type="button"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded transition">
                                Guardar proveedor
                            </button>
                        </div>
                    </div>
                    <div class="bg-white shadow rounded-xl p-4 space-y-4">
                        <select id="active_select" v-model="form.active"
                            class="w-full border-gray-300 rounded p-3 focus:ring focus:ring-blue-200">
                            <option :value="true">Activo</option>
                            <option :value="false">Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" @click="handleSubmit"
                class="text-blue-500 hover:text-white font-bold p-3 w-full md:w-auto hover:bg-blue-500 mt-2 rounded transition"
                :disabled="loading">
                {{ loading ? 'Guardando...' : 'Crear Producto' }}
            </button>

            <p v-if="error" class="text-red-600 text-center mt-4">{{ error }}</p>
            <p v-if="success" class="text-green-600 text-center mt-4">¡Producto creado exitosamente 🎉!</p>
        </div>
    </div>
</template>
<script setup>
import { reactive, ref, onMounted, computed } from 'vue';
import axios from 'axios';
import Sidebar from '@/Components/Sidebar.vue';

const form = reactive({
    name: '',
    description: '',
    active: false,
    price: '',
    cost: '',
    weight: '',
    image: null,
    category_id: '',
    tax_id: '',
    provider_id: '',
    variants: [],
});

const benefits = computed(() => {
    const price = parseFloat(form.price) || 0;
    const cost = parseFloat(form.cost) || 0;
    return (price - cost).toFixed(2);
});

const marge = computed(() => {
    const price = parseFloat(form.price) || 0;
    const profit = price - (parseFloat(form.cost) || 0);
    return price > 0 ? ((profit / price) * 100).toFixed(2) : 0;
});
const images = ref([]);      // Guardar los archivos seleccionados
const previews = ref([]);    // Guardar las URLs para previsualización
const loading = ref(false);
const error = ref('');
const success = ref(false);

const categories = ref([]);
const taxes = ref([]);
const providers = ref([]);

const creatingCategory = ref(false);
const creatingProvider = ref(false);
const creatingTax = ref(false);

const newCategory = reactive({ name: '', description: '' });
const newTax = reactive({ name: '', percentage: 0, description: '' });
const newProvider = reactive({ name: '', contact_email: '', phone: '', address: '' });

onMounted(async () => {
    try {
        const [catRes, taxRes, provRes] = await Promise.all([
            axios.get('/api/categories'),
            axios.get('/api/taxes'),
            axios.get('/api/providers'),
        ]);
        categories.value = catRes.data;
        taxes.value = taxRes.data;
        providers.value = provRes.data;
    } catch (e) {
        console.error(e);
    }
});


const handleFileChange = (e) => {
    const files = Array.from(e.target.files);

    // Validar número máximo
    if (files.length + images.value.length > 5) {
        alert('Solo puedes subir un máximo de 5 imágenes.');
        e.target.value = '';
        return;
    }

    files.forEach(file => {
        images.value.push(file);
        previews.value.push(URL.createObjectURL(file));
    });

    // Limpiar el input para permitir volver a subir las mismas imágenes si se eliminan
    e.target.value = '';
};

const removeImage = (index) => {
    images.value.splice(index, 1);
    previews.value.splice(index, 1);
};

const addVariant = () => {
    form.variants.push({
        name: '',
        sku: '',
        price_modifier: 0,
        stock: 0,
        weight_modifier: 0,
    });
};

const removeVariant = (index) => {
    form.variants.splice(index, 1);
};

const handleSubmit = async () => {
    error.value = '';
    success.value = false;
    try {
        loading.value = true;
        const formData = new FormData();
        formData.append('name', form.name);
        formData.append('description', form.description);
        formData.append('price', form.price);
        formData.append('cost', form.cost);
        formData.append('weight', form.weight);
        formData.append('category_id', form.category_id);
        formData.append('tax_id', form.tax_id);
        formData.append('provider_id', form.provider_id);
        images.value.forEach((file, idx) => {
            formData.append(`images[${idx}]`, file);
        });

        formData.append('variants', JSON.stringify(form.variants));

        await axios.post('/api/products', formData, { headers: { 'Content-Type': 'multipart/form-data' } });

        success.value = true;
        resetForm();
    } catch (e) {
        console.error(e);
        error.value = 'Ocurrió un error al crear el producto.';
    } finally {
        loading.value = false;
    }
};

const createTax = async () => {
    try {
        const res = await axios.post('/api/taxes', newTax);
        taxes.value.push(res.data);
        form.tax_id = res.data.id;
        Object.assign(newTax, { name: '', percentage: 0, description: '' });
        creatingTax.value = false;
    } catch (e) {
        console.error(e);
        alert('No se pudo crear la categoría.');
    }
};

const createCategory = async () => {
    try {
        const res = await axios.post('/api/categories', newCategory);
        categories.value.push(res.data);
        form.category_id = res.data.id;
        Object.assign(newCategory, { name: '', description: '' });
        creatingCategory.value = false;
    } catch (e) {
        console.error(e);
        alert('No se pudo crear la categoría.');
    }
};

const createProvider = async () => {
    try {
        const res = await axios.post('/api/providers', newProvider);
        providers.value.push(res.data);
        form.provider_id = res.data.id;
        Object.assign(newProvider, { name: '', contact_email: '', phone: '', address: '' });
        creatingProvider.value = false;
    } catch (e) {
        console.error(e);
        alert('No se pudo crear el proveedor.');
    }
};

const resetForm = () => {
    Object.assign(form, {
        name: '',
        description: '',
        active: false,
        price: '',
        cost: '',
        weight: '',
        image: null,
        category_id: '',
        tax_id: '',
        provider_id: '',
        variants: [],
    });
    previews.value = [];
};
</script>
