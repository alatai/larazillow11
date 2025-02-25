<template>
  <!-- <div>The page with time {{ timer }}</div> -->

  <header
    class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full"
  >
    <div class="container mx-auto">
      <nav class="p-4 flex items-center justify-between">
        <div class="text-lg font-medium">
          <Link :href="route('listing.index')">Listings</Link>
        </div>
        <div
          class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center"
        >
          <Link :href="route('listing.index')">LaraZillow</Link>
        </div>
        <div v-if="user" class="flex items-center gap-4">
          <Link :href="route('realtor.listing.index')" class="text-sm text-gray-500">{{ user.name }}</Link>
          <Link :href="route('realtor.listing.create')" class="btn-primary"
            >+ New Listing</Link
          >
          <div class="">
            <Link :href="route('logout')" method="delete">Logout</Link>
          </div>
        </div>
        <div v-else class="flex items-center gap-2">
          <Link :href="route('user-account.create')">Register</Link>
          <Link :href="route('login')">Sing-In</Link>
        </div>
      </nav>
    </div>
  </header>

  <main class="container mx-auto p-4 w-full">
    <div
      v-if="flashSuccess"
      class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900"
    >
      {{ flashSuccess }}
    </div>

    <!-- 如何告诉Vue？可以利用slot -->
    <slot>Default</slot>
  </main>
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
const user = computed(() => page.props.user)

// 使用ref函数，并设置初始值
// const timer = ref(0)
// setInterval(() => timer.value++, 1000)
</script>
