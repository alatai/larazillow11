<template>
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <!-- 当使用v-for时，每个元素都需要被赋予一个唯一的key -->
    <!-- vue也可以在没有key的情况下渲染，但这可能会导致问题 -->
    <!-- :key 表示这是一个需要计算的JavaScript表达式 -->
    <!-- 如果没有 : 那么呈现的每个元素都将具有相同的key -->
    <Box v-for="listing in listings" :key="listing.id">
      <div>
        <!-- <Link :href="`/listing/${listing.id}`"> -->
        <Link :href="route('listing.show', { listing: listing.id })">
          <!-- 如果想传递一些CSS类应用到组件，那么这个组件需要有一个根元素 -->
          <Price :price="listing.price" class="text-2xl font-bold" />
          <ListingSpace :listing="listing" class="text-lg" />
          <ListingAddress :listing="listing" class="text-gray-500" />
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
    </Box>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'

defineProps({
  listings: Array,
})
</script>
