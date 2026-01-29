<template>
  <div class="min-h-screen flex flex-col bg-zinc-900 text-zinc-100 relative overflow-hidden">
    <!-- Hero Background Accent -->
    <div
      class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-150 h-150 bg-blue-600/20 rounded-full blur-3xl pointer-events-none">
    </div>

    <HeroSection title="Fight Central"
      subtitle="Browse MMA fighters, see their stats and details — built with Laravel, Inertia, Vue, and Tailwind!"
      link-text="Browse Fighters" link-href="/fighters" />

    <!-- Featured Fighters Carousel -->
    <div class="mt-16 max-w-7xl mx-auto px-4">
      <h2 class="text-3xl font-bold mb-6 text-center text-zinc-100">
        Featured Fighters
      </h2>

      <div class="relative">
        <!-- Carousel Wrapper -->
        <div class="overflow-hidden" @mouseenter="pause = true" @mouseleave="pause = false">
          <div class="flex transition-transform duration-500 ease-in-out"
            :style="{ transform: `translateX(-${currentIndex * slideWidth}%)` }">
            <div v-for="(fighter, id) in featuredFighters" :key="id" class="shrink-0 w-full sm:w-1/2 lg:w-1/3 px-2">
              <Link :href="`/fighters/${id}`" class="block">
                <div
                  class="bg-zinc-800 rounded-xl overflow-hidden shadow-md hover:shadow-2xl transform hover:scale-105 transition-all duration-300 cursor-pointer relative">

                  <div class="h-64 overflow-hidden">
                    <img v-if="fighter.imgUrl" :src="fighter.imgUrl" alt=""
                      class="w-full h-full object-cover object-top" />
                  </div>

                  <div class="p-5 space-y-2">
                    <h3 class="text-xl font-semibold text-blue-400">{{ fighter.name }}</h3>
                    <p class="text-zinc-400 text-sm">{{ fighter.category }}</p>
                    <p class="text-sm text-zinc-300">
                      Record: <span class="font-medium text-zinc-100">{{ fighter.wins }}-{{ fighter.losses }}</span>
                    </p>
                  </div>

                  <!-- Optional subtle hover overlay -->
                  <div
                    class="absolute inset-0 bg-white/5 opacity-0 hover:opacity-100 rounded-xl transition-opacity duration-300">
                  </div>
                </div>
              </Link>
            </div>
          </div>
        </div>

        <!-- Navigation Buttons -->
        <button @click="prevSlide"
          class="absolute top-1/2 -translate-y-1/2 left-0 bg-blue-600/50 hover:bg-blue-600 text-white p-3 rounded-full">
          &#8592;
        </button>

        <button @click="nextSlide"
          class="absolute top-1/2 -translate-y-1/2 right-0 bg-blue-600/50 hover:bg-blue-600 text-white p-3 rounded-full">
          &#8594;
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { ref, onMounted, onUnmounted, computed } from 'vue'
import HeroSection from '@/components/HeroSection.vue';
import AppLayout from '@/layouts/AppLayout.vue'

defineOptions({ layout: AppLayout })

// Props from controller
const props = defineProps<{
  featuredFighters?: Record<string, any>
}>()

// Carousel state
const currentIndex = ref(0)
const pause = ref(false)
let interval: number | null = null

// Responsive slides width
const slideWidth = computed(() => {
  if (window.innerWidth >= 1024) return 33.3333
  if (window.innerWidth >= 640) return 50
  return 100
})

const visibleCards = computed(() => {
  if (window.innerWidth >= 1024) return 3
  if (window.innerWidth >= 640) return 2
  return 1
})

const totalSlides = computed(() =>
  Object.keys(props.featuredFighters ?? {}).length
)

// Navigation
const prevSlide = () => {
  currentIndex.value = (currentIndex.value - visibleCards.value + totalSlides.value) % totalSlides.value
}

const nextSlide = () => {
  currentIndex.value = (currentIndex.value + visibleCards.value) % totalSlides.value
}

// Auto-slide every 5 seconds 
onMounted(() => {
  interval = window.setInterval(() => {
    if (!pause.value) nextSlide()
  }, 5000)
})

onUnmounted(() => {
  if (interval) clearInterval(interval)
})
</script>