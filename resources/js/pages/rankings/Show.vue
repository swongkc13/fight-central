<template>
  <div class="min-h-screen bg-zinc-900 text-zinc-100 px-6 py-10">
    <h1 class="text-3xl font-bold mb-8 text-center tracking-wide">{{ category.categoryName }}</h1>

    <div class="max-w-md mx-auto mb-10">
      <input
        v-model="search"
        type="text"
        placeholder="Search fighters..."
        class="w-full rounded-lg bg-zinc-800 border border-zinc-700 px-4 py-3 text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
      />
    </div>

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
          <div class="w-full h-48 sm:h-56 md:h-64 lg:h-72 xl:h-80 overflow-hidden rounded-t-lg">
            <img
              v-if="fighter.imgUrl"
              :src="fighter.imgUrl"
              alt=""
              class="w-full h-full object-cover object-top"
            />
            <span v-else class="text-zinc-300 text-xl font-bold flex items-center justify-center h-full">
              {{ fighter.name }}
            </span>
          </div>

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

// Types
interface Fighter {
  id: string
  name: string
  imgUrl?: string
}

interface Category {
  id: string
  categoryName: string
  champion?: Fighter
  fighters: Fighter[]
}

// Props typing
const props = defineProps<{ category: Category }>()

defineOptions({
  layout: AppLayout
})

// Search
const search = ref('')

const filteredFighters = computed(() => {
  if (!props.category?.fighters) return []

  if (!search.value) return props.category.fighters

  return props.category.fighters.filter((fighter: Fighter) =>
    fighter.name.toLowerCase().includes(search.value.toLowerCase())
  )
})
</script>