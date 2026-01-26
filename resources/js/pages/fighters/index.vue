<template>
    <div class="p-8 bg-gray-100 min-h-screen">
        <h1 class="text-3xl font-bold mb-6 text-center">All Fighters</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div v-for="(fighter, id) in fighters" :key="id"
                class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:-translate-y-1">
                <!-- Image container -->
                <div class="w-full h-48 overflow-hidden rounded-t-lg">
                    <img v-if="fighter.imgUrl" :src="fighter.imgUrl" alt=""
                        class="w-full h-full object-cover object-top" />
                </div>


                <!-- Content -->
                <div class="p-4">
                    <Link :href="`/fighters/${id}`" class="text-xl font-semibold text-blue-600 hover:underline">
                        {{ fighter.name }}
                    </Link>
                    <p class="text-gray-500 mt-1">{{ fighter.category }}</p>

                    <p class="mt-2 text-sm text-gray-700">
                        🥊 Record: {{ fighter.wins }}‑{{ fighter.losses }}
                    </p>

                    <div class="mt-3">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-medium text-gray-700">
                            View Details
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    fighters: Array
})
</script>
