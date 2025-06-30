<template>
  <div class="min-h-screen bg-gray-50 flex flex-col">
    <NavigationTop />

    <main class="flex-grow container mx-auto py-16 px-6 max-w-4xl">
      <article class="bg-white rounded-3xl shadow p-8">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
          {{ blog.title }}
        </h1>

        <img
          :src="blog.image ?? 'https://via.placeholder.com/800x600'"
          :alt="blog.title"
          class="w-full aspect-video object-cover object-center rounded-2xl mb-6"
        />

        <div class="prose max-w-none" v-html="blog.content"></div>
      </article>
    </main>

    <FooterPage/>
  </div>
</template>

<script setup>
import {NavigationTop, FooterPage} from '@/Components/NavigationTop.vue';
defineProps({ blog: Object });
</script>
