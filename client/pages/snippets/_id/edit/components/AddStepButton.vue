<template>
  <a
    href="#"
    @click.prevent="addStep"
    class="block mb-2 p-3 bg-blue-500 rounded-lg"
    :title="`Add step ${position}`"
  >
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="fill-current text-white h-6 w-6">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
    </svg>
  </a>
</template>

<script>
export default {
  props: {
    position: {
      required: true,
      type: String
    },

    snippet: {
      required: true,
      type: Object
    },

    currentStep: {
      required: true,
      type: Object
    }
  },

  methods: {
    async addStep () {
      let response = await this.$axios.$post(`snippets/${this.snippet.uuid}/steps`, {
        [this.position]: this.currentStep.uuid
      })

      this.$emit('added', response.data)
    }
  }
}
</script>
