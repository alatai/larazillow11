<template>
  <Filters :filters="filters" />
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <!-- 当使用v-for时，每个元素都需要被赋予一个唯一的key -->
    <!-- vue也可以在没有key的情况下渲染，但这可能会导致问题 -->
    <!-- :key 表示这是一个需要计算的JavaScript表达式 -->
    <!-- 如果没有 : 那么呈现的每个元素都将具有相同的key -->
    <Listing
      v-for="listing in listings.data"
      :key="listing.id"
      :listing="listing"
    />
  </div>

  <div v-if="listings.data.length" class="w-full flex justify-center mt-4 mb-4">
    <Pagination :links="listings.links" />
  </div>
</template>

<script setup>
import Pagination from '@/Components/UI/Pagination.vue'
import Listing from '@/Pages/Listing/Index/Components/Listing.vue'
import Filters from '@/Pages/Listing/Index/Components/Filters.vue'

defineProps({
  listings: Object,
  filters: Object,
})
</script>
