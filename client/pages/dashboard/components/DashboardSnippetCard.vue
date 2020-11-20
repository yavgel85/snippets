<template>
  <SnippetCard
    :snippet="snippet"
  >
    <ul class="flex items-end text-gray-600">
      <li class="mr-6">
        <template v-if="snippet.is_public">
          <div class="inline-block px-2 leading-relaxed text-gray-600 rounded bg-gray-400 text-sm">Public</div>
        </template>
        <template v-else>
          <div class="inline-block px-2 leading-relaxed text-gray-600 rounded bg-gray-400 text-sm">Private</div>
        </template>
      </li>

      <li class="mr-6">
        <nuxt-link
          :to="{
            name: 'snippets-id-edit',
            params: {
              id: snippet.uuid
            }
          }"
        >
          Edit
        </nuxt-link>
      </li>
      <li>
        <a href="#" @click.prevent="deleteSnippet">
          Delete
        </a>
      </li>
    </ul>
  </SnippetCard>
</template>

<script>
import SnippetCard from "~/components/snippets/SnippetCard";

export default {
  components: {
    SnippetCard
  },

  props: {
    snippet: {
      required: true,
      type: Object
    }
  },

  methods: {
    async deleteSnippet () {
      if (!window.confirm('Are you sure you want to delete this snippet?')) {
        return
      }

      await this.$axios.$delete(`snippets/${this.snippet.uuid}`)

      this.$emit('deleted', this.snippet)
    }
  }
}
</script>
