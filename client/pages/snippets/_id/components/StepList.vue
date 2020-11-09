<template>
  <ul>
    <li class="mb-1" v-for="(step, index) in steps" :key="index">
      <nuxt-link
        :to="{
          query: {
            step: step.uuid
          }
        }"
        :class="{
          'font-bold': currentStep.uuid === step.uuid
        }"
      >
        {{ index + 1}}. {{ step.title || 'Untitled step' }}
      </nuxt-link>
    </li>
  </ul>
</template>

<script>
  export default {
    props: {
      steps: {
        required: true,
        type: Array
      },

      currentStep: {
        required: true,
        type: Object
      }
    }
  }
</script>
