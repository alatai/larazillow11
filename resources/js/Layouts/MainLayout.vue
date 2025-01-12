<template>
  <Link href="/listing">Listings</Link>&nbsp;
  <Link href="/listing/create">New Listing</Link>
  <!-- <div>The page with time {{ timer }}</div> -->
  <div v-if="flashSuccess" class="success">
    {{ flashSuccess }}
  </div>

  <!-- 如何告诉Vue？可以利用slot -->
  <slot></slot>
</template>

<script setup>
// import { ref } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
// 计算属性，基本上是从其他响应式数据或非响应式数据中获取
import { computed } from 'vue'

// 访问通过中间件共享的数据，使用inertia的usePage的props
// page.props.flash.success
const page = usePage()
const flashSuccess = computed(() => page.props.flash.success)

// 使用ref函数，并设置初始值
// const timer = ref(0)
// setInterval(() => timer.value++, 1000)
</script>

<style scoped>
.success {
  background-color: #008000;
  color: #fff;
}
</style>
