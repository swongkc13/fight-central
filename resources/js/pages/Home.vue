<template>
  <div
    class="min-h-screen flex flex-col items-center justify-center bg-zinc-900 text-zinc-100 p-6 relative overflow-hidden">
    <div
      class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-600/20 rounded-full blur-3xl pointer-events-none">
    </div>
    <h1 class="text-5xl font-extrabold mb-4 text-center">
      Welcome to Fight Central
    </h1>
    <p class="text-lg text-gray-600 mb-8 text-center max-w-xl">
      Browse MMA fighters, see their stats and details — built with Laravel, Inertia, Vue and Tailwind!
    </p>

    <!-- Big Button Link -->
    <Link href="/fighters"
      class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-4 rounded-lg text-lg shadow-md transition">
      View Fighters
    </Link>
  </div>
</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'

defineOptions({
  layout: AppLayout,
})
</script>
