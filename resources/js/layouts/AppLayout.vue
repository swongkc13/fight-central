<template>
  <div class="min-h-screen flex flex-col bg-zinc-900 text-zinc-100">
    <!-- Navbar -->
    <header class="border-b border-zinc-800">
      <nav class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <Link href="/" class="text-xl font-bold tracking-wide text-blue-400 hover:text-blue-300">
          Fight Central
        </Link>
        <div class="flex items-center gap-6 text-sm">
          <Link href="/" class="text-zinc-300 hover:text-white transition">Home</Link>
          <Link href="/fighters" class="text-zinc-300 hover:text-white transition">Fighters</Link>
          <Link href="/rankings" class="text-zinc-300 hover:text-white transition">Rankings</Link>
          <Link href="/division" class="text-zinc-300 hover:text-white transition">Division</Link>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <main class="flex-1">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="border-t border-zinc-800 mt-16">
      <div class="max-w-7xl mx-auto px-6 py-6 text-center text-sm text-zinc-500">
        © {{ new Date().getFullYear() }} Fight Central — Built with Laravel & Vue
      </div>
    </footer>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
</script>
