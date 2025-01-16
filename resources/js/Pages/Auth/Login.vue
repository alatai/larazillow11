<template>
  <form @submit.prevent="login">
    <div class="w-1/2 mx-auto">
      <div>
        <label for="email" class="label">E-mail</label>
        <input type="text" id="email" class="input" v-model="form.email" />
        <div v-if="form.errors.email" class="input-error">
          {{ form.errors.email }}
        </div>
      </div>

      <div class="mt-4">
        <label for="password" class="label">Password</label>
        <input
          type="password"
          id="password"
          class="input"
          v-model="form.password"
        />
        <div v-if="form.errors.password" class="input-error">
          {{ form.errors.password }}
        </div>
      </div>

      <div class="mt-4">
        <button class="btn-primary w-full" type="submit">Login</button>

        <div class="mt-2 text-center">
          <Link
            :href="route('user-account.create')"
            class="text-sm text-gray-500"
            >Need an account? Click here</Link
          >
        </div>
      </div>
    </div>
  </form>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3'

const form = useForm({
  email: null,
  password: null,
})

const login = () => form.post(route('login.store'))

/*
 inertia将收集Laravel后端发生的所有验证错误
 并将所有这些错误都提供给前端视图

 当使用useForm时，不必自己去获取它们，因为这个helper会把所有验证结果分配到字段
 e.g., form.errors.email
 */
</script>
