<template>
  <div class="bg-white py-8 lg:py-0 flex items-center">
    <div class="container flex flex-wrap items-center lg:flex-no-wrap">
      <nuxt-link
        :to="{name: 'index'}"
        class="mr-10 flex-shrink-0"
      >
        <img src="~/assets/logo.svg" alt="Logo" class="h-12">
<!--        <img src="~/assets/logo.png" alt="Logo" class="h-20">-->
      </nuxt-link>

      <a
        href="#"
        class="lg:hidden ml-auto flex flex-col relative justify-center h-8 w-8"
        @click.prevent="mobileNavOpen = !mobileNavOpen"
      >
        <span
          class="bg-blue-500 h-1 w-8 rounded mb-1"
          :class="{
            'rotate-45 absolute right-0': mobileNavOpen,
          }"
        ></span>
        <span
          class="bg-blue-500 h-1 w-8 rounded mb-1"
          :class="{
            '-rotate-45 absolute right-0': mobileNavOpen,
          }"
        ></span>
        <span
          class="bg-blue-500 h-1 w-8 rounded mb-1"
          :class="{
            'hidden': mobileNavOpen,
          }"
        ></span>
      </a>

      <div
        class="w-full flex"
        :class="{
          'mt-8': mobileNavOpen,
          'hidden lg:flex': !mobileNavOpen
        }"
      >
        <ul class="lg:h-24 lg:flex items-center w-full lg:w-auto">
          <li>
            <nuxt-link
              :to="{name: 'browse'}"
              class="text-lg text-gray-700 lg:py-8 lg:px-4"
            >
              Browse
            </nuxt-link>
          </li>
          <li>
            <nuxt-link
              :to="{name: 'search'}"
              class="text-lg text-gray-700 lg:py-8 lg:px-4"
            >
              Search
            </nuxt-link>
          </li>
        </ul>
        <ul class="lg:h-24 lg:flex items-center ml-auto text-right w-full lg:w-auto">
          <template v-if="$auth.loggedIn">
            <li>
              <nuxt-link
                :to="{name: 'dashboard'}"
                class="text-lg text-gray-700 lg:py-8 lg:px-4"
              >
                Dashboard
              </nuxt-link>
            </li>
            <li>
              <nuxt-link
                :to="{name: 'account'}"
                class="text-lg text-gray-700 lg:py-8 lg:px-4"
              >
                {{ $auth.user.name }}
              </nuxt-link>
            </li>
            <li>
              <a
                href="#"
                @click.prevent="signOut"
                class="text-lg text-gray-700 lg:py-8 lg:px-4"
              >
                Sign out
              </a>
            </li>
          </template>

          <template v-else>
            <li>
              <nuxt-link
                :to="{name: 'auth-signin'}"
                class="text-lg text-gray-700 lg:py-8 lg:px-4"
              >
                Sign in
              </nuxt-link>
            </li>
            <li>
              <nuxt-link
                :to="{name: 'auth-signup'}"
                class="text-lg text-gray-700 lg:py-8 lg:px-4"
              >
                Create an account
              </nuxt-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        mobileNavOpen: false
      }
    },

    methods: {
      async signOut () {
        await this.$auth.logout()
      }
    }
  }
</script>
