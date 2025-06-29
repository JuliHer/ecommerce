<template>
  <div class="w-full overflow-hidden">
    <Swiper
      :loop="true"
      :autoplay="{ delay: 3000 }"
      :pagination="{ clickable: true }"
      class="overflow-hidden shadow"
    >
      <SwiperSlide>
        <div class="w-full relative h-[30vh] md:h-[60vh]">
          <img src="https://picsum.photos/id/1/1920/1080" alt="Slide 1" class="w-full h-full object-cover object-center" />

          <div class="hidden md:flex absolute bottom-4 right-4 bg-white text-black text-lg rounded-lg px-4 py-2 shadow">
            Bienvenido a Jules Ecommerce 🚀
          </div>
        </div>
        <div class="w-full md:hidden text-black text-lg px-4 py-2 ">
          Bienvenido a Jules Ecommerce 🚀
        </div>
      </SwiperSlide>
      <SwiperSlide>
        <div class="w-full relative h-[30vh] md:h-[60vh]">
          <img src="https://picsum.photos/id/2/1920/1080" alt="Slide 1" class="w-full h-full object-cover object-center" />

          <div class="hidden md:flex absolute bottom-4 right-4 bg-white text-black text-lg rounded-lg px-4 py-2 shadow">
            Bienvenido a Jules Ecommerce 🚀
          </div>
        </div>
        <div class="w-full md:hidden text-black text-lg px-4 py-2 ">
          Bienvenido a Jules Ecommerce 🚀
        </div>
      </SwiperSlide>
      <SwiperSlide>
        <div class="w-full relative h-[30vh] md:h-[60vh]">
          <img src="https://picsum.photos/id/3/1920/1080" alt="Slide 1" class="w-full h-full object-cover object-center" />

          <div class="hidden md:flex absolute bottom-4 right-4 bg-white text-black text-lg rounded-lg px-4 py-2 shadow">
            Bienvenido a Jules Ecommerce 🚀
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
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/pagination';
</script>
