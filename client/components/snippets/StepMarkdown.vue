<template>
  <div v-html="markdown"></div>
</template>

<script>
import hljs from 'highlight.js'
// import 'highlight.js/styles/github.css';

let markdown = require('markdown-it')({
  highlight(str, lang) {
    let esc = markdown.utils.escapeHtml;

    if (lang && hljs.getLanguage(lang)) {
      return '<pre class="hljs javascript language-' + esc(lang.toLowerCase()) +'"><code>' + hljs.highlightAuto(str).value + '</code></pre>';
    }
    return '<pre class="hljs"><code>' + esc(str) + '</code></pre>';
  }
})

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
