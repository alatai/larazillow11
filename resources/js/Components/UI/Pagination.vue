<template>
  <div class="flex gap-1">
    <Link
      v-for="(link, index) in links"
      class="py-2 px-4 rounded-md"
      :href="link.url"
      :key="index"
      :class="{ 'bg-indigo-500 dark:bg-indigo-800 text-gray-300': link.active }"
      v-html="link.label"
    />
    <!-- {{ link.label }} -->
    <!-- </Link> -->
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  links: Array,
})
</script>
