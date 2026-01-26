<template>
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 text-gray-800 p-6">
    <h1 class="text-5xl font-extrabold mb-4 text-center">
      Welcome to Fight Central
    </h1>
    <p class="text-lg text-gray-600 mb-8 text-center max-w-xl">
      Browse MMA fighters, see their stats and details — built with Laravel, Inertia, Vue and Tailwind!
    </p>

    <!-- Big Button Link -->
    <Link
      href="/fighters"
      class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-4 rounded-lg text-lg shadow-md transition"
    >
      View Fighters
    </Link>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>
