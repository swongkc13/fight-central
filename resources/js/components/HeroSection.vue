<template>
  <div class="flex flex-col items-center justify-center text-center py-24 px-6">
    <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold mb-6 leading-tight">
      Welcome to <span class="text-blue-400">{{ title }}</span>
    </h1>
    <p class="text-lg sm:text-xl md:text-2xl text-zinc-300 mb-10 max-w-3xl">
      {{ subtitle }}
    </p>

    <!-- Render the Link button only if props are provided -->
    <Link
      v-if="linkText && linkHref"
      :href="linkHref"
      class="bg-blue-600 hover:bg-blue-500 text-white font-semibold px-10 py-5 rounded-xl text-lg shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-300"
    >
      {{ linkText }}
    </Link>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'

defineProps({
  title: { type: String, required: true },
  subtitle: { type: String, required: true },
  linkText: { type: String, default: "" },
  linkHref: { type: String, default: "" }
})
</script>