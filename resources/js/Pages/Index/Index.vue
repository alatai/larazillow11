<template>
  <!-- <MainLayout> -->
  <div>Index</div>
  <Link href="/hello">Show Page</Link>
  <div>The message is {{ message }}</div>
  <!-- </MainLayout>  -->
</template>

<!-- 组合式API风格 -->
<script setup>
import { Link } from '@inertiajs/vue3'
// 使用这种布局方式将丢失组件中存在的所有状态
// 解决：inertia持久布局
// import MainLayout from '../../Layouts/MainLayout.vue'

// 只能在 <script setup> 中使用
defineProps({
  // 可以指定预期类型，错误是会在控制台输出警告
  message: String,
})
</script>

<!-- 使用inertia持久布局 -->
<!-- 这个布局有自己的状态，不会被修改 -->
<!-- <script>
import MainLayout from '../../Layouts/MainLayout.vue'

export default {
  layout: MainLayout,
}
</script> -->
