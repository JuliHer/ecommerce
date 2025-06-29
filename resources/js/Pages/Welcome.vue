<template>
  <div class="min-h-screen bg-gray-50 flex flex-col items-center justify-center p-6">
    <h1 class="text-5xl font-bold mb-4 text-gray-800">Bienvenido a la tienda de Jules</h1>
    <p class="text-lg mb-6 text-gray-600">Explora nuestros productos y próximos eventos.</p>
    <button
      @click="saludar"
      class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded transition"
    >
      ¡Hola!
    </button>

    <nav class="flex space-x-8 mt-10 text-blue-600">
      <inertia-link href="/blog" class="hover:underline">Inicio (Blog)</inertia-link>
      <inertia-link href="/tour" class="hover:underline">Tour</inertia-link>
      <inertia-link href="/productos" class="hover:underline">Catálogo</inertia-link>
      <inertia-link href="/contacto" class="hover:underline">Contacto</inertia-link>
    </nav>
  </div>
</template>

<script>
export default {
  methods: {
    saludar() {
      alert('¡Gracias por visitar!');
    },
  },
};
</script>
