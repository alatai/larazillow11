<template>
  <div
    class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm dark:text-gray-300"
  >
    <div class="text-gray-500 font-medium mb-1">
      <slot name="header"></slot>
    </div>
    <!-- slot意味着我们将想这个组件传递内容 -->
    <slot></slot>
  </div>
</template>
