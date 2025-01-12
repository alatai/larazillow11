<template>
  <!-- 当使用v-for时，每个元素都需要被赋予一个唯一的key -->
  <!-- vue也可以在没有key的情况下渲染，但这可能会导致问题 -->
  <!-- :key 表示这是一个需要计算的JavaScript表达式 -->
  <!-- 如果没有 : 那么呈现的每个元素都将具有相同的key -->
  <div v-for="listing in listings" :key="listing.id">
    <div>
      <!-- <Link :href="`/listing/${listing.id}`"> -->
      <Link :href="route('listing.show', { listing: listing.id })">
        <ListingAddress :listing="listing" />
      </Link>
    </div>

    <div>
      <!-- <Link :href="`/listing/${listing.id}/edit`">Edit</Link> -->
      <Link :href="route('listing.edit', { listing: listing.id })">Edit</Link>
    </div>

    <div>
      <!-- <Link :href="`/listing/${listing.id}`" method="delete">Delete</Link> -->
      <Link
        :href="route('listing.destroy', { listing: listing.id })"
        method="delete"
        >Delete</Link
      >
    </div>
  </div>
</template>

<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  listings: Array,
})
</script>
