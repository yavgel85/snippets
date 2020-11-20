<template>
  <div class="container mt-16">
    <div class="flex flex-col items-center">
      <h1 class="text-3xl text-gray-700 font-medium mb-10">
        {{ $auth.user.name }}
      </h1>

      <div class="w-full md:w-6/12 lg:w-4/12 mb-6">
        <form
          action="#"
          class="mb-6"
          @submit.prevent="submit"
        >
          <div class="mb-6">
            <label
              for="email"
              class="block text-gray-600 font-medium mb-2"
              :class="{
              'text-red-500': validation.email
            }"
            >
              Email
            </label>
            <input
              type="email"
              name="email"
              id="email"
              class="border-2 border-gray-400 rounded block w-full p-3"
              :class="{
              'border-red-500': validation.email
            }"
              v-model="form.email"
            >
            <div class="text-red-500 mb-4 text-sm mt-1 font-medium" v-if="validation.email">
              {{ validation.email[0] }}
            </div>
          </div>
          <div class="mb-6">
            <label
              for="name"
              class="block text-gray-600 font-medium mb-2"
              :class="{
              'text-red-500': validation.name
            }"
            >
              Name
            </label>
            <input
              type="text"
              name="name"
              id="name"
              class="border-2 border-gray-400 rounded block w-full p-3"
              :class="{
              'border-red-500': validation.name
            }"
              v-model="form.name"
            >
            <div class="text-red-500 mb-4 text-sm mt-1 font-medium" v-if="validation.name">
              {{ validation.name[0] }}
            </div>
          </div>
          <div class="mb-6">
            <label
              for="username"
              class="block text-gray-600 font-medium mb-2"
              :class="{
              'text-red-500': validation.username
            }"
            >
              Username
            </label>
            <input
              type="text"
              name="username"
              id="username"
              class="border-2 border-gray-400 rounded block w-full p-3"
              :class="{
              'border-red-500': validation.username
            }"
              v-model="form.username"
            >
            <div class="text-red-500 mb-4 text-sm mt-1 font-medium" v-if="validation.username">
              {{ validation.username[0] }}
            </div>
          </div>
          <div class="mb-6">
            <label
              for="password"
              class="block text-gray-600 font-medium mb-2"
              :class="{
              'text-red-500': validation.password
            }"
            >
              Password
            </label>
            <input
              type="password"
              name="password"
              id="password"
              class="border-2 border-gray-400 rounded block w-full p-3"
              :class="{
              'border-red-500': validation.password
            }"
              v-model="form.password"
            >
            <div class="text-red-500 mb-4 text-sm mt-1 font-medium" v-if="validation.password">
              {{ validation.password[0] }}
            </div>

            <div class="text-sm text-gray-500">
              Leave blank to keep the same
            </div>
          </div>
          <div>
            <button type="submit" class="bg-blue-500 text-white p-4 rounded text-center font-medium">
              Update
            </button>
          </div>
        </form>

        <div>
          <nuxt-link
            :to="{
            name: 'author-id',
            params: {
              id: $auth.user.username
            }
          }"
          >
            View your public profile
          </nuxt-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return  {
        form: {
          email: this.$auth.user.email,
          password: '',
          name: this.$auth.user.name,
          username: this.$auth.user.username,
        },

        validation: {}
      }
    },

    head () {
      return {
        title: 'Account'
      }
    },

    methods: {
      async submit () {
        try {
          await this.$axios.$patch(`users/${this.$auth.user.username}`, this.form)
          await this.$auth.fetchUser()

          this.form.password = ''
          this.validation = {}
        } catch (e) {
          if (e.response.status === 422) {
            this.validation = e.response.data.errors
          }
        }
      }
    }
  }
</script>
