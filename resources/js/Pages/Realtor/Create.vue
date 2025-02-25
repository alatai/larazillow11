<template>
  <!-- 在HTML中，表单的默认行为是将表单提交到当前URL -->
  <!-- 当添加JavaScript来处理事件时，需要盗用event.prevent阻止默认行为 -->
  <!-- @ 是vue的属性 -->
  <form @submit.prevent="create">
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-2">
        <label class="label">Beds</label>
        <input v-model.number="form.beds" type="text" class="input" />
        <div v-if="form.errors.beds" class="input-error">
          {{ form.errors.beds }}
        </div>
      </div>

      <div class="col-span-2">
        <label class="label">Baths</label>
        <input v-model.number="form.baths" type="text" class="input" />
        <div v-if="form.errors.baths" class="input-error">
          {{ form.errors.baths }}
        </div>
      </div>

      <div class="col-span-2">
        <label class="label">Area</label>
        <input v-model.number="form.area" type="text" class="input" />
        <div v-if="form.errors.area" class="input-error">
          {{ form.errors.area }}
        </div>
      </div>

      <div class="col-span-4">
        <label class="label">City</label>
        <input v-model="form.city" type="text" class="input" />
        <div v-if="form.errors.city" class="input-error">
          {{ form.errors.city }}
        </div>
      </div>

      <div class="col-span-2">
        <label class="label">Post Code</label>
        <input v-model="form.code" type="text" class="input" />
        <div v-if="form.errors.code" class="input-error">
          {{ form.errors.code }}
        </div>
      </div>

      <div class="col-span-4">
        <label class="label">Street</label>
        <input v-model="form.street" type="text" class="input" />
        <div v-if="form.errors.street" class="input-error">
          {{ form.errors.street }}
        </div>
      </div>

      <div class="col-span-2">
        <label class="label">Street Nr</label>
        <input v-model.number="form.street_nr" type="text" class="input" />
        <div v-if="form.errors.street_nr" class="input-error">
          {{ form.errors.street_nr }}
        </div>
      </div>

      <div class="col-span-6">
        <label class="label">Price</label>
        <input v-model.number="form.price" type="text" class="input" />
        <div v-if="form.errors.price" class="input-error">
          {{ form.errors.price }}
        </div>
      </div>

      <div class="col-span-6">
        <button type="submit" class="btn-primary">Create</button>
      </div>
    </div>
  </form>
</template>

<script setup>
// 返回一个对象的响应式代理
// import { reactive } from 'vue'
// 使用useForm代替reactive
// 还可以访问通过表单发送的所有字段的验证错误
import { useForm } from '@inertiajs/vue3'

// 调用reactive，将向它传递一个对象
// ref和reactive之间的区别在于ref主要用于单个值
// 而reactive用于对象
// const form = reactive({

const form = useForm({
  beds: 0,
  baths: 0,
  area: 0,
  city: null,
  street: null,
  code: null,
  street_nr: null,
  price: 0,
})

// 响应式的值，意味着读取或设置时，可能会导致UI更新或其他一些依赖于它们的值变化
// 但是一旦为这个reactive属性设置了一个新的变量，从表单变量中读取
// 这个 x 就不再是响应式了，这意味着，在原始对象周围有一个代理对象包装
// 一旦把它设置为不同变量，就会失去响应式
// const x = form.beds

const create = () => form.post(route('realtor.listing.store'))
</script>

<!-- 可以为每个组件定制样式 -->
<!-- scoped属性，它实际上是一个vue属性，可以为通用的HTML元素定义样式 -->
<style scoped>
label {
  margin-right: 2em;
}

div {
  padding: 2px;
}
</style>
