<template>
  <div class="w-full overflow-hidden">
    <Swiper
      :loop="true"
      :autoplay="{ delay: 3000 }"
      :pagination="{ clickable: true }"
      class="overflow-hidden shadow"
    >
      <SwiperSlide v-for="slide in slides" :key="slide.id">
        <div class="w-full relative h-[30vh] md:h-[60vh]">
          <img :src="slide.image" alt="Slide image" class="w-full h-full object-cover object-center" />

          <div class="hidden md:flex absolute bottom-4 right-4 bg-white text-black text-lg rounded-lg px-4 py-2 shadow">
            <h2 class="font-bold">{{ slide.title }}</h2>
            <p>{{ slide.description }}</p>
            <a v-if="slide.cta_url" :href="slide.cta_url" class="inline-block text-blue-600 hover:text-blue-800 font-semibold mt-2">
              {{ slide.cta_text || 'Ver más' }}
            </a>
          </div>
        </div>
        <div class="w-full md:hidden text-black text-lg px-4 py-2 ">
          Bienvenido a Jules Ecommerce 🚀
        </div>
      </SwiperSlide>
      
    </Swiper>
  </div>
</template>

<script setup>
import {ref, onMounted } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';

import 'swiper/css';
import 'swiper/css/pagination';

const slides = ref([]);

onMounted(async () => {
  try{
    const response = await fetch('/api/carousel');
    slides.value = await response.json();
  } catch (error) {
    console.error('Error al cargar los slides: ', error);
  }
})
</script>
