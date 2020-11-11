<template>
  <div v-html="markdown"></div>
</template>

<script>
let markdown = require('markdown-it')()

export default {
  props: {
    value: {
      required: true,
      type: String
    }
  },

  computed: {
    markdown () {
      return markdown.render(this.value)
    }
  }
}
</script>
