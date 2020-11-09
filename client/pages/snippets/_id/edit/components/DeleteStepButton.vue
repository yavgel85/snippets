<template>
  <a
    href="#"
    class="block mb-2 p-3 bg-blue-500 rounded-lg mr-2 lg:mr-0"
    title="Delete step"
    @click.prevent="deleteStep"
  >
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-white h-6 w-6">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
    </svg>
  </a>
</template>

<script>
export default {
  props: {
    snippet: {
      required: true,
      type: Object
    },

    step: {
      required: true,
      type: Object
    }
  },

  methods: {
    async deleteStep () {
      await this.$axios.delete(`snippets/${this.snippet.uuid}/steps/${this.step.uuid}`)

      this.$emit('deleted', this.step)
    }
  }
}
</script>
