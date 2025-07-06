<template>
  <Sidebar />
  <div class="md:ml-64 min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto p-6">
      <h2 class="text-2xl font-bold mb-2 text-gray-800">Editar Producto</h2>

      <div v-if="loading" class="text-center text-gray-600">Cargando producto...</div>

      <div v-else class="flex flex-col md:flex-row md:space-x-4">
        <!-- Columna principal -->
        <div class="md:basis-2/3 space-y-4">
          <div class="bg-white p-4 rounded-xl shadow space-y-4">
            <div>
              <label class="block mb-1 font-semibold text-gray-700">Nombre del producto</label>
              <p class="border rounded-2xl p-2 text-gray-600">{{ product.name }}</p>
            </div>

            <div>
              <p class="block mb-1 font-semibold text-gray-700">Imágenes del producto</p>
              <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <div v-for="image in product.images" :key="image.id">
                  <img :src="image.URL" alt="Imagen producto" class="rounded shadow w-full aspect-square object-cover" />
                </div>
              </div>
            </div>
          </div>

          <div class="bg-white p-4 rounded-xl shadow space-y-4">
            <p class="font-semibold mb-1 text-gray-700">Precios</p>
            <div class="flex space-x-2">
              <div class="w-1/2">
                <label class="block mb-1" for="price">Precio</label>
                <input id="price" v-model="form.price" type="number" min="0" step="0.01"
                  class="w-full border-gray-300 rounded-2xl px-3 py-1 focus:ring focus:ring-blue-200" />
              </div>
              <div class="w-1/2">
                <label class="block mb-1" for="cost">Costo</label>
                <input id="cost" v-model="form.cost" type="number" min="0" step="0.01"
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

          <div class="bg-white p-4 rounded-xl shadow space-y-4">
            <div>
              <h3 class="text-xl font-bold text-gray-800 mb-2">Variantes</h3>
              <div v-for="(variant, index) in form.variants" :key="variant.id ?? index" class="border rounded p-3 mb-2">
                <div class="flex justify-between items-center">
                  <strong>Variante {{ index + 1 }}</strong>
                  <button type="button" @click="removeVariant(index)" class="text-red-600 hover:underline">Eliminar</button>
                </div>
                <input v-model="variant.name" type="text" placeholder="Nombre de la variante"
                  class="w-full border-gray-300 rounded-2xl p-2 mb-2 focus:ring focus:ring-blue-200" />
                <input v-model="variant.sku" type="text" placeholder="SKU"
                  class="w-full border-gray-300 rounded-2xl p-2 mb-2 focus:ring focus:ring-blue-200" />
                <input v-model="variant.price_modifier" type="number" placeholder="Modificador de precio"
                  class="w-full border-gray-300 rounded-2xl p-2 mb-2 focus:ring focus:ring-blue-200" />
                <input v-model="variant.stock" type="number" placeholder="Stock"
                  class="w-full border-gray-300 rounded-2xl p-2 mb-2 focus:ring focus:ring-blue-200" />
              </div>
              <button type="button" @click="addVariant" class="text-sm text-blue-600 hover:underline">
                + Agregar variante
              </button>
            </div>
          </div>
        </div>

        <!-- Columna proveedor -->
        <div class="md:basis-1/3">
          <div class="bg-white shadow rounded-xl p-4 space-y-4">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Proveedor</h3>
            <div v-if="product.provider">
              <p><strong>Nombre:</strong> {{ product.provider.name }}</p>
              <p><strong>Email:</strong> {{ product.provider.contact_email }}</p>
              <p><strong>Teléfono:</strong> {{ product.provider.phone }}</p>
            </div>
            <div v-else>
              <p class="text-gray-500">Este producto no tiene proveedor asignado.</p>
            </div>
          </div>
        </div>
      </div>

      <button @click="handleSubmit"
        class="bg-blue-500 text-white font-bold px-4 py-2 rounded mt-4 hover:bg-blue-600 transition"
        :disabled="submitting">
        {{ submitting ? 'Guardando...' : 'Guardar Cambios' }}
      </button>

      <p v-if="error" class="text-red-600 mt-4">{{ error }}</p>
      <p v-if="success" class="text-green-600 mt-4">¡Producto actualizado exitosamente 🎉!</p>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted, computed } from 'vue';
import axios from 'axios';
import Sidebar from '@/Components/Sidebar.vue';

const props = defineProps({
    productId: Number,
    // o si pasaste el producto completo:
    // product: Object,
});
const product = ref({});
const form = reactive({
  price: '',
  cost: '',
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

const loading = ref(true);
const submitting = ref(false);
const error = ref('');
const success = ref(false);

onMounted(async () => {
  try {
    const { data } = await axios.get(`/api/products/${props.productId}`);
    console.log(data);
    product.value = data;
    form.price = data.price;
    form.cost = data.cost;
    form.variants = data.variants.map(v => ({ ...v })); // copia para edición
  } catch (e) {
    console.error(e);
    error.value = 'Error al cargar el producto.';
  } finally {
    loading.value = false;
  }
});

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
    submitting.value = true;
    const payload = {
      price: form.price,
      cost: form.cost,
      variants: form.variants,
    };
    await axios.put(`/api/products/${props.productId}`, payload);
    success.value = true;
  } catch (e) {
    console.error(e);
    error.value = 'Ocurrió un error al actualizar el producto.';
  } finally {
    submitting.value = false;
  }
};
</script>
