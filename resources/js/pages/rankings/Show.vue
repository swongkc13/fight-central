<template>
    <div class="min-h-screen bg-zinc-900 text-zinc-100 px-6 py-10">
        <h1 class="text-3xl font-bold mb-8 text-center tracking-wide">{{ category.categoryName }}</h1>

        <div class="max-w-md mx-auto mb-10">
            <input v-model="search" type="text" placeholder="Search fighters..."
                class="w-full rounded-lg bg-zinc-800 border border-zinc-700 px-4 py-3 text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <!-- Champion Card -->
        <div v-if="props.category.champion" class="mb-12">
            <Link :href="`/fighters/${props.category.champion.id}`"
                class="block max-w-xl mx-auto relative rounded-2xl overflow-hidden shadow-2xl hover:shadow-3xl transform hover:scale-105 transition-all duration-300">
                <!-- Background Image -->
                <img v-if="props.category.champion.imgUrl" :src="props.category.champion.imgUrl" alt=""
                    class="w-full h-72 sm:h-80 md:h-96 object-cover object-top" />

                <!-- Fallback if no image -->
                <div v-else class="w-full h-72 sm:h-80 md:h-96 flex items-center justify-center bg-zinc-700">
                    <span class="text-3xl sm:text-4xl md:text-5xl font-bold text-blue-400">
                        🏆 {{ props.category.champion.championName }}
                    </span>
                </div>

                <!-- Gradient Overlay for Text Readability -->
                <div class="absolute inset-0 bg-gradient-to-b from-black/10 via-black/20 to-black/50 z-10"></div>

                <!-- Champion Name Overlay -->
                <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-20 text-center">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white drop-shadow-lg">
                        🏆 {{ props.category.champion.championName }}
                    </h2>
                </div>
            </Link>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <Link v-for="fighter in filteredFighters" :key="fighter.id" :href="`/fighters/${fighter.id}`" class="block">
                <div
                    class="bg-zinc-800 rounded-xl overflow-hidden shadow-md hover:shadow-2xl transform hover:scale-105 transition-all duration-300 cursor-pointer relative">
                    <div class="w-full h-48 sm:h-56 md:h-64 lg:h-72 xl:h-80 overflow-hidden rounded-t-lg">
                        <img v-if="fighter.imgUrl" :src="fighter.imgUrl" alt=""
                            class="w-full h-full object-cover object-top" />
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

interface Category {
    id: string
    categoryName: string
    champion?: Champion
    fighters: Fighter[]
}

const props = defineProps<{ category: Category }>()

defineOptions({
    layout: AppLayout
})

const search = ref('')

const filteredFighters = computed(() => {
    if (!props.category?.fighters) return []

    if (!search.value) return props.category.fighters

    return props.category.fighters.filter((fighter: Fighter) =>
        fighter.name.toLowerCase().includes(search.value.toLowerCase())
    )
})
</script>