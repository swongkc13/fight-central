<template>
  <div class="p-8">
    <button @click="$inertia.back()" class="text-blue-500 mb-4">← Back</button>

    <div class="flex space-x-8">
      <img v-if="fighter.imgUrl" :src="fighter.imgUrl" alt="" class="w-48 h-48 object-cover" />

      <div>
        <h1 class="text-3xl font-bold">{{ fighter.name }}</h1>
        <p class="text-lg text-gray-600">{{ fighter.category }}</p>
        <p class="text-lg text-gray-600">Status: {{ fighter.status }}</p>
        <p class="text-lg text-gray-600">Record: {{ fighter.wins }}‑{{ fighter.losses }}‑{{ fighter.draws }}</p>
        <p class="text-lg text-gray-600">Born in: {{ fighter.placeOfBirth }}</p>
        <p class="text-lg text-gray-600">Trains at: {{ fighter.trainsAt }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    fighter: Object,
  },
};
</script>
