<template>
  <form @submit.prevent="register">
    <div class="w-1/2 mx-auto">
      <div>
        <label for="name" class="label">Name</label>
        <input type="text" id="name" class="input" v-model="form.name" />
        <div v-if="form.errors.name" class="input-error">
          {{ form.errors.name }}
        </div>
      </div>

      <div class="mt-4">
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
        <label for="password_confirmation" class="label"
          >Confirmation Password</label
        >
        <input
          type="password"
          id="password_confirmation"
          class="input"
          v-model="form.password_confirmation"
        />
        <div v-if="form.errors.password_confirmation" class="input-error">
          {{ form.errors.password_confirmation }}
        </div>
      </div>

      <div class="mt-4">
        <button class="btn-primary w-full" type="submit">Create Account</button>

        <div class="mt-2 text-center">
          <Link :href="route('login')" class="text-sm text-gray-500"
            >Already have an account? Click here</Link
          >
        </div>
      </div>
    </div>
  </form>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3'

const form = useForm({
  name: null,
  email: null,
  password: null,
  // 在Laravel中，如果使用这个验证器，名称为password_confirmation
  password_confirmation: null,
})

const register = () => form.post(route('user-account.store'))

/*
 inertia将收集Laravel后端发生的所有验证错误
 并将所有这些错误都提供给前端视图

 当使用useForm时，不必自己去获取它们，因为这个helper会把所有验证结果分配到字段
 e.g., form.errors.email
 */
</script>
