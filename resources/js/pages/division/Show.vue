<template>
  <div class="min-h-screen bg-zinc-900 text-zinc-100 px-6 py-10">
    <h1 class="text-3xl font-bold mb-8 text-center tracking-wide">{{ division.name }}</h1>

    <!-- Search -->
    <div class="max-w-md mx-auto mb-10">
      <input
        v-model="search"
        type="text"
        placeholder="Search fighters..."
        class="w-full rounded-lg bg-zinc-800 border border-zinc-700 px-4 py-3 text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
      />
    </div>

    <!-- Fighters Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
      <Link
        v-for="fighter in filteredFighters"
        :key="fighter.id"
        :href="`/fighters/${fighter.id}`"
        class="block"
      >
        <div
          class="bg-zinc-800 rounded-xl overflow-hidden shadow-md hover:shadow-2xl transform hover:scale-105 transition-all duration-300 cursor-pointer relative"
        >
          <!-- Fighter Image -->
          <div
            class="w-full h-48 sm:h-56 md:h-64 lg:h-72 xl:h-80 overflow-hidden rounded-t-lg flex items-center justify-center bg-zinc-700"
          >
            <img
              v-if="fighter.imgUrl"
              :src="fighter.imgUrl"
              alt=""
              class="w-full h-full object-cover object-top"
            />
            <span
              v-else
              class="text-zinc-300 text-xl font-bold flex items-center justify-center h-full text-center"
            >
              {{ fighter.name }}
            </span>
          </div>

          <!-- Fighter Content -->
          <div class="p-4">
            <h3 class="text-xl font-semibold text-blue-300 mb-1">{{ fighter.name }}</h3>
          </div>
        </div>
      </Link>
    </div>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { ref, computed } from 'vue'
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

const props = defineProps<{ division: Division }>()

defineOptions({
  layout: AppLayout
})

// Merge champion into fighters array (if not already included)
const fightersWithChampion = computed(() => {
  const fighters = props.division.fighters ?? []
  if (props.division.champion && !fighters.some(f => f.id === props.division.champion!.id)) {
    // Map champion.championName → name so it matches Fighter interface
    return [{ 
      id: props.division.champion.id, 
      name: props.division.champion.championName, 
      imgUrl: props.division.champion.imgUrl 
    }, ...fighters]
  }
  return fighters
})

const search = ref('')

// Filtered fighters for search
const filteredFighters = computed(() => {
  if (!fightersWithChampion.value) return []
  if (!search.value) return fightersWithChampion.value
  return fightersWithChampion.value.filter(f =>
    f.name.toLowerCase().includes(search.value.toLowerCase())
  )
})
</script>