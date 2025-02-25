<template>
  <form>
    <div class="mb-4 mt-4 flex flex-wrap gap-2">
      <div class="flex flex-nowrap items-center gap-2">
        <input
          id="deleted"
          v-model="filterForm.deleted"
          type="checkbox"
          class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
        />
        <label for="deleted">Deleted</label>
      </div>

      <div>
        <select v-model="filterForm.by" class="input-filter-l w-24">
          <option value="created_at">Added</option>
          <option value="price">Price</option>
        </select>
        <select v-model="filterForm.order" class="input-filter-r w-32">
          <option
            v-for="option in sortOptions"
            :key="option.value"
            :value="option.value"
          >
            {{ option.label }}
          </option>
        </select>
      </div>
    </div>
  </form>
</template>

<script setup>
import { reactive, watch, computed } from 'vue'
import { router } from '@inertiajs/vue3'
import { debounce } from 'lodash'

const sortLabels = {
  created_at: [
    {
      label: 'Latest',
      value: 'desc',
    },
    {
      label: 'Oldest',
      value: 'asc',
    },
  ],
  price: [
    {
      label: 'Pricey',
      value: 'desc',
    },
    {
      label: 'Cheapest',
      value: 'asc',
    },
  ],
}

const sortOptions = computed(() => sortLabels[filterForm.by])

const props = defineProps({
  filters: Object,
})

const filterForm = reactive({
  deleted: props.filters.deleted ?? false,
  by: props.filters.by ?? 'created_at',
  order: props.filters.order ?? 'desc',
})

watch(
  filterForm,
  // 使用debounce包装请求
  // debounce返回的函数都会被忽略，只有在此时间跨度之后的最后一次调用才会被实际调用
  debounce(
    () =>
      router.get(route('realtor.listing.index'), filterForm, {
        preserveState: true,
        preserveScroll: true,
      }),
    1000
  )
)

// watch函数接收两个参数
// 第一个是观察变化的值:该对象发生变化时触发函数
// 这个值为这些函数的结果：reactive / ref / computed
// 第二个参数:触发的函数
// watch(
// 如果从reactive创建的对象访问属性，它就失去了反应性，意味着必须包装在一个getter函数中
// () => filterForm.deleted,
// 如果把由reactive函数创建的内容传给watch，那么这个被观察对象的各个属性的新值和旧值是相同的
//   (newValue, oldValue) => {
//     console.log(newValue)
//     console.log(oldValue)
//   }
// )
</script>
