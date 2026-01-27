<template>
  <div class="min-h-screen bg-zinc-900 text-zinc-100 p-8">
    <!-- Back Button -->
    <button @click="goBack"
      class="mb-6 px-4 py-2 bg-zinc-800 hover:bg-zinc-700 text-blue-400 rounded-lg shadow-sm hover:shadow-md transition">
      ← Back
    </button>

    <!-- Fighter Card -->
    <div class="flex flex-col md:flex-row md:space-x-10 bg-zinc-800 rounded-xl shadow-lg overflow-hidden p-6">
      <!-- Fighter Image -->
      <img v-if="fighter.imgUrl" :src="fighter.imgUrl" alt=""
        class="w-48 h-48 md:w-64 md:h-64 object-cover object-top rounded-lg shadow-md" />

      <!-- Fighter Info -->
      <div class="mt-6 md:mt-0 flex flex-col justify-between">
        <h1 class="text-4xl font-bold text-blue-400 mb-4">{{ fighter.name }}</h1>

        <div class="space-y-2 text-zinc-200">
          <p class="text-lg"><span class="font-semibold text-zinc-100">Category:</span> {{ fighter.category }}</p>
          <p class="text-lg"><span class="font-semibold text-zinc-100">Status:</span> {{ fighter.status }}</p>
          <p class="text-lg"><span class="font-semibold text-zinc-100">Record:</span> {{ fighter.wins }}‑{{
            fighter.losses }}‑{{ fighter.draws }}</p>
          <p class="text-lg"><span class="font-semibold text-zinc-100">Born in:</span> {{ fighter.placeOfBirth }}</p>
          <p class="text-lg"><span class="font-semibold text-zinc-100">Trains at:</span> {{ fighter.trainsAt }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue'

defineOptions({
  layout: AppLayout,
})

defineProps({
  fighter: Object,
})

const goBack = () => {
  if (window.history.length > 1) {
    window.history.back()
  } else {
    Inertia.visit('/fighters')
  }
}
</script>
