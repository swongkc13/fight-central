<template>
    <div class=" min-h-screen bg-zinc-900 text-zinc-100 px-6 py-10">
        <h1 class="text-3xl font-bold mb-8 text-center tracking-wide">All Fighters</h1>

        <div class="max-w-md mx-auto mb-10">
            <input v-model="search" type="text" placeholder="Search fighters..."
                class="w-full rounded-lg bg-zinc-800 border border-zinc-700 px-4 py-3 text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 " />
            <div class="mt-4 grid gap-3 sm:grid-cols-3">
                <select v-model="selectedDivision"
                    class="rounded-lg bg-zinc-800 border border-zinc-700 px-4 py-3 text-zinc-100">
                    <option value="">All divisions</option>
                    <option v-for="division in divisions" :key="division" :value="division">
                        {{ division }}
                    </option>
                </select>

                <select v-model="selectedStatus"
                    class="rounded-lg bg-zinc-800 border border-zinc-700 px-4 py-3 text-zinc-100">
                    <option value="">All statuses</option>
                    <option v-for="status in statuses" :key="status" :value="status">
                        {{ status }}
                    </option>
                </select>

                <button type="button" @click="applyFilters"
                    class="rounded-lg bg-blue-600 px-4 py-3 font-semibold text-white hover:bg-blue-500">
                    Apply Filters
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <Link :href="`/fighters/${id}`" :key="id" class="block" v-for="(fighter, id) in props.fighters">
                <div
                    class="bg-zinc-800 rounded-xl overflow-hidden shadow-md hover:shadow-2xl transform hover:scale-105 transition-all duration-300 cursor-pointer relative">
                    <!-- Image container -->
                    <div class="w-full h-48 sm:h-56 md:h-64 lg:h-72 xl:h-80 overflow-hidden rounded-t-lg">
                        <img v-if="fighter.imgUrl" :src="fighter.imgUrl" alt=""
                            class="w-full h-full object-cover object-top" />
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-blue-300 mb-1">{{ fighter.name }}</h3>
                        <p class="text-zinc-400 mt-1">{{ fighter.category }}</p>

                        <p class="mt-2 text-sm text-zinc-400">
                            🥊 Record: {{ fighter.wins }}‑{{ fighter.losses }}
                        </p>

                        <div class="mt-3">
                            <span
                                class="inline-block bg-zinc-700 text-zinc-200 rounded-full px-3 py-1 text-sm font-medium">
                                View Details
                            </span>
                        </div>
                    </div>
                </div>
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    fighters: Object,
    filters: Object,
    divisions: Array,
    statuses: Array,
})

defineOptions({
    layout: AppLayout,
})

const search = ref(props.filters?.search ?? '');
const selectedDivision = ref(props.filters?.division ?? '');
const selectedStatus = ref(props.filters?.status ?? '');

// const filteredFighters = computed(() => {
//     if (!search.value) {
//         return props.fighters
//     }

//     return Object.fromEntries(
//         Object.entries(props.fighters).filter(([_, fighter]) =>
//             fighter.name.toLowerCase().includes(search.value.toLowerCase())
//         )
//     )
// })

const applyFilters = () => {
    router.get('/fighters', {
        search: search.value || undefined,
        division: selectedDivision.value || undefined,
        status: selectedStatus.value || undefined,
    }, {
        preserveState: true,
        replace: true,
    })
}

</script>
