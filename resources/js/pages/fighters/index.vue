<template>
    <div class=" min-h-screen bg-zinc-900 text-zinc-100 px-6 py-10">
        <h1 class="text-3xl font-bold mb-8 text-center tracking-wide">All Fighters</h1>

        <div class="max-w-md mx-auto mb-10">
            <input v-model="search" type="text" placeholder="Search fighters..."
                class="w-full rounded-lg bg-zinc-800 border border-zinc-700 px-4 py-3 text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 " />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div v-for="(fighter, id) in filteredFighters" :key="id"
                class="bg-zinc-800 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition duration-300">
                <!-- Image container -->
                <div class="w-full h-48 overflow-hidden rounded-t-lg">
                    <img v-if="fighter.imgUrl" :src="fighter.imgUrl" alt=""
                        class="w-full h-full object-cover object-top" />
                </div>


                <!-- Content -->
                <div class="p-4">
                    <Link :href="`/fighters/${id}`" class="text-xl font-semibold text-blue-300 hover:underline">
                        {{ fighter.name }}
                    </Link>
                    <p class="text-zinc-400 mt-1">{{ fighter.category }}</p>

                    <p class="mt-2 text-sm text-zinc-400">
                        🥊 Record: {{ fighter.wins }}‑{{ fighter.losses }}
                    </p>

                    <div class="mt-3">
                        <span class="inline-block bg-zinc-700 text-zinc-200 rounded-full px-3 py-1 text-sm font-medium">
                            View Details
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    fighters: Object
})

defineOptions({
    layout: AppLayout,
})

const search = ref('');

const filteredFighters = computed(() => {
    if (!search.value) {
        return props.fighters
    }

    return Object.fromEntries(
        Object.entries(props.fighters).filter(([_, fighter]) =>
            fighter.name.toLowerCase().includes(search.value.toLowerCase())
        )
    )
})



</script>
