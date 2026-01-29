<template>
  <div class="min-h-screen bg-zinc-900 text-zinc-100 px-6 py-10">
    <h1 class="text-3xl font-bold mb-8 text-center tracking-wide">Divisions</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
      <Link
        v-for="division in props.divisions ?? []"
        :key="division.id"
        :href="`/division/${division.id}`"
        class="block"
      >
        <div
          class="bg-zinc-800 rounded-xl overflow-hidden shadow-md hover:shadow-2xl transform hover:scale-105 transition-all duration-300 cursor-pointer relative"
        >
          <!-- Champion image -->
          <div
            class="w-full h-48 sm:h-56 md:h-64 lg:h-72 xl:h-80 overflow-hidden rounded-t-lg flex items-center justify-center bg-zinc-700"
          >
            <img
              v-if="division.champion?.imgUrl"
              :src="division.champion.imgUrl"
              alt=""
              class="w-full h-full object-cover object-top"
            />
            <span v-else class="text-zinc-300 text-xl font-bold text-center">
              {{ division.champion?.championName || division.name }}
            </span>
          </div>

          <!-- Content -->
          <div class="p-4">
            <h3 class="text-xl font-semibold text-blue-300 mb-1">{{ division.name }}</h3>
            <p class="text-zinc-400 text-sm">
              🏆 Champion: {{ division.champion?.championName || 'N/A' }}
            </p>
            <p class="text-zinc-400 text-sm">
              🥊 {{ division.fighters?.length || 0 }} Fighters
            </p>

            <div class="mt-3">
              <span
                class="inline-block bg-zinc-700 text-zinc-200 rounded-full px-3 py-1 text-sm font-medium"
              >
                View Fighters
              </span>
            </div>
          </div>
        </div>
      </Link>
    </div>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'

interface Fighter {
  id: string
  name: string
  imgUrl?: string
}

interface Champion {
  id: string
  championName: string
  imgUrl?: string
}

interface Division {
  id: string
  name: string
  fighters?: Fighter[]
  champion?: Champion
}

const props = defineProps<{ divisions?: Division[] }>()

defineOptions({
  layout: AppLayout
})
</script>