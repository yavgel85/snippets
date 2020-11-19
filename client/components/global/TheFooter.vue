<template>
  <div class="mt-24 mb-12">
    <div class="container flex flex-wrap lg:flex-no-wrap justify-between">
      <ul class="flex items-center mb-6 lg:mb-0">
        <li class="mr-16">
          <nuxt-link
            class="text-gray-500 text-sm mb-2 inline-block"
            :to="{
              name: 'index'
            }"
          >
            Home
          </nuxt-link>

          <div class="text-gray-500 text-sm">
            &copy; Yavgel Ltd 2020-{{ new Date().getFullYear() }}. All rights reserved.
          </div>
        </li>
      </ul>

      <ul class="flex flex-wrap lg:flex-no-wrap items-end">
        <li class="mr-8 w-full lg:w-auto">
          <a
            class="text-gray-500 text-sm"
            href="#"
            target="_blank"
            rel="noopener"
          >
            Terms
          </a>
        </li>
        <li class="mr-8 w-full lg:w-auto">
          <a
            class="text-gray-500 text-sm"
            href="#"
            target="_blank"
            rel="noopener"
          >
            Privacy policy
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {

}
</script>
